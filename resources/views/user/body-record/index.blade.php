@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h2><i class="fas fa-weight me-2" style="color: #254D70;"></i>Record Weight & Body Fat</h2>
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
                                                    <a href="{{ route('body-records.edit', $record) }}"
                                                        class="btn btn-outline-primary btn-sm me-1">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
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

@endsection
