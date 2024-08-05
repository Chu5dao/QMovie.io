@extends('layouts.app')

@section('content')
{{-- modal show Phim tương ứng tập phim --}}
<div class="modal" id="videoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="video_title"></span></h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button> --}}
            </div>
            <div class="modal-body">
                <p id="video_desc"></p>
                <br>
                <p id="video_link"></p>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<h2 class="title1">DANH SÁCH PHIM</h2>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <style>
        .custom-width3 {
            min-width: 40px; /* Đặt chiều rộng tối đa cho cột */
        }
        .custom-width2 {
            min-width: 80px; /* Đặt chiều rộng tối đa cho cột */
        }
        .custom-width1 {
            min-width: 60px;
        }
        .custom-width {
            min-width: 100px; /* Đặt chiều rộng tối đa cho cột */
            word-wrap: break-word; /* Tự động xuống dòng nếu văn bản quá dài */
        }
        .custom-width-image img {
            width: 80px; /* Đặt chiều rộng cụ thể cho hình ảnh */
            height: auto; /* Đảm bảo tỷ lệ hình ảnh được giữ nguyên */
        }
        .custom-width-image input {
            line-height: 1.5em; /* Chiều cao dòng */
            display: -webkit-box;
            -webkit-line-clamp: 4; /* Số dòng hiển thị tối đa */
            -webkit-box-orient: vertical;
            white-space: normal; /* Cho phép nội dung xuống dòng */
            overflow-y: hidden; /* Ẩn nội dung vượt quá */
            width: 100px;
        }
        .table-responsive {
            overflow-x: auto;
            cursor: grab; /* Con trỏ thay đổi khi rê chuột qua bảng */
        }
        .table-responsive:active {
            cursor: grabbing; /* Con trỏ thay đổi khi kéo bảng */
        }
        .color-svg{
            color: #dc3545;
        }
        .color-svg-initial{
            color: initial;
        }
        .card-body{
            min-height: 1360px;
        }
        #table_phim .th {
            min-height: 72px;
        }
        .fix-text {
            line-height: 1.5em; /* Chiều cao dòng */
            display: -webkit-box;
            -webkit-line-clamp: 4; /* Số dòng hiển thị tối đa */
            -webkit-box-orient: vertical;
            white-space: normal; /* Cho phép nội dung xuống dòng */
            overflow-y: hidden; /* Ẩn nội dung vượt quá */
            width: 150px;
        }
        .select-topview {
            width: 96px;
            border: 1px solid #ccc;
            border-radius: 8px;
            cursor: pointer;
        }
        .dropdown-menu.select-topview-option {
            border: 1px solid #ccc;
            border-radius: 8px;
            min-width: 96px;
            cursor: pointer;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .select-subtitled,
        .select-country-list,
        .select-category-list {
            border: 1px solid #ccc;
            border-radius: 8px;
            /* Optional: Ensure the button has a minimum width */
            min-width: 100px;
            /* Ensure the button text wraps within its container */
            overflow: hidden;
            text-overflow: ellipsis; /* Optional: Show ellipsis (...) for overflowing text */
            white-space: nowrap; /* Prevent text from wrapping */
        }
        .select-resolution{
            border: 0;
            background: none;
        }
        .form-control.dropdown-toggle.select-resolution:focus{
            outline: none;
            background: none;
            border: 0;
            box-shadow: none;
        }
        .dropdown-menu.select-resolution-option,
        .dropdown-menu.select-subtitled-option,
        .dropdown-menu.select-country-option,
        .dropdown-menu.select-category-option{
            border: 1px solid #ccc;
            border-radius: 8px;
            cursor: pointer;
            min-width: 96px;
        }
        .show_video {
            cursor: pointer;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" id="table-wrapper">
                        <table class="table table-striped table-bordered" id="table_phim" style="width:100%">
                            <thead>
                                <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên phim</th>
                                <th scope="col">Tên tiếng Anh</th>
                                {{-- <th scope="col">Đường dẫn</th> --}}
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Từ khóa</th>
                                {{-- <th scope="col">Nội dung</th> --}}
                                <th scope="col">Danh mục</th>
                                <th scope="col">Quốc gia</th>
                                <th scope="col">Phụ đề</th>
                                <th scope="col">Thể loại</th>
                                <th scope="col">Năm SX</th>
                                <th scope="col">Định dạng</th>
                                <th scope="col">Thời lượng</th>
                                <th scope="col">Số tập</th>
                                <th scope="col">Tập phim</th>
                                <th scope="col">Ngày update</th>
                                <th scope="col">Trailer</th>
                                <th scope="col">Top xem</th>
                                <th scope="col">Phim đề cử</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $key => $movie)
                                <tr>
                                <th scope="row"><center>{{$key}}</center></th>
                                <td>{{$movie->title}}</td>
                                <td>{{$movie->name_eng}}</td>
                                {{-- <td>{{$movie->slug}}</td> --}}
                                <td class="custom-width">
                                    <div class="custom-width-image">
                                        <img src="{{asset('uploads/movie/'.$movie->image)}}" alt="{{$movie->title}}">
                                        <input class="fix-text" type="file" name="" id="file-{{$movie->id}}" data-movie_id={{$movie->id}} class="form-control-file file_image" accept="image/*">
                                    </div>
                                </td>
                                <td><div class="fix-text">{{$movie->tags}}</div></td>
                                {{-- <td><div>
                                    {{$movie->description}}
                                </div></td> --}}
                                <td>
                                    {{-- {{$movie->category->title}} --}}
                                    <div class="dropdown">
                                        <button data-id="{{ $movie->id }}" name="category_list" class="form-control dropdown-toggle select-category-list" type="button" id="categoryDropdownMenuButton_{{ $movie->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ $movie->category->title }}
                                        </button>
                                        <div class="dropdown-menu select-category-option" aria-labelledby="categoryDropdownMenuButton_{{ $movie->id }}">
                                            @foreach ($category as $id => $title)
                                                <li><a class="dropdown-item" data-value="{{ $id }}" data-id="{{ $movie->id }}">{{ $title }}</a></li>
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{-- {{$movie->country->title}} --}}
                                    <div class="dropdown">
                                        <button data-id="{{ $movie->id }}" name="country_list" class="form-control dropdown-toggle select-country-list" type="button" id="countryDropdownMenuButton_{{ $movie->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ $movie->country->title }}
                                        </button>
                                        <div class="dropdown-menu select-country-option" aria-labelledby="countryDropdownMenuButton_{{ $movie->id }}">
                                            @foreach ($country as $id => $title)
                                                <li><a class="dropdown-item" data-value="{{ $id }}" data-id="{{ $movie->id }}">{{ $title }}</a></li>
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{-- @switch($movie->subtitled)
                                        @case(0)
                                            Vietsub
                                            @break
                                        @case(1)
                                            TM
                                            @break
                                        @case(2)
                                            Eng-sub
                                            @break
                                        @default
                                            Khác
                                    @endswitch --}}

                                    @php
                                        $subtitledText = 'Choose';
                                        switch ($movie->subtitled) {
                                            case 0:
                                                $subtitledText = 'Vietsub';
                                                break;
                                            case 1:
                                                $subtitledText = 'Thuyết Minh';
                                                break;
                                            case 2:
                                                $subtitledText = 'Eng-sub';
                                            default:
                                                $subtitledText = 'Khác';
                                        }
                                    @endphp
                                    <div class="dropdown">
                                        <button data-id="{{ $movie->id }}" name="subtitled" class="form-control dropdown-toggle select-subtitled" type="button" id="subtitledDropdownMenuButton_{{ $movie->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{$subtitledText}}
                                        </button>
                                        <div class="dropdown-menu select-subtitled-option" aria-labelledby="subtitledDropdownMenuButton_{{ $movie->id }}">
                                            <li><a class="dropdown-item" data-value="0" data-id="{{ $movie->id }}">Vietsub</a></li>
                                            <li><a class="dropdown-item" data-value="1" data-id="{{ $movie->id }}">Thuyết Minh</a></li>
                                            <li><a class="dropdown-item" data-value="2" data-id="{{ $movie->id }}">Eng-sub</a></li>
                                            <li><a class="dropdown-item" data-value="3" data-id="{{ $movie->id }}">Khác</a></li>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @foreach($movie->genres as $genre)
                                        <span class="badge badge-info">{{ $genre->title }}</span>
                                        @if (!$loop->last), @endif
                                    @endforeach
                                </td>
                                {{-- <td>
                                    {!! Form::selectYear('year', 2000, 2024, isset($movie->year) ? $movie->year : '', ['class'=>'select-year', 'id'=>$movie->id]) !!}
                                </td> --}}
                                <td>
                                    <div class="year-picker year-picker-{{$movie->id}}" data-current-year="{{$movie->year}}">
                                        <div class="year-picker-header">
                                            <button class="prev-year"><i class='fa fa-angle-left'></i></button>
                                            <span class="current-year"></span>
                                            <button class="next-year"><i class='fa fa-angle-right'></i></button>
                                        </div>
                                        <div class="year-picker-container">
                                            <div class="year-picker-body select-year" id="select-year-{{$movie->id}}">
                                                <!-- JavaScript sẽ thêm các năm ở đây -->
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                <td>
                                    @php
                                    $options = [
                                        '0' => 'HD',
                                        '1' => 'SD',
                                        '2' => 'HD-Cam',
                                        '3' => 'Cam',
                                        '4' => 'FULL-HD',
                                        '5' => 'Trailer'
                                    ];
                                    $cssClasses = [
                                        '0' => 'badge-primary',
                                        '1' => 'badge-info',
                                        '2' => 'badge-success',
                                        '3' => 'badge-warning',
                                        '4' => 'badge-danger',
                                        '5' => 'badge-secondary'
                                    ];
                                    @endphp
                                    <div class="dropdown">
                                        <button data-id="{{ $movie->id }}" name="resolution" class="form-control dropdown-toggle select-resolution" type="button" id="resolutionDropdownMenuButton_{{ $movie->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="badge {{ $cssClasses[$movie->resolution] }}">
                                                {{ $options[$movie->resolution] }}
                                            </span>
                                        </button>
                                        <div class="dropdown-menu select-resolution-option" aria-labelledby="resolutionDropdownMenuButton_{{ $movie->id }}">
                                            @foreach ($options as $value => $text)
                                                <li><a class="dropdown-item" data-value="{{ $value }}" data-id="{{ $movie->id }}">
                                                    <span class="badge {{ $cssClasses[$value] }}">{{ $text }}</span>
                                                </a></li>
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                                <td>{{$movie->duration}}</td>
                                <td><center>{{$movie->ep_number}}</center></td>
                                <td> 
                                    @if ($movie->ep_number == 0)
                                        Tập Lẻ 
                                        @if ($movie->episode_count == 1)
                                            - Hoàn Thành
                                        @else
                                            - Đang cập nhật
                                        @endif
                                    @else
                                        {{-- {{$movie->episodes_count}}/{{$movie->ep_number}} Tập --}}
                                        @foreach($movie->episodes as $key => $episode_list)
                                            <a style="color: #fff"
                                                class="show_video" 
                                                data-movie_video_id="{{ $episode_list->movie_id }}"
                                                data-video_episode="{{ $episode_list->episode }}">
                                                <span class="badge badge-dard">{{$episode_list->episode}}</span>
                                            </a>
                                        @endforeach
                                    @endif
                                    <br>
                                    <a href="{{route('add-episode', $movie->id)}}"><i class="fa fa-plus-square fa-lg" aria-hidden="true"></i></a>
                                    
                                </td>
                                <td>
                                    @if ($movie->date_up)
                                        {{$movie->date_up}}
                                    @else
                                        <center><i class='fa fa-calendar'></i></center>
                                    @endif
                                </td>
                                <td>{{$movie->trailer}}</td>
                                <td>
                                    @php
                                        $topviewText = 'Choose';
                                        if ($movie->top_view === null) {
                                            $topviewText = 'Choose';
                                        } elseif ($movie->top_view === 0) {
                                            $topviewText = 'Ngày';
                                        } elseif ($movie->top_view === 1) {
                                            $topviewText = 'Tuần';
                                        } elseif ($movie->top_view === 2) {
                                            $topviewText = 'Tháng';
                                        }
                                    @endphp
                                    {{-- <select name="top_view" class="form-control select-topview" id="{{ $movie->id }}">
                                        <option value=NULL {{ isset($movie) && $movie->top_view == NULL ? 'selected' : '' }}>---</option>
                                        <option value="0" {{ isset($movie) && $movie->top_view == '0' ? 'selected' : '' }}>Ngày</option>
                                        <option value="1" {{ isset($movie) && $movie->top_view == '1' ? 'selected' : '' }}>Tuần</option>
                                        <option value="2" {{ isset($movie) && $movie->top_view == '2' ? 'selected' : '' }}>Tháng</option>
                                    </select> --}}
                                    <div class="dropdown">
                                        <button data-id="{{ $movie->id }}" name="top_view" class=" form-control dropdown-toggle select-topview" type="button" id="dropdownMenuButton_{{ $movie->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{$topviewText}}
                                        </button>
                                        <div class="dropdown-menu select-topview-option" aria-labelledby="dropdownMenuButton_{{ $movie->id }}">
                                            <li><a class="dropdown-item" data-value="NULL" data-id="{{ $movie->id }}">Choose</a></li>
                                            <li><a class="dropdown-item" data-value="0" data-id="{{ $movie->id }}">Ngày</a></li>
                                            <li><a class="dropdown-item" data-value="1" data-id="{{ $movie->id }}">Tuần</a></li>
                                            <li><a class="dropdown-item" data-value="2" data-id="{{ $movie->id }}">Tháng</a></li>
                                        </div>
                                    </div>
                                </td>
                                <td><center>
                                    @if ($movie->hot)
                                    <a href="" class="color-svg toggle-hot" data-id="{{ $movie->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fire" viewBox="0 0 16 16">
                                            <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16m0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15"/>
                                        </svg>
                                    </a>
                                    @else
                                    <a href="" class="color-svg-initial toggle-hot" data-id="{{ $movie->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fire" viewBox="0 0 16 16">
                                        <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16m0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15"/>
                                    </svg></a>
                                    @endif
                                </center></td>
                                <td>
                                    @if ($movie->status)
                                        <center><a href="#" class="toggle-status" data-id="{{ $movie->id }}"><i class='fa fa-eye'></i></a></center> 
                                    @else
                                        <center><a href="#" class="color-svg-initial toggle-status" data-id="{{ $movie->id }}"><i class='fa fa-eye-slash'></i></a></center>
                                    @endif
                                </td>
                                <td class="custom-td"><center>
                                    {!! Form::open(['method'=>'DELETE', 'route'=>['watching.destroy', $movie->id], 'onsubmit'=>'return confirm("Bạn có chắc muốn xóa hay không?")']) !!}
                                        {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                                    {!! Form::close() !!}

                                    <a href="{{route('watching.edit', $movie->id)}}" class="btn btn-warning">Sửa</a>
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