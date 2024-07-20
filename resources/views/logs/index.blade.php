@extends('layouts.master')
@section('title', 'Data Log')

@section('content')
    <div class="shadow-md sm:rounded-sm">
        <div class="card">
            <div class="card-header">Logs Data</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
