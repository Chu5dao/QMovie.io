<!-- Modal đăng ký -->
<div class="modal fade" id="signUpModalCenter" tabindex="-1" role="dialog" aria-labelledby="signUpModalCenterTitle" aria-hidden="true">
    <div class="modal show d-block" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content modal-fix">
                <div class="modal-header">
                    <h3 class="modal-title">ĐĂNG KÝ</h3>
                    <button type="button" class="close icon-fix" data-dismiss="modal" aria-label="Close" aria-hidden="true">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="social-buttons">
                        <a href="{{ route('google.login') }}">
                            <div class="social-button google">
                                <i class="fa fa-google-plus fa-2x"></i>
                            </div>
                        </a>
                        <div class="social-button facebook">
                            <i class="fa fa-facebook fa-2x"></i>
                        </div>
                    </div>
                    <div class="divider">
                        <span>Hoặc</span>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Tên của bạn" required>
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-group">
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" required>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-group">
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu" required>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-group">
                            <input type="password" id="password-confirm" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block fix-btn">{{ __('Đăng ký') }}</button>
                    </form>
                    <p class="text-center mt-3">Bạn đã có tài khoản? <a href="#" data-toggle="modal" data-target="#signInModalCenter" data-dismiss="modal">Đăng nhập</a></p>
                </div>
            </div>
        </div>
    </div>
</div>