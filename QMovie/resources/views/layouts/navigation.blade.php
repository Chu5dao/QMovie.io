<!--left-fixed -navigation-->
<aside class="sidebar-left">
    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <h1>
            <a class="navbar-brand" href="/admin">
            <span class=""><img width="18%" src="{{asset('uploads/logo/'.$info->shortcut_icon)}}" alt="Logo {{$info->title}}"></span> {{ config('app.name', 'Laravel') }} <span class="dashboard_text">Trang Admin QMovie</span>
            </a>
        </h1>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @if(auth()->user()->isAdmin('admin'))
            <ul class="sidebar-menu">
                <li class="header">THANH ĐIỀU HƯỚNG</li>
                @php
                    $segment = Request::segment(1);
                @endphp
                <li class="treeview {{ ($segment=='admin') ? 'active' : '' }}">
                    <a href="/admin">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                <li class="treeview {{ ($segment=='category') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-list"></i>
                        <span>Danh mục phim</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{route('category.create')}}">
                                <i class="fa fa-angle-right"></i> Thêm danh mục
                            </a>
                        </li>
                        <li>
                            <a href="{{route('category.index')}}">
                                <i class="fa fa-angle-right"></i> Danh sách danh mục
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ ($segment=='genre') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>Thể loại</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{route('genre.create')}}">
                                <i class="fa fa-angle-right"></i> Thêm thể loại
                            </a>
                        </li>
                        <li>
                            <a href="{{route('genre.index')}}">
                                <i class="fa fa-angle-right"></i> Danh sách thể loại
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ ($segment=='country') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-globe"></i>
                        <span>Quốc gia</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{route('country.create')}}">
                                <i class="fa fa-angle-right"></i> Thêm quốc gia
                            </a>
                        </li>
                        <li>
                            <a href="{{route('country.index')}}">
                                <i class="fa fa-angle-right"></i> Danh sách quốc gia
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ ($segment=='watching' || $segment=='sort-movie') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-film"></i>
                        <span>Phim</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{route('watching.create')}}">
                                <i class="fa fa-angle-right"></i> Thêm phim
                            </a>
                        </li>
                        <li>
                            <a href="{{route('watching.index')}}">
                                <i class="fa fa-angle-right"></i> Danh sách phim
                            </a>
                        </li>
                        <li>
                            <a href="{{route('sort-movie')}}">
                                <i class='fa fa-angle-right'></i> Sắp xếp phim
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ ($segment=='episode' || $segment=='add-episode') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-video-camera"></i>
                        <span>Tập phim</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{route('episode.create')}}">
                                <i class="fa fa-angle-right"></i> Thêm tập phim
                            </a>
                        </li>
                        <li>
                            <a href="{{route('episode.index')}}">
                                <i class="fa fa-angle-right"></i> Danh sách phim (theo tập phim)
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ ($segment=='server') ? 'active' : '' }}">
                    <a href="#">
                        <i class='fa fa-sitemap'></i>
                        <span>Server Phim</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{route('server.create')}}">
                                <i class="fa fa-angle-right"></i> Thêm server phim
                            </a>
                        </li>
                        <li>
                            <a href="{{route('server.index')}}">
                                <i class="fa fa-angle-right"></i> Danh sách server
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ ($segment=='leech-movie') ? 'active' : '' }}">
                    <a href="{{route('leech-movie')}}">
                        <i class='fa fa-file-movie-o'></i>
                        <span>Leech Phim</span>
                    </a>
                </li>
                <li class="treeview {{ ($segment=='info') ? 'active' : '' }}">
                    <a href="{{route('info.create')}}">
                        <i class="fa fa-info-circle"></i>
                        <span>Thông tin webphim</span>
                    </a>
                </li>
                <li class="treeview {{ ($segment=='activity-log') ? 'active' : '' }}">
                    <a href="{{route('activity-log')}}">
                        <i class="fa fa-users"></i>
                        <span>Lượt truy cập</span>
                    </a>
                </li>
            </ul>
            @endif
        
        
        </div>
        <!-- /.navbar-collapse -->
    </nav>
    </aside>
</div>
<!--left-fixed -navigation-->