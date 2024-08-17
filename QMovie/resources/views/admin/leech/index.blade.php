@extends('layouts.app')
@section('content')
<h2 class="title1">DANH SÁCH PHIM API</h2>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <div class="row justify-content-center fix-card-list">
        <div class="col-md-12">
            <div class="card fix-card">
                <div class="fix-card">

                    <form method="GET" action="{{ route('leech-movie') }}">
                        <label for="page">Chọn trang API:</label>
                        <input type="number" name="page" id="page" value="{{ $page }}" min="1">
                        <button type="submit">Chuyển trang</button>
                    </form>

                    <div class="table-responsive" id="table-wrapper">
                    <table class="table table-striped table-bordered" id="table_leech">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên phim</th>
                            <th scope="col">Têm chính thức</th>
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
                        <tbody class="">
                            @if(isset($resp['items']) && is_array($resp['items']) && count($resp['items']) > 0)
                                @foreach($resp['items'] as $key => $res)
                                    <tr>
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
                                    <td class="custom-td"><center>
                                        <a href="{{ route('leech-detail', $res['slug']) }}" class="btn btn-primary btn-sm" style="margin-bottom: 0px;">Chi tiết phim</a>
                                        @php
                                            $movie = \App\Models\Movie::where('slug', $res['slug'])->first();
                                        @endphp
                                        @if (!$movie)
                                            <form action="{{ route('leech-store', $res['slug']) }}" method="POST">
                                                @csrf
                                                <input type="submit" class="btn btn-success btn-sm" value="Thêm Phim">
                                            </form>
                                        @else
                                            <form action="{{ route('leech-episode', $res['slug']) }}" method="POST">
                                                @csrf
                                                <input type="submit" class="btn btn-success btn-sm" value="Xem Tập Phim">
                                            </form>
                                            <form action="{{ route('watching.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa hay không?')">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-danger btn-sm" value="Xóa Phim">
                                            </form>
                                        @endif
                                        
                                    </center></td>
                                    </tr>
                                @endforeach
                            @else
                                <p>No items found or the data structure is incorrect.</p>
                            @endif
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
