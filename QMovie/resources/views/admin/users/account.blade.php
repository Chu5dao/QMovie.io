@extends('layouts.app')

@section('content')
    <div class="main-page compose">
        <h2 class="title1">THÔNG TIN TÀI KHOẢN</h2>
        <div class="col-md-4 compose-left">
            <div class="folder widget-shadow">
                <ul>
                    <li class="head">Danh mục</li>
                    <li><a href="#" id="user-info-link">Thông tin tài khoản</a></li>
                    <li><a href="#" id="change-password-link">Đổi mật khẩu</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-8 compose-right widget-shadow">
            <div class="panel-default" id="panel-content">
                <!-- Nội dung của panel sẽ được Ajax load vào đây -->
                <div class="panel-heading">Thông Tin Tài Khoản</div>
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
            </div>
        </div>
    </div>
@endsection