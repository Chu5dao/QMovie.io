@extends('layouts.app')

@section('content')
<style>
    .form-check input {
        display: block;margin: 0 auto;
    }
    /* Custom Checkbox Styling */
    .form-check {
        display: flex;
        align-items: center;
        margin-bottom: 0; /* Adjust margin if needed */
    }

    .form-check-input {
        width: 1.25em;
        height: 1.25em;
        margin-right: 0.5em;
        vertical-align: middle;
        cursor: pointer;
    }

    .form-check-label {
        font-size: 16px;
        line-height: 1.5;
        cursor: pointer;
    }

    #checkAll {
        margin-top: 0.3em; /* Adjust for alignment with text */
    }
</style>
<h2 class="title1">THÊM TẬP PHIM</h2>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <div class="container-fluid fix-container">
        <div class="row justify-content-center" style="width: 50%;">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="title1">THÊM TẬP PHIM</h3>
                
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
    
                            {!! Form::open(['route'=>'store-episode', 'method'=>'POST']) !!}
                            <div class="form-group">
                                {!! Form::label('Movie', 'Tên Phim', []) !!}
                                {!! Form::text('movie_name', isset($movie) ? ($movies_with_resolution[$movie->id] ?? '') : '', ['class'=>'form-control select-movie', 'readonly']) !!}
                                {!! Form::hidden('movie_id', isset($movie) ? $movie->id: '') !!}
    
                                {{-- {!! Form::hidden('movie_id', isset($episode) ? $episode->movie_id : '') !!} --}}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Link', 'Link Phim', []) !!}
                                {!! Form::text('link', '', ['class'=>'form-control', 'placeholder' => 'Nhập dữ liệu...']) !!}
                            </div>
                            <div class="form-group">
                                {{-- {!! Form::label('Episode', 'Tập Phim', []) !!}
                                    {!! Form::selectRange('episode', 1, $movie->ep_number, $movie->ep_number, ['class'=>'form-control']) !!} --}}
    
                                {!! Form::label('Episode', 'Tập Phim', []) !!}
                                    <select name="episode" id="show_movie" class="form-control">
                                        <option value=""> --- Chọn tập phim --- </option>
                                        @if ($movie->ep_number == 0)
                                        <option value="1">Tập Lẻ</option>
                                        @else
                                            @for ($i = 1; $i <= $movie->ep_number; $i++)
                                                <option value="{{ $i }}">Tập {{ $i }}</option>
                                            @endfor
                                        @endif
                                    </select>
                                    <input type="text" id="new_episode" name="new_episode" class="form-control mt-2" placeholder="Nhập tập phim mới...">
                            
                            </div>
                            <div class="form-group">
                                {!! Form::label('Server', 'Server Phim', []) !!}
                                {!! Form::select('server', $server, '', ['class'=>'form-control']) !!}
                            </div>
    
                            {!! Form::submit('THÊM TẬP PHIM', ['class' => 'btn btn-success pull-right']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row justify-content-center fix-card-list">
            <div class="col-md-12">
                <div class="card fix-card">
                    <h3 class="title1">DANH SÁCH TẬP PHIM</h3>
                    <div class="fix-card">
                        <div class="table-responsive" id="table-wrapper">
                        {!! Form::open(['method' => 'DELETE', 'route' => 'destroy-checked', 'onsubmit' => 'return confirm("Bạn có chắc muốn xóa hay không?")']) !!}
                            <table class="table table-striped table-bordered" id="table_leech">
                                <thead>
                                    <tr>
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" style="margin:0 8px 0 0"> 
                                            <span for="">Chọn</span>
                                        </div>
                                    </th>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên phim</th>
                                    <th scope="col">Tập phim</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Link phim</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list_episode as $key => $episode)
                                        <tr id="{{$episode->movie->id}}">
                                        <td>
                                            <div class="form-check">
                                                {!! Form::checkbox('episode_ids[]', $episode->id, false, ['class' => 'form-check-input episode-checkbox']) !!}
                                            </div>
                                        </td>
                                        <th scope="row">{{$key}}</th>
                                        <td>{{$episode->movie->title}}</td>
                                        <td>
                                            {{-- {{$episode->episode}} --}}
                                            @if ($episode->movie->ep_number == 0 || $episode->movie->ep_number == 1)
                                                Full
                                            @else
                                                Tập {{$episode->episode}}
                                            @endif
                                        </td>
                                        <td>
                                            @if (Str::startsWith($episode->movie->image, 'https'))
                                                <img width="100" src="{{ $episode->movie->image }}" alt="{{$movie->title}}">
                                            @else
                                                <img width="100" src="{{asset('uploads/movie/'.$episode->movie->image)}}" alt="{{$movie->title}}">
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($server_list as $key => $server_film)
                                                @if($episode->server == $server_film->id)
                                                    {{$server_film->title}}
                                                @endif
                                            @endforeach
                                            @if($episode->server == 0)
                                                Không có server
                                            @endif
                                        </td>
                                        <td>
                                            <iframe width="400" height="200" src="{{$episode->link}}" frameborder="0" allowfullscreen></iframe>
                                        </td>
                                        <td>
                                            @if ($episode->movie->status)
                                                Đang hiển thị
                                            @else
                                                Đang ẩn
                                            @endif
                                        </td>
                                        <td class="custom-td"><center>
                                            {!! Form::open(['method'=>'DELETE', 'route'=>['episode.destroy', $episode->id], 'onsubmit'=>'return confirm("Bạn có chắc muốn xóa hay không?")']) !!}
                                                {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                            <a href="{{route('episode.edit', $episode->id)}}" class="btn btn-warning">Sửa</a>
                                        </center></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        {!! Form::submit('Xóa các tập đã chọn', ['class' => 'btn btn-danger', 'style' => 'margin-bottom: 40px']) !!}
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
