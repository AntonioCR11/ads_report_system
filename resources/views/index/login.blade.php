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
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">

                            <form action="{{ route('doLogin') }}" method="POST">
                                @csrf
                                <div class="form-group row mb-2">
                                    <label for="username"class="col-md-4 col-form-label text-md-right">Username</label>
                                    <div class="col">
                                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                                            class="form-control" required autofocus>
                                    </div>

                                </div>

                                <div class="form-group row mb-2">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col">
                                        <input type="password" id="password" class="form-control" name="password" required>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-4 col-form-label"></div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">
                                            Login
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
