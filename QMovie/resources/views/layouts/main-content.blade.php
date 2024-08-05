{{-- <style>
    .fix-navbar{
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: 0.25rem;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light fix-navbar">
    <a class="navbar-brand" href="{{route('admin')}}">ADMIN QUẢN LÝ</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('info.create')}}">THÔNG TIN WEBSITE</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{route('category.create')}}">DANH MỤC PHIM</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{route('genre.create')}}">THỂ LOẠI</span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{route('country.create')}}">QUỐC GIA</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    PHIM
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('watching.create')}}">Thêm Phim</a>
                    <a class="dropdown-item" href="{{route('watching.list')}}">Danh Sách Phim</a>
                </div>

            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('episode.create')}}">TẬP PHIM</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm phim..." aria-label="Search"
            style="outline: none;">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="padding: 4px 12px 8px">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
        </form>
    </div>
</nav> --}}
{{-- ============================== new theme =============================== --}}
<div class="main-content">
    <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
    @include('layouts.navigation')
    @include('layouts.header')
    <!-- main content start-->
    <div id="page-wrapper">
        <div class="main-page">

            <!-- admin widget here -->

            <!-- for amcharts js -->
            <script src="{{asset('backend/js/amcharts.js')}}"></script>
            <script src="{{asset('backend/js/serial.js')}}"></script>
            <script src="{{asset('backend/js/export.min.js')}}"></script>
            <link rel="stylesheet" href="{{asset('backend/css/export.css')}}" type="text/css" media="all" />
            <script src="{{asset('backend/js/light.js')}}"></script>
            <!-- for amcharts js -->
            <script src="{{asset('backend/js/index1.js')}}"></script>

            {{-- Nội dung --}}
            @yield('content')
        </div>
        <div class="clearfix"></div>
    </div>
    @include('layouts.footer')
</div>
{{-- ==================================================================== --}}