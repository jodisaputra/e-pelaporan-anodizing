@extends('layouts.app')
@section('header', 'Machine Detail')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Machine Detail</h3>
                    <div class="card-tools">
                        <a href="{{ route('machines.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $machine->name }}</p>
                            <p><strong>Description:</strong> {{ $machine->description }}</p>
                        </div>
                        <div class="col-md-6">
                            @if($machine->image)
                                <img src="{{ asset('storage/' . $machine->image) }}" alt="Machine Image" class="img-fluid rounded border" style="max-width:200px;max-height:200px;">
                            @else
                                <p><em>No image uploaded.</em></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 