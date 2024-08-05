@extends('welcome')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <div class="col-xs-12 carausel-sliderWidget">
            {{-- <section id="halim-advanced-widget-4">
                <div class="section-heading">
                    <a href="danhmuc.php" title="Phim Chiếu Rạp">
                        <span class="h-text">Phim nổi bật</span>
                    </a>
                </div>
                <div id="halim-advanced-widget-4-ajax-box" class="halim_box">
                    <article class="col-md-2 col-sm-4 col-xs-6 thumb grid-item post-38424">
                        <div class="halim-item">
                            <a class="halim-thumb" href="{{route('detail')}}" title="GÓA PHỤ ĐEN">
                                <figure><img class="lazy img-responsive" src="https://lumiere-a.akamaihd.net/v1/images/p_blackwidow_disneyplus_21043-1_63f71aa0.jpeg" alt="GÓA PHỤ ĐEN" title="GÓA PHỤ ĐEN"></figure>
                                <span class="status">HD</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span>
                                <div class="icon_overlay"></div>
                                <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                        <p class="entry-title">GÓA PHỤ ĐEN</p>
                                        <p class="original_title">Black Widow</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </article>
                    


                </div>
                
            </section>
            
            <div class="clearfix"></div> --}}

            <div id="halim_related_movies-2xx" class="wrap-slider">
                <div class="section-bar clearfix">
                    <h3 class="section-title"><span>PHIM ĐỀ CỬ</span></h3>
                </div>
                <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">

                    @foreach($phimhot as $key => $hot)
                    <article class="thumb grid-item post-38498">
                        <div class="halim-item">
                            <a class="halim-thumb" href="{{route('detail', $hot->slug)}}" title="{{$hot->title}}">
                                <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$hot->image)}}" alt="{{$hot->title}}" title="{{$hot->title}}"></figure>
                            @if ($hot->resolution==5)
                                <span class="is_trailer">
                            @else
                                <span class="status">
                            @endif
                                    @switch($hot->resolution)
                                        @case(0)
                                            HD
                                            @break
                                        @case(1)
                                            SD
                                            @break
                                        @case(2)
                                            HD-Cam
                                            @break
                                        @case(3)
                                            Cam
                                            @break
                                        @case(4)
                                            FULL-HD
                                            @break
                                        @default
                                            Trailer
                                    @endswitch
                                </span>
                            @if ($hot->resolution!=5)
                                <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                    @if ($hot->ep_number==0)
                                        @switch($hot->subtitled)
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
                                        @endswitch
                                    @else
                                        @switch($hot->subtitled)
                                            @case(0)
                                                Vietsub - {{$hot->episodes_count}}/{{$hot->ep_number}}
                                                @break
                                            @case(1)
                                                TM - {{$hot->episodes_count}}/{{$hot->ep_number}}
                                                @break
                                            @case(2)
                                                Eng-sub - {{$hot->episodes_count}}/{{$hot->ep_number}}
                                                @break
                                            @default
                                                Khác
                                        @endswitch
                                    @endif
                                </span>
                            @endif
                                <div class="red_overlay"></div> <!-- Thêm layer màu đỏ -->
                                <div class="icon_overlay"></div>
                                <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                        <p class="entry-title">{{$hot->title}}</p>
                                        <p class="original_title">{{$hot->name_eng}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                    </article>
                    @endforeach
    
                </div>
                
            </div>
            
            <div class="clearfix"></div>

        </div>
        
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-9">
            @foreach ($category_title as $key => $cate_home)
            <section id="halim-advanced-widget-2">
                <div class="section-heading">
                    <a href="{{route('category', $cate_home['category_homepage']->slug)}}" title="{{$cate_home['category_homepage']->title}}">
                        <span class="h-text">{{$cate_home['category_homepage']->title}}</span>
                    </a>
                </div>
                <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                    {{-- @foreach($cate_home->movie->where('status', 1)->take(8) as $key => $movie) --}}
                    @foreach($cate_home['movies']->sortBy('position') as $key => $movie)
                    <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                        <div class="halim-item">
                            <a class="halim-thumb" href="{{route('detail', $movie->slug)}}">
                                <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$movie->image)}}" alt="{{$movie->title}}" title="{{$movie->title}}"></figure>
                            @if ($movie->resolution==5)
                                <span class="is_trailer">
                            @else
                                <span class="status">
                            @endif 
                                    @switch($movie->resolution)
                                        @case(0)
                                            HD
                                            @break
                                        @case(1)
                                            SD
                                            @break
                                        @case(2)
                                            HD-Cam
                                            @break
                                        @case(3)
                                            Cam
                                            @break
                                        @case(4)
                                            FULL-HD
                                            @break
                                        @default
                                            Trailer
                                    @endswitch
                                </span>
                                @if ($movie->resolution!=5)
                                    <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                        @if ($movie->ep_number==0)
                                            @switch($movie->subtitled)
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
                                            @endswitch
                                        @else
                                            @switch($movie->subtitled)
                                                @case(0)
                                                    Vietsub - {{$movie->episodes_count}}/{{$movie->ep_number}}
                                                    @break
                                                @case(1)
                                                    TM - {{$movie->episodes_count}}/{{$movie->ep_number}}
                                                    @break
                                                @case(2)
                                                    Eng-sub - {{$movie->episodes_count}}/{{$movie->ep_number}}
                                                    @break
                                                @default
                                                    Khác
                                            @endswitch
                                        @endif
                                    </span>
                                @endif
                                <div class="red_overlay"></div> <!-- Thêm layer màu đỏ -->
                                <div class="icon_overlay"></div>
                                <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                        <p class="entry-title">{{$movie->title}}</p>
                                        <p class="original_title">{{$movie->name_eng}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </article>
                    @endforeach

                </div>
            </section>
            <div class="clearfix"></div>
            @endforeach

        </main>
        <div id="sidebar" class="col-xs-12 col-sm-12 col-md-3">
            {{-- Sidebar --}}
            @include('pages.include.sidebar')
        </div>
    </div>
@endsection