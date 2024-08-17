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
                <span id="online-users-count">Tài khoản: 0</span>
                <br>
                {{-- <span id="total-online-users-count">All: 0</span> --}}
                {{-- <span>All: {{ $activeUsersCount }}</span> --}}
                {{-- <span>All: {{ $activityData['activeUsersCount'] }}</span> --}}
                @if (Request::is('activity-log'))
                    {{-- Hiển thị thông tin cho trang /activity-log --}}
                    <span>Tất cả: {{ $activeUsersCount }}</span>
                @elseif (Request::is('admin'))
                    {{-- Hiển thị thông tin cho trang /admin --}}
                    <span>Tất cả: {{ $activityData['activeUsersCount'] }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>