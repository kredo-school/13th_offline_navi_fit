<?php

namespace App\Livewire;

use App\Models\Goal;
use App\Models\TrainingRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component; // 追加

class DashboardCalendar extends Component
{
    public $events = [];

    public $goal = 0;

    public $actual = 0;

    public $startOfWeek;

    public $endOfWeek;

    public $trainingDaysCount = 0; // 追加：トレーニング実施日数

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

        // トレーニング実施日をカウント (重複日を除く)
        $this->trainingDaysCount = $allRecords->pluck('training_date')->unique()->count();

        // カレンダー表示用にイベントデータを整形
        foreach ($allRecords as $record) {
            // トレーニングメニュー名を取得
            $menuName = $record->menu ? $record->menu->name : 'Training';
            $title = Str::limit($menuName, 15);

            // 強度または種類に基づいて色を決定
            // $intensity = $record->perceived_intensity ?? 0;
            // $color = '#4ade80'; // デフォルト緑

            // if ($intensity >= 8) {
            //     $color = '#ef4444'; // 高強度：赤
            // } elseif ($intensity >= 5) {
            //     $color = '#f97316'; // 中強度：オレンジ
            // } elseif ($intensity >= 3) {
            //     $color = '#3b82f6'; // 低強度：青
            // }

            $this->events[] = [
                'title' => $title,
                'start' => $record->training_date,
                'url' => route('training-history.show', $record->id),
                'backgroundColor' => '#4ade80',
                'borderColor' => '#4ade80',
                'extendedProps' => [
                    'menuName' => $menuName,
                    'duration' => $record->duration ?? null,
                ],
            ];
        }
    }

    public function render()
    {
        return view('livewire.dashboard-calendar');
    }
}
