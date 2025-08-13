<?php

namespace App\Livewire;

use App\Models\Exercise;
use App\Models\Menu;
use App\Models\MenuExercise;
use App\Models\Template;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ExerciseEditor extends Component
{
    // メニューの基本情報
    public $menuName = '';

    public $basedOnTemplateId = null;

    public $isActive = true;

    // エクササイズリスト
    public $exercises = [];

    // バリデーションエラー
    public $errors = [];

    // 保存状態
    public $saving = false;

    protected $listeners = [
        'exerciseAdded' => 'addExercise',
        'templateSelected' => 'loadFromTemplate',
    ];

    public function mount()
    {
        // 初期化処理
        $this->exercises = [];
        $this->errors = [];
    }

    /**
     * Exercise Catalogからエクササイズを追加
     */
    public function addExercise($data)
    {
        $exerciseId = $data['exerciseId'];
        $exerciseName = $data['exerciseName'] ?? '';

        // 既に追加されているかチェック（一意制約対応）
        foreach ($this->exercises as $exercise) {
            if ($exercise['exercise_id'] == $exerciseId) {
                session()->flash('warning', "'{$exerciseName}' is already added to the menu.");

                return;
            }
        }

        // 新しいエクササイズを追加
        $this->exercises[] = [
            'exercise_id' => $exerciseId,
            'exercise_name' => $exerciseName,
            'order_index' => count($this->exercises) + 1,
            'sets' => null,
            'reps' => null,
            'weight' => null,
            'rest_seconds' => null,
            'duration_seconds' => null,
        ];

        // エラーをクリア
        if (isset($this->errors['exercises'])) {
            unset($this->errors['exercises']);
        }

        session()->flash('message', "'{$exerciseName}' has been added to your menu!");
    }

    /**
     * Template Libraryからテンプレートを読み込み
     */
    public function loadFromTemplate($data)
    {
        $templateId = $data['templateId'];
        $templateName = $data['templateName'] ?? '';

        try {
            $template = Template::with('templateExercises.exercise')->find($templateId);

            if ($template && $template->templateExercises) {
                // メニュー名を自動設定
                $this->menuName = $templateName.' - My Workout';
                $this->basedOnTemplateId = $templateId;

                // テンプレートのエクササイズを追加
                $this->exercises = [];
                foreach ($template->templateExercises as $index => $templateExercise) {
                    if ($templateExercise->exercise) {
                        $this->exercises[] = [
                            'exercise_id' => $templateExercise->exercise_id,
                            'exercise_name' => $templateExercise->exercise->name,
                            'order_index' => $index + 1,
                            'sets' => $templateExercise->sets ?? 3,
                            'reps' => $templateExercise->reps ?? 10,
                            'weight' => $templateExercise->weight,
                            'rest_seconds' => $templateExercise->rest_seconds ?? 60,
                            'duration_seconds' => null,
                        ];
                    }
                }

                // エラーをクリア
                $this->errors = [];

                session()->flash('message', "Template '{$templateName}' has been loaded!");
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to load template.');
            Log::error('Template load error: '.$e->getMessage());
        }
    }

    /**
     * エクササイズを削除
     */
    public function removeExercise($index)
    {
        if (isset($this->exercises[$index])) {
            $exerciseName = $this->exercises[$index]['exercise_name'];
            unset($this->exercises[$index]);

            // インデックスを再構築
            $this->exercises = array_values($this->exercises);

            // order_indexを更新
            foreach ($this->exercises as $i => $exercise) {
                $this->exercises[$i]['order_index'] = $i + 1;
            }

            session()->flash('message', "'{$exerciseName}' has been removed from the menu.");
        }
    }

    /**
     * エクササイズの順序を変更（上に移動）
     */
    public function moveUp($index)
    {
        if ($index > 0) {
            $temp = $this->exercises[$index];
            $this->exercises[$index] = $this->exercises[$index - 1];
            $this->exercises[$index - 1] = $temp;

            // order_indexを更新
            $this->exercises[$index]['order_index'] = $index + 1;
            $this->exercises[$index - 1]['order_index'] = $index;
        }
    }

    /**
     * エクササイズの順序を変更（下に移動）
     */
    public function moveDown($index)
    {
        if ($index < count($this->exercises) - 1) {
            $temp = $this->exercises[$index];
            $this->exercises[$index] = $this->exercises[$index + 1];
            $this->exercises[$index + 1] = $temp;

            // order_indexを更新
            $this->exercises[$index]['order_index'] = $index + 1;
            $this->exercises[$index + 1]['order_index'] = $index + 2;
        }
    }

    /**
     * エクササイズの値を更新
     */
    public function updateExercise($index, $field, $value)
    {
        if (isset($this->exercises[$index])) {
            // 数値フィールドの場合は最小値チェック
            if (in_array($field, ['sets', 'reps', 'rest_seconds', 'duration_seconds'])) {
                $value = $value ? max(1, (int) $value) : null;
            } elseif ($field === 'weight') {
                $value = $value ? max(0, (float) $value) : null;
            }

            $this->exercises[$index][$field] = $value;
        }
    }

    /**
     * バリデーション
     */
    public function validateMenu()
    {
        $this->errors = [];

        if (empty(trim($this->menuName))) {
            $this->errors['menuName'] = 'Menu name is required.';
        } elseif (strlen($this->menuName) > 255) {
            $this->errors['menuName'] = 'Menu name must be less than 255 characters.';
        }

        if (empty($this->exercises)) {
            $this->errors['exercises'] = 'Please add at least one exercise to your menu.';
        }

        // 各エクササイズのバリデーション
        foreach ($this->exercises as $index => $exercise) {
            if (empty($exercise['exercise_name'])) {
                $this->errors["exercise_{$index}_name"] = 'Exercise name is required.';
            }

            $exerciseLabel = ! empty($exercise['exercise_name']) ? $exercise['exercise_name'] : 'Exercise #'.($index + 1);

            // Sets validation
            $sets = $exercise['sets'] ?? null;
            if ($sets === null || ! is_numeric($sets) || (int) $sets < 1) {
                $this->errors["exercise_{$index}_sets"] = $exerciseLabel.': Enter at least 1 set';
            }

            // Reps validation
            $reps = $exercise['reps'] ?? null;
            if ($reps === null || ! is_numeric($reps) || (int) $reps < 1) {
                $this->errors["exercise_{$index}_reps"] = $exerciseLabel.': Enter at least 1 rep';
            }

            // Weight validation (kg)
            $weight = $exercise['weight'] ?? null;
            if ($weight === null || ! is_numeric($weight) || (float) $weight < 0) {
                $this->errors["exercise_{$index}_weight"] = $exerciseLabel.': Enter a weight (kg) of 0 or more';
            }
        }

        return empty($this->errors);
    }

    /**
     * メニューをクリア
     */
    public function clearMenu()
    {
        $this->menuName = '';
        $this->basedOnTemplateId = null;
        $this->exercises = [];
        $this->errors = [];

        session()->flash('message', 'Menu has been cleared.');
    }

    /**
     * メニューを保存
     */
    public function saveMenu()
    {
        if (! $this->validateMenu()) {
            session()->flash('error', 'Please fix the errors before saving.');

            return;
        }

        $this->saving = true;

        try {
            DB::transaction(function () {
                // メニューを作成
                $menu = Menu::create([
                    'user_id' => Auth::id(),
                    'name' => trim($this->menuName),
                    'based_on_template_id' => $this->basedOnTemplateId,
                    'is_active' => $this->isActive,
                ]);

                // エクササイズを追加
                foreach ($this->exercises as $exerciseData) {
                    MenuExercise::create([
                        'menu_id' => $menu->id,
                        'exercise_id' => $exerciseData['exercise_id'],
                        'order_index' => $exerciseData['order_index'],
                        'sets' => $exerciseData['sets'],
                        'reps' => $exerciseData['reps'],
                        'weight' => $exerciseData['weight'],
                        'rest_seconds' => $exerciseData['rest_seconds'],
                        'duration_seconds' => $exerciseData['duration_seconds'],
                    ]);
                }

                session()->flash('success', "Menu '{$this->menuName}' has been created successfully!");
            });

            // リダイレクト（Livewire推奨のnavigate）
            return redirect()->route('menus.index');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to save menu. Please try again.');
            Log::error('Menu save error: '.$e->getMessage());
        } finally {
            $this->saving = false;
        }
    }

    /**
     * 推定時間を計算
     */
    public function getEstimatedDuration()
    {
        $totalTime = 0;

        foreach ($this->exercises as $exercise) {
            // 各セットの時間（平均45秒）
            $setTime = ($exercise['sets'] ?? 0) * 45;

            // 休憩時間
            $restTime = ($exercise['sets'] ?? 0) * ($exercise['rest_seconds'] ?? 60);

            // 最初のセットは休憩なし
            if (($exercise['sets'] ?? 0) > 0) {
                $restTime -= ($exercise['rest_seconds'] ?? 60);
            }

            $totalTime += $setTime + $restTime;
        }

        return ceil($totalTime / 60); // 分に変換
    }

    /**
     * 総セット数を計算
     */
    public function getTotalSets()
    {
        return array_sum(array_column($this->exercises, 'sets'));
    }

    public function render()
    {
        return view('livewire.exercise-editor');
    }
}
