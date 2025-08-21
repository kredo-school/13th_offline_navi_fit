@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Training Record</h1>

        <form method="POST" action="{{ route('training-history.update', $record->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="training_date" class="form-label">Training Date</label>
                <input type="datetime-local" name="training_date" id="training_date"
                    class="form-control @error('training_date') is-invalid @enderror"
                    value="{{ old('training_date', $record->training_date->format('Y-m-d\TH:i')) }}" required>
                @error('training_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Notes</label>
                <textarea name="note" id="note" rows="4" class="form-control @error('note') is-invalid @enderror">{{ old('note', $record->note) }}</textarea>
                @error('note')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('training-history.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    Delete
                </button>
            </div>
        </form>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this training record? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('training-history.destroy', $record->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
