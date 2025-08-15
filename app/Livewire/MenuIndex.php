<?php

namespace App\Livewire;

use App\Models\Exercise;
use App\Models\Menu;
use App\Models\Template;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MenuIndex extends Component
{
    // フィルター用のプロパティ
    public $search = '';

    public $difficulty = [];

    public $visibility = [];

    public $tags = [];

    public $duration_min = '';

    public $duration_max = '';

    public $sort = 'date';

    // データ用のプロパティ
    public $exercises;

    public $templates;

    public $muscleGroups = [];

    public $equipmentCategories = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'difficulty' => ['except' => []],
        'visibility' => ['except' => []],
        'tags' => ['except' => []],
        'duration_min' => ['except' => ''],
        'duration_max' => ['except' => ''],
        'sort' => ['except' => 'date'],
    ];

    public function mount()
    {
        // 初期データを読み込み
        $this->loadFilterData();
    }

    public function updatedSearch()
    {
        // 検索が更新されたときの処理
    }

    public function updatedDifficulty()
    {
        // 難易度フィルターが更新されたときの処理
    }

    public function updatedVisibility()
    {
        // 公開設定フィルターが更新されたときの処理
    }

    public function updatedTags()
    {
        // タグフィルターが更新されたときの処理
    }

    public function updatedSort()
    {
        // ソートが更新されたときの処理
    }

    public function clearFilters()
    {
        $this->reset(['search', 'difficulty', 'visibility', 'tags', 'duration_min', 'duration_max']);
        $this->sort = 'date';
    }

    public function deleteMenu($menuId)
    {
        $menu = Menu::where('user_id', Auth::id())->findOrFail($menuId);
        $menu->delete();

        session()->flash('success', 'Menu deleted successfully.');
    }

    public function render()
    {
        $menus = $this->getFilteredMenus();
        $counts = $this->getCounts();

        return view('livewire.menu-index', [
            'menus' => $menus,
            'difficultyCounts' => $counts['difficulty'],
            'visibilityCounts' => $counts['visibility'],
            'tagCounts' => $counts['tags'],
        ]);
    }

    private function loadFilterData()
    {
        $this->exercises = Exercise::active()->get();
        $this->templates = Template::active()->get();

        // Extract unique muscle groups for filtering
        $this->muscleGroups = $this->exercises->flatMap(function ($exercise) {
            return $exercise->muscle_groups ?? [];
        })->unique()->values()->toArray();

        // Extract unique equipment categories for filtering
        $this->equipmentCategories = $this->exercises->pluck('equipment_category')
            ->unique()
            ->filter()
            ->values()
            ->toArray();
    }

    private function getFilteredMenus()
    {
        // Start query builder
        $query = Menu::query()
            ->with([
                'basedOnTemplate',
                'menuExercises.exercise',
            ])
            ->forUser(Auth::id());

        // Apply filters
        $this->applyDifficultyFilter($query);
        $this->applyVisibilityFilter($query);
        $this->applyTagsFilter($query);
        $this->applyDurationFilter($query);
        $this->applySearchFilter($query);
        $this->applySorting($query);

        return $query->get();
    }

    private function applyDifficultyFilter($query)
    {
        if (! empty($this->difficulty)) {
            $query->where(function ($q) {
                foreach ($this->difficulty as $difficulty) {
                    $q->orWhereHas('basedOnTemplate', function ($subQ) use ($difficulty) {
                        $subQ->where('difficulty', $difficulty);
                    });
                }
            });
        }
    }

    private function applyVisibilityFilter($query)
    {
        if (! empty($this->visibility)) {
            if (in_array('public', $this->visibility) && ! in_array('private', $this->visibility)) {
                $query->where('is_active', true);
            } elseif (in_array('private', $this->visibility) && ! in_array('public', $this->visibility)) {
                $query->where('is_active', false);
            }
        }
    }

    private function applyTagsFilter($query)
    {
        if (! empty($this->tags)) {
            $query->where(function ($q) {
                foreach ($this->tags as $tag) {
                    $q->orWhereHas('menuExercises.exercise', function ($subQ) use ($tag) {
                        $subQ->whereJsonContains('muscle_groups', $tag);
                    });
                }
            });
        }
    }

    private function applyDurationFilter($query)
    {
        if ($this->duration_min) {
            $query->where('estimated_duration', '>=', $this->duration_min);
        }
        if ($this->duration_max) {
            $query->where('estimated_duration', '<=', $this->duration_max);
        }
    }

    private function applySearchFilter($query)
    {
        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%");
        }
    }

    private function applySorting($query)
    {
        switch ($this->sort) {
            case 'name':
                $query->orderBy('name');
                break;
            case 'exercises':
                // エクササイズ数でのソートは複雑なため、デフォルトに戻す
                $query->latest();
                break;
            case 'duration':
                $query->orderBy('estimated_duration');
                break;
            case 'date':
            default:
                $query->latest();
                break;
        }
    }

    private function getCounts()
    {
        $userId = Auth::id();

        return [
            'difficulty' => [
                'beginner' => Menu::forUser($userId)
                    ->whereHas('basedOnTemplate', function ($q) {
                        $q->where('difficulty', 'beginner');
                    })->count(),
                'intermediate' => Menu::forUser($userId)
                    ->whereHas('basedOnTemplate', function ($q) {
                        $q->where('difficulty', 'intermediate');
                    })->count(),
                'advanced' => Menu::forUser($userId)
                    ->whereHas('basedOnTemplate', function ($q) {
                        $q->where('difficulty', 'advanced');
                    })->count(),
            ],
            'visibility' => [
                'public' => Menu::forUser($userId)->where('is_active', true)->count(),
                'private' => Menu::forUser($userId)->where('is_active', false)->count(),
            ],
            'tags' => collect($this->muscleGroups)->mapWithKeys(function ($muscleGroup) use ($userId) {
                return [
                    $muscleGroup => Menu::forUser($userId)
                        ->whereHas('menuExercises.exercise', function ($q) use ($muscleGroup) {
                            $q->whereJsonContains('muscle_groups', $muscleGroup);
                        })->count(),
                ];
            })->toArray(),
        ];
    }
}
