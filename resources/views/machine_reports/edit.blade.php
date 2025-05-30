@extends('layouts.app')
@section('header', 'Edit Machine Report')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Machine Report</h3>
                    <div class="card-tools">
                        <a href="{{ route('machine-reports.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <form action="{{ route('machine-reports.update', $report->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="user_id">User</label>
                            <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                <option value="">-- Select User --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $report->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="machine_name">Machine Name</label>
                            <input type="text" class="form-control @error('machine_name') is-invalid @enderror" id="machine_name" name="machine_name" value="{{ old('machine_name', $report->machine_name) }}">
                            @error('machine_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="report_description">Description</label>
                            <textarea class="form-control @error('report_description') is-invalid @enderror" id="report_description" name="report_description">{{ old('report_description', $report->report_description) }}</textarea>
                            @error('report_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="report_date">Date</label>
                            <input type="date" class="form-control @error('report_date') is-invalid @enderror" id="report_date" name="report_date" value="{{ old('report_date', $report->report_date) }}">
                            @error('report_date')
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
                                    <option value="{{ $action->action_id }}" {{ old('action_id', $report->action_id) == $action->action_id ? 'selected' : '' }}>{{ $action->action_status }}</option>
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
                        <button type="submit" class="btn btn-primary">Update Machine Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 