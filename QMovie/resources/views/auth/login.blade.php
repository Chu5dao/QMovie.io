@extends('layouts.form-login')

@section('content-login')
<div id="logreg-forms">
    <form class="form-signin" method="POST" action="{{ route('login') }}">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center">ĐĂNG NHẬP</h1>
        <div class="social-login">
            <button class="btn facebook-btn social-btn" type="button">
                <span><i class="fab fa-facebook-f"></i> Đăng nhập với Facebook</span>
            </button>
            <button class="btn google-btn social-btn" type="button" onclick="window.location='{{ route('google.login') }}'">
                <span><i class="fab fa-google-plus-g"></i> Đăng nhập với Google+</span>
            </button>
        </div>
        <p style="text-align:center">HOẶC</p>
        <input type="email" placeholder="Địa chỉ Email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <input type="password" placeholder="Mật khẩu" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <button class="btn btn-success btn-block" type="submit">
            <i class="fas fa-sign-in-alt"></i> {{ __('Đăng nhập') }}
        </button>
        <a href="#" id="forgot_pswd">Quên mật khẩu?</a>
        <hr>
        <button class="btn btn-primary btn-block" type="button" id="btn-signup">
            <i class="fas fa-user-plus"></i> Đăng ký tài khoản mới
        </button>
    </form>

    <form method="POST" action="{{ route('password.email') }}" class="form-reset">
        @csrf

        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Địa chỉ Email" name="email" required="" autofocus="" value="{{ old('email') }}">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <button class="btn btn-primary btn-block" type="submit">Gửi liên kết đặt lại mật khẩu</button>
        <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Trở lại</a>
    </form>
    
    <form method="POST" action="{{ route('register') }}" class="form-signup">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center">Đăng ký</h1>
        <div class="social-login">
            <button class="btn facebook-btn social-btn" type="button">
                <span><i class="fab fa-facebook-f"></i> Đăng ký với Facebook</span>
            </button>
        </div>
        <div class="social-login">
            <button class="btn google-btn social-btn" type="button">
                <span><i class="fab fa-google-plus-g"></i> Đăng ký với Google+</span>
            </button>
        </div>
        <p style="text-align:center">OR</p>
        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Tên" required="" autofocus="" value="{{ old('name') }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Địa chỉ Email" required autofocus="" value="{{ old('email') }}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu" required autofocus="" autocomplete="new-password" min="8">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        <input type="password" id="password-confirm" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu" required autofocus="" autocomplete="new-password">
        <div style="text-align:center">
            <label for="role">Vai trò:</label>
            {{-- <input type="radio" name="role" value="admin" checked> Admin --}}
            <input type="radio" name="role" value="user" checked> User
            <input type="radio" name="role" value="contributor"> Contributor
        </div>
        <button class="btn btn-primary btn-block" type="submit">
            <i class="fas fa-user-plus"></i> {{ __('Đăng ký') }}
        </button>
        <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Trở lại</a>
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
