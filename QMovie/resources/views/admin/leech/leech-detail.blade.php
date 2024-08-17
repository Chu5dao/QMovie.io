@extends('layouts.app')
@section('content')
<style>
    #table-wrapper {
        cursor: grab;
    }

    #table-wrapper.active {
        cursor: grabbing;
    }

    span.badge.badge-info {
        background-color: #17a2b8;
    }
</style>
<h2 class="title1">CHI TIẾT PHIM API</h2>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <div class="row justify-content-center fix-card-list">
        <div class="col-md-12">
            <div class="card fix-card">
                <div class="fix-card">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" 
                        {{-- id="table_leech" --}}
                        >
                            <thead>
                                <tr>
                                    <th scope="row">Tên Film</th>
                                @foreach($resp_movie as $key => $res)
                                    <th scope="row">{{$res['name']}}</th>
                                @endforeach
                                @php
                                    // dd($resp_movie['name'])
                                @endphp
                                </tr>
                            </thead>
                            <tbody class="">
                                @php
                                    $column1 = [
                                        'Tên chính thức' => 'origin_name',
                                        'Nội dung' => 'content',
                                        'Danh mục' => 'category',
                                        'Trạng thái' => 'status',
                                        'Hình ảnh' => 'thumb_url',
                                        'Bản quyền' => 'is_copyright',
                                        'Trailer' => 'trailer_url',
                                        'Tập hiện tại' => 'episode_current',
                                        'Số tập' => 'episode_total',
                                        'Chất lượng' => 'quality',
                                        'Ngôn ngữ' => 'lang',
                                        'Thông báo' => 'notify',
                                        'Thời lượng' => 'time',
                                        'Giờ chiếu' => 'showtimes',
                                        'Slug' => 'slug',
                                        'Year' => 'year',
                                        'Lượt xem' => 'view',
                                        'Diễn viên' => 'actor',
                                        'Đạo diễn' => 'director',
                                        'Thể loại' => 'category',
                                        'Quốc gia' => 'country',
                                        'Chiếu rạp' => 'chieurap',
                                        'Poster URL' => 'poster_url',
                                        'Sub độc quyền' => 'sub_docquyen'
                                    ];
                                @endphp
                                
                                @foreach($column1 as $label => $key)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td>
                                            @switch($key)
                                                @case('thumb_url')
                                                    <img src="{{ $res[$key] }}" alt="{{ $label }}" height="80" width="80">
                                                    @break

                                                @case('poster_url')
                                                    <img src="{{ $res[$key] }}" alt="{{ $label }}" height="80" width="160">
                                                    @break

                                                @case('is_copyright')
                                                @case('chieurap')
                                                @case('sub_docquyen')
                                                    @if($res[$key] === true)
                                                        <span class="badge badge-info">TRUE</span>
                                                    @else
                                                        <span class="badge badge-danger">FALSE</span>
                                                    @endif
                                                    @break

                                                @case('category')
                                                @case('country')
                                                    @foreach($res[$key] as $item)
                                                        <span class="badge badge-info">{{ $item['name'] }}</span>
                                                    @endforeach
                                                    @break

                                                @case('actor')
                                                @case('director')
                                                    @foreach($res[$key] as $item)
                                                        <span class="badge badge-info">{{ $item }}</span>
                                                    @endforeach
                                                    @break

                                                @default
                                                    {{ $res[$key] }}
                                            @endswitch
                                        </td>
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
