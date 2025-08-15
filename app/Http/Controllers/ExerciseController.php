<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExerciseRequest;
use App\Models\Exercise;
use App\Utilities\FileUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExerciseController extends Controller
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

        return view('exercises.index', compact('exercises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('exercises.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExerciseRequest $request)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image_path'] = FileUtility::replaceFile(
                $request->file('image'),
                null,
                'exercises'
            );
        }

        Exercise::create($data);

        return redirect()->route('exercises.index')->with('success', 'Exercise created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise)
    {
        return view('exercises.show', compact('exercise'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exercise $exercise)
    {
        return view('exercises.edit', compact('exercise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExerciseRequest $request, Exercise $exercise)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image_path'] = FileUtility::replaceFile(
                $request->file('image'),
                $exercise->image_path,
                'exercises'
            );
        }
        $exercise->update($data);

        return redirect()->route('exercises.index')->with('success', 'Exercise updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();

        return redirect()->route('exercises.index')->with('success', 'Exercise deleted successfully.');
    }
}
