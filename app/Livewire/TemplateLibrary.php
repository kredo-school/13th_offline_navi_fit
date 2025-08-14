<?php

namespace App\Livewire;

use App\Models\Template;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class TemplateLibrary extends Component
{
    // テンプレートデータ
    public $templates = [];

    // モーダル関連のプロパティ
    public $showModal = false;

    public $selectedTemplate = null;

    // ローディング状態
    public $loading = false;

    public function mount()
    {
        $this->loadTemplates();
    }

    /**
     * テンプレート詳細モーダルを開く
     */
    public function showTemplateDetails($templateId)
    {
        $this->loading = true;

        try {
            $this->selectedTemplate = Template::with([
                'creator',
                'templateExercises.exercise',
                'templateExercises' => function ($query) {
                    $query->orderBy('order_index');
                },
            ])->find($templateId);

            if ($this->selectedTemplate) {
                $this->showModal = true;
            } else {
                session()->flash('error', 'Template not found.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error loading template details.');
            Log::error('Template details loading error: '.$e->getMessage());
        } finally {
            $this->loading = false;
        }
    }

    /**
     * モーダルを閉じる
     */
    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedTemplate = null;
    }

    /**
     * テンプレートからメニューを作成
     * ExerciseEditorに templateSelected イベントを送信
     */
    public function createFromTemplate($templateId)
    {
        try {
            $template = Template::with('templateExercises')->find($templateId);

            if (! $template) {
                session()->flash('error', 'Template not found.');

                return;
            }

            // 親コンポーネント（ExerciseEditor）にイベントを送信
            // テンプレートの全情報を送信
            $this->dispatch('templateSelected', [
                'templateId' => $templateId,
                'templateName' => $template->name,
                'templateDifficulty' => $template->difficulty,
            ]);

            // モーダルを閉じる
            $this->closeModal();

            // 成功メッセージを表示
            session()->flash('message', "Template '{$template->name}' has been added to your menu!");

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to select template.');
            Log::error('Template selection error: '.$e->getMessage());
        }
    }

    /**
     * 難易度バッジのCSSクラスを取得
     */
    public function getDifficultyBadgeClass($difficulty)
    {
        return match ($difficulty) {
            'beginner' => 'bg-success',
            'intermediate' => 'bg-warning text-dark',
            'advanced' => 'bg-danger',
            default => 'bg-secondary'
        };
    }

    /**
     * 難易度ラベルを取得
     */
    public function getDifficultyLabel($difficulty)
    {
        return match ($difficulty) {
            'beginner' => 'Beginner',
            'intermediate' => 'Intermediate',
            'advanced' => 'Advanced',
            default => 'Unknown'
        };
    }

    /**
     * テンプレートの推定時間を計算
     */
    public function getEstimatedTime($template)
    {
        // templateExercisesから推定時間を計算
        $totalTime = 0;
        if ($template->templateExercises) {
            foreach ($template->templateExercises as $templateExercise) {
                // 各セットの時間（平均45秒）+ 休憩時間
                $setTime = ($templateExercise->sets ?? 0) * 45;
                $restTime = ($templateExercise->sets ?? 0) * ($templateExercise->rest_seconds ?? 60);

                if ($templateExercise->sets > 0) {
                    $restTime -= ($templateExercise->rest_seconds ?? 60); // 最初のセットは休憩なし
                }

                $totalTime += $setTime + $restTime;
            }
        }

        return $totalTime > 0 ? ceil($totalTime / 60) : 30; // 分に変換、最低30分
    }

    /**
     * テンプレートの推定カロリーを計算
     */
    public function getEstimatedCalories($template)
    {
        // エクササイズから推定カロリーを計算
        $totalCalories = 0;
        if ($template->templateExercises) {
            foreach ($template->templateExercises as $templateExercise) {
                if ($templateExercise->exercise) {
                    // 難易度とセット数に基づいて大まかなカロリーを計算
                    $baseCalories = match ($templateExercise->exercise->difficulty) {
                        'beginner' => 8,
                        'intermediate' => 12,
                        'advanced' => 16,
                        default => 10
                    };
                    $sets = $templateExercise->sets ?? 1;
                    $totalCalories += $baseCalories * $sets;
                }
            }
        }

        return $totalCalories > 0 ? $totalCalories : 200; // デフォルト200kcal
    }

    /**
     * 筋肉グループの配列を取得
     */
    public function getMuscleGroups($template)
    {
        $muscleGroups = [];

        if ($template->templateExercises) {
            foreach ($template->templateExercises as $templateExercise) {
                if ($templateExercise->exercise && $templateExercise->exercise->muscle_groups) {
                    $muscleGroups = array_merge($muscleGroups, $templateExercise->exercise->muscle_groups);
                }
            }
        }

        return array_unique($muscleGroups);
    }

    /**
     * 必要な器具の配列を取得
     */
    public function getEquipmentNeeded($template)
    {
        $equipment = [];

        if ($template->templateExercises) {
            foreach ($template->templateExercises as $templateExercise) {
                if ($templateExercise->exercise) {
                    // equipment_categoryを使用
                    if ($templateExercise->exercise->equipment_category) {
                        $equipment[] = $templateExercise->exercise->equipment_category;
                    }
                    // equipment_neededも利用
                    if ($templateExercise->exercise->equipment_needed) {
                        $equipment[] = $templateExercise->exercise->equipment_needed;
                    }
                }
            }
        }

        return array_unique(array_filter($equipment));
    }

    /**
     * テンプレートの評価を取得（将来の拡張用）
     */
    public function getTemplateRating($template)
    {
        // 現在は固定値、将来的にはユーザー評価から計算
        return '4.5';
    }

    /**
     * テンプレートの総セット数を計算
     */
    public function getTotalSets($template)
    {
        $totalSets = 0;
        if ($template->templateExercises) {
            foreach ($template->templateExercises as $templateExercise) {
                $totalSets += $templateExercise->sets ?? 0;
            }
        }

        return $totalSets;
    }

    /**
     * テンプレートの人気度を取得（将来の拡張用）
     */
    public function getPopularityScore($template)
    {
        // 現在は基づいたメニューの数で簡易計算
        return $template->menus ? $template->menus->count() : 0;
    }

    /**
     * テンプレートのサムネイル画像URLを取得
     */
    public function getThumbnailUrl($template)
    {
        return $template->image_path ?? 'https://images.pexels.com/photos/1552252/pexels-photo-1552252.jpeg?auto=compress&cs=tinysrgb&w=200&h=120&fit=crop';
    }

    private function loadTemplates()
    {
        try {
            // アクティブなテンプレートのみを取得
            $this->templates = Template::with([
                'creator',
                'templateExercises.exercise',
            ])
                ->active()
                ->orderBy('name')
                ->get();
        } catch (\Exception $e) {
            session()->flash('error', 'Error loading templates.');
            Log::error('Templates loading error: '.$e->getMessage());
            $this->templates = collect();
        }
    }

    public function render()
    {
        return view('livewire.template-library');
    }
}
