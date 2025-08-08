<?php

namespace App\Livewire;

use App\Models\Exercise;
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
