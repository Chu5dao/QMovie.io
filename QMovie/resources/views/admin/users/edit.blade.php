@extends('layouts.app')

@section('content')
<h2 class="title1">SỬA THÔNG TIN NGƯỜI DÙNG</h2>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <div class="container-fluid fix-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Hiển thị thông báo nếu có lỗi -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- Form để chỉnh sửa thông tin người dùng -->
                        <form action="{{ route('admin-users.update', $user) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="role">Vai trò</label>
                                <select name="role" class="form-control" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" {{ $user->role == $role ? 'selected' : '' }}>
                                            {{ ucfirst($role) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">CẬP NHẬT</button>
                            <a href="{{ route('admin-users.index') }}" class="btn btn-secondary">TRỞ VỀ</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    

    
@endsection