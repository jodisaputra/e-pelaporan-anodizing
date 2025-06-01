@extends('layouts.app')
@section('header', 'Machine Report Detail')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-file-alt"></i> Machine Report Detail
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="30%">Machine</th>
                            <td>{{ $report->machine_name }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $report->report_description }}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{ $report->report_date }}</td>
                        </tr>
                        <tr>
                            <th>User</th>
                            <td>{{ $report->user->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Technician</th>
                            <td>
                                @if($report->technician)
                                    <span class="badge badge-info">{{ $report->technician->name }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Action</th>
                            <td>{{ $report->action->action_status ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('machine-reports.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 