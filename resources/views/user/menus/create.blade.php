{{-- resources/views/user/menus/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Menu-Create')

@section('content')
    @php $hideNavigation = true; @endphp {{-- ナビゲーションを非表示 --}}

    <div class="min-vh-100" style="background-color: #f8f9fa;">
        {{-- Header --}}
        @include('user.menus.partials.create.header')

        {{-- Main Content - 3 Column Layout --}}
        <div class="container-fluid px-5 py-3">
            <div class="row g-3" style="height: calc(100vh - 200px);">
                {{-- Left Column - Template Library (3/12) --}}
                <div class="col-3">
                    @include('user.menus.partials.create.template-library')
                </div>

                {{-- Center Column - Menu Editor (6/12) --}}
                <div class="col-6 d-flex flex-column">
                    {{-- Basic Information Card --}}
                    @include('user.menus.partials.create.basic-info')

                    {{-- Exercise Editor Card --}}
                    @include('user.menus.partials.create.exercise-editor')
                </div>

                {{-- Right Column - Exercise Catalog (3/12) --}}
                <div class="col-3">
                    @include('user.menus.partials.create.exercise-catalog')
                </div>
            </div>
        </div>

        {{-- AI Proposal Modal --}}
        {{-- @include('user.menus.partials.create.ai-proposal-modal') --}}

        {{-- Notification Toast --}}
        {{-- @include('user.menus.partials.create.notification-toast') --}}
    </div>

    @push('styles')
        <style>
            /* スクロールバーを常に表示し、幅の変化を防止 */
            .card-body.overflow-auto {
                overflow-y: scroll !important;
                /* 常にスクロールバーを表示 */
                scrollbar-width: thin;
                /* Firefox用 */
                -ms-overflow-style: scrollbar;
                /* IE/Edge用 */
            }

            /* ホバー効果 */
            .drag-handle {
                cursor: move;
            }

            .drag-over {
                background-color: #e3f2fd !important;
                border-color: #2196f3 !important;
            }

            .dragging {
                opacity: 0.5;
            }

            /* collapseアニメーションの無効化 */
            .collapse {
                transition: none !important;
            }

            /* 列の高さを固定 */
            .col-3,
            .col-6 {
                height: calc(100vh - 200px);
            }

            /* Exercise card hover effects */
            .exercise-card:hover,
            .template-card:hover {
                cursor: pointer;
                box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1) !important;
                border-color: #0d6efd !important;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Create button functionality
                const createButton = document.getElementById('createButton');
                if (createButton) {
                    createButton.addEventListener('click', function() {
                        const button = this;
                        const originalText = button.innerHTML;

                        // Show loading state
                        button.innerHTML =
                            '<span class="spinner-border spinner-border-sm me-1" role="status"></span>作成中...';
                        button.disabled = true;

                        // Simulate create process
                        setTimeout(() => {
                            button.innerHTML = originalText;
                            button.disabled = false;
                            // メニューが作成されました的な処理をここに追加
                            alert('メニューが作成されました');
                        }, 2000);
                    });
                }

                // トグルボタンのクリックイベントを処理
                const toggleButtons = document.querySelectorAll('.toggle-details');

                toggleButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        // クリックイベントの伝播を停止
                        e.stopPropagation();

                        // 現在のスクロール位置を記憶
                        const scrollContainer = document.querySelector('.template-library-container')
                            .parentElement;
                        const scrollPos = scrollContainer.scrollTop;

                        // collapseの表示/非表示が完了した後にスクロール位置を復元
                        setTimeout(() => {
                            scrollContainer.scrollTop = scrollPos;
                        }, 10);
                    });
                });

                // Exercise drag and drop functionality
                let draggedElement = null;

                document.addEventListener('dragstart', function(e) {
                    if (e.target.classList.contains('exercise-row')) {
                        draggedElement = e.target;
                        e.target.classList.add('dragging');
                    }

                    if (e.target.classList.contains('exercise-card') || e.target.classList.contains(
                            'template-card')) {
                        const exerciseName = e.target.getAttribute('data-exercise') ||
                            e.target.querySelector('.card-title').textContent.trim();
                        e.dataTransfer.setData('text/plain', exerciseName);
                    }
                });

                document.addEventListener('dragend', function(e) {
                    if (e.target.classList.contains('exercise-row')) {
                        e.target.classList.remove('dragging');
                    }
                    draggedElement = null;
                });

                // Drop functionality for adding new exercises
                document.addEventListener('drop', function(e) {
                    if (e.target.closest('#exerciseTableBody') && !draggedElement) {
                        e.preventDefault();
                        const exerciseName = e.dataTransfer.getData('text/plain');
                        if (exerciseName) {
                            addExerciseToTable(exerciseName);
                            // Show empty state if no exercises
                            toggleEmptyState();
                        }
                    }
                });

                document.addEventListener('dragover', function(e) {
                    if (e.target.closest('#exerciseTableBody')) {
                        e.preventDefault();
                    }
                });

                // Function to add exercise to table
                function addExerciseToTable(exerciseName) {
                    const tbody = document.getElementById('exerciseTableBody');
                    const newRow = document.createElement('tr');
                    newRow.className = 'exercise-row';
                    newRow.draggable = true;

                    newRow.innerHTML = `
            <td class="text-center">
                <i class="fa-solid fa-grip-vertical text-muted drag-handle"></i>
            </td>
            <td>
                <input type="text" 
                       class="form-control form-control-sm" 
                       value="${exerciseName}"
                       placeholder="種目名"
                       style="border: 1px solid #ced4da; background-color: #f8f9fa;">
            </td>
            <td>
                <input type="number" 
                       class="form-control form-control-sm text-center" 
                       value="3" 
                       min="1" 
                       max="999"
                       style="border: 1px solid #ced4da; background-color: #f8f9fa;">
            </td>
            <td>
                <input type="number" 
                       class="form-control form-control-sm text-center" 
                       value="10" 
                       min="1" 
                       max="999"
                       style="border: 1px solid #ced4da; background-color: #f8f9fa;">
            </td>
            <td>
                <input type="number" 
                       class="form-control form-control-sm text-center" 
                       value="" 
                       min="1" 
                       max="999"
                       step="0.5"
                       style="border: 1px solid #ced4da; background-color: #f8f9fa;">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-outline-danger btn-sm remove-exercise">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </td>
        `;

                    tbody.appendChild(newRow);
                }

                // Remove exercise functionality
                document.addEventListener('click', function(e) {
                    if (e.target.closest('.remove-exercise')) {
                        const row = e.target.closest('tr');
                        if (row) {
                            row.remove();
                            toggleEmptyState();
                        }
                    }
                });

                // Template add functionality
                document.addEventListener('click', function(e) {
                    if (e.target.closest('.template-card .btn-primary')) {
                        const templateCard = e.target.closest('.template-card');
                        const templateName = templateCard.querySelector('.card-title').textContent.trim();
                        // ここでテンプレートの種目を追加する処理
                        alert(templateName + 'テンプレートを追加しました');
                    }
                });

                // Exercise card click functionality
                document.addEventListener('click', function(e) {
                    if (e.target.closest('.exercise-card')) {
                        const exerciseCard = e.target.closest('.exercise-card');
                        const exerciseName = exerciseCard.getAttribute('data-exercise');
                        addExerciseToTable(exerciseName);
                        toggleEmptyState();
                    }
                });

                // Toggle empty state based on exercise count
                function toggleEmptyState() {
                    const tbody = document.getElementById('exerciseTableBody');
                    const emptyState = document.getElementById('emptyState');
                    const exerciseRows = tbody.querySelectorAll('.exercise-row');

                    if (exerciseRows.length === 0) {
                        emptyState.classList.remove('d-none');
                    } else {
                        emptyState.classList.add('d-none');
                    }
                }

                // Initial empty state check
                toggleEmptyState();
            });
        </script>
    @endpush
@endsection

@section('footer')

@endsection
