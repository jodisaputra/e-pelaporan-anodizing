@extends('layouts.app')
@section('header', 'Action List')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Action List</h3>
                    <div class="card-tools">
                        @can('action-create')
                        <a href="{{ route('actions.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Action
                        </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="actions-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Technician</th>
                                    <th>Spare Part</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#actions-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{!! route('actions.index') !!}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'action_status', name: 'action_status' },
            { data: 'action_description', name: 'action_description' },
            { data: 'action_date', name: 'action_date' },
            { data: 'technician_name', name: 'technician_name' },
            { data: 'spare_part', name: 'spare_part' },
            { data: 'spare_part_quantity', name: 'spare_part_quantity' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});
</script>
@endpush 