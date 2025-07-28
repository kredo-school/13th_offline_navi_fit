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
        $menus = Menu::with('basedOnTemplate')
            ->forUser(auth()->user()->id)
            ->active()
            ->latest()
            ->get();

        return view('user.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $templates = Template::active()->get();

        return view('user.menus.create', compact('templates'));
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

        $menu->load(['basedOnTemplate', 'menuExercises']);

        return view('user.menus.show', compact('menu'));
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

        $templates = Template::active()->get();

        return view('user.menus.edit', compact('menu', 'templates'));
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
