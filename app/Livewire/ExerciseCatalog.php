<?php

namespace App\Livewire;

use App\Models\Exercise;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ExerciseCatalog extends Component
{
    // 検索用プロパティ
    public $searchExercise = '';

    // フィルター用プロパティ
    public $categoryFilter = 'all';

    public $difficultyFilter = 'all';

    // ソート用プロパティ
    public $sortBy = 'name';

    // エクササイズデータ
    public $exercises = [];

    // モーダル関連のプロパティ
    public $showModal = false;

    public $selectedExercise = null;

    // ローディング状態
    public $loading = false;

    public function mount()
    {
        $this->updateExercises();
    }

    public function updatedSearchExercise()
    {
        $this->updateExercises();
    }

    public function updatedCategoryFilter()
    {
        $this->updateExercises();
    }

    public function updatedDifficultyFilter()
    {
        $this->updateExercises();
    }

    public function updatedSortBy()
    {
        $this->updateExercises();
    }

    public function clear()
    {
        $this->searchExercise = '';
        $this->categoryFilter = 'all';
        $this->difficultyFilter = 'all';
        $this->sortBy = 'name';

        $this->updateExercises();

        $this->dispatch('clearSearchInput');
        // UI上のセレクトも初期表示に戻す
        $this->dispatch('resetFilterSelects');
    }

    /**
     * エクササイズ詳細モーダルを開く
     */
    public function showExerciseDetails($exerciseId)
    {
        $this->loading = true;

        try {
            $this->selectedExercise = Exercise::find($exerciseId);

            if ($this->selectedExercise) {
                $this->showModal = true;
            } else {
                session()->flash('error', 'Exercise not found.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error loading exercise details.');
            Log::error('Exercise details loading error: '.$e->getMessage());
        } finally {
            $this->loading = false;
        }
    }

    /**
     * モーダルを閉じる
     */
    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedExercise = null;
    }

    /**
     * エクササイズをメニューに追加
     */
    // public function addToMenu($exerciseId)
    // {
    //     try {
    //         $exercise = Exercise::find($exerciseId);

    //         if (!$exercise) {
    //             session()->flash('error', 'Exercise not found.');
    //             return;
    //         }

    //         // 親コンポーネントにイベントを送信（メニュー作成ページで使用）
    //         $this->dispatch('exerciseAdded', [
    //             'exerciseId' => $exerciseId,
    //             'exerciseName' => $exercise->name
    //         ]);

    //         // モーダルを閉じる
    //         $this->closeModal();

    //         // 成功メッセージを表示
    //         session()->flash('message', "'{$exercise->name}' がメニューに追加されました！");

    //     } catch (\Exception $e) {
    //         session()->flash('error', 'エクササイズの追加に失敗しました。');
    //         \Log::error('Add exercise to menu error: ' . $e->getMessage());
    //     }
    // }

    /**
     * 難易度バッジのCSSクラスを取得
     */
    public function getDifficultyBadgeClass($difficulty)
    {
        return match ($difficulty) {
            'beginner' => 'bg-success',
            'intermediate' => 'bg-warning text-dark',
            'advanced' => 'bg-danger',
            default => 'bg-secondary'
        };
    }

    /**
     * 難易度ラベルを取得
     */
    public function getDifficultyLabel($difficulty)
    {
        return match ($difficulty) {
            'beginner' => 'Beginner',
            'intermediate' => 'Intermediate',
            'advanced' => 'Advanced',
            default => 'Unknown'
        };
    }

    private function updateExercises()
    {
        // アクティブなエクササイズのみを取得するクエリを開始
        $query = Exercise::active();

        // 検索条件の適用（Exerciseモデルのスコープを使用）
        if (! empty($this->searchExercise)) {
            $query->searchByName($this->searchExercise);
        }

        // カテゴリフィルターの適用（Exerciseモデルのスコープを使用）
        if ($this->categoryFilter !== 'all') {
            $query->byMuscleGroup($this->categoryFilter);
        }

        // 難易度フィルターの適用（Exerciseモデルのスコープを使用）
        if ($this->difficultyFilter !== 'all') {
            $query->byDifficulty($this->difficultyFilter);
        }

        // ソート条件の適用
        switch ($this->sortBy) {
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'difficulty':
                // 難易度順（初級→中級→上級）
                $query->orderByRaw("
                    CASE difficulty 
                        WHEN 'beginner' THEN 1 
                        WHEN 'intermediate' THEN 2 
                        WHEN 'advanced' THEN 3 
                        ELSE 4 
                    END
                ");
                break;
            default:
                $query->orderBy('name', 'asc');
                break;
        }

        // 結果を取得してプロパティに保存
        $this->exercises = $query->get();
    }

    public function render()
    {
        return view('livewire.exercise-catalog');
    }
}
