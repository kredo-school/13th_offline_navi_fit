<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExerciseRequest;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $exercises = Exercise::query()
            ->when($request->search, function ($query, $search) {
                return $query->searchByName($search);
            })
            ->when($request->muscle_group, function ($query, $muscle) {
                return $query->byMuscleGroup($muscle);
            })
            ->when($request->equipment_category, function ($query, $equipment) {
                return $query->byEquipmentCategory($equipment);
            })
            ->when($request->difficulty, function ($query, $difficulty) {
                return $query->byDifficulty($difficulty);
            })
            ->active()
            ->paginate(12);

        return view('admin.exercises.index', compact('exercises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.exercises.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExerciseRequest $request)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('exercises', 'public');
            $data['image_path'] = $imagePath;
        }

        Exercise::create($data);

        return redirect()->route('admin.exercises.index')->with('success', 'Exercise created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise)
    {
        return view('admin.exercises.show', compact('exercise'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exercise $exercise)
    {
        return view('admin.exercises.edit', compact('exercise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExerciseRequest $request, Exercise $exercise)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($exercise->image_path && Storage::disk('public')->exists($exercise->image_path)) {
                Storage::disk('public')->delete($exercise->image_path);
            }

            $imagePath = $request->file('image')->store('exercises', 'public');
            $data['image_path'] = $imagePath;
        }
        $exercise->update($data);

        return redirect()->route('admin.exercises.index')->with('success', 'Exercise updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();

        return redirect()->route('admin.exercises.index')->with('success', 'Exercise deleted successfully.');
    }
}
