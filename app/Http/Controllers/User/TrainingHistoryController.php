<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TrainingRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingHistoryController extends Controller
{
    public function index(Request $request)
    {
        $records = TrainingRecord::query()
            ->with(['menu', 'template', 'details.exercise'])
            ->where('user_id', Auth::id());

        // クイックフィルター処理
        if ($request->filled('filter')) {
            switch ($request->filter) {
                case 'this_week':
                    $records->whereBetween('training_date', [
                        now()->startOfWeek(),
                        now()->endOfWeek(),
                    ]);
                    break;
                case 'this_month':
                    $records->whereBetween('training_date', [
                        now()->startOfMonth(),
                        now()->endOfMonth(),
                    ]);
                    break;
                case 'last_30_days':
                    $records->whereBetween('training_date', [
                        now()->subDays(30),
                        now(),
                    ]);
                    break;
            }
        }

        // 既存のフィルター処理
        $records->when($request->filled('date'), fn ($q) => $q->whereDate('training_date', $request->date))
            ->when($request->filled('date_from'), fn ($q) => $q->whereDate('training_date', '>=', $request->date_from))
            ->when($request->filled('date_to'), fn ($q) => $q->whereDate('training_date', '<=', $request->date_to))
            ->when($request->filled('template'), function ($q) use ($request) {
                $q->whereHas('template', fn ($t) => $t->where('slug', $request->template));
            })
            ->when($request->filled('keyword'), function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->whereHas('menu', fn ($m) => $m->where('name', 'like', '%'.$request->keyword.'%'))
                        ->orWhere('note', 'like', '%'.$request->keyword.'%');
                });
            });

        $records = $records->latest('training_date')
            ->paginate(10)
            ->withQueryString();

        $details = $records->getCollection()->pluck('details')->flatten();
        $totalSets = $details->count();
        $totalReps = $details->sum('reps');
        $totalVolume = $details->sum('volume');

        return view('user.training-history.index', compact(
            'records',
            'totalSets',
            'totalReps',
            'totalVolume'
        ));
    }

    public function destroy(string $id)
    {
        $record = TrainingRecord::where('user_id', Auth::id())->findOrFail($id);
        $record->delete();

        return redirect()->route('training-history.index')->with('success', 'トレーニング記録を削除しました');
    }

    public function show($id)
    {
        $record = TrainingRecord::with(['details.exercise', 'template', 'menu'])->findOrFail($id);

        // 自分の記録だけ見られるように
        if ($record->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.training-history.show', [
            'record' => $record,
            'userId' => Auth::id(),  // ユーザーIDを渡す
        ]);
    }

    public function edit(string $id)
    {
        $record = TrainingRecord::where('user_id', Auth::id())->findOrFail($id);

        return view('user.training-history.edit', compact('record'));
    }

    public function update(Request $request, string $id)
    {
        $record = TrainingRecord::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'training_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $record->update($validated);

        return redirect()->route('training-history.index')->with('success', '更新しました');
    }
}
