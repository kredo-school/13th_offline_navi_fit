<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Https\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Auth::user()->profile;

        if (! $profile) {
            return redirect()->route('profile.create');
        }

        return view('user.profile.show', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if user already has a profile
        if (Auth::user()->profile) {
            return redirect()->route('profile.edit');
        }

        return view('user.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileRequest $request)
    {
        // Check if user already has a profile
        if (Auth::user()->profile) {
            return redirect()->route('profile.edit');
        }

        // FormRequestで自動バリデーション済み
        $validated = $request->validated();

        $profile = Profile::create([
            'user_id' => Auth::id(),
            'full_name' => $validated['full_name'],
            'age' => $validated['age'],
            'gender' => $validated['gender'],
            'height' => $validated['height'],
            'current_weight' => $validated['current_weight'],
            'exercise_experience_level' => $validated['exercise_experience_level'],
            'medical_conditions' => $validated['medical_conditions'],
        ]);

        return redirect()->route('goals.create')->with('success', 'Profile created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $profile = Auth::user()->profile;

        if (! $profile) {
            return redirect()->route('profile.create');
        }

        return view('user.profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $profile = Auth::user()->profile;

        if (! $profile) {
            return redirect()->route('profile.create');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:13|max:120',
            'gender' => ['required', Rule::in(['male', 'female', 'other'])],
            'height' => 'required|numeric|min:50|max:300',
            'weight' => 'required|numeric|min:20|max:500',
            'fitness_level' => ['required', Rule::in(['beginner', 'intermediate', 'advanced'])],
            'medical_conditions' => 'nullable|string|max:1000',
        ]);

        // Update user's name
        Auth::user()->update([
            'name' => $validated['full_name'],
        ]);

        // Update profile
        $profile->update([
            'age' => $validated['age'],
            'gender' => $validated['gender'],
            'height' => $validated['height'],
            'weight' => $validated['weight'],
            'fitness_level' => $validated['fitness_level'],
            'medical_conditions' => $validated['medical_conditions'] ?? null,
        ]);

        return back()->with('success', 'update a profile successfully');
    }
}
