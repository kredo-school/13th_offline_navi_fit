<div class="space-y-4">
    @if($this->selectedMenu)
        @php
            $groupedSets = collect($workoutSets)->groupBy('exercise_id');
        @endphp
        
        @foreach($this->selectedMenu->menuExercises as $menuExercise)
            @php
                $exerciseSets = $groupedSets->get($menuExercise->exercise_id, collect());
                $previousRecord = $this->getPreviousRecord($menuExercise->exercise_id);
                $exercise = $menuExercise->exercise;
            @endphp
            
            <div class="card border-1 shadow-sm mb-3">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h3 class="h5 fw-semibold text-dark mb-1">{{ $exercise->name }}</h3>
                            <div class="d-flex align-items-center text-muted small">
                                <span>{{ implode(', ', $exercise->muscle_groups ?? []) }}</span>
                                @if($exercise->equipment_category)
                                    <span class="mx-2">•</span>
                                    <span>{{ $exercise->equipment_category }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            @if(!empty($previousRecord))
                                <button wire:click="applyPreviousRecord({{ $exercise->id }})"
                                        type="button" 
                                        class="btn btn-link text-muted p-2 me-2" 
                                        title="前回の記録を適用">
                                    <i class="fas fa-undo"></i>
                                </button>
                            @endif
                            <button wire:click="addSet({{ $exercise->id }})"
                                    type="button" 
                                    class="btn btn-link text-primary p-2" 
                                    title="セットを追加">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Previous Record Display --}}
                    @if(!empty($previousRecord))
                        <div class="bg-light rounded p-3 mb-4">
                            <div class="small text-muted">
                                <span class="fw-medium">前回の記録:</span>
                                @if(isset($previousRecord['weight']))
                                    <span class="ms-2">{{ $previousRecord['weight'] }}kg</span>
                                @endif
                                @if(isset($previousRecord['reps']))
                                    <span class="ms-2">{{ $previousRecord['reps'] }}回</span>
                                @endif
                                @if(isset($previousRecord['date']))
                                    <span class="ms-2 text-muted">({{ $previousRecord['date'] }})</span>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="bg-light rounded p-3 mb-4">
                            <div class="small text-muted">
                                <span class="fw-medium">前回の記録:</span>
                                <span class="ms-2">-</span>
                                <span class="ms-2 text-muted">(初回)</span>
                            </div>
                        </div>
                    @endif

                    {{-- Sets Table --}}
                    @if($exerciseSets->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted fw-normal small">セット</th>
                                        @if($exercise->equipment_category !== 'bodyweight')
                                            <th class="text-muted fw-normal small">重量(kg)</th>
                                        @endif
                                        <th class="text-muted fw-normal small">回数</th>
                                        <th class="text-muted fw-normal small">休憩(秒)</th>
                                        <th class="text-muted fw-normal small">完了</th>
                                        <th class="text-muted fw-normal small">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exerciseSets->sortBy('set_number') as $set)
                                        <tr class="align-middle">
                                            <td class="fw-medium text-dark">{{ $set['set_number'] }}</td>
                                            @if($exercise->equipment_category !== 'bodyweight')
                                                <td>
                                                    <input wire:model.lazy="workoutSets.{{ array_search($set, $workoutSets) }}.weight"
                                                           type="number" 
                                                           step="0.5" 
                                                           min="0" 
                                                           class="form-control form-control-sm" 
                                                           style="width: 80px;" 
                                                           placeholder="0">
                                                </td>
                                            @endif
                                            <td>
                                                <input wire:model.lazy="workoutSets.{{ array_search($set, $workoutSets) }}.reps"
                                                       type="number" 
                                                       min="0" 
                                                       class="form-control form-control-sm" 
                                                       style="width: 80px;" 
                                                       placeholder="0">
                                            </td>
                                            <td>
                                                <input wire:model.lazy="workoutSets.{{ array_search($set, $workoutSets) }}.rest_seconds"
                                                       type="number" 
                                                       min="0" 
                                                       class="form-control form-control-sm" 
                                                       style="width: 80px;" 
                                                       placeholder="60">
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input wire:click="toggleSetCompletion('{{ $set['id'] }}')"
                                                           class="form-check-input" 
                                                           type="checkbox" 
                                                           @if($set['completed']) checked @endif>
                                                </div>
                                            </td>
                                            <td>
                                                <button wire:click="removeSet('{{ $set['id'] }}')"
                                                        type="button" 
                                                        class="btn btn-link text-danger p-1" 
                                                        title="セットを削除">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <p class="mb-0">セットを追加してください</p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif

    {{-- Navigation --}}
    <div class="d-flex justify-content-between pt-4">
        <button wire:click="goToStep1"
                type="button" 
                class="btn btn-outline-secondary">
            前に戻る
        </button>
        <button wire:click="goToStep3"
                type="button" 
                class="btn btn-primary"
                @if(empty($workoutSets)) disabled @endif>
            確認画面へ
        </button>
    </div>

    {{-- Validation Errors --}}
    @error('sets')
        <div class="alert alert-danger mt-3">
            {{ $message }}
        </div>
    @enderror
</div>