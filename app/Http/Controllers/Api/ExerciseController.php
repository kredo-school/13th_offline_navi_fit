<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function search(Request $request)
    {
        $query = Exercise::query()->active();

        if ($request->filled('q')) {
            $query->where('name', 'like', "%{$request->q}%");
        }

        if ($request->filled('muscle_group')) {
            $query->byMuscleGroup($request->muscle_group);
        }

        $exercises = $query->get(['id', 'name', 'muscle_groups', 'equipment_category']);

        return response()->json([
            'data' => $exercises,
        ]);
    }

    public function show(Exercise $exercise)
    {
        if (! $exercise->is_active) {
            abort(404);
        }

        return response()->json([
            'data' => $exercise,
        ]);
    }
}
