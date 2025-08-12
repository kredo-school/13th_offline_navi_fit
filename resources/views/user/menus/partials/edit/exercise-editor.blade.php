{{-- resources/views/menu/partials/exercise-editor.blade.php --}}
<div class="card border-0 shadow-sm flex-fill">
    <div class="card-body d-flex flex-column">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title mb-0">Exercises</h5>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#aiProposalModal">
                <i class="fa-solid fa-star me-1"></i>
                AI Suggestions
            </button>
        </div>

        {{-- Error Alert --}}
        <div class="alert alert-danger d-none" id="exerciseError">
            <small>Please add at least one exercise</small>
        </div>

        {{-- Exercise Table --}}
        <div class="flex-fill overflow-auto">
            <table class="table table-sm">
                <thead class="table-light sticky-top">
                    <tr>
                        <th width="30"></th>
                        <th>Exercise Name</th>
                        <th width="80">Sets</th>
                        <th width="80">Reps</th>
                        <th width="80">Weight</th>
                        <th width="50"></th>
                    </tr>
                </thead>
                <tbody id="exerciseTableBody">
                    @if (isset($menu) && $menu->menuExercises->count() > 0)
                        @foreach ($menu->menuExercises as $menuExercise)
                            <tr class="exercise-row" draggable="true"
                                data-exercise-id="{{ $menuExercise->exercise_id }}">
                                <td class="text-center">
                                    <i class="fa-solid fa-grip-vertical text-muted drag-handle"></i>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm"
                                        value="{{ $menuExercise->exercise->name }}" placeholder="Exercise Name" readonly
                                        style="border: 1px solid #ced4da; background-color: #f8f9fa;">
                                    <input type="hidden" name="exercise_ids[]"
                                        value="{{ $menuExercise->exercise_id }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-sm text-center"
                                        name="sets[]" value="{{ $menuExercise->sets }}" min="1" max="999"
                                        style="border: 1px solid #ced4da; background-color: #f8f9fa;">
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-sm text-center"
                                        name="reps[]" value="{{ $menuExercise->reps }}" min="1" max="999"
                                        style="border: 1px solid #ced4da; background-color: #f8f9fa;">
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-sm text-center"
                                        name="weights[]" value="{{ $menuExercise->weight }}" min="0"
                                        max="999" step="0.5"
                                        style="border: 1px solid #ced4da; background-color: #f8f9fa;">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-outline-danger btn-sm remove-exercise">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            {{-- Empty State --}}
            <div class="text-center py-5 text-muted {{ isset($menu) && $menu->menuExercises->count() > 0 ? 'd-none' : '' }}"
                id="emptyState">
                <p class="small">Drag & drop exercises from the side panels to add them</p>
            </div>
        </div>
    </div>
</div>
