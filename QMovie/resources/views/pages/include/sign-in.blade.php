{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
<style>
	.modal-title {
		display: inline-block;
		position: relative;
		left: 50%;
		transform: translateX(-50%);
		margin-bottom: 40px;
		color: #333;
	}
    .modal-content {
		border-radius: 10px;
	}

	.social-buttons {
		display: flex;
		justify-content: space-around;
		margin-bottom: 10px;
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
</style>
<!-- Modal -->
<div class="modal fade" id="signInModalCenter" tabindex="-1" role="dialog" aria-labelledby="signInModalCenterTitle" aria-hidden="true">
	<div class="modal show d-block" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close icon-fix" data-dismiss="modal" aria-label="Close" aria-hidden="true">
						&times;
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="modal-title">ĐĂNG NHẬP</h3>

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
                        <div class="social-button facebook">
                            <i class="fa fa-facebook fa-2x"></i>
                        </div>
                    </div>
                    <div class="divider">
                        <span>or</span>
                    </div>
					<span class="modal-title">Đăng ký các trang mạng xã hội ở trên</span>
                    {{-- <form>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                    <p class="text-center mt-3">Looking to <a href="#">create an account</a>?</p> --}}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script> --}}
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}