<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TemplateRequest;
use App\Models\Exercise;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminTemplateController extends Controller
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

        // 各テンプレートに準備時間を含めた合計時間を計算
        foreach ($templates as $template) {
            // モデルのアクセサで基本時間を取得
            $baseTime = $template->estimated_duration;

            // 準備時間を追加（エクササイズごとに30秒）
            $preparationTime = ceil($template->templateExercises_count * 0.5);

            // 合計時間を設定
            $template->total_duration = $baseTime + $preparationTime;
        }

        return view('admin.templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new template.
     */
    public function create()
    {
        $exercises = Exercise::active()
            ->orderBy('name')
            ->get(['id', 'name', 'muscle_groups', 'equipment_category', 'difficulty']);

        return view('admin.templates.create', compact('exercises'));
    }

    /**
     * Store a newly created template.
     */
    public function store(TemplateRequest $request)
    {
        // Debug request data
        // dd($request->all(), $request->hasFile('thumbnail'), $request->file('thumbnail'));

        try {
            DB::beginTransaction();

            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'difficulty' => $request->difficulty ?? 'normal',
                'created_by' => Auth::id(),
                'is_active' => $request->boolean('is_active', true),
            ];

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
                $data['thumbnail_path'] = $request->file('thumbnail')->store('thumbnails', 'public');
            }

            $template = Template::create($data);

            // Add exercises to the template
            if ($request->filled('exercises')) {
                foreach ($request->exercises as $index => $exerciseData) {
                    $template->templateExercises()->create([
                        'exercise_id' => $exerciseData['exercise_id'],
                        'order_index' => $index + 1,
                        'sets' => $exerciseData['sets'] ?? 3,
                        'reps' => $exerciseData['reps'] ?? 10,
                        'weight' => $exerciseData['weight'] ?? 0,
                        'rest_seconds' => $exerciseData['rest_seconds'] ?? 60,
                        'duration_seconds' => $exerciseData['duration_seconds'] ?? null,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.templates.show', $template)
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
            $query->select('id', 'name', 'muscle_groups', 'equipment_category', 'difficulty', 'image_path', 'image_url');
        }]);

        // モデルのアクセサメソッドを使用して基本時間を計算
        $baseTime = $template->estimated_duration;

        // エクササイズの数に応じて準備時間を追加（例：エクササイズごとに30秒）
        $preparationTime = ceil($template->templateExercises->count() * 0.5); // 0.5分 = 30秒

        // 合計時間
        $estimatedDuration = $baseTime + $preparationTime;

        // カロリー計算も同様に修正が必要かもしれません
        // $estimatedCalories = $this->calculateEstimatedCalories($template);

        return view('admin.templates.show', compact('template', 'estimatedDuration'));
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

        return view('admin.templates.edit', compact('template', 'exercises'));
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

            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'difficulty' => $request->difficulty ?? 'normal',
                'is_active' => $request->boolean('is_active', true),
            ];

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
                $data['thumbnail_path'] = $request->file('thumbnail')->store('thumbnails', 'public');
            }

            $template->update($data);

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
                        'weight' => $exerciseData['weight'] ?? 0,
                        'rest_seconds' => $exerciseData['rest_seconds'] ?? 60,
                        'duration_seconds' => $exerciseData['duration_seconds'] ?? null,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.templates.show', $template)
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

            return redirect()->route('admin.templates.index')
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
