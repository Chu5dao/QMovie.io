@extends('welcome')
@section('content')
<style>
   .halim-entry-box-fix {
      background-color: #fff;
   }
   /* Basic styles for tabs */
   .tab {
      display: flex;
      border-bottom: 1px solid #263a4c;
   }
   .tab a {
      background-color: inherit;
      border: none;
      outline: none;
      padding: 10px 20px;
      cursor: pointer;
      transition: background-color 0.3s;
      text-decoration: none;
      color: #86add0;
   }
   .tab a.active {
      background-color: #86add0; /* Change to the desired active color */
      color: white; /* Change text color to white when active */
   }
   .tabcontent {
      display: none;
      padding: 20px;
      border-top: none;
   }
   .tabcontent.active {
      display: block;
   }
   .tablinks {
      padding: 8px 16px;
      background-color: #333;
      border: 1px solid #444;
      margin-right: 2px;
   }
   .tablinks:hover {
      background-color: #86add0;
      color: #fff;
   }
   .tablinks.active {
      background-color: #86add0;
      color: #fff;
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
                           <span class="breadcrumb_last" aria-current="page">{{$movie->title}} 
                              @if ($movie->ep_number == 0)
                                 - Tập Lẻ
                              @else
                                 - Tập {{$episode->episode}}
                              @endif
                           </span>
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

               @if ($movie->ep_number == 0)
                  @foreach($episodes_add as $ep)
                  @php
                  $movie_item = $movies_add->firstWhere('id', $ep->movie_id);
                  switch ($movie_item->resolution) {
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
                  @endphp
                  @if (Request::is('xem-phim/' . $movie_item->slug . '/tap-' . $tapValue))
                     <iframe width="100%" height="500" src="{{ $ep->link }}" title="Video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  @endif
                  @endforeach
               @else
                  <iframe width="100%" height="500" src="{{$episode->link}}" title="Video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
               @endif
               
               <div class="button-watch">
                  <ul class="halim-social-plugin col-xs-4 hidden-xs">
                     @php
                        $current_url = Request::url();
                     @endphp
                     <div class="fb-save" data-uri="{{$current_url}}" data-size=""></div>
                     <div class="fb-like" data-href="{{$current_url}}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true" data-width=""></div>
                  </ul>
                  <ul class="col-xs-12 col-md-8">
                     {{-- <div id="autonext" class="btn-cs autonext">
                        <i class="icon-autonext-sm"></i>
                        <span><i class="hl-next"></i> Autonext: <span id="autonext-status">On</span></span>
                     </div>
                     <div id="explayer" class="hidden-xs"><i class="hl-resize-full"></i>
                        Expand 
                     </div> --}}
                     <div id="toggle-light"><i class="hl-adjust"></i>
                        Light Off 
                     </div>
                     <div id="report" class="halim-switch"><i class="hl-attention"></i> Report</div>
                     <div class="luotxem"><i class="hl-eye"></i>
                        <span>{{$movie->views}}</span> lượt xem
                     </div>
                     <div class="luotxem">
                        <a class="visible-xs-inline" data-toggle="collapse" href="#moretool" aria-expanded="false" aria-controls="moretool"><i class="hl-forward"></i> Share</a>
                     </div>
                  </ul>
               </div>
               <div class="collapse" id="moretool">
                  <ul class="nav nav-pills x-nav-justified">
                     <li class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
                     <div class="fb-save" data-uri="" data-size="small"></div>
                  </ul>
               </div>
            
               <div class="clearfix"></div>
               <div class="clearfix"></div>
               <div class="title-block">
                  {{-- <a href="javascript:;" data-toggle="tooltip" title="Add to bookmark">
                     <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="37976">
                        <div class="halim-pulse-ring"></div>
                     </div>
                  </a> --}}
                  <div class="title-wrapper full">
                     <h1 class="entry-title"><a href="" title="{{$movie->title}}" class="tl">{{$movie->title}} - 
                        @if ($movie->ep_number == 0)
                           Tập Lẻ
                        @else
                           Tập {{$episode->episode}}
                        @endif</a></h1>
                     @if ($movie->resolution===5)
                        Phim hiện tại chưa cập nhật
                     @endif
                  </div>
               </div>
               <div class="entry-content htmlwrap clearfix collapse" id="expand-post-content">
                  <article id="post-37976" class="item-content post-37976"></article>
               </div>
               <div class="clearfix"></div>
               <div class="text-center">
                  <div id="halim-ajax-list-server"></div>
               </div>
               <div id="halim-list-server">
                  <ul class="tab
                  {{-- nav nav-tabs --}}
                  ">
                     @foreach($server_list as $key => $server)
                     {{-- <li class="nav-item"> --}}
                        <a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'server-{{ $server->id }}')" id="{{ $key === 0 ? 'defaultOpen' : '' }}"><i class="hl-server"></i> {{ $server->title }}</a>
                     {{-- </li> --}}
                     @endforeach
                  </ul>
                  <div 
                  {{-- class="tab-content" id="myTabContent" --}}
                  >
                     @foreach($server_list as $key => $server)
                     <div id="server-{{ $server->id }}" class="tabcontent">
                        <div class="halim-server">
                           <ul class="halim-list-eps">
                              {{-- @foreach ($movie->episodes as $key => $ep)
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
                                    $tapValue =  $ep->episode;
                                 }
                              @endphp
                              <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$tapValue)}}">
                                 <li class="halim-episode"><span 
                                    class="halim-btn halim-btn-2 halim-info-1-1 box-shadow
                                    {{$tapphim==$ep->episode ? 'active' : ''}}
                                    " 
                                    data-post-id="{{ $movie->id }}" 
                                    data-server="1" 
                                    data-episode="{{ $ep->episode }}" 
                                    data-position="first" 
                                    data-embed="0" 
                                    data-title="Xem phim {{ $movie->title }} - Tập {{ $ep->episode }} - {{ $movie->name_eng }} - vietsub + Thuyết Minh" 
                                    data-h1="{{ $movie->title }} - tập {{ $ep->episode }}">
                                    @if ($movie->ep_number > 0)
                                       {{ $ep->episode }}
                                    @else
                                       {{$tapValue}}
                                    @endif
                                    </span>
                                 </li>
                              </a>
                              @endforeach --}}
                              {{-- @foreach ($episodes_add as $ep) --}}
                              {{-- @dump($server_list, $episodes_add); --}}
                              {{-- @dump($episodes_add->where('server', $server->id)) --}}
                              @foreach ($episodes_add->where('server', $server->id) as $ep)
                              @php
                                 // $movie_item = $movie->firstWhere('id', $ep->movie_id);
                                 $movie_item = $movies_add->firstWhere('id', $ep->movie_id);
                                 // echo json_encode($movie_item, JSON_PRETTY_PRINT);
                                 // Xác định giá trị của $tapValue dựa vào $movie->ep_number và $ep->episode
                                 if ($movie_item->ep_number == 0) {
                                    switch ($movie_item->resolution) {
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
                                 } else {
                                    $tapValue = $ep->episode; // Lấy số tập phim
                                 }
                              @endphp
                              
                              <a href="{{ url('xem-phim/' . $movie_item->slug . '/tap-' . $tapValue) }}" class="bwac-btn">
                                 <li class="halim-episode">
                                    <span class="halim-btn halim-btn-2 halim-info-1-1 box-shadow {{ Request::is('xem-phim/' . $movie_item->slug . '/tap-' . $tapValue) ? 'active' : '' }}"
                                          data-post-id="{{ $movie_item->id }}"
                                          data-server="{{ $server->id }}"
                                          data-episode="{{ $ep->episode }}"
                                          data-position="first"
                                          data-embed="0"
                                          data-title="Xem phim {{ $movie_item->title }} - Tập {{ $ep->episode }} - {{ $movie_item->name_eng }} - vietsub + Thuyết Minh"
                                          data-h1="{{ $movie_item->title }} - tập {{ $ep->episode }}">
                                       {{ $tapValue }}
                                    </span>
                                 </li>
                              </a>
                           @endforeach
                           </ul>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                     @endforeach
                  </div>

               </div>
               <div class="clearfix"></div>
               <div class="htmlwrap clearfix">
                  {{-- CMT --}}
                  @php
                     $current_url = Request::url();
                  @endphp
                  <div class="video-item halim-entry-box halim-entry-box-fix">
                     <div class="fb-comments" data-href="{{$current_url}}" data-width="100%" data-numposts="10" data-colorscheme="dark"></div>
                  </div>
                  {{-- ========== --}}
                     <div id="lightout"></div>
               </div>
         </section>
         {{-- related movies --}}
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
   <script>
      function openTab(evt, tabName) {
         var i, tabcontent, tablinks;
         tabcontent = document.getElementsByClassName("tabcontent");
         for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
         }
         tablinks = document.getElementsByClassName("tablinks");
         for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
         }
         document.getElementById(tabName).style.display = "block";
         evt.currentTarget.className += " active";
      }

      // Get the element with id="defaultOpen" and click on it
      document.getElementById("defaultOpen").click();
   </script>
@endsection

