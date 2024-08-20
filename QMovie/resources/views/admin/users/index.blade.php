@extends('layouts.app')

@section('content')
<h2 class="title1">DANH SÁCH NGƯỜI DÙNG</h2>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" id="table-wrapper">
                        <table class="table table-striped" id="table_leech">
                            <tr>
                                <th scope="col">STT</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Hành động</th>
                            </tr>
                            @foreach ($users as $key => $user)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>
                                    <a href="{{ route('admin-users.edit', $user) }}">Sửa</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection