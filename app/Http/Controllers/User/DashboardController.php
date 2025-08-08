<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BodyRecord;
use App\Models\Goal;
use App\Models\TrainingRecord;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        session()->forget('is_setup'); // Clear the first-time setup flag

        $user = Auth::user();

        // Get recent training records (latest 5)
        $recentWorkouts = TrainingRecord::with(['template', 'menu', 'details.exercise'])
            ->forUser($user->id)
            ->orderBy('training_date', 'desc')
            ->take(3)
            ->get();

        // Get active goal
        $activeGoal = Goal::where('user_id', $user->id)
            ->where('is_active', true)
            ->first();

        // Get latest body record
        $latestBodyRecord = BodyRecord::forUser($user->id)
            ->latest()
            ->first();

        return view('user.dashboard.index', [
            'recentWorkouts' => $recentWorkouts,
            'activeGoal' => $activeGoal,
            'latestBodyRecord' => $latestBodyRecord,
        ]);
    }
}
