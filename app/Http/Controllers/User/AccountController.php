<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Utilities\FileUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the account settings page.
     */
    public function index()
    {
        $user = Auth::user();

        return view('user.account.index', compact('user'));
    }

    /**
     * Update the user's avatar.
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $profile = $user->profile;

        // Replace avatar using utility
        $avatarPath = FileUtility::replaceFile(
            $request->file('avatar'),
            $profile->avatar,
            'avatars'
        );

        // Update profile with new avatar path
        $profile->update([
            'avatar' => $avatarPath,
        ]);

        return back()->with('success', 'Avatar updated successfully');
    }

    /**
     * Remove the user's avatar.
     */
    public function deleteAvatar()
    {
        $user = Auth::user();
        $profile = $user->profile;

        if ($profile->avatar) {
            Storage::disk('public')->delete($profile->avatar);
            $profile->update(['avatar' => null]);

            return back()->with('success', 'Avatar removed successfully');
        }

        return back()->with('info', 'No avatar to remove');
    }

    /**
     * Show the form for updating password.
     */
    public function showPasswordForm()
    {
        return view('user.account.password');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed|different:current_password',
        ]);

        $user = Auth::user();

        // Check if current password is correct
        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully');
    }
}
