@extends('welcome')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><span class="breadcrumb_last" aria-current="page">Thể Loại</span> » 
                            <a href="">{{$genre_slug->title}}</a></span></span></div>
                    </div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-9">
            <section>
                <div class="section-bar clearfix">
                    <h1 class="section-title"><span>{{$genre_slug->title}}</span></h1>
                </div>
                <div class="halim_box">
                    <div class="section-bar clearfix">
                        <div class="row">
                            @include('pages.include.filter-film')
                        </div>
                    </div>
                    @foreach($movie as $key => $mov)

                    <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
                        <div class="halim-item">
                            <a class="halim-thumb" href="{{route('detail', $mov->slug)}}" title="{{$mov->title}}">
                                <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$mov->image)}}" alt="{{$mov->title}}" title="{{$mov->title}}"></figure>
                            @if ($mov->resolution==5)
                                <span class="is_trailer">
                            @else
                                <span class="status">
                            @endif
                                    @switch($mov->resolution)
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
                            @if ($mov->resolution!=5)
                                <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                    @if ($mov->ep_number==0)
                                        @switch($mov->subtitled)
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
                                        @switch($mov->subtitled)
                                            @case(0)
                                                Vietsub - {{$mov->episodes_count}}/{{$mov->ep_number}}
                                                @break
                                            @case(1)
                                                TM - {{$mov->episodes_count}}/{{$mov->ep_number}}
                                                @break
                                            @case(2)
                                                Eng-sub - {{$mov->episodes_count}}/{{$mov->ep_number}}
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
                                        <p class="entry-title">{{$mov->title}}</p>
                                        <p class="original_title">{{$mov->name_eng}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </article>
                    @endforeach
                    

                </div>
                <div class="clearfix"></div>
                <div class="text-center">
                    {{ $movie->links("pagination::bootstrap-4") }}

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