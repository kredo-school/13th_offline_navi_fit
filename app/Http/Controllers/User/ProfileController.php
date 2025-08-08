<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
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
        if (Auth::user()->profile && ! session('is_setup')) {
            return redirect()->route('profile.edit');
        }

        session(['is_setup' => true]); // first-time setup flag

        $profile = Auth::user()->profile;

        return view('user.profile.create', compact('profile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileRequest $request)
    {
        if (Auth::user()->profile && ! session('is_setup')) {
            return redirect()->route('profile.edit');
        }

        $validated = $request->validated();

        $profile = Auth::user()->profile;

        if ($profile) {
            $profile->update($validated); // セットアップ中の再保存も対応
        } else {
            Profile::create(array_merge($validated, ['user_id' => Auth::id()]));
        }

        return redirect()->route('goal.create')->with('success', 'Profile saved!');
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
            // 'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:13|max:120',
            'gender' => ['required', Rule::in(['male', 'female', 'other'])],
            'height' => 'required|numeric|min:50|max:300',
            'weight' => 'required|numeric|min:20|max:500',
            'fitness_level' => ['required', Rule::in(['beginner', 'intermediate', 'advanced'])],
            'medical_conditions' => 'nullable|string|max:1000',
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

        // 初回セットアップかどうかをチェック
        if (! Auth::user()->goals()->exists()) {
            // 初回セットアップの場合は目標設定ページへ
            return redirect()->route('goal.create')->with('success', 'Profile updated successfully! Now let\'s set your goals.');
        }

        // 通常の更新の場合は元のページに戻る
        return back()->with('success', 'Profile updated successfully');
    }
}
