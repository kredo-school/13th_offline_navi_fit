<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BodyRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BodyRecordController extends Controller
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
        $bodyRecords = Auth::user()->bodyRecords()
            ->latest()
            ->paginate(10);

        return view('user.body-record.index', compact('bodyRecords'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'recorded_date' => 'required|date|before_or_equal:today',
            'weight' => 'required|numeric|min:1|max:499.99',
            'body_fat_percentage' => 'nullable|numeric|min:0|max:100',
            'memo' => 'nullable|string|max:1000',
        ]);

        $validated['user_id'] = Auth::id();

        // 同日の記録があるかチェック
        $existingRecord = BodyRecord::where('user_id', Auth::id())
            ->where('recorded_date', $validated['recorded_date'])
            ->first();

        if ($existingRecord) {
            $existingRecord->update($validated);
            $message = 'Body record updated successfully!';
        } else {
            BodyRecord::create($validated);
            $message = 'Body record saved successfully!';
        }

        return redirect()->route('body-records.index')
            ->with('success', $message);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BodyRecord $bodyRecord)
    {
        $this->authorize('update', $bodyRecord);

        return view('user.body-record.edit', compact('bodyRecord'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BodyRecord $bodyRecord)
    {
        $this->authorize('update', $bodyRecord);

        $validated = $request->validate([
            'recorded_date' => 'required|date|before_or_equal:today',
            'weight' => 'required|numeric|min:1|max:499.99',
            'body_fat_percentage' => 'nullable|numeric|min:0|max:100',
            'memo' => 'nullable|string|max:1000',
        ]);

        $bodyRecord->update($validated);

        return redirect()->route('body-records.index')
            ->with('success', 'Body record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BodyRecord $bodyRecord)
    {
        $this->authorize('delete', $bodyRecord);

        $bodyRecord->delete();

        return redirect()->route('body-records.index')
            ->with('success', 'Body record deleted successfully!');
    }
}
