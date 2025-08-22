<?php

namespace App\Livewire\Training;

use App\Models\Menu;
use App\Models\TrainingRecord;
use App\Models\TrainingRecordDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app', ['hideNavigation' => true])]
#[Title('Training Wizard')]
class TrainingWizard extends Component
{
    // ステップ管理
    public int $currentStep = 1;

    public array $completedSteps = [];

    // 選択されたメニュー
    public ?int $selectedMenuId = null;

    // セッションデータ
    public ?int $trainingRecordId = null;

    public array $workoutSets = [];

    public string $notes = '';

    // Step1: 検索・フィルタ
    public string $searchTerm = '';

    public string $selectedCategory = 'all';

    // public string $selectedDifficulty = 'all';

    // ローディング状態
    public bool $isTransitioning = false;

    // 完了データ
    public ?TrainingRecord $completedRecord = null;

    public function mount(?int $menuId = null)
    {
        if ($menuId) {
            $this->selectedMenuId = $menuId;
            $this->goToStep(2);
        }
    }

    #[Computed]
    public function menus()
    {
        $query = Menu::with(['menuExercises.exercise'])
            ->where('user_id', Auth::id())
            ->where('is_active', true);

        // 検索
        if ($this->searchTerm) {
            $searchTerm = trim($this->searchTerm);

            if (! empty($searchTerm)) {
                // LIKE句の特殊文字をエスケープ
                $escapedTerm = str_replace(['%', '_'], ['\\%', '\\_'], $searchTerm);
                $query->where('name', 'like', '%'.$escapedTerm.'%');
            }
        }

        // カテゴリフィルタ（メニューに含まれるエクササイズのmuscle_groupsから判定）
        if ($this->selectedCategory !== 'all') {
            $query->whereHas('menuExercises.exercise', function ($q) {
                $q->whereJsonContains('muscle_groups', $this->selectedCategory);
            });
        }

        // 難易度フィルタ（メニューに含まれるエクササイズの平均難易度から判定）
        // if ($this->selectedDifficulty !== 'all') {
        //     $query->whereHas('menuExercises.exercise', function ($q) {
        //         $q->where('difficulty', $this->selectedDifficulty);
        //     });
        // }

        return $query->get();
    }

    #[Computed]
    public function selectedMenu()
    {
        if (! $this->selectedMenuId) {
            return null;
        }

        return Menu::with(['menuExercises.exercise'])
            ->find($this->selectedMenuId);
    }

    #[Computed]
    public function categories()
    {
        // ユーザーのメニューに含まれる全muscle_groupsを取得
        $muscleGroups = collect();

        Menu::where('user_id', Auth::id())
            ->with('menuExercises.exercise')
            ->get()
            ->each(function ($menu) use ($muscleGroups) {
                $menu->menuExercises->each(function ($menuExercise) use ($muscleGroups) {
                    if ($menuExercise->exercise && $menuExercise->exercise->muscle_groups) {
                        $muscleGroups->push(...$menuExercise->exercise->muscle_groups);
                    }
                });
            });

        return $muscleGroups->unique()->values()->toArray();
    }

    public function selectMenu(int $menuId)
    {
        // トグル機能：既に選択されているメニューをクリックした場合は選択を解除
        if ($this->selectedMenuId === $menuId) {
            $this->selectedMenuId = null;
            $this->dispatch('menu-deselected');
        } else {
            $this->selectedMenuId = $menuId;
            $this->dispatch('menu-selected');
        }
    }

    public function goToStep1()
    {
        $this->currentStep = 1;
    }

    public function goToStep2()
    {
        if (! $this->selectedMenuId) {
            return;
        }

        $this->initializeWorkoutSets();
        $this->markStepCompleted(1);
        $this->currentStep = 2;
    }

    public function goToStep3()
    {
        // 最低1セット以上が必要
        if (empty($this->workoutSets)) {
            $this->addError('sets', 'Add at least one exercise before saving your workout plan.');

            return;
        }

        $this->markStepCompleted(2);
        $this->currentStep = 3;
    }

    public function goToStep4()
    {
        $success = $this->saveTrainingRecord();

        if ($success) {
            $this->markStepCompleted(3);
            $this->currentStep = 4;
        }
    }

    public function goToPreviousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    private function initializeWorkoutSets()
    {
        $menu = $this->selectedMenu;
        if (! $menu) {
            return;
        }

        $this->workoutSets = [];

        foreach ($menu->menuExercises as $index => $menuExercise) {
            $previousRecord = $this->getPreviousRecord($menuExercise->exercise_id);

            // ユーザーがセット数を設定している場合はその数、設定していない場合はデフォルトで1セット作成
            $setsCount = $menuExercise->sets ?? 1;
            for ($setNumber = 1; $setNumber <= $setsCount; $setNumber++) {
                $this->workoutSets[] = [
                    'id' => uniqid(),
                    'exercise_id' => $menuExercise->exercise_id,
                    'exercise_name' => $menuExercise->exercise->name,
                    'order_index' => $index + 1,
                    'set_number' => $setNumber,
                    'weight' => $previousRecord['weight'] ?? $menuExercise->weight,
                    'reps' => $previousRecord['reps'] ?? $menuExercise->reps,
                    'rest_seconds' => $previousRecord['rest_seconds'] ?? $menuExercise->rest_seconds ?? 60,
                    'completed' => false,
                ];
            }
        }
    }

