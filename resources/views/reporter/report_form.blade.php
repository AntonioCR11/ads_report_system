@extends('layout.layout')

@section('customDependencies')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset('storage/css/login.css') }}">
@endsection

@section('content')
    @include('index.partial.navbar')

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
                                            'title' => 'Nama',
                                            'form_data' => 'name',
                                            'input_type' => 'text',
                                        ],
                                        (object) [
                                            'title' => 'Email',
                                            'form_data' => 'email',
                                            'input_type' => 'text',
                                        ],
                                        (object) [
                                            'title' => 'Nomor HP',
                                            'form_data' => 'phone_number',
                                            'input_type' => 'text',
                                        ],
                                        (object) [
                                            'title' => 'Tipe Identitas',
                                            'form_data' => 'identity_type',
                                            'input_type' => 'select',
                                        ],
                                        (object) [
                                            'title' => 'Nomor Identitas',
                                            'form_data' => 'identity_number',
                                            'input_type' => 'text',
                                        ],
                                        (object) [
                                            'title' => 'Tempat Lahir',
                                            'form_data' => 'pob',
                                            'input_type' => 'text',
                                        ],
                                        (object) [
                                            'title' => 'Tanggal Lahir',
                                            'form_data' => 'dob',
                                            'input_type' => 'date',
                                        ],
                                        (object) [
                                            'title' => 'Alaamat',
                                            'form_data' => 'address',
                                            'input_type' => 'text',
                                        ],
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

                                <div class="row">
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
