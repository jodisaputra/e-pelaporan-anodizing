@extends('layouts.app')
@section('header', 'Edit Action')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Action</h3>
                    <div class="card-tools">
                        <a href="{{ route('actions.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <form action="{{ route('actions.update', $action->action_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="action_status">Status</label>
                            <input type="text" class="form-control @error('action_status') is-invalid @enderror" id="action_status" name="action_status" value="{{ old('action_status', $action->action_status) }}">
                            @error('action_status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="action_description">Description</label>
                            <textarea class="form-control @error('action_description') is-invalid @enderror" id="action_description" name="action_description">{{ old('action_description', $action->action_description) }}</textarea>
                            @error('action_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="action_date">Date</label>
                            <input type="date" class="form-control @error('action_date') is-invalid @enderror" id="action_date" name="action_date" value="{{ old('action_date', $action->action_date) }}">
                            @error('action_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="technician_name">Technician Name</label>
                            <input type="text" class="form-control @error('technician_name') is-invalid @enderror" id="technician_name" name="technician_name" value="{{ old('technician_name', $action->technician_name) }}">
                            @error('technician_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="spare_part_id">Spare Part</label>
                            <select class="form-control @error('spare_part_id') is-invalid @enderror" id="spare_part_id" name="spare_part_id">
                                <option value="">-- Select Spare Part --</option>
                                @foreach($spareParts as $sparePart)
                                    <option value="{{ $sparePart->id }}" {{ old('spare_part_id', $action->spare_part_id) == $sparePart->id ? 'selected' : '' }}>{{ $sparePart->name }}</option>
                                @endforeach
                            </select>
                            @error('spare_part_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="spare_part_quantity">Spare Part Quantity</label>
                            <input type="number" class="form-control @error('spare_part_quantity') is-invalid @enderror" id="spare_part_quantity" name="spare_part_quantity" value="{{ old('spare_part_quantity', $action->spare_part_quantity) }}">
                            @error('spare_part_quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Action</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: @json(session('error')),
        });
    @endif
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: @json(session('success')),
        });
    @endif
});
</script>
@endpush 