@extends('layouts.app')
@section('content')
<h2 class="title1">DANH SÁCH THỂ LOẠI</h2>
<!-- Button trigger modal -->
<button type="button" class="btn btn-success hvr-icon-float-away fix-btn" data-toggle="modal" data-target="#exampleModal">
    Thêm nhanh
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">THÊM NHANH THỂ LOẠI PHIM</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> --}}
        </div>
        <div class="modal-body">
            <div class="card">
    
                <div class="card-body">
                    {{-- Thông báo --}}
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul style="margin: 0;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                        {!! Form::open(['route'=>'genre.store', 'method'=>'POST']) !!}
                            <div class="form-group">
                                {!! Form::label('Title', 'Tên Thể Loại', []) !!}
                                {!! Form::text('title', isset($genre) ? $genre->title : '', ['class'=>'form-control', 'required'=>'required', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'slug', 'onkeyup'=>'ChangeToSlug()']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Slug', 'Slug', []) !!}
                                {!! Form::text('slug', isset($genre) ? $genre->slug : '', ['class'=>'form-control', 'required'=>'required', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'convert_slug']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Description', 'Mô Tả', []) !!}
                                {!! Form::textarea('description', isset($genre) ? $genre->description : '', ['style'=>'resize:none', 'class'=>'form-control', 'required'=>'required', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'description']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Active', 'Trạng Thái', []) !!}
                                {!! Form::select('status', ['1'=>'Hiển thị', '0'=>'Ẩn'], isset($genre) ? $genre->status : '', ['class'=>'form-control']) !!}
                            </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {!! Form::submit('THÊM THỂ LOẠI', ['class' => 'btn btn-success pull-right']) !!}
        </div>
    </div>
    {!! Form::close() !!}
    </div>
</div>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <div class="row justify-content-center fix-card-list">
        <div class="col-md-12">
            <div class="card fix-card">
                    <div class="fix-card">
    
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên thể loại</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $key => $genre)
                                <tr>
                                <th scope="row">{{$key}}</th>
                                <td>{{$genre->title}}</td>
                                <td>{{$genre->slug}}</td>
                                <td>{{$genre->description}}</td>
                                <td>
                                    @if ($genre->status)
                                        Đang hiển thị
                                    @else
                                        Đang ẩn
                                    @endif
                                </td>
                                <td class="custom-td"><center>
                                    {!! Form::open(['method'=>'DELETE', 'route'=>['genre.destroy', $genre->id], 'onsubmit'=>'return confirm("Bạn có chắc muốn xóa hay không?")']) !!}
                                        {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    <a href="{{route('genre.edit', $genre->id)}}" class="btn btn-warning">Sửa</a>
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

@endsection
