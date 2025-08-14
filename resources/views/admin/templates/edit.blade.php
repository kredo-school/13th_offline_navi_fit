@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Header -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
                    <h2 class="mb-0">Edit Template: {{ $template->name }}</h2>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.templates.show', $template) }}" class="btn btn-outline-secondary"
                            aria-label="View Template" title="View Template">
                            <i class="fas fa-eye"></i> View Template
                        </a>
                        <a href="{{ route('admin.templates.index') }}" class="btn btn-outline-secondary"
                            aria-label="Back to Templates" title="Back to Templates">
                            <i class="fas fa-arrow-left"></i> Back to Templates
                        </a>
                    </div>
                </div>

                <!-- Form -->
                <!-- Feedback Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.templates.update', $template) }}" id="templateForm"
                    autocomplete="on" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Left Column - Template Info -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Template Information</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Name -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Template Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $template->name) }}"
                                            required maxlength="100" placeholder="e.g. Full Body Beginner"
                                            aria-label="Template Name" aria-required="true">
                                        <div class="form-text">Enter a unique name for this template (max 100 characters).
                                        </div>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                            rows="3" maxlength="500" placeholder="Describe the template purpose, target, etc." aria-label="Description">{{ old('description', $template->description) }}</textarea>
                                        <div class="form-text">Optional. Max 500 characters.</div>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Difficulty -->
                                    <div class="mb-3">
                                        <label for="difficulty" class="form-label">Difficulty</label>
                                        <select class="form-select @error('difficulty') is-invalid @enderror"
                                            id="difficulty" name="difficulty" aria-label="Difficulty">
                                            <option value="easy"
                                                {{ old('difficulty', $template->difficulty) === 'easy' ? 'selected' : '' }}>
                                                Easy</option>
                                            <option value="normal"
                                                {{ old('difficulty', $template->difficulty) === 'normal' ? 'selected' : '' }}>
                                                Normal</option>
                                            <option value="hard"
                                                {{ old('difficulty', $template->difficulty) === 'hard' ? 'selected' : '' }}>
                                                Hard</option>
                                        </select>
                                        <div class="form-text">Select the overall difficulty level.</div>
                                        @error('difficulty')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Current Thumbnail -->
                                    <div class="mb-3">
                                        <label class="form-label">Current Thumbnail</label>
                                        <div>
                                            @if ($template->thumbnail_path)
                                                <img src="{{ asset('storage/' . $template->thumbnail_path) }}"
                                                    alt="{{ $template->name }}" class="img-thumbnail"
                                                    style="height: 200px; width: 100%; object-fit: contain;">
                                            @else
                                                <p class="text-muted">No thumbnail uploaded</p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Thumbnail Upload -->
                                    <div class="mb-3">
                                        <label for="thumbnail" class="form-label">Update Thumbnail</label>
                                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                            id="thumbnail" name="thumbnail" accept="image/*"
                                            aria-label="Template Thumbnail">
                                        <div class="form-text">Optional. Max file size: 2MB. Supported formats: JPEG, PNG,
                                            JPG, GIF</div>
                                        @error('thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Is Active -->
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                                value="1"
                                                {{ old('is_active', $template->is_active) ? 'checked' : '' }}
                                                aria-label="Active Template">
                                            <label class="form-check-label" for="is_active">
                                                Active Template
                                            </label>
                                        </div>
                                        <div class="form-text">If checked, this template will be available for users.</div>
                                    </div>

                                    <!-- Template Stats -->
                                    <div class="alert alert-info">
                                        <h6>Template Stats</h6>
                                        <div class="row">
                                            <div class="col-6">
                                                <small><strong>Created:</strong><br>{{ $template->created_at->format('M d, Y') }}</small>
                                            </div>
                                            <div class="col-6">
                                                <small><strong>Last
                                                        Updated:</strong><br>{{ $template->updated_at->format('M d, Y') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Exercise Management -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Exercises ({{ $template->templateExercises->count() }})</h5>
                                    <button type="button" class="btn btn-sm btn-primary" id="addExerciseBtn"
                                        data-bs-toggle="modal" data-bs-target="#exerciseModal">
                                        <i class="fas fa-plus"></i> Add Exercise
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div id="exercisesList">
                                        @if ($template->templateExercises->isEmpty())
                                            <div class="alert alert-info" id="noExercisesAlert">
                                                No exercises added yet. Click "Add Exercise" to select exercises for this
                                                template.
                                            </div>
                                        @else
                                            @foreach ($template->templateExercises->sortBy('order_index') as $index => $templateExercise)
                                                <div class="card mb-3 exercise-item" id="exercise_{{ $index }}"
                                                    data-exercise-id="{{ $templateExercise->exercise_id }}">
                                                    <div
                                                        class="card-header d-flex justify-content-between align-items-center bg-light">
                                                        <div class="d-flex align-items-center">
                                                            <span
                                                                class="badge bg-primary me-2">#{{ $templateExercise->order_index }}</span>
                                                            <h6 class="mb-0">{{ $templateExercise->exercise->name }}
                                                            </h6>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-secondary move-up"
                                                                title="Move Up">
                                                                <i class="fas fa-arrow-up"></i>
                                                            </button>
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-secondary move-down"
                                                                title="Move Down">
                                                                <i class="fas fa-arrow-down"></i>
                                                            </button>
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-danger remove-exercise"
                                                                title="Remove">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <input type="hidden"
                                                            name="exercises[exercise_{{ $index }}][exercise_id]"
                                                            value="{{ $templateExercise->exercise_id }}">

                                                        <div class="row">
                                                            <div class="col-md-4 mb-2">
                                                                <label class="form-label">Sets</label>
                                                                <div class="input-group">
                                                                    <button class="btn btn-outline-secondary decrement"
                                                                        type="button">-</button>
                                                                    <input type="number" class="form-control text-center"
                                                                        name="exercises[exercise_{{ $index }}][sets]"
                                                                        value="{{ $templateExercise->sets }}"
                                                                        min="1" max="99">
                                                                    <button class="btn btn-outline-secondary increment"
                                                                        type="button">+</button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <label class="form-label">Reps</label>
                                                                <div class="input-group">
                                                                    <button class="btn btn-outline-secondary decrement"
                                                                        type="button">-</button>
                                                                    <input type="number" class="form-control text-center"
                                                                        name="exercises[exercise_{{ $index }}][reps]"
                                                                        value="{{ $templateExercise->reps }}"
                                                                        min="1" max="999">
                                                                    <button class="btn btn-outline-secondary increment"
                                                                        type="button">+</button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <label class="form-label">Weight (kg)</label>
                                                                <div class="input-group">
                                                                    <button class="btn btn-outline-secondary decrement"
                                                                        type="button">-</button>
                                                                    <input type="number" class="form-control text-center"
                                                                        name="exercises[exercise_{{ $index }}][weight]"
                                                                        value="{{ $templateExercise->weight ?? 0 }}"
                                                                        min="0" step="0.5">
                                                                    <button class="btn btn-outline-secondary increment"
                                                                        type="button">+</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Rest Time (sec)</label>
                                                                <div class="input-group">
                                                                    <button class="btn btn-outline-secondary decrement"
                                                                        type="button">-</button>
                                                                    <input type="number" class="form-control text-center"
                                                                        name="exercises[exercise_{{ $index }}][rest_seconds]"
                                                                        value="{{ $templateExercise->rest_seconds }}"
                                                                        min="0" max="999">
                                                                    <button class="btn btn-outline-secondary increment"
                                                                        type="button">+</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden"
                                                            name="exercises[exercise_{{ $index }}][order_index]"
                                                            value="{{ $templateExercise->order_index }}"
                                                            class="order-input">
                                                        <input type="hidden"
                                                            name="exercises[exercise_{{ $index }}][duration_seconds]"
                                                            value="{{ $templateExercise->duration_seconds }}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    @error('exercises')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Exercise Selection Modal -->
                        <div class="modal fade" id="exerciseModal" tabindex="-1" aria-labelledby="exerciseModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="exerciseModalLabel">Select Exercises</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3 position-relative">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                                <input type="text" class="form-control" id="exerciseSearch"
                                                    placeholder="Search by name, muscle group or equipment...">
                                                <button class="btn btn-outline-secondary" type="button"
                                                    id="searchClear">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                            <small id="searchResultsInfo" class="text-muted mt-1"
                                                style="display: none;"></small>
                                        </div>
                                        <div class="table-responsive" style="max-height: 50vh; overflow-y: auto;">
                                            <table class="table table-hover" id="exercisesTable">
                                                <thead class="sticky-top bg-light">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Muscle Groups</th>
                                                        <th>Equipment</th>
                                                        <th>Difficulty</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($exercises as $exercise)
                                                        <tr data-exercise-id="{{ $exercise->id }}"
                                                            data-exercise-name="{{ $exercise->name }}">
                                                            <td>{{ $exercise->name }}</td>
                                                            <td>{{ is_array($exercise->muscle_groups) ? implode(', ', $exercise->muscle_groups) : $exercise->muscle_groups }}
                                                            </td>
                                                            <td>{{ $exercise->equipment_category }}</td>
                                                            <td>
                                                                <span
                                                                    class="badge bg-{{ $exercise->difficulty === 'easy' ? 'success' : ($exercise->difficulty === 'normal' ? 'warning' : 'danger') }}">
                                                                    {{ ucfirst($exercise->difficulty) }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-primary select-exercise">
                                                                    Select
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="exerciseDoneBtn">Done</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.templates.show', $template) }}" class="btn btn-secondary me-2"
                                    aria-label="Cancel and go back" title="Cancel">Cancel</a>
                                <button type="submit" class="btn btn-primary" aria-label="Update Template"
                                    title="Update Template" id="submitBtn">
                                    <span id="submitBtnText"><i class="fas fa-save"></i> Update Template</span>
                                    <span id="submitBtnLoading" class="d-none"><span
                                            class="spinner-border spinner-border-sm me-1"></span>Saving...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Delete Form -->
                <div class="row mt-3">
                    <div class="col-12">
                        <form method="POST" action="{{ route('admin.templates.destroy', $template) }}"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" aria-label="Delete Template"
                                title="Delete Template" id="deleteBtn"
                                onclick="return confirm('Are you sure you want to delete this template? This action cannot be undone.')">
                                <span id="deleteBtnText"><i class="fas fa-trash"></i> Delete Template</span>
                                <span id="deleteBtnLoading" class="d-none"><span
                                        class="spinner-border spinner-border-sm me-1"></span>Deleting...</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Responsive form section spacing */
        @media (max-width: 767px) {
            .card {
                margin-bottom: 1.5rem;
            }
        }

        /* Button hover/focus */
        .btn:focus,
        .btn:hover {
            opacity: 0.92;
        }

        .exercise-item {
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .exercise-item:hover,
        .exercise-item:focus-within {
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.12);
            transform: translateY(-2px) scale(1.01);
            z-index: 2;
        }
    </style>
    <script>
        // Exercise selection functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Prevent double submit and show loading
            const form = document.getElementById('templateForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitBtnText = document.getElementById('submitBtnText');
            const submitBtnLoading = document.getElementById('submitBtnLoading');
            const deleteBtn = document.getElementById('deleteBtn');
            const deleteBtnText = document.getElementById('deleteBtnText');
            const deleteBtnLoading = document.getElementById('deleteBtnLoading');

            if (form && submitBtn) {
                form.addEventListener('submit', function() {
                    submitBtn.disabled = true;
                    if (submitBtnText && submitBtnLoading) {
                        submitBtnText.classList.add('d-none');
                        submitBtnLoading.classList.remove('d-none');
                    }
                });
            }

            if (deleteBtn) {
                deleteBtn.addEventListener('click', function() {
                    deleteBtn.disabled = true;
                    if (deleteBtnText && deleteBtnLoading) {
                        deleteBtnText.classList.add('d-none');
                        deleteBtnLoading.classList.remove('d-none');
                    }
                });
            }

            // Elements
            const exercisesList = document.getElementById('exercisesList');
            const noExercisesAlert = document.getElementById('noExercisesAlert');
            const exerciseSearch = document.getElementById('exerciseSearch');
            const exercisesTable = document.getElementById('exercisesTable');
            const modalElement = document.getElementById('exerciseModal');

            // Bootstrap Modal のためのヘルパー関数
            function showModal() {
                if (modalElement) {
                    modalElement.classList.add('show');
                    modalElement.style.display = 'block';
                    document.body.classList.add('modal-open');
                    const backdrop = document.createElement('div');
                    backdrop.className = 'modal-backdrop fade show';
                    document.body.appendChild(backdrop);
                }
            }

            function hideModal() {
                if (modalElement) {
                    modalElement.classList.remove('show');
                    modalElement.style.display = 'none';
                    document.body.classList.remove('modal-open');
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                        backdrop.parentNode.removeChild(backdrop);
                    }
                }
            }

            // モーダルを閉じるボタンのイベント
            document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    hideModal();
                });
            });

            // モーダルの外側クリックで閉じる
            window.addEventListener('click', function(event) {
                if (event.target === modalElement) {
                    hideModal();
                }
            });

            // Add Exercise ボタンイベント
            const addExerciseBtn = document.getElementById('addExerciseBtn');
            if (addExerciseBtn) {
                addExerciseBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    showModal();
                });
            }

            // Exercise counter for unique IDs - 既存の数をカウント
            let exerciseCounter = document.querySelectorAll('.exercise-item').length;

            // 追加済みエクササイズのIDを保持する配列
            let addedExerciseIds = [];

            // 既存のエクササイズIDを配列に追加
            document.querySelectorAll('.exercise-item').forEach(item => {
                addedExerciseIds.push(item.dataset.exerciseId);
            });

            // Add event listeners to existing exercises
            setupExistingExercises();

            function setupExistingExercises() {
                // Add increment/decrement event listeners to existing items
                document.querySelectorAll('.exercise-item .increment').forEach(button => {
                    button.addEventListener('click', function() {
                        const input = this.parentNode.querySelector('input');
                        const step = parseFloat(input.step) || 1;
                        input.value = (parseFloat(input.value) + step).toString();
                    });
                });

                document.querySelectorAll('.exercise-item .decrement').forEach(button => {
                    button.addEventListener('click', function() {
                        const input = this.parentNode.querySelector('input');
                        const min = parseFloat(input.min) || 0;
                        const step = parseFloat(input.step) || 1;
                        const newValue = Math.max(min, parseFloat(input.value) - step);
                        input.value = newValue.toString();
                    });
                });

                // Add move up/down event listeners
                document.querySelectorAll('.exercise-item .move-up').forEach(button => {
                    button.addEventListener('click', function() {
                        const exerciseCard = this.closest('.exercise-item');
                        const prevExercise = exerciseCard.previousElementSibling;
                        if (prevExercise && prevExercise.classList.contains('exercise-item')) {
                            exercisesList.insertBefore(exerciseCard, prevExercise);
                            updateExerciseOrder();
                        }
                    });
                });

                document.querySelectorAll('.exercise-item .move-down').forEach(button => {
                    button.addEventListener('click', function() {
                        const exerciseCard = this.closest('.exercise-item');
                        const nextExercise = exerciseCard.nextElementSibling;
                        if (nextExercise && nextExercise.classList.contains('exercise-item')) {
                            exercisesList.insertBefore(nextExercise, exerciseCard);
                            updateExerciseOrder();
                        }
                    });
                });

                // Add remove event listener
                document.querySelectorAll('.exercise-item .remove-exercise').forEach(button => {
                    button.addEventListener('click', function() {
                        const exerciseCard = this.closest('.exercise-item');
                        const exerciseId = exerciseCard.dataset.exerciseId;

                        // 追加済みリストから削除
                        addedExerciseIds = addedExerciseIds.filter(id => id !== exerciseId);

                        // モーダル内のボタンを再度有効化
                        const modalButton = exercisesTable.querySelector(
                            `tr[data-exercise-id="${exerciseId}"] .select-exercise`);
                        if (modalButton) {
                            modalButton.innerHTML = 'Select';
                            modalButton.classList.remove('btn-success');
                            modalButton.classList.add('btn-primary');
                            modalButton.disabled = false;
                        }

                        // カードを削除
                        exerciseCard.remove();

                        // 順序を更新
                        updateExerciseOrder();

                        // Show no exercises alert if no exercises left
                        if (exercisesList.querySelectorAll('.exercise-item').length === 0) {
                            if (!noExercisesAlert) {
                                const alertDiv = document.createElement('div');
                                alertDiv.className = 'alert alert-info';
                                alertDiv.id = 'noExercisesAlert';
                                alertDiv.textContent =
                                    'No exercises added yet. Click "Add Exercise" to select exercises for this template.';
                                exercisesList.appendChild(alertDiv);
                            } else {
                                noExercisesAlert.style.display = '';
                            }
                        }
                    });
                });
            }

            // Search functionality with enhanced UI feedback
            if (exerciseSearch) {
                exerciseSearch.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const rows = exercisesTable.querySelectorAll('tbody tr');
                    let resultsCount = 0;

                    rows.forEach(row => {
                        const exerciseId = row.dataset.exerciseId;
                        const exerciseName = row.querySelector('td:first-child').textContent
                            .toLowerCase();
                        const muscleGroups = row.querySelector('td:nth-child(2)').textContent
                            .toLowerCase();
                        const equipment = row.querySelector('td:nth-child(3)').textContent
                            .toLowerCase();

                        // 既に追加されたエクササイズはボタンを無効化
                        const selectButton = row.querySelector('.select-exercise');
                        if (addedExerciseIds.includes(exerciseId)) {
                            selectButton.innerHTML = 'Added';
                            selectButton.classList.remove('btn-primary');
                            selectButton.classList.add('btn-success');
                            selectButton.disabled = true;
                        } else {
                            selectButton.innerHTML = 'Select';
                            selectButton.classList.remove('btn-success');
                            selectButton.classList.add('btn-primary');
                            selectButton.disabled = false;
                        }

                        if (exerciseName.includes(searchTerm) ||
                            muscleGroups.includes(searchTerm) ||
                            equipment.includes(searchTerm)) {
                            row.style.display = '';
                            resultsCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    // 検索結果のフィードバック
                    const resultsInfo = document.getElementById('searchResultsInfo');
                    if (resultsInfo) {
                        if (searchTerm) {
                            resultsInfo.textContent = `Found ${resultsCount} exercise(s)`;
                            resultsInfo.style.display = 'block';
                        } else {
                            resultsInfo.style.display = 'none';
                        }
                    }
                });

                // モーダルを開いたときに検索ボックスをクリアして結果を更新
                addExerciseBtn.addEventListener('click', function() {
                    exerciseSearch.value = '';
                    exerciseSearch.dispatchEvent(new Event('input'));
                });

                // クリアボタンの追加
                const searchClear = document.getElementById('searchClear');
                if (searchClear) {
                    searchClear.addEventListener('click', function() {
                        exerciseSearch.value = '';
                        exerciseSearch.dispatchEvent(new Event('input'));
                        exerciseSearch.focus();
                    });
                }
            }

            // Select exercise buttons
            document.querySelectorAll('.select-exercise').forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const exerciseId = row.dataset.exerciseId;
                    const exerciseName = row.dataset.exerciseName;

                    // 重複追加を防止
                    if (!addedExerciseIds.includes(exerciseId)) {
                        addExerciseToList(exerciseId, exerciseName);

                        // 追加済みマーク付け
                        addedExerciseIds.push(exerciseId);
                        this.innerHTML = 'Added';
                        this.classList.remove('btn-primary');
                        this.classList.add('btn-success');
                        this.disabled = true;

                        // 確認メッセージ表示
                        showNotification(`Exercise "${exerciseName}" added`);
                    }

                    // モーダルを閉じない - 複数追加しやすくする
                    // hideModal();
                });
            });

            // 通知表示関数
            function showNotification(message, type = 'success') {
                const notification = document.createElement('div');
                notification.className = `alert alert-${type} notification-toast`;
                notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" aria-label="Close"></button>
            `;

                // スタイル
                notification.style.position = 'fixed';
                notification.style.top = '20px';
                notification.style.right = '20px';
                notification.style.zIndex = '9999';
                notification.style.minWidth = '250px';
                notification.style.opacity = '0';
                notification.style.transition = 'opacity 0.3s ease';

                document.body.appendChild(notification);

                // フェードイン
                setTimeout(() => {
                    notification.style.opacity = '1';
                }, 10);

                // 閉じるボタン
                notification.querySelector('.btn-close').addEventListener('click', function() {
                    notification.style.opacity = '0';
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                });

                // 自動的に消える
                setTimeout(() => {
                    notification.style.opacity = '0';
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                }, 3000);
            }

            // Add exercise to the list
            function addExerciseToList(exerciseId, exerciseName) {
                // Hide no exercises alert if visible
                if (noExercisesAlert) {
                    noExercisesAlert.style.display = 'none';
                }

                // 追加済みエクササイズの数を取得
                const exerciseItems = exercisesList.querySelectorAll('.exercise-item');
                const currentOrder = exerciseItems.length + 1;

                // Create unique identifier for this exercise entry
                const uniqueId = `exercise_${exerciseCounter++}`;

                // Create exercise card
                const exerciseCard = document.createElement('div');
                exerciseCard.className = 'card mb-3 exercise-item';
                exerciseCard.id = uniqueId;
                exerciseCard.dataset.exerciseId = exerciseId;

                exerciseCard.innerHTML = `
                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-primary me-2">#${currentOrder}</span>
                        <h6 class="mb-0">${exerciseName}</h6>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary move-up" title="Move Up">
                            <i class="fas fa-arrow-up"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary move-down" title="Move Down">
                            <i class="fas fa-arrow-down"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-exercise" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <input type="hidden" name="exercises[${uniqueId}][exercise_id]" value="${exerciseId}">
                    
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Sets</label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary decrement" type="button">-</button>
                                <input type="number" class="form-control text-center" name="exercises[${uniqueId}][sets]" value="3" min="1" max="99">
                                <button class="btn btn-outline-secondary increment" type="button">+</button>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Reps</label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary decrement" type="button">-</button>
                                <input type="number" class="form-control text-center" name="exercises[${uniqueId}][reps]" value="10" min="1" max="999">
                                <button class="btn btn-outline-secondary increment" type="button">+</button>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Weight (kg)</label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary decrement" type="button">-</button>
                                <input type="number" class="form-control text-center" name="exercises[${uniqueId}][weight]" value="0" min="0" step="0.5">
                                <button class="btn btn-outline-secondary increment" type="button">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="form-label">Rest Time (sec)</label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary decrement" type="button">-</button>
                                <input type="number" class="form-control text-center" name="exercises[${uniqueId}][rest_seconds]" value="60" min="0" max="999">
                                <button class="btn btn-outline-secondary increment" type="button">+</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="order-input" name="exercises[${uniqueId}][order_index]" value="${currentOrder}">
                    <input type="hidden" name="exercises[${uniqueId}][duration_seconds]" value="">
                </div>
            `;

                // Add to exercises list
                exercisesList.appendChild(exerciseCard);

                // Add increment/decrement event listeners
                exerciseCard.querySelectorAll('.increment').forEach(button => {
                    button.addEventListener('click', function() {
                        const input = this.parentNode.querySelector('input');
                        const step = parseFloat(input.step) || 1;
                        input.value = (parseFloat(input.value) + step).toString();
                    });
                });

                exerciseCard.querySelectorAll('.decrement').forEach(button => {
                    button.addEventListener('click', function() {
                        const input = this.parentNode.querySelector('input');
                        const min = parseFloat(input.min) || 0;
                        const step = parseFloat(input.step) || 1;
                        const newValue = Math.max(min, parseFloat(input.value) - step);
                        input.value = newValue.toString();
                    });
                });

                // Add move up/down event listeners
                exerciseCard.querySelector('.move-up').addEventListener('click', function() {
                    const prevExercise = exerciseCard.previousElementSibling;
                    if (prevExercise && prevExercise.classList.contains('exercise-item')) {
                        exercisesList.insertBefore(exerciseCard, prevExercise);
                        updateExerciseOrder();
                    }
                });

                exerciseCard.querySelector('.move-down').addEventListener('click', function() {
                    const nextExercise = exerciseCard.nextElementSibling;
                    if (nextExercise && nextExercise.classList.contains('exercise-item')) {
                        exercisesList.insertBefore(nextExercise, exerciseCard);
                        updateExerciseOrder();
                    }
                });

                // Add remove event listener
                exerciseCard.querySelector('.remove-exercise').addEventListener('click', function() {
                    // 追加済みリストから削除
                    addedExerciseIds = addedExerciseIds.filter(id => id !== exerciseId);

                    // モーダル内のボタンを再度有効化
                    const modalButton = exercisesTable.querySelector(
                        `tr[data-exercise-id="${exerciseId}"] .select-exercise`);
                    if (modalButton) {
                        modalButton.innerHTML = 'Select';
                        modalButton.classList.remove('btn-success');
                        modalButton.classList.add('btn-primary');
                        modalButton.disabled = false;
                    }

                    // カードを削除
                    exerciseCard.remove();

                    // 順序を更新
                    updateExerciseOrder();

                    // Show no exercises alert if no exercises left
                    if (exercisesList.querySelectorAll('.exercise-item').length === 0) {
                        if (!noExercisesAlert) {
                            const alertDiv = document.createElement('div');
                            alertDiv.className = 'alert alert-info';
                            alertDiv.id = 'noExercisesAlert';
                            alertDiv.textContent =
                                'No exercises added yet. Click "Add Exercise" to select exercises for this template.';
                            exercisesList.appendChild(alertDiv);
                        } else {
                            noExercisesAlert.style.display = '';
                        }
                    }
                });
            }

            // 全エクササイズの順序を更新
            function updateExerciseOrder() {
                const exerciseItems = exercisesList.querySelectorAll('.exercise-item');
                exerciseItems.forEach((item, index) => {
                    const orderNum = index + 1;
                    // 順序バッジを更新
                    item.querySelector('.badge').textContent = `#${orderNum}`;
                    // order_index入力フィールドを更新
                    item.querySelector('.order-input').value = orderNum;
                });
            }

            // 完了ボタン（モーダル内）
            const doneButton = document.getElementById('exerciseDoneBtn');
            if (doneButton) {
                doneButton.addEventListener('click', function() {
                    hideModal();
                    const count = exercisesList.querySelectorAll('.exercise-item').length;
                    if (count > 0) {
                        showNotification(`Template has ${count} exercise(s)`, 'info');
                    }
                });
            }

            // 初期ロード時にモーダル内の追加済みボタンを処理
            if (exercisesTable) {
                exerciseSearch.dispatchEvent(new Event('input'));
            }
        });
    </script>
@endsection
