<style>
	.modal-title {
		display: inline-block;
		position: relative;
		left: 50%;
		transform: translateX(-50%);
		color: #333;
	}
    .modal-content {
		border-radius: 10px;
	}

	.social-buttons {
		display: flex;
		justify-content: space-around;
		margin-bottom: 10px;
		margin-top: 10px; 
	}

	.social-button {
		width: 80px;
		height: 80px;
		border-radius: 50%;
		display: flex;
		justify-content: center;
		align-items: center;
		color: white;
	}

	.social-button a{
		text-decoration: none;
		color: white;
	}

	.github {
		background-color: #333;
	}

	.google {
		background-color: #db4437;
	}

	.facebook {
		background-color: #3b5998;
	}

	.divider {
		display: flex;
		align-items: center;
		text-align: center;
		margin-bottom: 10px;
	}

	.divider::before, .divider::after {
		content: "";
		flex: 1;
		border-bottom: 1px solid #ddd;
	}

	.divider:not(:empty)::before {
		margin-right: .25em;
	}

	.divider:not(:empty)::after {
		margin-left: .25em;
	}
	.icon-fix {
		font-size: 40px;
	}
	.modal-content.modal-fix{
		max-width: 400px;
		display: block;margin: 0 auto;
	}
	.btn.btn-primary.btn-block.fix-btn {
		background-color: #DF0053;
		color: #ffed4d;
	}
	.btn.btn-primary.btn-block.fix-btn:hover {
		background-color: #337ab7;
	}
	.text-center a {
		color: #FFA500;
	}
	.text-center a:hover {
		color: #DF0053;
	}
</style>
<!-- Modal -->
<div class="modal fade" id="signInModalCenter" tabindex="-1" role="dialog" aria-labelledby="signInModalCenterTitle" aria-hidden="true">
	<div class="modal show d-block" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content modal-fix">
                <div class="modal-header">
                    <h3 class="modal-title">ĐĂNG NHẬP</h3>

                    <button type="button" class="close icon-fix" data-dismiss="modal" aria-label="Close" aria-hidden="true">
						&times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="social-buttons">
                        {{-- <div class="social-button github">
                            <i class="fab fa-github"></i>
                        </div> --}}
						{{-- <a href="{{ url('auth/google') }}"> --}}
						<a href="{{ route('google.login') }}">
							<div class="social-button google">
								{{-- <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;"> --}}

								<i class="fa fa-google-plus fa-2x"></i>
							</div>
						</a>
						<a href="{{ route('facebook.login') }}">
							<div class="social-button facebook">
								<i class="fa fa-facebook fa-2x"></i>
							</div>
						</a>
                    </div>
                    <div class="divider">
                        <span>Hoặc</span>
                    </div>
					{{-- <span class="modal-title">Đăng ký các trang mạng xã hội ở trên</span> --}}
                    <form method="POST" action="{{ route('login') }}">
						@csrf
                        <div class="form-group">
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" required >
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
                        <button type="submit" class="btn btn-primary btn-block fix-btn">{{ __('Đăng nhập') }}</button>
                    </form>
                    <p class="text-center mt-3">Bạn đang muốn <a href="#" data-toggle="modal" data-target="#signUpModalCenter" data-dismiss="modal">tạo tài khoản</a>?</p>
                </div>
            </div>
        </div>
    </div>
</div>