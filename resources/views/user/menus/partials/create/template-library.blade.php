{{-- resources/views/user/menus/partials/create/template-library.blade.php --}}
<div class="card border-0 shadow-sm h-100 d-flex flex-column">
    <div class="card-header bg-white border-bottom">
        <h6 class="card-title mb-1">テンプレートライブラリ</h6>
        <small class="text-muted">クリックして詳細を確認</small>
    </div>

    <div class="card-body flex-fill overflow-auto p-4 template-library-container">
        <div class="d-flex flex-column gap-3">
            @forelse($templates as $template)
                <div class="card border template-card" draggable="true">
                    <div class="position-relative">
                        <img src="{{ $template->image_url ?? 'https://images.pexels.com/photos/1552252/pexels-photo-1552252.jpeg?auto=compress&cs=tinysrgb&w=200&h=120&fit=crop' }}"
                            class="card-img-top" alt="{{ $template->name }}" style="height: 120px; object-fit: cover;">
                        @php
                            $badgeClass = 'bg-success';
                            if ($template->difficulty === 'intermediate') {
                                $badgeClass = 'bg-warning text-dark';
                            } elseif ($template->difficulty === 'advanced') {
                                $badgeClass = 'bg-danger';
                            }

                            $difficultyLabel = '初級';
                            if ($template->difficulty === 'intermediate') {
                                $difficultyLabel = '中級';
                            } elseif ($template->difficulty === 'advanced') {
                                $difficultyLabel = '上級';
                            }
                        @endphp
                        <span class="badge {{ $badgeClass }} position-absolute top-0 end-0 m-1"
                            style="font-size: 0.75rem;">{{ $difficultyLabel }}</span>
                    </div>

                    <div class="card-body p-3">
                        <h6 class="card-title mb-1" style="font-size: 0.95rem;">{{ $template->name }}</h6>
                        <p class="card-text text-muted mb-2" style="font-size: 0.8rem;">{{ $template->description }}</p>

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center">
                                <i class="fa-regular fa-clock me-1" style="font-size: 0.8rem;"></i>
                                <span style="font-size: 0.8rem;">{{ $template->estimated_time ?? '30' }}分</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-bullseye me-1" style="font-size: 0.8rem;"></i>
                                <span style="font-size: 0.8rem;">{{ $template->templateExercises->count() }}種目</span>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-primary btn-sm flex-fill" style="font-size: 0.8rem;"
                                data-bs-toggle="modal" 
                                data-bs-target="#templateDetailsModal"
                                data-template-id="{{ $template->id }}">
                                <i class="fa-solid fa-eye me-1"></i>詳細
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-clipboard-x display-6 text-muted mb-2"></i>
                    <p>テンプレートが見つかりません</p>
                </div>
            @endforelse
        </div>
    </div>
</div>