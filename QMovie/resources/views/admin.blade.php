@extends('layouts.app')

@section('content')
<?php
// try {
//     $redis = new Redis();
//     $redis->connect('127.0.0.1', 6379);
//     echo "Connected to Redis!";
// } catch (Exception $e) {
//     echo "Could not connect to Redis: ", $e->getMessage();
// }
?>
    <!-- admin widget -->
    <div class="col_3">
        <div class="col-md-3 widget widget1">
            <div class="r3_counter_box">
                <a href="{{route('category.index')}}">
                    <i class="pull-left fa fa-file-text-o icon-rounded"></i>
                    <div class="stats">
                        <h5>
                            <strong>{{ $category_total }}</strong>
                        </h5>
                        <span>Danh mục phim</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 widget widget1">
            <div class="r3_counter_box">
                <a href="{{route('genre.index')}}">
                    <i class="pull-left fa fa-th-large user1 icon-rounded"></i>
                    <div class="stats">
                        <h5>
                            <strong>{{ $genre_total }}</strong>
                        </h5>
                        <span>Thể loại</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 widget widget1">
            <div class="r3_counter_box">
                <a href="{{route('country.index')}}">
                    <i class="pull-left fa fa-globe user2 icon-rounded"></i>
                    <div class="stats">
                        <h5>
                            <strong>{{ $country_total }}</strong>
                        </h5>
                        <span>Quốc gia</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 widget widget1">
            <div class="r3_counter_box">
                <a href="{{route('watching.index')}}">
                    <i class="pull-left fa fa-film dollar1 icon-rounded"></i>
                    <div class="stats">
                        <h5>
                            <strong>{{ $movie_total }}</strong>
                        </h5>
                        <span>Phim</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 widget">
            <div class="r3_counter_box">
                <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                <div class="stats">
                    {{-- <h5>
                        <strong>1450</strong>
                    </h5>
                    <span>Total Users</span>
                    <br> --}}
                    <span>Tổng số lượt truy cập:</span>
                    <br>
                    <span id="online-users-count">Account: 0</span>
                    <br>
                    <span id="total-online-users-count">All: 0</span>
                    
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="row-one widgettable">
        
    </div>
    {{-- ======================================================= --}}
    <div class="panel panel-success"> <div class="panel-heading"> <h3 class="panel-title">{{ __('Đăng nhập thành công!') }}</h3> </div> <div class="panel-body"> 
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        Xin chào Admin
    </div> </div>
    {{-- script --}}
    <!-- Load userStatus.js -->
    <script src="{{ mix('js/userStatus.js') }}" defer></script>
    <!-- Initialize Echo -->
    <script src="{{ mix('js/userActivity.js') }}" defer></script>
@endsection
