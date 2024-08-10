@extends('layouts.app')
@section('content')
<h2 class="title1">DANH SÁCH DANH MỤC</h2>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <div class="row justify-content-center fix-card-list">
        <div class="col-md-12">
            <div class="card fix-card">
                <div class="fix-card">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên phim</th>
                            <th scope="col">Thêm chính thức</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Hình poster</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Year</th>
                            <th scope="col">Thể loại</th>
                            <th scope="col">Season</th>
                            <th scope="col">_Id</th>
                            <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody class="order_position">
                            @foreach($resp['items'] as $key => $res)
                                <tr id="{{$res['tmdb']['id']}}">
                                <th scope="row">{{$key}}</th>
                                <td>{{$res['name']}}</td>
                                <td>{{$res['origin_name']}}</td>
                                <td><img src="{{$resp['pathImage'].$res['thumb_url']}}" height="80" width="80" alt="Hình ảnh bộ phim"></td>
                                <td><img src="{{$resp['pathImage'].$res['poster_url']}}" height="80" width="160" alt="Ảnh poster bộ phim"></td>
                                <td>{{$res['slug']}}</td>
                                <td>{{$res['year']}}</td>
                                <td>{{$res['tmdb']['type']}}</td>
                                <td>{{$res['tmdb']['season']}}</td>
                                <td>{{$res['_id']}}</td>
                                <td></td>

                                {{-- <td class="custom-td"><center>
                                    {!! Form::open(['method'=>'DELETE', 'route'=>['category.destroy', $cate->id], 'onsubmit'=>'return confirm("Bạn có chắc muốn xóa hay không?")']) !!}
                                        {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    <a href="{{route('category.edit', $cate->id)}}" class="btn btn-warning">Sửa</a>
                                </center></td> --}}
                                </th>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
