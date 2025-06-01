@extends('layouts.app')
@section('header', 'Create Machine Report')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Machine Report</h3>
                    <div class="card-tools">
                        <a href="{{ route('machine-reports.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <form action="{{ route('machine-reports.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="user_id">User</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        </div>
                        <div class="form-group">
                            <label for="machine_name">Machine Name</label>
                            <input type="text" class="form-control @error('machine_name') is-invalid @enderror" id="machine_name" name="machine_name" value="{{ old('machine_name') }}">
                            @error('machine_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="report_description">Description</label>
                            <textarea class="form-control @error('report_description') is-invalid @enderror" id="report_description" name="report_description">{{ old('report_description') }}</textarea>
                            @error('report_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="report_date">Date</label>
                            <input type="date" class="form-control @error('report_date') is-invalid @enderror" id="report_date" name="report_date" value="{{ old('report_date') }}">
                            @error('report_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="technician_id">Technician</label>
                            <select class="form-control @error('technician_id') is-invalid @enderror" id="technician_id" name="technician_id">
                                <option value="">-- Select Technician --</option>
                                @foreach($technicians as $technician)
                                    <option value="{{ $technician->id }}" {{ old('technician_id') == $technician->id ? 'selected' : '' }}>{{ $technician->name }}</option>
                                @endforeach
                            </select>
                            @error('technician_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="action_id">Action</label>
                            <select class="form-control @error('action_id') is-invalid @enderror" id="action_id" name="action_id">
                                <option value="">-- Select Action --</option>
                                @foreach($actions as $action)
                                    <option value="{{ $action->action_id }}" {{ old('action_id') == $action->action_id ? 'selected' : '' }}>{{ $action->action_status }}</option>
                                @endforeach
                            </select>
                            @error('action_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create Machine Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 