@extends('layout.layout')

@section('customDependencies')
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
        .cursor-pointer {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    @include('admin.partial.navbar')

    <div class="container" style="height: calc(100vh - 57px)">
        <div class="h-100 py-2 overflow-auto">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
