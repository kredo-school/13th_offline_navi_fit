@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h2><i class="fas fa-weight me-2" style="color: #254D70;"></i>Record Weight & Body Fat</h2>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Input Form Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-body"
                        style="background: linear-gradient(135deg, #254D70 0%, #3d6a91 100%); border-radius: 15px;">
                        <form action="{{ route('body-records.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <!-- Measurement Date -->
                                <div class="col-md-3">
                                    <label for="recorded_date" class="form-label text-white">
                                        <i class="fas fa-calendar-alt me-1"></i>Measurement Date
                                    </label>
                                    <input type="date" class="form-control @error('recorded_date') is-invalid @enderror"
                                        id="recorded_date" name="recorded_date"
                                        value="{{ old('recorded_date', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}"
                                        required>
                                    @error('recorded_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Weight -->
                                <div class="col-md-3">
                                    <label for="weight" class="form-label text-white">
                                        <i class="fas fa-weight-hanging me-1"></i>Weight(kg) <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input type="number" step="0.1" min="1" max="999.9"
                                        class="form-control @error('weight') is-invalid @enderror" id="weight"
                                        name="weight" value="{{ old('weight') }}" placeholder="70.5" required>
                                    @error('weight')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Body Fat Percentage -->
                                <div class="col-md-3">
                                    <label for="body_fat_percentage" class="form-label text-white">
                                        <i class="fas fa-percentage me-1"></i>Body Fat (%)
                                    </label>
                                    <input type="number" step="0.1" min="0" max="100"
                                        class="form-control @error('body_fat_percentage') is-invalid @enderror"
                                        id="body_fat_percentage" name="body_fat_percentage"
                                        value="{{ old('body_fat_percentage') }}" placeholder="15.2">
                                    @error('body_fat_percentage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-light btn-lg w-100"
                                        style="border-radius: 10px; font-weight: 600;">
                                        <i class="fas fa-save me-2"></i>Save
                                    </button>
                                </div>
                            </div>

                            <!-- Memo Section -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="memo" class="form-label text-white">
                                        <i class="fas fa-sticky-note me-1"></i>Memo (Optional)
                                    </label>
                                    <textarea class="form-control @error('memo') is-invalid @enderror" id="memo" name="memo" rows="2"
                                        placeholder="Notes about today's measurement...">{{ old('memo') }}</textarea>
                                    @error('memo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Records List Section -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-header border-0 pb-0" style="background: transparent;">
                        <h5 class="mb-0"><i class="fas fa-history me-2" style="color: #254D70;"></i>Measurement History
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($bodyRecords->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead style="background-color: #f8f9fa;">
                                        <tr>
                                            <th><i class="fas fa-calendar-alt me-1"></i>Date</th>
                                            <th><i class="fas fa-weight-hanging me-1"></i>Weight (kg)</th>
                                            <th><i class="fas fa-percentage me-1"></i>Body Fat (%)</th>
                                            <th><i class="fas fa-sticky-note me-1"></i>Memo</th>
                                            <th width="150"><i class="fas fa-cogs me-1"></i>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bodyRecords as $record)
                                            <tr>
                                                <td>
                                                    <span class="badge bg-primary px-3 py-2" style="font-size: 0.9em;">
                                                        {{ $record->recorded_date->format('M d, Y') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <strong
                                                        style="color: #254D70;">{{ number_format($record->weight, 1) }}</strong>
                                                    kg
                                                </td>
                                                <td>
                                                    @if ($record->body_fat_percentage)
                                                        <strong
                                                            style="color: #28a745;">{{ number_format($record->body_fat_percentage, 1) }}</strong>
                                                        %
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($record->memo)
                                                        <span class="text-truncate d-inline-block"
                                                            style="max-width: 200px;" title="{{ $record->memo }}">
                                                            {{ $record->memo }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-outline-primary btn-sm me-1 edit-record"
                                                        data-bs-toggle="modal" data-bs-target="#editRecordModal"
                                                        data-id="{{ $record->id }}"
                                                        data-date="{{ $record->recorded_date->format('Y-m-d') }}"
                                                        data-weight="{{ $record->weight }}"
                                                        data-bodyfat="{{ $record->body_fat_percentage }}"
                                                        data-memo="{{ $record->memo }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <form action="{{ route('body-records.destroy', $record) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $bodyRecords->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No Measurement Records Yet</h5>
                                <p class="text-muted">Record your first measurement using the form above.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Record Modal -->
    <div class="modal fade" id="editRecordModal" tabindex="-1" aria-labelledby="editRecordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRecordModalLabel">Edit Body Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editRecordForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_recorded_date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="edit_recorded_date" name="recorded_date"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_weight" class="form-label">Weight (kg)</label>
                            <input type="number" step="0.1" min="1" max="999.9" class="form-control"
                                id="edit_weight" name="weight" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_body_fat_percentage" class="form-label">Body Fat (%)</label>
                            <input type="number" step="0.1" min="0" max="100" class="form-control"
                                id="edit_body_fat_percentage" name="body_fat_percentage">
                        </div>
                        <div class="mb-3">
                            <label for="edit_memo" class="form-label">Memo</label>
                            <textarea class="form-control" id="edit_memo" name="memo" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 編集ボタンがクリックされたときの処理
            const editButtons = document.querySelectorAll('.edit-record');
            const editForm = document.getElementById('editRecordForm');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // データ属性からフォームに値をセット
                    const id = this.getAttribute('data-id');
                    const date = this.getAttribute('data-date');
                    const weight = this.getAttribute('data-weight');
                    const bodyfat = this.getAttribute('data-bodyfat');
                    const memo = this.getAttribute('data-memo');

                    // フォームのアクションを設定
                    editForm.action = `/body-records/${id}`;

                    // フォームの値を設定
                    document.getElementById('edit_recorded_date').value = date;
                    document.getElementById('edit_weight').value = weight;
                    document.getElementById('edit_body_fat_percentage').value = bodyfat;
                    document.getElementById('edit_memo').value = memo;
                });
            });
        });
    </script>
@endsection
