<?php

namespace App\Livewire;

use App\Models\Goal;
use App\Models\TrainingRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardCalendar extends Component
{
    public $events = [];

    public $goal = 0;

    public $actual = 0;

    public $startOfWeek;

    public $endOfWeek;

    public function mount()
    {
        // 現在の週の開始日と終了日を設定
        $this->startOfWeek = Carbon::now()->startOfWeek();
        $this->endOfWeek = Carbon::now()->endOfWeek();

        // ユーザーの週間トレーニング目標を取得
        $goal = Goal::where('user_id', Auth::id())
            ->where('is_active', true)
            ->first();

        $this->goal = $goal ? $goal->weekly_workout_frequency : 0;

        // 今週のトレーニング記録を取得
        $trainingRecords = TrainingRecord::where('user_id', Auth::id())
            ->whereBetween('training_date', [
                $this->startOfWeek->format('Y-m-d'),
                $this->endOfWeek->format('Y-m-d'),
            ])
            ->get();

        // 実際のトレーニング回数を計算
        $this->actual = $trainingRecords->count();

        // 過去3ヶ月分のトレーニング記録をイベントとして取得
        $threeMonthsAgo = Carbon::now()->subMonths(3)->startOfDay();
        $allRecords = TrainingRecord::where('user_id', Auth::id())
            ->where('training_date', '>=', $threeMonthsAgo)
            ->get();

        // カレンダー表示用にイベントデータを整形
        foreach ($allRecords as $record) {
            $this->events[] = [
                'title' => 'Training',
                'start' => $record->training_date,
                'url' => route('training-history.show', $record->id),
                'backgroundColor' => '#4ade80', // 緑色
                'borderColor' => '#4ade80',
            ];
        }
    }

    public function render()
    {
        return view('livewire.dashboard-calendar');
    }
}
