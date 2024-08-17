@extends('welcome')
@section('content')
<style>
    li span, article,
    .video-item .item-content {
        color: #fff;
    }
    .halim-entry-box-fix {
        background-color: #fff;
    }
    .total_rating {
        padding-left: 8px;
    }
</style>
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="yoast_breadcrumb hidden-xs"><span>
                            <span>
                                <a href="{{route('category', [$movie->category->slug])}}">{{$movie->category->title}}</a> » 
                                <span>
                                    <a href="{{route('country', [$movie->country->slug])}}">{{$movie->country->title}}</a> » 
                                    @foreach($movie->genres as $key => $m_genre)
                                        <a href="{{route('genre', [$m_genre->slug])}}">{{$m_genre->title}}</a> » 
                                    @endforeach
                                    <span class="breadcrumb_last" aria-current="page">{{$movie->title}}</span>
                                </span>
                            </span>
                        </span></div>
                    </div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-9">
            <section id="content" class="test">
                <div class="clearfix wrap-content">

                    <div class="halim-movie-wrapper">
                        {{-- <div class="title-block">
                            <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                                <div class="halim-pulse-ring"></div>
                            </div>
                            <div class="title-wrapper" style="font-weight: bold;">
                                Bookmark
                            </div>
                        </div> --}}
                        {{-- @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif --}}
                        <div class="movie_info col-xs-12">
                            <div class="movie-poster col-md-3">
                                @if (Str::startsWith($movie->image, 'https'))
                                    <img class="movie-thumb" src="{{ $movie->image }}" alt="{{ $movie->title }}">
                                @else
                                    <img class="movie-thumb" src="{{ asset('uploads/movie/' . $movie->image) }}" alt="{{ $movie->title }}">
                                @endif
                                @php
                                    if ($movie->ep_number == 0) {
                                        switch ($movie->resolution) {
                                        case '0':
                                            $tapValue = 'HD';
                                            break;
                                        case '1':
                                            $tapValue = 'SD';
                                            break;
                                        case '2':
                                            $tapValue = 'HD-Cam';
                                            break;
                                        case '3':
                                            $tapValue = 'Cam';
                                            break;
                                        case '4':
                                            $tapValue = 'Full-HD';
                                            break;
                                        default:
                                            $tapValue = 'Trailer';
                                            break;
                                        }
                                    }else{
                                        $tapValue = isset($episode_default) ? $episode_default->episode : 'HD'; 
                                    }
                                @endphp
                                @if ($movie->resolution == 5)
                                    <a href="#watch_trailer" style="display: block" class="watch_trailer btn btn-warning">Xem Trailer</a>
                                @elseif (isset($episode_default))
                                    <div class="bwa-content">
                                        <div class="loader"></div>
                                        <a href="{{ url('xem-phim/' . $movie->slug . '/tap-' . $tapValue) }}" class="bwac-btn">
                                            <i class="fa fa-play"></i>
                                        </a>
                                    </div>
                                @else
                                    <a href="#watch_trailer" style="display: block" class="watch_trailer btn btn-warning">
                                        @if (session('detail_status'))
                                            {{ session('detail_status') }}
                                        @endif
                                    </a>
                                @endif
                            </div>
                            <div class="film-poster col-md-9">
                                <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{$movie->title}}</h1>
                                <h2 class="movie-title title-2" style="font-size: 12px;">{{$movie->name_eng}}</h2>
                                <ul class="list-info-group">
                                    <li class="list-info-group-item"><span>Trạng Thái : </span><span class="quality">
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
                                    <span class="episode">
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
                                    </span>
                                    @endif
                                    </li>
                                    <li class="list-info-group-item"><span>Thời lượng : </span>{{$movie->duration}}</li>
                                @if ($movie->ep_number != 0)
                                    <li class="list-info-group-item">
                                        <span>Tập phim</span> :
                                        @if ($movie->episodes->isNotEmpty())
                                            {{ $movie->episodes->max('episode') }}
                                        @else
                                            0
                                        @endif
                                        / {{$movie->ep_number}} -
                                        @if (($movie->ep_number) - ($movie->episodes->count()) == 0)
                                            Hoàn Thành
                                        @else
                                            Đang cập nhật
                                        @endif
                                    </li>
                                @else
                                    <li class="list-info-group-item"><span>Tập phim : </span>
                                        @if (!isset($episode_default))
                                            @if (session('detail_status'))
                                                {{ session('detail_status') }}
                                            @endif
                                        @else
                                            Tập Lẻ
                                        @endif
                                    </li>
                                @endif
                                    <li class="list-info-group-item">
                                        <span>Danh Mục : </span>
                                        {{-- <a href="{{route('category', [$movie->category->slug])}}" rel="category tag">{{$movie->category->title}}</a> --}}

                                        @foreach($movie->categories as $category_movie)
                                            <a href="{{route('category', $category_movie->slug)}}" rel="category tag">{{$category_movie->title}}</a>
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </li>
                                    <li class="list-info-group-item">
                                        <span>Thể loại : </span>
                                        @if ($movie->genres->isNotEmpty())
                                            @foreach ($movie->genres as $gen)
                                                <a href="{{ route('genre', [$gen->slug]) }}" rel="category tag">{{ $gen->title }}</a>
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        @else
                                            Chưa có thể loại cho phim này.
                                        @endif
                                    </li>
                                    <li class="list-info-group-item"><span>Quốc Gia : </span>
                                        <a href="{{route('country', [$movie->country->slug])}}" rel="tag">{{$movie->country->title}}</a>
                                    </li>
                                    
                                @if ($movie->ep_number != 0)
                                    <li class="list-info-group-item"><span>Tập mới nhất : </span>
                                        @if ($movie->episodes->isNotEmpty())
                                            @foreach($episode as $key => $ep)
                                            <a href="{{url('xem-phim/'.$ep->movie->slug.'/tap-'.$ep->episode)}}" rel="tag">
                                                @if ($movie->ep_number == 0 || $movie->ep_number == 1)
                                                    Full
                                                @else
                                                    Tập {{$ep->episode}}
                                                @endif
                                            </a>
                                            @endforeach
                                        @else
                                            Đang cập nhật
                                        @endif
                                    </li>
                                @endif
                                    <li class="list-info-group-item">
                                        <ul class="list-inline rating"  title="Average Rating">
                                            <span class="total_rating">Đánh giá :</span>
                                            @for($count=1; $count<=5; $count++)
                                                @php
                                                    if($count<=$rating) { 
                                                        $color = 'color:#ffcc00;'; //mau vang
                                                    } else {
                                                        $color = 'color:#ccc;'; //mau xam
                                                    }
                                                @endphp
                                                <li title="star_rating" 
                                                id="{{$movie->id}}-{{$count}}" 
                                                data-index="{{$count}}"  
                                                data-movie_id="{{$movie->id}}" 
                                                data-rating="{{$rating}}" 
                                                class="rating" 
                                                style="cursor:pointer; {{$color}} 
                                                font-size:30px;">&#9733;</li>
                                            @endfor
                                            {{$rating}} sao / {{$count_total}} lượt
                                        </ul>
                                    </li>
                                    {{-- <li class="list-info-group-item"><span>Đạo diễn</span> : <a class="director" rel="nofollow" href="https://phimhay.co/dao-dien/cate-shortland" title="Cate Shortland">Cate Shortland</a></li>
                                    <li class="list-info-group-item last-item" style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;"><span>Diễn viên</span> : <a href="" rel="nofollow" title="C.C. Smiff">C.C. Smiff</a>, <a href="" rel="nofollow" title="David Harbour">David Harbour</a>, <a href="" rel="nofollow" title="Erin Jameson">Erin Jameson</a>, <a href="" rel="nofollow" title="Ever Anderson">Ever Anderson</a>, <a href="" rel="nofollow" title="Florence Pugh">Florence Pugh</a>, <a href="" rel="nofollow" title="Lewis Young">Lewis Young</a>, <a href="" rel="nofollow" title="Liani Samuel">Liani Samuel</a>, <a href="" rel="nofollow" title="Michelle Lee">Michelle Lee</a>, <a href="" rel="nofollow" title="Nanna Blondell">Nanna Blondell</a>, <a href="" rel="nofollow" title="O-T Fagbenle">O-T Fagbenle</a></li> --}}
                                </ul>
                                <div class="movie-trailer hidden"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="halim_trailer"></div>
                    <div class="clearfix"></div>
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">
                                {!! nl2br(e($movie->description)) !!}
                            </article>
                        </div>
                    </div>

                    {{-- Tags phim --}}
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Tags phim</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">
                                @if($movie->tags!=NULL)
                                    @php
                                        $tags = array();
                                        $tags = explode(',', $movie->tags);
                                        // print_r($tags);
                                    @endphp
                                    @foreach($tags as $key => $tag)
                                        <a href="{{url('tu-khoa/'.$tag)}}">{{$tag}}</a>
                                    @endforeach
                                @else
                                    <a href="{{url('tu-khoa/'.$movie->title)}}">{{$movie->title}}</a>
                                @endif
                            </article>
                        </div>
                    </div>
                    {{-- ========== --}}

                    {{-- Trailer phim --}}
                    <div class="section-bar clearfix" id="watch_trailer">
                        <h2 class="section-title"><span style="color:#ffed4d">Trailer  phim</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article class="item-content">
                                <iframe width="100%" height="315"
                                @php
                                $url_trailer = $movie->trailer;
                                $url_check = substr($url_trailer, 0, 5);
                                
                                if ($url_check === 'https') {
                                    // Phân tích URL và lấy giá trị sau dấu '='
                                    parse_str(parse_url($url_trailer, PHP_URL_QUERY), $query);
                                    $url_trailer = $query['v'] ?? $url_trailer; // Lấy giá trị 'v' nếu tồn tại
                                }else{
                                    $url_trailer = $url_trailer;
                                }
                                @endphp
                                src="https://www.youtube.com/embed/{{$url_trailer}}" 
                                title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </article>
                        </div>
                    </div>

                    {{-- CMT --}}
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        @php
                            $current_url = Request::url();
                        @endphp
                        <div class="video-item halim-entry-box halim-entry-box-fix">
                            <div class="fb-comments" data-href="{{$current_url}}" data-width="100%" data-numposts="10" data-colorscheme="dark"></div>
                        </div>
                    </div>
                    {{-- ========== --}}
                    
                </div>
            </section>
            <section class="related-movies">
                <div id="halim_related_movies-2xx" class="wrap-slider">
                    <div class="section-bar clearfix">
                        <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                    </div>
                    <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                        @foreach($movie_related as $key => $m_related)
                        <article class="thumb grid-item post-38498">
                            <div class="halim-item">
                                <a class="halim-thumb" href="{{route('detail', $m_related->slug)}}" title="{{$m_related->title}}">
                                    <figure>
                                        @if (Str::startsWith($m_related->image, 'https'))
                                            <img class="lazy img-responsive" src="{{ $m_related->image }}" alt="{{$m_related->title}}" title="{{$m_related->title}}">
                                        @else
                                            <img class="lazy img-responsive" src="{{asset('uploads/movie/'.$m_related->image)}}" alt="{{$m_related->title}}" title="{{$m_related->title}}">
                                        @endif
                                    </figure>
                                @if ($m_related->resolution==5)
                                    <span class="is_trailer">
                                @else
                                    <span class="status">
                                @endif
                                        @switch($m_related->resolution)
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
                                @if ($m_related->resolution!=5)
                                    <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                        @if ($m_related->ep_number==0)
                                            @switch($m_related->subtitled)
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
                                            @switch($m_related->subtitled)
                                                @case(0)
                                                    Vietsub - {{$m_related->episodes_count}}/{{$m_related->ep_number}}
                                                    @break
                                                @case(1)
                                                    TM - {{$m_related->episodes_count}}/{{$m_related->ep_number}}
                                                    @break
                                                @case(2)
                                                    Eng-sub - {{$m_related->episodes_count}}/{{$m_related->ep_number}}
                                                    @break
                                                @default
                                                    Khác
                                            @endswitch
                                        @endif
                                    </span>
                                @endif
                                    <div class="icon_overlay"></div>
                                    <div class="halim-post-title-box">
                                        <div class="halim-post-title ">
                                            <p class="entry-title">{{$m_related->title}}</p>
                                            <p class="original_title">{{$m_related->name_eng}}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                        </article>
                        @endforeach

                    </div>
                    {{-- Slider --}}
                    {{-- <script>
                        jQuery(document).ready(function($) {
                            var owl = $('#halim_related_movies-2');
                            owl.owlCarousel({
                                loop: true,
                                margin: 4,
                                autoplay: true,
                                autoplayTimeout: 4000,
                                autoplayHoverPause: true,
                                nav: true,
                                navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],
                                responsiveClass: true,
                                responsive: {
                                    0: {
                                        items: 2
                                    },
                                    480: {
                                        items: 3
                                    },
                                    600: {
                                        items: 4
                                    },
                                    1000: {
                                        items: 4
                                    }
                                }
                            })
                        });
                    </script> --}}
                </div>
            </section>
        </main>
        <div id="sidebar" class="col-xs-12 col-sm-12 col-md-3">
            {{-- Sidebar-hot(đề cử) --}}
            @include('pages.include.sidebar-hot')
            {{-- Sidebar --}}
            @include('pages.include.sidebar')
        </div>
    </div>
@endsection