<?php

namespace App\Livewire;

use App\Models\Exercise;
use App\Models\Menu;
use App\Models\MenuExercise;
use App\Models\Template;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ExerciseEditorEdit extends Component
{
    // 編集対象のメニュー
    public $menu;

    // メニューの基本情報
    public $menuName = '';

    public $basedOnTemplateId = null;

    public $isActive = true;

    // エクササイズリスト
    public $exercises = [];

    // バリデーションエラー
    public $errors = [];

    // 保存状態
    public $saving = false;

    protected $listeners = [
        'exerciseAdded' => 'addExercise',
        'templateSelected' => 'loadFromTemplate',
    ];

    public function mount(Menu $menu)
    {
        // 権限チェック
        if ($menu->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this menu.');
        }

        $this->menu = $menu;

        // 既存データの読み込み
        $this->loadExistingData();
    }

    /**
     * 既存のメニューデータを読み込み
     */
    private function loadExistingData()
    {
        // メニューの基本情報を設定
        $this->menuName = $this->menu->name;
        $this->basedOnTemplateId = $this->menu->based_on_template_id;
        $this->isActive = $this->menu->is_active;

        // 既存のエクササイズを読み込み
        $this->menu->load(['menuExercises' => function ($query) {
            $query->orderBy('order_index');
        }, 'menuExercises.exercise']);

        $this->exercises = [];
        foreach ($this->menu->menuExercises as $menuExercise) {
            $this->exercises[] = [
                'exercise_id' => $menuExercise->exercise_id,
                'exercise_name' => $menuExercise->exercise->name,
                'order_index' => $menuExercise->order_index,
                'sets' => $menuExercise->sets,
                'reps' => $menuExercise->reps,
                'weight' => $menuExercise->weight,
                'rest_seconds' => $menuExercise->rest_seconds,
                'duration_seconds' => null,
            ];
        }

        // エラーをクリア
        $this->errors = [];
    }

    /**
     * Exercise Catalogからエクササイズを追加
     */
    public function addExercise($data)
    {
        $exerciseId = $data['exerciseId'];
        $exerciseName = $data['exerciseName'] ?? '';

        // 既に追加されているかチェック
        foreach ($this->exercises as $exercise) {
            if ($exercise['exercise_id'] == $exerciseId) {
                session()->flash('warning', "'{$exerciseName}' is already added to the menu.");

                return;
            }
        }

        // 新しいエクササイズを追加
        $this->exercises[] = [
            'exercise_id' => $exerciseId,
            'exercise_name' => $exerciseName,
            'order_index' => count($this->exercises) + 1,
            'sets' => null,
            'reps' => null,
            'weight' => null,
            'rest_seconds' => null,
            'duration_seconds' => null,
        ];

        // エラーをクリア
        if (isset($this->errors['exercises'])) {
            unset($this->errors['exercises']);
        }

        session()->flash('message', "'{$exerciseName}' has been added to your menu!");
    }

    /**
     * Template Libraryからテンプレートを読み込み
     */
    public function loadFromTemplate($data)
    {
        $templateId = $data['templateId'];
        $templateName = $data['templateName'] ?? '';

        try {
            $template = Template::with('templateExercises.exercise')->find($templateId);

            if ($template && $template->templateExercises) {
                // テンプレートIDを記録
                $this->basedOnTemplateId = $templateId;

                // 現在のエクササイズ数を取得（order_indexの開始位置）
                $currentExerciseCount = count($this->exercises);

                // テンプレートのエクササイズを既存のエクササイズに追加
                foreach ($template->templateExercises as $index => $templateExercise) {
                    if ($templateExercise->exercise) {
                        // 重複チェック
                        $exists = false;
                        foreach ($this->exercises as $exercise) {
                            if ($exercise['exercise_id'] == $templateExercise->exercise_id) {
                                $exists = true;
                                break;
                            }
                        }

                        if (! $exists) {
                            $this->exercises[] = [
                                'exercise_id' => $templateExercise->exercise_id,
                                'exercise_name' => $templateExercise->exercise->name,
                                'order_index' => $currentExerciseCount + $index + 1,
                                'sets' => $templateExercise->sets,
                                'reps' => $templateExercise->reps,
                                'weight' => $templateExercise->weight,
                                'rest_seconds' => $templateExercise->rest_seconds,
                                'duration_seconds' => $templateExercise->duration_seconds,
                            ];
                        }
                    }
                }

                // エラーをクリア
                if (isset($this->errors['exercises'])) {
                    unset($this->errors['exercises']);
                }

                $addedCount = count($template->templateExercises);
                session()->flash('message', "Template '{$templateName}' has been loaded! {$addedCount} exercises added to your menu.");
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to load template.');
            Log::error('Template load error: '.$e->getMessage());
        }
    }

    /**
     * エクササイズを削除
     */
    public function removeExercise($index)
    {
        if (isset($this->exercises[$index])) {
            $exerciseName = $this->exercises[$index]['exercise_name'];
            unset($this->exercises[$index]);

            // インデックスを再構築
            $this->exercises = array_values($this->exercises);

            // order_indexを更新
            foreach ($this->exercises as $i => $exercise) {
                $this->exercises[$i]['order_index'] = $i + 1;
            }

            session()->flash('message', "'{$exerciseName}' has been removed from the menu.");
        }
    }

    /**
     * バリデーション
     */
    public function validateMenu()
    {
        $this->errors = [];

        if (empty(trim($this->menuName))) {
            $this->errors['menuName'] = 'Menu name is required.';
        } elseif (strlen($this->menuName) > 255) {
            $this->errors['menuName'] = 'Menu name must be less than 255 characters.';
        }

        if (empty($this->exercises)) {
            $this->errors['exercises'] = 'Please add at least one exercise to your menu.';
        }

        // 各エクササイズのバリデーション
        foreach ($this->exercises as $index => $exercise) {
            if (empty($exercise['exercise_name'])) {
                $this->errors["exercise_{$index}_name"] = 'Exercise name is required.';
            }
        }

        return empty($this->errors);
    }

    /**
     * メニューをクリア
     */
    public function clearMenu()
    {
        $this->exercises = [];
        $this->errors = [];

        session()->flash('message', 'All exercises have been cleared.');
    }

    /**
     * メニューを更新
     */
    public function saveMenu()
    {
        if (! $this->validateMenu()) {
            session()->flash('error', 'Please fix the errors before saving.');

            return;
        }

        $this->saving = true;

        try {
            DB::transaction(function () {
                // メニューの基本情報を更新
                $this->menu->update([
                    'name' => trim($this->menuName),
                    'based_on_template_id' => $this->basedOnTemplateId,
                    'is_active' => $this->isActive,
                ]);

                // 既存のエクササイズを削除
                $this->menu->menuExercises()->delete();

                // 新しいエクササイズを追加
                foreach ($this->exercises as $exerciseData) {
                    MenuExercise::create([
                        'menu_id' => $this->menu->id,
                        'exercise_id' => $exerciseData['exercise_id'],
                        'order_index' => $exerciseData['order_index'],
                        'sets' => $exerciseData['sets'],
                        'reps' => $exerciseData['reps'],
                        'weight' => $exerciseData['weight'],
                        'rest_seconds' => $exerciseData['rest_seconds'],
                        'duration_seconds' => $exerciseData['duration_seconds'] ?? null,
                    ]);
                }

                session()->flash('success', "Menu '{$this->menuName}' has been updated successfully!");
            });

            // リダイレクト
            return redirect()->route('menus.index', $this->menu);

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update menu. Please try again.');
            Log::error('Menu update error: '.$e->getMessage());
        } finally {
            $this->saving = false;
        }
    }

    /**
     * 総セット数を計算
     */
    public function getTotalSets()
    {
        return array_sum(array_column($this->exercises, 'sets'));
    }

    public function render()
    {
        return view('livewire.exercise-editor-edit');
    }
}
