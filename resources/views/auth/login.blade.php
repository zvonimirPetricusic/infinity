@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
<link href="{{ asset('css/login/login.css') }}" rel="stylesheet">
<body>
    <div id="shade"></div>
    <div id="mainContainer">
        <div id="leftContentContainer">
            <div id="heading">
                <h1>INFINITY</h1>
            </div>
            <div id="paragraph">
                    Manage your website <br>with infinity system!
            </div>
        </div>
        <div id="rightContentContainer">
            <div id="formContainer">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h3>Login</h3>
                            <p>Enter your email and password</p>
                        </div>
                    </div>
                    <hr><br>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-8 offset-md-0">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                        </div><br><br>
                        <div class="col-md-8 offset-md-0">
                            <button type="submit" name="login" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>  
    </div>

</body>
@endsection
