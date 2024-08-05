@extends('layouts.app')

@section('content')
<h2 class="title1">SẮP XẾP PHIM</h2>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <div class="container-fluid fix-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
    
                    <div class="card-body">
                        {{-- Thông báo --}}
                        {{-- @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul style="margin: 0;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}
                        <style>
                            .navbar-header a,
                            .navbar-nav li { margin: 0 5px 5px 5px; padding: 5px}
                            .ui-state-highlight { height: 1.5em; line-height: 1.2em; }
                            .category-title {
                                font-weight: bold;
                                text-transform: uppercase;
                                font-size: 1.2em;
                                color: #629aa9;
                                margin-bottom: .5em;
                            }
                            .fix-image {
                                max-height: 270px;
                                min-height: 270px;
                                width: auto;
                            }
                            .box_film {
                                display: inline-block;
                                position: relative;
                                left: 50%;
                                transform: translateX(-50%);
                            }
                        </style>
                        <nav id="navbar-example2" class="navbar navbar-default navbar-static"> 
                            <div class="container-fluid"> 
                                <div class="collapse navbar-collapse bs-example-js-navbar-scrollspy"> 
                                    <ul class="nav navbar-nav"> 
                                        <li>
                                        <a class="navbar-brand" href="{{ url('/') }}" target="_blank">Trang Chủ</a> 
                                        </li>
                                        <li class="disabled"><a href="#fat">Thể Loại</a></li> 
                                        <li class="disabled"><a href="#three">Quốc Gia</a></li> 
                                        <li class="disabled"><a href="#four">Năm</a></li> 
                                    </ul>
                                    <ul class="nav navbar-nav cate_position" id="sortable_navbar"> 
                                    @foreach($category_user as $key=> $cate)
                                        <li id="{{$cate->id}}"><a title="{{$cate->title}}" href="{{route('category', $cate->slug)}}">{{ $cate->title }}</a></li>
                                    @endforeach
                                        <li class="disabled"><a href="#four">Lọc Phim</a></li> 
                                    </ul>
                                </div> 
                            </div> 
                        </nav> 
                    @foreach ($category_title as $key => $cate_home)
                        <h3 class="category-title">Danh mục: {{$cate_home['category_homepage']->title}}</h3>
                        <div class="row movie_position sortable_movie">
                            @foreach($cate_home['movies']->sortBy('position') as $key => $movie)
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 well" id="{{ $movie->id }}">
                                <div class="box_film">
                                    <figure><img class="fix-image" src="{{asset('uploads/movie/'.$movie->image)}}" alt="{{$movie->title}}" title="{{$movie->title}}"></figure>
                                    <p class="entry-title">{{$movie->title}}</p>
                                    <p class="original_title">{{$movie->name_eng}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>



@endsection
