<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Template;
use App\Models\TrainingRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingRecordController extends Controller
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
        $trainingRecords = Auth::user()->trainingRecords()
            ->with(['menu', 'template', 'details'])
            ->orderBy('training_date', 'desc')
            ->paginate(10);

        return view('user.training-records.index', compact('trainingRecords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = Auth::user()->menus()->get();
        $templates = Template::all();

        return view('user.training-records.create', compact('menus', 'templates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'nullable|exists:menus,id',
            'template_id' => 'nullable|exists:templates,id',
            'training_date' => 'required|date',
            'duration_minutes' => 'nullable|integer|min:1|max:600',
            'calories_burned' => 'nullable|integer|min:1|max:2000',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Ensure either menu_id or template_id is provided
        if (! $validated['menu_id'] && ! $validated['template_id']) {
            return back()->withErrors(['menu_id' => 'Please select either a menu or a template.']);
        }

        $validated['user_id'] = Auth::id();

        $trainingRecord = TrainingRecord::create($validated);

        return redirect()->route('training-records.show', $trainingRecord)
            ->with('success', 'Training record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingRecord $trainingRecord)
    {
        // Authorize user can only view their own records
        if ($trainingRecord->user_id !== Auth::id()) {
            abort(403);
        }

        $trainingRecord->load(['menu', 'template', 'details', 'user']);

        return view('user.training-records.show', compact('trainingRecord'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingRecord $trainingRecord)
    {
        // Authorize user can only edit their own records
        if ($trainingRecord->user_id !== Auth::id()) {
            abort(403);
        }

        $menus = Auth::user()->menus()->get();
        $templates = Template::all(); // Simplified - all available templates

        return view('user.training-records.edit', compact('trainingRecord', 'menus', 'templates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrainingRecord $trainingRecord)
    {
        // Authorize user can only update their own records
        if ($trainingRecord->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'menu_id' => 'nullable|exists:menus,id',
            'template_id' => 'nullable|exists:templates,id',
            'training_date' => 'required|date',
            'duration_minutes' => 'nullable|integer|min:1|max:600',
            'calories_burned' => 'nullable|integer|min:1|max:2000',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Ensure either menu_id or template_id is provided
        if (! $validated['menu_id'] && ! $validated['template_id']) {
            return back()->withErrors(['menu_id' => 'Please select either a menu or a template.']);
        }

        $trainingRecord->update($validated);

        return redirect()->route('training-records.show', $trainingRecord)
            ->with('success', 'Training record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingRecord $trainingRecord)
    {
        // Authorize user can only delete their own records
        if ($trainingRecord->user_id !== Auth::id()) {
            abort(403);
        }

        $trainingRecord->delete();

        return redirect()->route('training-records.index')
            ->with('success', 'Training record deleted successfully.');
    }
}
