@extends('layouts.app')

@section('content')
<h2 class="title1">THÊM SERVER PHIM</h2>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <div class="container-fluid fix-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
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
    
                        @if (!isset($server))
                            {!! Form::open(['route'=>'server.store', 'method'=>'POST']) !!}
                        @else
                            {!! Form::open(['route'=>['server.update', $server->id], 'method'=>'PUT']) !!}
                        @endif
                                <div class="form-group">
                                    {!! Form::label('Title', 'Server Phim', []) !!}
                                    {!! Form::text('title', isset($server) ? $server->title : '', ['class'=>'form-control', 'required'=>'required', 'placeholder' => 'Nhập dữ liệu...']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Description', 'Mô Tả', []) !!}
                                    {!! Form::textarea('description', isset($server) ? $server->description : '', ['style'=>'resize:none', 'class'=>'form-control', 'required'=>'required', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'description']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Active', 'Trạng Thái', []) !!}
                                    {!! Form::select('status', ['1'=>'Hiển thị', '0'=>'Ẩn'], isset($server) ? $server->status : '', ['class'=>'form-control']) !!}
                                </div>
                                @if (!isset($server))
                                    {!! Form::submit('THÊM SERVER PHIM', ['class' => 'btn btn-success pull-right']) !!}
                                @else
                                    {!! Form::submit('CẬP NHẬT', ['class' => 'btn btn-success pull-right']) !!}
                                @endif
                            {!! Form::close() !!}
    
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>



@endsection
