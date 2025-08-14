<?php

namespace App\Http\Controllers;

use App\Http\Requests\TemplateRequest;
use App\Models\Exercise;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'setup']);
    }

    /**
     * Display a listing of templates.
     */
    public function index(Request $request)
    {
        $query = Template::where('created_by', Auth::id())
            ->with(['templateExercises.exercise'])
            ->withCount('templateExercises');

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $templates = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new template.
     */
    public function create()
    {
        $exercises = Exercise::active()
            ->orderBy('name')
            ->get(['id', 'name', 'muscle_groups', 'equipment_category', 'difficulty']);

        return view('templates.create', compact('exercises'));
    }

    /**
     * Store a newly created template.
     */
    public function store(TemplateRequest $request)
    {
        try {
            DB::beginTransaction();

            $template = Template::create([
                'name' => $request->name,
                'description' => $request->description,
                'difficulty' => $request->difficulty ?? 'normal',
                'image_path' => $request->image_path,
                'created_by' => Auth::id(),
                'is_active' => $request->boolean('is_active', true),
            ]);

            // Add exercises to the template
            if ($request->filled('exercises')) {
                foreach ($request->exercises as $index => $exerciseData) {
                    $template->templateExercises()->create([
                        'exercise_id' => $exerciseData['exercise_id'],
                        'order_index' => $index + 1,
                        'sets' => $exerciseData['sets'] ?? 3,
                        'reps' => $exerciseData['reps'] ?? 10,
                        'rest_seconds' => $exerciseData['rest_seconds'] ?? 60,
                        'duration_seconds' => $exerciseData['duration_seconds'] ?? null,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('templates.show', $template)
                ->with('success', 'Template created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Failed to create template. Please try again.');
        }
    }

    /**
     * Display the specified template.
     */
    public function show(Template $template)
    {
        // Check if user can view this template
        if ($template->created_by !== Auth::id() && ! $template->is_active) {
            abort(403, 'You do not have permission to view this template.');
        }

        $template->load(['templateExercises.exercise' => function ($query) {
            $query->select('id', 'name', 'muscle_groups', 'equipment_category', 'difficulty', 'image_path');
        }]);

        // Calculate estimated duration and calories
        $estimatedDuration = $this->calculateEstimatedDuration($template);
        $estimatedCalories = $this->calculateEstimatedCalories($template);

        return view('templates.show', compact('template', 'estimatedDuration', 'estimatedCalories'));
    }

    /**
     * Show the form for editing template.
     */
    public function edit(Template $template)
    {
        // Check ownership
        if ($template->created_by !== Auth::id()) {
            abort(403, 'You do not have permission to edit this template.');
        }

        $template->load(['templateExercises.exercise']);

        $exercises = Exercise::active()
            ->orderBy('name')
            ->get(['id', 'name', 'muscle_groups', 'equipment_category', 'difficulty']);

        return view('templates.edit', compact('template', 'exercises'));
    }

    /**
     * Update the specified template.
     */
    public function update(TemplateRequest $request, Template $template)
    {
        // Check ownership
        if ($template->created_by !== Auth::id()) {
            abort(403, 'You do not have permission to edit this template.');
        }

        try {
            DB::beginTransaction();

            $template->update([
                'name' => $request->name,
                'description' => $request->description,
                'difficulty' => $request->difficulty ?? 'normal',
                'image_path' => $request->image_path,
                'is_active' => $request->boolean('is_active', true),
            ]);

            // Delete existing template exercises
            $template->templateExercises()->delete();

            // Add updated exercises
            if ($request->filled('exercises')) {
                foreach ($request->exercises as $index => $exerciseData) {
                    $template->templateExercises()->create([
                        'exercise_id' => $exerciseData['exercise_id'],
                        'order_index' => $index + 1,
                        'sets' => $exerciseData['sets'] ?? 3,
                        'reps' => $exerciseData['reps'] ?? 10,
                        'rest_seconds' => $exerciseData['rest_seconds'] ?? 60,
                        'duration_seconds' => $exerciseData['duration_seconds'] ?? null,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('templates.show', $template)
                ->with('success', 'Template updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Failed to update template. Please try again.');
        }
    }

    /**
     * Remove the specified template.
     */
    public function destroy(Template $template)
    {
        // Check ownership
        if ($template->created_by !== Auth::id()) {
            abort(403, 'You do not have permission to delete this template.');
        }

        try {
            // Delete template (cascade will handle template_exercises)
            $template->delete();

            return redirect()->route('templates.index')
                ->with('success', 'Template deleted successfully.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Failed to delete template. Please try again.');
        }
    }

    /**
     * Calculate estimated duration in minutes.
     */
    private function calculateEstimatedDuration(Template $template): int
    {
        $totalMinutes = 0;

        foreach ($template->templateExercises as $templateExercise) {
            // Exercise time: sets * (reps * 3 seconds + rest time)
            $exerciseTime = $templateExercise->sets *
                (($templateExercise->reps * 3) + $templateExercise->rest_seconds);
            $totalMinutes += $exerciseTime / 60;
        }

        // Add 10 minutes for warm-up and cool-down
        return (int) ceil($totalMinutes + 10);
    }

    /**
     * Calculate estimated calories burned.
     */
    private function calculateEstimatedCalories(Template $template): int
    {
        $baselineCaloriesPerMinute = 8; // Average for strength training

        $duration = $this->calculateEstimatedDuration($template);

        return (int) ($duration * $baselineCaloriesPerMinute);
    }
}
