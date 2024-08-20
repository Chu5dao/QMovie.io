@extends('layouts.app')

@section('content')
<h2 class="title1">THÔNG TIN WEBSITE</h2>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <style>
        .fix-form-group-child-end {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-end;
        }
        .cstm-frm {
            display: flex;
            justify-content: space-around;
        }
        .cstm-frm div {
            width: 100%;
            padding: 0 16px;
        }
        @media only screen and (max-width: 768px) {
            .cstm-frm {
                display: flex;
                justify-content: space-around;
                flex-direction: column;
            }
            .cstm-frm div {
                width: 100%;
                padding: 0 10px;
            }
            .cstm-frm .form-group label {
                width: 40%; /* adjust label width for smaller screens */
            }
            .cstm-frm .form-group input, .cstm-frm .form-group textarea, .cstm-frm .form-group select {
                width: 60%; /* adjust input width for smaller screens */
            }
        }
        @media only screen and (max-width: 1024px) {
            .cstm-frm {
                display: flex;
                justify-content: space-around;
                flex-direction: column;
            }
            .cstm-frm div {
                width: 100%;
                padding: 0 10px;
            }
            .cstm-frm .form-group label {
                width: 40%; /* adjust label width for smaller screens */
            }
            .cstm-frm .form-group input, .cstm-frm .form-group textarea, .cstm-frm .form-group select {
                width: 60%; /* adjust input width for smaller screens */
            }
        }
    </style>
    <div class="container-fluid">
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
                            {!! Form::open(['route'=>['info.update', $info->id], 'method'=>'PUT', 'enctype'=>'multipart/form-data', 'class'=>'cstm-frm']) !!}
                                <div>
                                    <div class="form-group">
                                        {!! Form::label('Title', 'Tiêu đề website', []) !!}
                                        {!! Form::text('title', isset($info) ? $info->title : '', ['class'=>'form-control', 'required'=>'required', 'placeholder' => 'Nhập dữ liệu...']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Description', 'Mô tả website', []) !!}
                                        {!! Form::textarea('description', isset($info) ? $info->description : '', ['style'=>'resize:none', 'class'=>'form-control', 'required'=>'required', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'description']) !!}
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group">
                                        {!! Form::label('Logo', 'Hình ảnh logo', []) !!}
                                        {!! Form::file('logo', ['class'=>'form-control-file']) !!}
                                        @if(isset($info))
                                            {!! Form::hidden('current_image', $info->logo) !!}
                                            <img style="margin-top:6px;" width="22%" src="{{asset('uploads/logo/'.$info->logo)}}" alt="Hình ảnh logo website {{$info->title}}">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Logo Footer', 'Hình ảnh logo footer', []) !!}
                                        {!! Form::file('logo_footer', ['class'=>'form-control-file']) !!}
                                        @if(isset($info))
                                            {!! Form::hidden('current_logo_footer', $info->logo_footer) !!}
                                            <img style="margin-top:6px;" width="22%" src="{{asset('uploads/logo/'.$info->logo_footer)}}" alt="Hình ảnh logo website {{$info->title}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="fix-form-group-child-end">
                                    <div class="form-group">
                                        {!! Form::label('Shortcut Icon', 'Hình ảnh shortcut icon', []) !!}
                                        {!! Form::file('shortcut_icon', ['class'=>'form-control-file']) !!}
                                        @if(isset($info))
                                            {!! Form::hidden('current_image_shortcut_icon', $info->shortcut_icon) !!}
                                            <img style="margin-top:6px;" width="22%" src="{{asset('uploads/logo/'.$info->shortcut_icon)}}" alt="Hình ảnh logo website {{$info->title}}">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Copyright', 'Copyright', []) !!}
                                        {!! Form::text('copyright', isset($info) ? $info->copyright : '', ['class'=>'form-control', 'required'=>'required', 'placeholder' => 'Nhập dữ liệu...']) !!}
                                    </div>
                                    {!! Form::submit('CẬP NHẬT THÔNG TIN', ['class' => 'btn btn-success pull-right', 'style' => 'margin: 16px;']) !!}
                                </div>
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
