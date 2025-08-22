{{-- Mobile Card View --}}
<div class="d-md-none">
    <div class="row g-3 mb-4">
        @forelse ($records as $record)
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <div class="fw-medium">{{ $record->training_date->format('Y/m/d (D) H:i') }}</div>
                                <div class="text-muted small">{{ $record->menu->name ?? '-' }}</div>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary" type="button"
                                    data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('training-history.edit', $record->id) }}">
                                            Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form method="POST"
                                            action="{{ route('training-history.destroy', $record->id) }}">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger"
                                                onclick="return confirm('Are you sure you want to delete?')">
                                                Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <h3 class="h6 mb-3">{{ $record->menu->name ?? 'No menu set' }}</h3>

                        <div class="row text-center mb-3">
                            <div class="col-3">
                                <div class="fw-medium">{{ $record->details->count() }}</div>
                                <div class="text-muted small">Sets</div>
                            </div>
                            <div class="col-3">
                                <div class="fw-medium">{{ $record->details->sum('reps') }}</div>
                                <div class="text-muted small">Reps</div>
                            </div>
                            <div class="col-3">
                                <div class="fw-medium">{{ number_format($record->details->sum('volume')) }}</div>
                                <div class="text-muted small">kg</div>
                            </div>
                            <div class="col-3">
                                <div class="fw-medium">{{ $record->duration_minutes ?? '-' }}</div>
                                <div class="text-muted small">min</div>
                            </div>
                        </div>

                        <div class="border-top pt-3">
                            <p class="text-muted small mb-0">{{ $record->note ?? 'No notes' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">No records found.</div>
        @endforelse
    </div>
</div>

{{-- Desktop Table View --}}
<div class="d-none d-md-block">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Date/Time</th>
                            <th>Menu</th>
                            <th>Template</th>
                            <th class="text-center">Sets</th>
                            <th class="text-center">Total Reps</th>
                            <th class="text-center">Total Weight</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($records as $record)
                            <tr>
                                <td>
                                    <a href="{{ route('training-history.show', $record->id) }}"
                                        class="text-decoration-none">
                                        {{ $record->training_date->format('Y/m/d (D)') }}<br>
                                        <small class="text-muted">{{ $record->training_date->format('H:i') }}</small>
                                    </a>
                                </td>
                                <td>{{ $record->menu->name ?? '-' }}</td>
                                <td>{{ $record->menu->basedOnTemplate->name ?? '-' }}</td>
                                <td class="text-center">{{ $record->details->count() }}</td>
                                <td class="text-center">{{ $record->details->sum('reps') }}</td>
                                <td class="text-center">{{ number_format($record->details->sum('volume')) }} kg</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('training-history.show', $record->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('training-history.edit', $record->id) }}"
                                            class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $record->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $record->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirm Deletion</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this training record? This
                                                        action cannot be undone.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <form
                                                            action="{{ route('training-history.destroy', $record->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
