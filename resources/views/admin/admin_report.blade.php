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
        <div class="d-flex justify-content-center">
            <div class="w-75 border-end bg-light p-3 h-100">
                <div class="w-100 h-100 overflow-auto bg-white border border-dark p-3">
                    <h1 class="mb-3">Detail Report</h1>
                    <div id="report-detail">
                        @include('admin.report_detail')
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
