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
        <div class="row h-100">
            <div
                class="col-sm-12 col-lg-6 d-flex align-items-start border-start border-end bg-light py-2 h-100 overflow-auto">
                {{ $dataTable->table() }}
            </div>
            <div class="col-sm-12 col-lg-6 border-end bg-light p-3 h-100">
                <div class="w-100 h-100 overflow-auto bg-white border border-dark p-3">
                    <h1 class="mb-3">Detail Report</h1>
                    <div id="report-detail">
                        * Belum ada report yang dipilih
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        function reportClicked(report_id) {
            $.ajax({
                type: "get",
                url: "/admin/report",
                data: {
                    'report_id': report_id
                },
                success: function(response) {
                    // TOGGLE FAV BUTTON
                    if (response) {
                        $("#report-detail").html(response);
                    }
                },
            });
        }
    </script>
@endpush
