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
                $restTime = ($templateExercise->sets ?? 0) * ($templateExercise->rest_seconds ?? 120); // 60秒から120秒に変更

                if ($templateExercise->sets > 0) {
                    $restTime -= ($templateExercise->rest_seconds ?? 120); // 最初のセットは休憩なし
                }

                $totalTime += $setTime + $restTime;
            }
        }

        return $totalTime > 0 ? ceil($totalTime / 60) : 30; // 分に変換、最低30分
    }

    /**
     * テンプレートの推定カロリーを計算
     */
    // public function getEstimatedCalories($template)
    // {
    //     // エクササイズから推定カロリーを計算
    //     $totalCalories = 0;
    //     if ($template->templateExercises) {
    //         foreach ($template->templateExercises as $templateExercise) {
    //             if ($templateExercise->exercise) {
    //                 // 難易度とセット数に基づいて大まかなカロリーを計算
    //                 $baseCalories = match ($templateExercise->exercise->difficulty) {
    //                     'beginner' => 8,
    //                     'intermediate' => 12,
    //                     'advanced' => 16,
    //                     default => 10
    //                 };
    //                 $sets = $templateExercise->sets ?? 1;
    //                 $totalCalories += $baseCalories * $sets;
    //             }
    //         }
    //     }

    //     return $totalCalories > 0 ? $totalCalories : 200; // デフォルト200kcal
    // }

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
     * 必要な器具の配列を取得（重複を避けて表示）
     */
    public function getEquipmentNeeded($template)
    {
        $equipmentSet = []; // 重複チェック用の連想配列

        if ($template->templateExercises) {
            foreach ($template->templateExercises as $templateExercise) {
                if ($templateExercise->exercise) {
                    // equipment_neededの処理
                    if ($templateExercise->exercise->equipment_needed) {
                        // 可能性のある区切り文字で分割
                        $patterns = [',', ';', '、', '/', '&'];
                        $equipmentText = $templateExercise->exercise->equipment_needed;

                        // 区切り文字を空白に置換
                        foreach ($patterns as $pattern) {
                            $equipmentText = str_replace($pattern, ' ', $equipmentText);
                        }

                        // 単語の境界で分割（連続した文字を単語として認識）
                        preg_match_all('/\b[A-Za-z0-9]+(?:\s+[A-Za-z0-9]+)*\b/', $equipmentText, $matches);

                        if (isset($matches[0]) && is_array($matches[0])) {
                            foreach ($matches[0] as $item) {
                                $item = trim($item);
                                if (! empty($item)) {
                                    $itemLower = strtolower($item);
                                    if (! isset($equipmentSet[$itemLower])) {
                                        $equipmentSet[$itemLower] = $item;
                                    }
                                }
                            }
                        }
                    }

                    // equipment_categoryの処理
                    if ($templateExercise->exercise->equipment_category) {
                        $category = trim($templateExercise->exercise->equipment_category);
                        $categoryLower = strtolower($category);
                        if (! empty($category) && ! isset($equipmentSet[$categoryLower])) {
                            $equipmentSet[$categoryLower] = $category;
                        }
                    }
                }
            }
        }

        // 値のみを返す
        return array_values($equipmentSet);
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
        if ($template->image_path) {
            // 相対パスをフルURLに変換
            return asset('storage/'.$template->image_path);
        }

        // ローカルのフォールバック画像を使用
        return asset('images/default-template.jpg');
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
