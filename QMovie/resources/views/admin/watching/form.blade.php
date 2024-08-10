@extends('layouts.app')

@section('content')
<h2 class="title1">THÊM PHIM</h2>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <style>
        .cstm-frm {
            display: flex;
            justify-content: space-around;
        }
        .cstm-frm div {
            width: 100%;
            padding: 0 16px;
        }
        .btn.btn-success.pull-right {
            margin: 0 16px;
        }
        .flex {
            display: flex;
            flex-direction: column;
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
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
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
    
                        @if (!isset($movie))
                            {!! Form::open(['route'=>'watching.store', 'method'=>'POST','enctype'=>'multipart/form-data', 'class'=>'cstm-frm']) !!}
                        @else
                            {!! Form::open(['route'=>['watching.update', $movie->id], 'method'=>'PUT', 'enctype'=>'multipart/form-data', 'class'=>'cstm-frm']) !!}
                        @endif
                            <div>
                                <div class="form-group">
                                    {!! Form::label('Title', 'Tên Phim', []) !!}
                                    {!! Form::text('title', isset($movie) ? $movie->title : '', ['class'=>'form-control', 'required'=>'required', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'slug', 'onkeyup'=>'ChangeToSlug()']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Slug', 'Đường Dẫn', []) !!}
                                    {!! Form::text('slug', isset($movie) ? $movie->slug : '', ['class'=>'form-control', 'required'=>'required', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'convert_slug']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Name', 'Tên Tiếng Anh', []) !!}
                                    {!! Form::text('name_eng', isset($movie) ? $movie->name_eng : '', ['class'=>'form-control', 'required'=>'required', 'placeholder' => 'Nhập dữ liệu...']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Trailer', 'Trailer Phim', []) !!}
                                    {!! Form::text('trailer', isset($movie) ? $movie->trailer : '', ['class'=>'form-control', 'required'=>'required', 'placeholder' => 'Nhập dữ liệu...']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Image', 'Hình Ảnh', []) !!}
                                    {!! Form::file('image', ['class'=>'form-control-file', 
                                    // 'required'=>'required'
                                    ]) !!}
                                    @if(isset($movie))
                                        {!! Form::hidden('current_image', $movie->image) !!}
                                        <img style="margin-top:6px;"  width="22%" src="{{asset('uploads/movie/'.$movie->image)}}" alt="{{$movie->title}}">
                                    @endif
                                </div>
                                {!! Form::hidden('year', isset($movie->year) ? $movie->year : date('Y')) !!}
                                
                            </div>
                            <div>
                                <div class="form-group">
                                    {!! Form::label('Description', 'Nội Dung Phim', []) !!}
                                    {!! Form::textarea('description', isset($movie) ? $movie->description : '', ['style'=>'resize:none', 'class'=>'form-control', 'required'=>'required', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'description']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Resolution', 'Đinh Dạng', []) !!}
                                    {!! Form::select('resolution', ['0'=>'HD', '1'=>'SD', '2'=>'HD-CAM', '3'=>'CAM', '4'=>'FULL-HD', '5'=>'Trailer'], isset($movie) ? $movie->resolution : '', ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Subtitled', 'Phụ Đề', []) !!}
                                    {!! Form::select('subtitled', ['0'=>'Vietsub', '1'=>'Thuyết Minh', '2'=>'Eng-sub', '3'=>'Khác'], isset($movie) ? $movie->subtitled : '', ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Country', 'Quốc Gia', []) !!}
                                    {!! Form::select('country_id', $country, isset($movie) ? $movie->country_id : '', ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Film-hot', 'Độ Hot', []) !!}
                                    {!! Form::select('hot', ['1'=>'HOT', '0'=>'Không'], isset($movie) ? $movie->hot : '', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    {!! Form::label('Tags', 'Từ Khóa', []) !!}
                                    {!! Form::textarea('tags', isset($movie) ? $movie->tags : '', ['style'=>'resize:none', 'class'=>'form-control', 'required'=>'required', 'placeholder' => 'Nhập dữ liệu...']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Duration', 'Thời Lượng Phim', []) !!}
                                    {!! Form::text('duration', isset($movie) ? $movie->duration : '', ['class'=>'form-control', 'required'=>'required', 'placeholder' => 'Nhập dữ liệu...']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Number-of-ep', 'Số Tập Phim', []) !!}
                                    {!! Form::number('ep_number', isset($movie) ? $movie->ep_number : '', ['class'=>'form-control', 'required'=>'required']) !!}
                                </div>
                                {{-- <div class="form-group">
                                    {!! Form::label('Top-view', 'Top View', []) !!}
                                    {!! Form::select('top_view', ['0'=>'Ngày', '1'=>'Tháng', '2'=>'Năm', NULL=>'Không thuộc Top View'], isset($movie) ? $movie->top_view : '', ['class'=>'form-control']) !!}
                                </div> --}}
                                <div class="form-group">
                                    {!! Form::label('Active', 'Trạng Thái', []) !!}
                                    {!! Form::select('status', ['1'=>'Hiển thị', '0'=>'Ẩn'], isset($movie) ? $movie->status : '', ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Category', 'Danh Mục', []) !!}
                                    <br>
                                    {{-- {!! Form::select('category_id', $category, isset($movie) ? $movie->category_id : '', ['class'=>'form-control']) !!} --}}
                                    @foreach($list_category as $key => $cate)
                                    <div>
                                        @if(isset($movie))
                                            {!! Form::checkbox('category[]', $cate->id, $movie->categories->contains($cate->id), ['class' => 'form-check-input']) !!}
                                        @else
                                            {!! Form::checkbox('category[]', $cate->id, false, ['class' => 'form-check-input']) !!}
                                        @endif
                                        {!! Form::label('category', $cate->title, ['class' => 'form-check-label']) !!}  
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    {!! Form::label('Genre', 'Thể Loại', []) !!}
                                    <br>
                                    <div class="flex">
                                    {{-- {!! Form::select('genre_id', $genre, isset($movie) ? $movie->genre_id : '', ['class'=>'form-control']) !!} --}}
                                    @foreach($list_genre as $key => $gen)
                                        <div>
                                            {{-- {!! Form::checkbox('genre[]', $gen->id, isset($movie) && $movie->genre->contains($gen->id), ['class' => 'form-check-input', 'id' => 'genre_'.$gen->id]) !!}
                                            {!! Form::label('genre_'.$gen->id, $gen->title, ['class' => 'form-check-label']) !!} --}}
                                            {!! Form::checkbox('genre[]', $gen->id, isset($movie) && $movie->genres->contains($gen->id), ['class' => 'form-check-input', 'id' => 'genre_'.$gen->id]) !!}
                                            {!! Form::label('genre_'.$gen->id, $gen->title, ['class' => 'form-check-label']) !!}  
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            
                                @if (!isset($movie))
                                    {!! Form::submit('THÊM PHIM', ['class' => 'btn btn-success pull-right']) !!}
                                @else
                                    {!! Form::submit('CẬP NHẬT', ['class' => 'btn btn-success pull-right']) !!}
                                @endif
                            </div>
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    
        
    </div>
</div>



@endsection
