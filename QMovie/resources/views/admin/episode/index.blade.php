@extends('layouts.app')
@section('content')
<h2 class="title1">DANH SÁCH PHIM (THEO TẬP) </h2>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <div class="row justify-content-center fix-card-list">
        <div class="col-md-12">
            <div class="card fix-card">
                <div class="card-body">
                    <div class="table-responsive" id="table-wrapper">
                        <table class="table table-striped table-bordered" id="table_phim_tap">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên phim</th>
                                <th scope="col">Thể loại</th>
                                <th scope="col">Tập phim</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Server</th>
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
                                        <img width="100" src="{{asset('uploads/movie/'.$episode->movie->image)}}" alt="{{$episode->movie->title}}">
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
