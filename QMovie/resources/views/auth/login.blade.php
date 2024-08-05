@extends('layouts.form-login')

@section('content-login')
<div id="logreg-forms">
    <form class="form-signin" method="POST" action="{{ route('login') }}">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center">Sign in</h1>
        <div class="social-login">
            <button class="btn facebook-btn social-btn" type="button">
                <span><i class="fab fa-facebook-f"></i> Sign in with Facebook</span>
            </button>
            <button class="btn google-btn social-btn" type="button">
                <span><i class="fab fa-google-plus-g"></i> Sign in with Google+</span>
            </button>
        </div>
        <p style="text-align:center">OR</p>
        <input type="email" placeholder="Email address" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <input type="password" placeholder="Password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <button class="btn btn-success btn-block" type="submit">
            <i class="fas fa-sign-in-alt"></i> {{ __('Login') }}
        </button>
        <a href="#" id="forgot_pswd">Forgot password?</a>
        <hr>
        <button class="btn btn-primary btn-block" type="button" id="btn-signup">
            <i class="fas fa-user-plus"></i> Sign up New Account
        </button>
    </form>

    <form action="/reset/password/" class="form-reset">
        <input type="email" id="resetEmail" class="form-control" placeholder="Email address" required="" autofocus="">
        <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
        <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
    </form>
    
    <form method="POST" action="{{ route('register') }}" class="form-signup">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center">Sign up</h1>
        <div class="social-login">
            <button class="btn facebook-btn social-btn" type="button">
                <span><i class="fab fa-facebook-f"></i> Sign up with Facebook</span>
            </button>
        </div>
        <div class="social-login">
            <button class="btn google-btn social-btn" type="button">
                <span><i class="fab fa-google-plus-g"></i> Sign up with Google+</span>
            </button>
        </div>
        <p style="text-align:center">OR</p>
        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full name" required="" autofocus="" value="{{ old('name') }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email address" required autofocus="" value="{{ old('email') }}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autofocus="" autocomplete="new-password" min="8">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        <input type="password" id="password-confirm" class="form-control" name="password_confirmation" placeholder="Repeat Password" required autofocus="" autocomplete="new-password">
        <div style="text-align:center">
            <label for="role">Role:</label>
            {{-- <input type="radio" name="role" value="admin" checked> Admin --}}
            <input type="radio" name="role" value="user" checked> User
            <input type="radio" name="role" value="contributor"> Contributor
        </div>
        <button class="btn btn-primary btn-block" type="submit">
            <i class="fas fa-user-plus"></i> {{ __('Register') }}
        </button>
        <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
    </form>
    <br>
</div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
