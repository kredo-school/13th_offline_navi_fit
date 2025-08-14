@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Header -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
                    <h2 class="mb-0">Workout Templates</h2>
                    <a href="{{ route('admin.templates.create') }}" class="btn btn-primary" aria-label="Create New Template"
                        title="新しいテンプレートを作成">
                        <i class="fas fa-plus"></i> Create New Template
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.templates.index') }}"
                            class="row g-2 align-items-center">
                            <div class="col-12 col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="Search templates..."
                                    value="{{ request('search') }}" aria-label="Search templates">
                            </div>
                            <div class="col-6 col-md-3 d-grid">
                                <button type="submit" class="btn btn-outline-secondary" aria-label="Search">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                            <div class="col-6 col-md-3 d-grid">
                                <a href="{{ route('admin.templates.index') }}" class="btn btn-outline-secondary"
                                    aria-label="Clear search">
                                    <i class="fas fa-times"></i> Clear
                                </a>
                            </div>
                        </form>
                        @if (request('search'))
                            <div class="mt-2 text-muted small">
                                <i class="fas fa-filter me-1"></i>Showing results for: <span
                                    class="fw-semibold">{{ request('search') }}</span>
                                <a href="{{ route('admin.templates.index') }}"
                                    class="ms-2 text-decoration-underline">Reset</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Success/Error Messages -->
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

                <!-- Templates List -->
                @if ($templates->count() > 0)
                    <div class="row">
                        @foreach ($templates as $template)
                            <div class="col-md-6 mb-4">
                                <div class="card template-card h-100">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">{{ $template->name }}</h5>
                                        <span
                                            class="badge bg-{{ $template->difficulty === 'easy' ? 'success' : ($template->difficulty === 'normal' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($template->difficulty) }}
                                        </span>
                                    </div>

                                    <!-- Template Thumbnail -->
                                    <div class="template-thumbnail bg-light">
                                        @if ($template->thumbnail_path)
                                            <img src="{{ asset('storage/' . $template->thumbnail_path) }}" class="card-img"
                                                alt="{{ $template->name }}"
                                                style="height: 160px; width: 100%; object-fit: contain;">
                                        @elseif ($template->thumbnail_url)
                                            <img src="{{ $template->thumbnail_url }}" class="card-img"
                                                alt="{{ $template->name }}"
                                                style="height: 160px; width: 100%; object-fit: contain;">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center"
                                                style="height: 160px;">
                                                <i class="fas fa-image fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Template Details -->
                                    <div class="card-body">
                                        @if ($template->description)
                                            <p class="card-text">{{ Str::limit($template->description, 100) }}</p>
                                        @endif
                                        <div class="row text-center mb-3">
                                            <div class="col-4">
                                                <small class="text-muted">Exercises</small>
                                                <div class="fw-bold">{{ $template->template_exercises_count }}</div>
                                            </div>
                                            <div class="col-4">
                                                <small class="text-muted">Duration</small>
                                                <div class="fw-bold">
                                                    @if ($template->total_duration > 0)
                                                        @if ($template->total_duration < 15)
                                                            About 15 min
                                                        @elseif($template->total_duration < 30)
                                                            About 30 min
                                                        @elseif($template->total_duration < 45)
                                                            About 45 min
                                                        @elseif($template->total_duration < 60)
                                                            About 1 hour
                                                        @elseif($template->total_duration < 90)
                                                            About 1.5 hours
                                                        @elseif($template->total_duration < 120)
                                                            About 2 hours
                                                        @else
                                                            About {{ ceil($template->total_duration / 60) }} hours
                                                        @endif
                                                    @else
                                                        <span class="text-muted">Not set</span>
                                                    @endif

                                                    
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <small class="text-muted">Volume</small>
                                                <div class="fw-bold">{{ $template->total_volume ?? 0 }} kg</div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                Created: {{ $template->created_at->format('M d, Y') }}
                                            </small>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.templates.show', $template) }}"
                                                    class="btn btn-sm btn-outline-primary"
                                                    aria-label="View details for {{ $template->name }}" title="詳細">
                                                    <i class="fas fa-eye"></i> Details
                                                </a>
                                                <a href="{{ route('admin.templates.edit', $template) }}"
                                                    class="btn btn-sm btn-outline-secondary"
                                                    aria-label="Edit {{ $template->name }}" title="編集">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form method="POST"
                                                    action="{{ route('admin.templates.destroy', $template) }}"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this template?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        aria-label="Delete {{ $template->name }}" title="削除">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $templates->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-dumbbell fa-3x text-muted mb-3"></i>
                            <h4>No Workout Templates Yet</h4>
                            <p class="text-muted">Create your first workout template to get started</p>
                            <a href="{{ route('admin.templates.create') }}" class="btn btn-primary"
                                aria-label="Create your first template">
                                <i class="fas fa-plus"></i> Create Your First Template
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <style>
        /* カードのホバー効果 */
        .template-card {
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .template-card:hover,
        .template-card:focus-within {
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.12);
            transform: translateY(-2px) scale(1.01);
            z-index: 2;
        }
    </style>
@endsection
