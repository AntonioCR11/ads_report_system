@extends('layout.layout')

@section('customDependencies')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset('storage/css/login.css') }}">
@endsection

@section('content')
    @include('reporter.partial.navbar')

    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-8">
                    <div class="card">
                        <div class="card-header">Form Report</div>
                        <div class="card-body">
                            <form action="{{ route('submit-report') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @php
                                    $inputs = [
                                        (object) [
                                            'title' => 'Judul Laporan',
                                            'form_data' => 'title',
                                            'input_type' => 'text',
                                        ],
                                        (object) [
                                            'title' => 'Deskripsi Laporan',
                                            'form_data' => 'description',
                                            'input_type' => 'textarea',
                                        ],
                                    ];
                                @endphp

                                @foreach ($inputs as $input)
                                    @include('reporter.partial.input', ['input', $input])

                                    @error($input->form_data)
                                        <div class="row">
                                            <div class="col-md-4 col-form-label"></div>
                                            <div class="col">
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            </div>
                                        </div>
                                    @enderror
                                @endforeach

                                <div class="row mb-2">
                                    <label class="col-md-4 col-form-label text-md-right">Media bukti :</label>
                                    <div class="col">
                                        <input type="file" name="foto[]" id="foto" class="form-control" multiple>
                                    </div>
                                    @error('foto')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-4 col-form-label"></div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-success">
                                            Submit Report
                                        </button>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>
@endsection
