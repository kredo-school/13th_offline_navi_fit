<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Template;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $menus = Menu::with('basedOnTemplate')
            ->forUser(auth()->user()->id)
            ->active()
            ->latest()
            ->get();

        return view('user.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $templates = Template::active()->get();

        return view('user.menus.create', compact('templates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'based_on_template_id' => 'required|exists:templates,id',
        ]);

        $validated['user_id'] = auth()->user()->id;
        $validated['is_active'] = true;

        $menu = Menu::create($validated);

        return redirect()
            ->route('menus.show', $menu)
            ->with('success', 'Menu created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu): View
    {
        // Ensure user can only access their own menus
        if ($menu->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized access to this menu.');
        }

        $menu->load(['basedOnTemplate', 'menuExercises']);

        return view('user.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu): View
    {
        // Ensure user can only edit their own menus
        if ($menu->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized access to this menu.');
        }

        $templates = Template::active()->get();

        return view('user.menus.edit', compact('menu', 'templates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu): RedirectResponse
    {
        // Ensure user can only update their own menus
        if ($menu->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized access to this menu.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'based_on_template_id' => 'nullable|exists:templates,id',
            'is_active' => 'boolean',
        ]);

        $menu->update($validated);

        return redirect()
            ->route('menu.show', $menu)
            ->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu): RedirectResponse
    {
        // Ensure user can only delete their own menus
        if ($menu->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized access to this menu.');
        }

        $menu->delete();

        return redirect()
            ->route('menus.index')
            ->with('success', 'Menu deleted successfully.');
    }
}
