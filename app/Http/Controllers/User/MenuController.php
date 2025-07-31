<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\Menu;
use App\Models\Template;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // Start query builder
        $query = Menu::query()
            ->with([
                'basedOnTemplate',
                'menuExercises.exercise',
            ])
            ->forUser(auth()->user()->id);

        // Apply filters from request

        // Difficulty filter
        if ($request->filled('difficulty')) {
            $difficulties = $request->input('difficulty');
            // この部分は複雑なため、実際のデータ構造に応じて実装が必要
            // 例: テンプレートベースのメニューの場合
            if (in_array('beginner', $difficulties)) {
                $query->whereHas('basedOnTemplate', function ($q) {
                    $q->where('difficulty', 'beginner');
                });
            }
            // 他の難易度も同様に
        }

        // Visibility filter
        if ($request->filled('visibility')) {
            $visibility = $request->input('visibility');
            if (in_array('public', $visibility) && ! in_array('private', $visibility)) {
                $query->where('is_active', true);
            } elseif (in_array('private', $visibility) && ! in_array('public', $visibility)) {
                $query->where('is_active', false);
            }
            // 両方選択されている場合は条件なし（すべて表示）
        }

        // Tags filter (複雑なため、実際のデータ構造に応じて実装が必要)
        if ($request->filled('tags')) {
            $tags = $request->input('tags');
            // 例: 全身タグのフィルタリング
            if (in_array('fullbody', $tags)) {
                $query->whereHas('menuExercises.exercise', function ($q) {
                    $q->whereJsonContains('muscle_groups', '全身');
                });
            }
            // 他のタグも同様に
        }

        // Duration range filter
        if ($request->filled('duration_min')) {
            // 時間による絞り込みは複雑なため、別途実装が必要
            // この例では簡略化のためスキップ
        }

        // Text search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Sort options
        $sort = $request->input('sort', 'date');
        switch ($sort) {
            case 'name':
                $query->orderBy('name');
                break;
            case 'exercises':
                // エクササイズ数でのソートは複雑なため、別途実装が必要
                // この例では簡略化のためスキップ
                $query->latest(); // デフォルトに戻す
                break;
            case 'duration':
                // 時間でのソートも複雑なため、別途実装が必要
                // この例では簡略化のためスキップ
                $query->latest(); // デフォルトに戻す
                break;
            case 'date':
            default:
                $query->latest();
                break;
        }

        // Execute query
        $menus = $query->get();

        // Get data for filter options
        $exercises = Exercise::active()->get();
        $templates = Template::active()->get();

        // Extract unique muscle groups for filtering
        $muscleGroups = $exercises->flatMap(function ($exercise) {
            return $exercise->muscle_groups ?? [];
        })->unique()->values()->toArray();

        // Extract unique equipment categories for filtering
        $equipmentCategories = $exercises->pluck('equipment_category')
            ->unique()
            ->filter()
            ->values()
            ->toArray();

        // Pass current filter values to view for form persistence
        $filters = [
            'difficulty' => $request->input('difficulty', []),
            'visibility' => $request->input('visibility', []),
            'tags' => $request->input('tags', []),
            'duration_min' => $request->input('duration_min'),
            'duration_max' => $request->input('duration_max'),
            'search' => $request->input('search'),
            'sort' => $sort,
        ];

        return view('user.menus.index', compact(
            'menus',
            'exercises',
            'templates',
            'muscleGroups',
            'equipmentCategories',
            'filters'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get active templates
        $templates = Template::with('templateExercises.exercise')
            ->active()
            ->get();

        // Get all active exercises for the catalog
        $exercises = Exercise::active()
            ->orderBy('name')
            ->get();

        // Group exercises by category
        $exercisesByCategory = $exercises->groupBy('equipment_category');

        // Extract unique muscle groups for filtering
        $muscleGroups = $exercises->flatMap(function ($exercise) {
            return $exercise->muscle_groups ?? [];
        })->unique()->values()->toArray();

        return view('user.menus.create', compact(
            'templates',
            'exercises',
            'exercisesByCategory',
            'muscleGroups'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'based_on_template_id' => 'required|exists:templates,id',
        ]);

        $validated['user_id'] = auth()->user()->id;
        $validated['is_active'] = true;

        $menu = Menu::create($validated);

        return redirect()
            ->route('menus.show', $menu)
            ->with('success', 'Menu created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu): View
    {
        // Ensure user can only access their own menus
        if ($menu->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized access to this menu.');
        }

        // Eager load menu relationships with exercise details
        $menu->load([
            'basedOnTemplate',
            'menuExercises' => function ($query) {
                $query->ordered();
            },
            'menuExercises.exercise',
        ]);

        // Calculate menu statistics
        $stats = [
            'exerciseCount' => $menu->menuExercises->count(),
            'totalSets' => $menu->menuExercises->sum('sets'),
            'estimatedTime' => $this->calculateEstimatedTime($menu->menuExercises),
            'totalVolume' => $this->calculateTotalVolume($menu->menuExercises),
        ];

        return view('user.menus.show', compact('menu', 'stats'));
    }

    /**
     * Calculate estimated workout time in minutes.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $menuExercises
     */
    private function calculateEstimatedTime($menuExercises): int
    {
        $totalTime = 0;

        foreach ($menuExercises as $menuExercise) {
            // Add time for each set (average 30-60 seconds per set)
            $setTime = ($menuExercise->sets ?? 0) * 45;

            // Add rest time between sets
            $restTime = ($menuExercise->sets ?? 0) * ($menuExercise->rest_seconds ?? 60);

            // For first set, no rest before
            if ($menuExercise->sets > 0) {
                $restTime -= ($menuExercise->rest_seconds ?? 60);
            }

            $totalTime += $setTime + $restTime;
        }

        // Convert to minutes and round up
        return ceil($totalTime / 60);
    }

    /**
     * Calculate total volume (weight × sets × reps) for strength exercises.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $menuExercises
     */
    private function calculateTotalVolume($menuExercises): int
    {
        $totalVolume = 0;

        foreach ($menuExercises as $menuExercise) {
            // Skip exercises without weights
            if (empty($menuExercise->weight)) {
                continue;
            }

            $volume = $menuExercise->weight * ($menuExercise->sets ?? 0) * ($menuExercise->reps ?? 0);
            $totalVolume += $volume;
        }

        return (int) $totalVolume;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu): View
    {
        // Ensure user can only edit their own menus
        if ($menu->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized access to this menu.');
        }

        // Load menu with its exercises in correct order
        $menu->load([
            'basedOnTemplate',
            'menuExercises' => function ($query) {
                $query->ordered();
            },
            'menuExercises.exercise',
        ]);

        // Get active templates
        $templates = Template::with('templateExercises.exercise')
            ->active()
            ->get();

        // Get all active exercises for the catalog
        $exercises = Exercise::active()
            ->orderBy('name')
            ->get();

        // Group exercises by category
        $exercisesByCategory = $exercises->groupBy('equipment_category');

        // Extract unique muscle groups for filtering
        $muscleGroups = $exercises->flatMap(function ($exercise) {
            return $exercise->muscle_groups ?? [];
        })->unique()->values()->toArray();

        return view('user.menus.edit', compact(
            'menu',
            'templates',
            'exercises',
            'exercisesByCategory',
            'muscleGroups'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu): RedirectResponse
    {
        // Ensure user can only update their own menus
        if ($menu->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized access to this menu.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'based_on_template_id' => 'nullable|exists:templates,id',
            'is_active' => 'boolean',
        ]);

        $menu->update($validated);

        return redirect()
            ->route('menus.show', $menu)
            ->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu): RedirectResponse
    {
        // Ensure user can only delete their own menus
        if ($menu->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized access to this menu.');
        }

        $menu->delete();

        return redirect()
            ->route('menus.index')
            ->with('success', 'Menu deleted successfully.');
    }

    /**
     * Add exercises to a menu.
     */
    public function addExercises(Request $request, Menu $menu): JsonResponse
    {
        // Ensure user can only modify their own menus
        if ($menu->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized access to this menu.');
        }

        $validated = $request->validate([
            'exercises' => 'required|array',
            'exercises.*.exercise_id' => 'required|exists:exercises,id',
            'exercises.*.sets' => 'nullable|integer|min:1',
            'exercises.*.reps' => 'nullable|integer|min:1',
            'exercises.*.weight' => 'nullable|numeric|min:0',
            'exercises.*.rest_seconds' => 'nullable|integer|min:0',
        ]);

        $result = [];

        foreach ($validated['exercises'] as $exerciseData) {
            // Get max order index
            $maxOrder = $menu->menuExercises()->max('order_index') ?? 0;

            // Create new menu exercise
            $menuExercise = $menu->menuExercises()->create([
                'exercise_id' => $exerciseData['exercise_id'],
                'order_index' => $maxOrder + 1,
                'sets' => $exerciseData['sets'] ?? null,
                'reps' => $exerciseData['reps'] ?? null,
                'weight' => $exerciseData['weight'] ?? null,
                'rest_seconds' => $exerciseData['rest_seconds'] ?? null,
            ]);

            // Load exercise details
            $menuExercise->load('exercise');
            $result[] = $menuExercise;
        }

        return response()->json([
            'message' => 'Exercises added successfully',
            'data' => $result,
        ]);
    }

    /**
     * Remove an exercise from a menu.
     */
    public function removeExercise(Menu $menu, $exerciseId): JsonResponse
    {
        // Ensure user can only modify their own menus
        if ($menu->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized access to this menu.');
        }

        $menuExercise = $menu->menuExercises()
            ->where('exercise_id', $exerciseId)
            ->first();

        if (! $menuExercise) {
            return response()->json([
                'message' => 'Exercise not found in this menu',
            ], 404);
        }

        $menuExercise->delete();

        // Reorder remaining exercises
        $this->reindexExercises($menu);

        return response()->json([
            'message' => 'Exercise removed successfully',
        ]);
    }

    /**
     * Update exercise details in a menu.
     */
    public function updateExerciseDetails(Request $request, Menu $menu, $exerciseId): JsonResponse
    {
        // Ensure user can only modify their own menus
        if ($menu->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized access to this menu.');
        }

        $menuExercise = $menu->menuExercises()
            ->where('exercise_id', $exerciseId)
            ->first();

        if (! $menuExercise) {
            return response()->json([
                'message' => 'Exercise not found in this menu',
            ], 404);
        }

        $validated = $request->validate([
            'sets' => 'nullable|integer|min:1',
            'reps' => 'nullable|integer|min:1',
            'weight' => 'nullable|numeric|min:0',
            'rest_seconds' => 'nullable|integer|min:0',
        ]);

        $menuExercise->update($validated);
        $menuExercise->load('exercise');

        return response()->json([
            'message' => 'Exercise details updated successfully',
            'data' => $menuExercise,
        ]);
    }

    /**
     * Reorder exercises in a menu.
     */
    public function reorderExercises(Request $request, Menu $menu): JsonResponse
    {
        // Ensure user can only modify their own menus
        if ($menu->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized access to this menu.');
        }

        $validated = $request->validate([
            'exercise_ids' => 'required|array',
            'exercise_ids.*' => 'required|exists:exercises,id',
        ]);

        $exerciseIds = $validated['exercise_ids'];

        // Check if all exercises exist in the menu
        $menuExerciseCount = $menu->menuExercises()
            ->whereIn('exercise_id', $exerciseIds)
            ->count();

        if ($menuExerciseCount !== count($exerciseIds)) {
            return response()->json([
                'message' => 'One or more exercises not found in this menu',
            ], 400);
        }

        // Update order index for each exercise
        foreach ($exerciseIds as $index => $exerciseId) {
            $menu->menuExercises()
                ->where('exercise_id', $exerciseId)
                ->update(['order_index' => $index + 1]);
        }

        $menuExercises = $menu->menuExercises()
            ->with('exercise')
            ->ordered()
            ->get();

        return response()->json([
            'message' => 'Exercises reordered successfully',
            'data' => $menuExercises,
        ]);
    }

    /**
     * Create a menu from a template.
     */
    public function createFromTemplate(Request $request, $templateId): JsonResponse
    {
        $template = Template::findOrFail($templateId);

        if (! $template->is_active) {
            return response()->json([
                'message' => 'Template is not active',
            ], 400);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create menu
        $menu = Menu::create([
            'user_id' => auth()->user()->id,
            'name' => $validated['name'],
            'based_on_template_id' => $template->id,
            'is_active' => true,
        ]);

        // Copy exercises from template
        $template->load('templateExercises.exercise');

        foreach ($template->templateExercises as $index => $templateExercise) {
            $menu->menuExercises()->create([
                'exercise_id' => $templateExercise->exercise_id,
                'order_index' => $index + 1,
                'sets' => $templateExercise->sets,
                'reps' => $templateExercise->reps,
                'weight' => null, // Weight is user-specific
                'rest_seconds' => $templateExercise->rest_seconds,
            ]);
        }

        $menu->load('menuExercises.exercise');

        return response()->json([
            'message' => 'Menu created from template successfully',
            'data' => $menu,
        ]);
    }

    /**
     * Helper method to reindex exercise order after deletion.
     */
    private function reindexExercises(Menu $menu): void
    {
        $exercises = $menu->menuExercises()->ordered()->get();

        foreach ($exercises as $index => $exercise) {
            $exercise->update(['order_index' => $index + 1]);
        }
    }
}
