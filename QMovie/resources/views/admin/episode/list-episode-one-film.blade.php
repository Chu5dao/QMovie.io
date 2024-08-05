@extends('layouts.app')

@section('content')
<h2 class="title1">THÊM TẬP PHIM</h2>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <div class="container-fluid fix-container">
        <div class="row justify-content-center" style="width: 50%;">
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
    
                            {!! Form::open(['route'=>'episode.store-episode', 'method'=>'POST']) !!}
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
                    <div class="card-header">DANH SÁCH DANH MỤC</div>
                    <div class="fix-card">
    
                        <table class="table table-striped table-bordered" id="table_phim">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên phim</th>
                                <th scope="col">Thể loại</th>
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
                                    <th scope="row">{{$key}}</th>
                                    <td>{{$episode->movie->title}}</td>
                                    <td>
                                        @switch($episode->movie->category_id)
                                        @case(1)
                                            Phim Mới
                                            @break
                                        @case(2)
                                            Phim Chiếu Rạp
                                            @break
                                        @case(3)
                                            Series Ngắn Tập Netflix
                                            @break
                                        @case(4)
                                            Series Season
                                            @break
                                        @case(5)
                                            Phim Bộ
                                            @break
                                        @case(6)
                                            Phim Lẻ
                                            @break
                                        @default
                                            Lỗi không xác định
                                        @endswitch
                                    </td>
                                    <td>
                                        {{-- {{$episode->episode}} --}}
                                        @if ($episode->movie->category_id == 2 || $episode->movie->category_id == 6)
                                            Tập Lẻ
                                        @elseif ($episode->movie->category_id == 3 || $episode->movie->category_id == 5)
                                            Tập {{$episode->episode}}
                                        @elseif ($episode->movie->category_id == 1 || $episode->movie->category_id == 4)
                                            @if ($episode->movie->ep_number == 0)
                                                Tập Lẻ
                                            @else
                                                Tập {{$episode->episode}}
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <img width="100" src="{{asset('uploads/movie/'.$episode->movie->image)}}" alt="{{$movie->title}}">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
