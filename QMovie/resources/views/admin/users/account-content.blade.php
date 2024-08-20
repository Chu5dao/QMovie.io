<div class="panel-heading">Thông Tin Tài Khoản</div> <!-- Sửa tên biến nếu cần -->
    <div class="panel-body">
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">Tên: </label>
            <div class="col-md-6">
                {{ $user->name }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">Email: </label>
            <div class="col-md-6">
                {{ $user->email }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">Vai trò: </label>
            <div class="col-md-6">
                {{ $user->role }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">Mật khẩu: </label>
            <div class="col-md-6">
                ********* <a href="" id="change-password"> <span>Đặt lại</span></a>
            </div>
        </div>
    </div>

    <script>
        $('#change-password').click(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('password.change') }}",
                    type: 'GET',
                    success: function(response) {
                        $('#panel-content').html(response);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
    </script>