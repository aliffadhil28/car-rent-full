@extends('layouts.master')
@section('title', 'Persetujuan Peminjaman')

@section('content')
    <div class="shadow-md sm:rounded-sm">
        <div class="card">
            <div class="card-header">History Data</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
