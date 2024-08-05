@extends('layouts.app')
@section('content')
<h2 class="title1">DANH SÁCH SERVER</h2>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <div class="row justify-content-center fix-card-list">
        <div class="col-md-12">
            <div class="card fix-card">
                <div class="card-body">
                    <div class="table-responsive" id="table-wrapper">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên server</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $key => $server)
                                    <tr id="{{$server->id}}">
                                    <th scope="row">{{$key}}</th>
                                    <td>{{$server->title}}</td>
                                    <td>{{$server->description}}</td>
                                    <td>
                                        @if ($server->status)
                                            Đang hiển thị
                                        @else
                                            Đang ẩn
                                        @endif
                                    </td>
                                    <td class="custom-td"><center>
                                        {!! Form::open(['method'=>'DELETE', 'route'=>['server.destroy', $server->id], 'onsubmit'=>'return confirm("Bạn có chắc muốn xóa hay không?")']) !!}
                                            {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                        <a href="{{route('server.edit', $server->id)}}" class="btn btn-warning">Sửa</a>
                                    </center></td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