    private function getPreviousRecord(int $exerciseId): array
    {
        $lastRecord = TrainingRecordDetail::where('exercise_id', $exerciseId)
            ->whereHas('trainingRecord', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->orderBy('created_at', 'desc')
            ->first();

        if (! $lastRecord) {
            return [];
        }

        return [
            'weight' => $lastRecord->weight,
            'reps' => $lastRecord->reps,
            'rest_seconds' => $lastRecord->rest_seconds,
            'date' => $lastRecord->created_at->format('Y-m-d'),
        ];
    }

    public function addSet(int $exerciseId)
    {
        $exerciseSets = collect($this->workoutSets)
            ->where('exercise_id', $exerciseId)
            ->sortBy('set_number');

        $lastSet = $exerciseSets->last();
        $newSetNumber = $lastSet ? $lastSet['set_number'] + 1 : 1;

        $exercise = $this->selectedMenu->menuExercises
            ->firstWhere('exercise_id', $exerciseId);

        $this->workoutSets[] = [
            'id' => uniqid(),
            'exercise_id' => $exerciseId,
            'exercise_name' => $exercise->exercise->name,
            'order_index' => $lastSet['order_index'] ?? 1,
            'set_number' => $newSetNumber,
            'weight' => $lastSet['weight'] ?? null,
            'reps' => $lastSet['reps'] ?? null,
            'rest_seconds' => $lastSet['rest_seconds'] ?? 60,
            'completed' => false,
        ];
    }

    public function removeSet(string $setId)
    {
        $this->workoutSets = collect($this->workoutSets)
            ->reject(fn ($set) => $set['id'] === $setId)
            ->values()
            ->toArray();
    }

    public function updateSet(string $setId, string $field, $value)
    {
        $this->workoutSets = collect($this->workoutSets)
            ->map(function ($set) use ($setId, $field, $value) {
                if ($set['id'] === $setId) {
                    $set[$field] = $value;
                }

                return $set;
            })
            ->toArray();
    }

    public function toggleSetCompletion(string $setId)
    {
        $this->updateSet(
            $setId,
            'completed',
            ! collect($this->workoutSets)->firstWhere('id', $setId)['completed']
        );
    }

    public function applyPreviousRecord(int $exerciseId)
    {
        $previousRecord = $this->getPreviousRecord($exerciseId);

        if (empty($previousRecord)) {
            return;
        }

        $this->workoutSets = collect($this->workoutSets)
            ->map(function ($set) use ($exerciseId, $previousRecord) {
                if ($set['exercise_id'] === $exerciseId) {
                    $set['weight'] = $previousRecord['weight'];
                    $set['reps'] = $previousRecord['reps'];
                    $set['rest_seconds'] = $previousRecord['rest_seconds'];
                }

                return $set;
            })
            ->toArray();
    }

    private function saveTrainingRecord()
    {
        DB::beginTransaction();

        try {
            // バリデーション追加
            if (! $this->selectedMenuId) {
                $this->addError('save', 'メニューが選択されていません。');

                return false;
            }

            if (empty(collect($this->workoutSets)->where('completed', true))) {
                $this->addError('save', '完了したセットがありません。');

                return false;
            }

            // TrainingRecord作成
            $record = TrainingRecord::create([
                'user_id' => Auth::id(),
                'training_date' => now()->toDateString(),
                'menu_id' => $this->selectedMenuId,
                'notes' => $this->notes,
            ]);

            // TrainingRecordDetail作成（完了したセットのみ）
            $completedSets = collect($this->workoutSets)
                ->where('completed', true);

            foreach ($completedSets as $set) {
                // 各フィールドのバリデーション
                if (! isset($set['exercise_id']) || ! $set['exercise_id']) {
                    $this->addError('save', '無効なエクササイズデータが含まれています。');
                    DB::rollback();

                    return false;
                }

                TrainingRecordDetail::create([
                    'training_record_id' => $record->id,
                    'exercise_id' => $set['exercise_id'],
                    'order_index' => $set['order_index'] ?? 1,
                    'set_number' => $set['set_number'] ?? 1,
                    'weight' => $set['weight'] ?? 0,
                    'reps' => $set['reps'] ?? 0,
                    'rest_seconds' => $set['rest_seconds'] ?? 60,
                ]);
            }

            DB::commit();

            $this->completedRecord = $record;
            $this->trainingRecordId = $record->id;

            return true;
        } catch (\Exception $e) {
            DB::rollback();

            // ログに詳細を記録
            Log::error('Training record save failed', [
                'user_id' => Auth::id(),
                'menu_id' => $this->selectedMenuId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            $this->addError('save', '保存中にエラーが発生しました。再度お試しください。');

            return false;
        }
    }

    private function markStepCompleted(int $step)
    {
        if (! in_array($step, $this->completedSteps)) {
            $this->completedSteps[] = $step;
        }
    }

    public function getCompletedSetsCount(): int
    {
        return collect($this->workoutSets)
            ->where('completed', true)
            ->count();
    }

    public function getTotalVolume(): float
    {
        return collect($this->workoutSets)
            ->where('completed', true)
            ->sum(fn ($set) => ($set['weight'] ?? 0) * ($set['reps'] ?? 0));
    }

    public function getUniqueExercisesCount(): int
    {
        return collect($this->workoutSets)
            ->pluck('exercise_id')
            ->unique()
            ->count();
    }

    public function getEstimatedDuration(): int
    {
        $totalSeconds = collect($this->workoutSets)
            ->where('completed', true)
            ->sum(function ($set) {
                $workTime = 60; // 1セットあたり60秒と仮定
                $restTime = $set['rest_seconds'] ?? 0;

                return $workTime + $restTime;
            });

        return ceil($totalSeconds / 60); // 分に変換
    }

    public function redirectToStats()
    {
        return redirect()->route('training-history.index');
    }

    public function createNew()
    {
        // リセット
        $this->reset();
        $this->currentStep = 1;
    }

    public function goHome()
    {
        return redirect()->route('dashboard');
    }

    public function render(): View
    {
        return view('livewire.training.training-wizard');
    }
}
