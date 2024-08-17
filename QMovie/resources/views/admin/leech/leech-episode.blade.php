@extends('layouts.app')
@section('content')
<h2 class="title1">DANH SÁCH TẬP PHIM API</h2>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <div class="row justify-content-center fix-card-list">
        <div class="col-md-12">
            <div class="card fix-card">
                <div class="fix-card">

                    <h3 class="title1">CHI TIẾT PHIM</h3>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">Id Phim API</th>
                            <th scope="col">Tên phim</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Số tập</th>
                            <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody >
                                <tr>
                                <th scope="row">{{$resp['movie']['_id']}}</th>
                                <td>{{$resp['movie']['name']}}</td>
                                <td>{{$resp['movie']['slug']}}</td>
                                <td>{{$resp['movie']['episode_total']}}</td>
                                <td class="custom-td"><center>
                                    <form action="{{ route('leech-episode-store', $resp['movie']['slug'])}}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-success btn-sm" value="Thêm Tập Phim">
                                    </form>
                                    <form action="" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa hay không?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger btn-sm" value="Xóa Tập Phim">
                                    </form>
                                </center></td>
                                </tr>
                        </tbody>
                    </table>

                    <h3 class="title1">CHI TIẾT TẬP PHIM</h3>
                    <div class="table-responsive" id="table-wrapper">
                        <table class="table table-striped table-bordered" id="table_leech">
                            <thead>
                                <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tập</th>
                                <th scope="col">Server phim</th>
                                <th scope="col">Link Tập phim Embed</th>
                                <th scope="col">Link Tập phim M3u8</th>
                                </tr>
                            </thead>
                            @foreach($resp['episodes'] as $key => $res)
                            <tbody>
                                @foreach($res['server_data'] as $key => $server_1)
                                <tr>
                                    <th scope="row"> {{ $server_1['name'] }}</th>
                                    <td>Tập {{ $server_1['name'] }}</td>
                                    <td>{{$res['server_name']}}</td>
                                    <td>
                                        <div>
                                            <input type="text" class="form-control" value=" {{ $server_1['link_embed'] }}" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <input type="text" class="form-control" value=" {{ $server_1['link_m3u8'] }}" readonly>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
