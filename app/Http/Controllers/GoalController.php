<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $goal = Auth::user()->goals()->where('is_active', true)->first();

        if ($goal) {
            return redirect()->route('goal.edit', $goal);
        }

        return redirect()->route('goal.create');
    }

    public function create()
    {
        $activeGoal = Auth::user()->goals()->where('is_active', true)->first();

        if ($activeGoal) {
            return redirect()->route('goal.edit', $activeGoal);
        }

        return view('goal.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'target_weight' => 'required|numeric|min:20|max:300',
            'target_date' => 'required|date|after:today',
            'weekly_workout_frequency' => 'required|integer|min:1|max:7',
            'target_body_fat_percentage' => 'nullable|numeric|min:3|max:50',
        ]);

        $validated['user_id'] = Auth::id();

        // 既存のアクティブな目標を非アクティブにする
        Auth::user()->goals()->where('is_active', true)->update(['is_active' => false]);

        $goal = Goal::create($validated);

        return redirect()->route('home')->with('success', 'Goals set successfully!');
    }

    public function edit(Goal $goal)
    {
        $this->authorize('update', $goal);

        return view('goal.edit', compact('goal'));
    }

    public function update(Request $request, Goal $goal)
    {
        $this->authorize('update', $goal);

        $validated = $request->validate([
            'target_weight' => 'required|numeric|min:20|max:300',
            'target_date' => 'required|date|after:today',
            'weekly_workout_frequency' => 'required|integer|min:1|max:7',
            'target_body_fat_percentage' => 'nullable|numeric|min:3|max:50',
        ]);

        $goal->update($validated);

        return redirect()->route('goal.edit', $goal)->with('success', 'Goals updated successfully!');
    }

    public function destroy(Goal $goal)
    {
        $this->authorize('delete', $goal);

        $goal->delete();

        return redirect()->route('goal.create')->with('success', 'Goals deleted successfully.');
    }
}
