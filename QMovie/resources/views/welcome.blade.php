<!DOCTYPE html>
<html lang="vi">

<head>
   {{-- FILE chứa CSS/JS người dùng và Phần Header và Footer --}}
   <meta charset="utf-8" />
   <meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
   <meta name="theme-color" content="#234556">
   <meta http-equiv="Content-Language" content="vi" />
   <meta content="VN" name="geo.region" />
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <meta name="DC.language" scheme="utf-8" content="vi" />
   <meta name="language" content="Việt Nam">
   <link rel="shortcut icon" href="{{ asset('uploads/logo/'.$info->shortcut_icon) }}" type="image/x-icon" />
   <meta name="revisit-after" content="1 days" />
   <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
   <title>{{ $meta_title }}</title>

   <meta name="description" content="{{ $meta_description }}" />
   <link rel="canonical" href="{{Request::url()}}">
   <link rel="next" href="" />
   <meta property="og:locale" content="vi_VN" />
   <meta property="og:title" content="{{ $meta_title }}" />
   <meta property="og:description" content="{{ $meta_description }}" />
   <meta property="og:url" content="{{Request::url()}}" />
   <meta property="og:site_name" content="{{ $meta_title }}" />
   <meta property="og:image" content="{{ $meta_image }}" />
   <meta property="og:image:width" content="300" />
   <meta property="og:image:height" content="55" />
   {{-- font awesome (icon) --}}
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
   <link rel='dns-prefetch' href='//s.w.org' />
   <link rel='stylesheet' id='bootstrap-css' href='{{asset('css/bootstrap.min.css?ver=5.7.2')}}' media='all' />
   <link rel='stylesheet' id='style-css' href='{{asset('css/style.css?ver=5.7.2')}}' media='all' />
   <link rel='stylesheet' id='wp-block-library-css' href='{{asset('css/style.min.css?ver=5.7.2')}}' media='all' />
   <style type="text/css" id="wp-custom-css">
      .textwidget p a img {
      width: 100%;
      }
   </style>
   <style>
      /* #header .site-title {background: url( '{{asset('uploads/logo/'.$info->logo)}}' ) no-repeat top left;background-size: contain;text-indent: -9999px;} */
   </style>
</head>

<body class="home blog halimthemes halimmovies" data-masonry="">
   <header id="header">
      <div class="container">
         <div class="row" id="headwrap">
               <div class="col-md-3 col-sm-6 slogan">
                  <p class=""><a class="logo" href="{{route('homepage')}}" title="{{$info->title}}">
                     <img src="{{ asset('uploads/logo/'.$info->logo) }}" alt="Hình ảnh website {{$info->title}}" width="300">
                  </a></p>
               </div>
               <div class="col-md-5 col-sm-6 halim-search-form hidden-xs">
                  <div class="header-nav">
                     <div class="col-xs-12">
                           <form id="search-form-pc" name="halimForm" role="search" action="{{route('search')}}" method="GET">
                              <div class="form-group form-search"> {{-- form-timkiem --}}
                                 <div class="input-group col-xs-12">
                                       <input id="search-fix" type="text" name="search" class="form-control" placeholder="Tìm kiếm..." autocomplete="off" required>
                                       <i class="animate-spin hl-spin4 hidden"></i>
                                 </div>
                              </div>
                           </form>
                           <ul class="ui-autocomplete ajax-results" style="display: none">
                              {{-- items search --}}
                           </ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 hidden-xs">
                  {{-- <div id="get-bookmark" class="box-shadow">
                     <i class="hl-bookmark"></i>
                     <span> Bookmarks</span><span class="count">0</span>
                  </div>
                  <div id="bookmark-list" class="hidden bookmark-list-on-pc">
                     <ul style="margin: 0;"></ul>
                  </div> --}}
                  <div id="sign-in" class="box-shadow">
                     <i class='fa fa-sign-in'></i>
                     <span> Đăng nhập</span>
                  </div>
                  <div id="sign-up" class="box-shadow">
                     <i class='fa fa-user'></i>
                     <span> Đăng ký</span>
                  </div>
               </div>
         </div>
      </div>
   </header>
   <div class="navbar-container">
      <div class="container">
         <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#halim" aria-expanded="false">
                     <span class="sr-only">Menu</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right expand-search-form" data-toggle="collapse" data-target="#search-form" aria-expanded="false">
                     <span class="hl-search" aria-hidden="true"></span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right sign-up-on-mobile">
                     Đăng ký <i class="fa fa-user" aria-hidden="true"></i>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right sign-in-on-mobile">
                     Đăng nhập <i class="fa fa-sign-in" aria-hidden="true"></i>
                  </button>
                  {{-- <button type="button" class="navbar-toggle collapsed pull-right get-bookmark-on-mobile">
                     Bookmarks<i class="hl-bookmark" aria-hidden="true"></i>
                     <span class="count">0</span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right get-locphim-on-mobile">
                     <a href="javascript:;" id="expand-ajax-filter" style="color: #ffed4d;">Lọc <i class="fas fa-filter"></i></a>
                  </button> --}}
               </div>
               <div class="collapse navbar-collapse" id="halim">
                  <div class="menu-menu_1-container">
                     <ul id="menu-menu_1" class="nav navbar-nav navbar-left">
                           <li class="current-menu-item active"><a title="Trang Chủ" href="{{route('homepage')}}" style="background:#000;">Trang Chủ</a></li>
                           <li class="mega dropdown">
                              <a title="Thể Loại" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Thể Loại <span class="caret"></span></a>
                              <ul role="menu" class=" dropdown-menu">
                                 @foreach ($genre_user as $key=>$gen)
                                    <li><a title="{{$gen->title}}" href="{{route('genre', $gen->slug)}}">{{$gen->title}}</a></li>
                                 @endforeach
                              </ul>
                           </li>
                           <li class="mega dropdown">
                              <a title="Quốc Gia" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Quốc Gia <span class="caret"></span></a>
                                 <ul role="menu" class=" dropdown-menu">
                                    @foreach ($country_user as $key=> $cou)
                                       <li><a title="{{$cou->title}}" href="{{route('country', $cou->slug)}}">{{$cou->title}}</a></li>
                                    @endforeach
                                 </ul>
                           </li>

                           <li class="mega dropdown">
                              <a title="Năm" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Năm <span class="caret"></span></a>
                              <ul role="menu" class=" dropdown-menu">
                                 @for ($year=1970; $year<=2024; $year++)
                                 <li><a title="Phim {{$year}}" href="{{url('nam/'.$year)}}">Phim {{$year}}</a></li>
                                 @endfor
                              </ul>
                           </li>

                           @foreach ($category_user as $key=> $cate)
                              <li class="mega"><a title="{{$cate->title}}" href="{{route('category', $cate->slug)}}">{{$cate->title}}</a></li>
                           @endforeach
                           
                     </ul>
                  </div>
                  <ul class="nav navbar-nav navbar-left" style="background:#000;">
                     <li><a href="{{route('filter-film')}}" onclick="locphim()" style="color: #ffed4d;">Lọc Phim</a></li>
                  </ul>
               </div>
         </nav>
         <div class="collapse navbar-collapse" id="search-form">
               <div id="mobile-search-form" class="halim-search-form"></div>
         </div>
         <div class="collapse navbar-collapse" id="user-info">
               <div id="mobile-user-login"></div>
         </div>
      </div>
   </div>
   </div>

   <div class="container">
      <div class="row fullwith-slider"></div>
   </div>
   <!-- CUT Container (pages/home.blade.php,...) -->
   <div class="container">
      @yield('content')
      @include('pages.include.modal')
   </div>

   <div class="clearfix"></div>
   <footer id="footer" class="clearfix">
      <div class="container footer-columns">
         <div class="row container">
               <div class="widget about col-xs-12 col-sm-4 col-md-2">
                  <div class="footer-logo">
                     <img class="img-responsive" src="{{ asset('uploads/logo/'.$info->logo_footer) }}" alt="Hình ảnh website {{ $info->title }}" style="border: 5px solid #0E1215;" />
                  </div>
                  {{-- Liên hệ QC: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="e5958d8c888d849ccb868aa58288848c89cb868a88">[email&#160;protected]</a> &#169;QMovie --}}
               </div>
               <div class="widget about col-xs-12 col-sm-4 col-md-6">
                  <div class="footer-logo">
                     <p>{{ $info->description }}</p>
                  </div>
               </div>
         </div>
      </div>
   </footer>
   <style>
      .copyright_footer {
         margin-top: 10px; 
         text-align: center;
      }
      .text_copyright {
         line-height: 32px;
         font-weight: 600;
      }
      #sign-in {
         color: #ffed4d;
         background: #DF0053;
      }
      #sign-up {
         background: #224361;
         color: #fff;
      }
      #sign-up,
      #sign-in {
      display: inline-block;
      line-height: 20px;
      padding: 6px 15px;
      border-radius: 20px;
      cursor: pointer;
      transition: 0.4s all;
      margin-top: 1px;
      margin-right: 15px;
      }
      #sign-up:hover,
      #sign-in:hover {
      background: #337ab7;
      }
      .sign-up-on-mobile,
      .sign-in-on-mobile {
      position: relative;
      }
      .sign-in-on-mobile {
         color: #ffed4d;
      }
      .halim-light-mode #sign-up,
      .halim-light-mode #sign-in {
      box-shadow: none;
      text-shadow: none;
      }
      .halim-light-mode #sign-up:hover,
      .halim-light-mode #sign-in:hover {
      background: #4d7496;
      color: #fff;
      }
   </style>
   <div class="copyright_footer">
      <p class="text_copyright">{{ $info->copyright }}</p>
   </div>
   <div id='easy-top'></div>

   <style>
      #overlay_mb{position:fixed;display:none;width:100%;height:100%;top:0;left:0;right:0;bottom:0;background-color:rgba(0, 0, 0, 0.7);z-index:99999;cursor:pointer}#overlay_mb .overlay_mb_content{position:relative;height:100%}.overlay_mb_block{display:inline-block;position:relative}#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:600px;height:auto;position:relative;left:50%;top:50%;transform:translate(-50%, -50%);text-align:center}#overlay_mb .overlay_mb_content .cls_ov{color:#fff;text-align:center;cursor:pointer;position:absolute;top:5px;right:5px;z-index:999999;font-size:14px;padding:4px 10px;border:1px solid #aeaeae;background-color:rgba(0, 0, 0, 0.7)}#overlay_mb img{position:relative;z-index:999}@media only screen and (max-width: 768px){#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:400px;top:3%;transform:translate(-50%, 3%)}}@media only screen and (max-width: 400px){#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:310px;top:3%;transform:translate(-50%, 3%)}}
   </style>

   <style>
      #overlay_pc {
      position: fixed;
      display: none;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.7);
      z-index: 99999;
      cursor: pointer;
      }
      #overlay_pc .overlay_pc_content {
      position: relative;
      height: 100%;
      }
      .overlay_pc_block {
      display: inline-block;
      position: relative;
      }
      #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
      width: 600px;
      height: auto;
      position: relative;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      }
      #overlay_pc .overlay_pc_content .cls_ov {
      color: #fff;
      text-align: center;
      cursor: pointer;
      position: absolute;
      top: 5px;
      right: 5px;
      z-index: 999999;
      font-size: 14px;
      padding: 4px 10px;
      border: 1px solid #aeaeae;
      background-color: rgba(0, 0, 0, 0.7);
      }
      #overlay_pc img {
      position: relative;
      z-index: 999;
      }
      @media only screen and (max-width: 768px) {
      #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
      width: 400px;
      top: 3%;
      transform: translate(-50%, 3%);
      }
      }
      @media only screen and (max-width: 400px) {
      #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
      width: 310px;
      top: 3%;
      transform: translate(-50%, 3%);
      }
      }
      .ui-autocomplete div {
         flex: 1;
         margin-left: 10px; /* Đặt khoảng cách giữa hình ảnh và nội dung */
      }
   </style>

   <style>
      .float-ck { position: fixed; bottom: 0px; z-index: 9}
      * html .float-ck /* IE6 position fixed Bottom */{position:absolute;bottom:auto;top:expression(eval (document.documentElement.scrollTop+document.docum entElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||0))) ;}
      #hide_float_left a {background: #0098D2;padding: 5px 15px 5px 15px;color: #FFF;font-weight: 700;float: left;}
      #hide_float_left_m a {background: #0098D2;padding: 5px 15px 5px 15px;color: #FFF;font-weight: 700;}
      span.bannermobi2 img {height: 70px;width: 300px;}
      #hide_float_right a { background: #01AEF0; padding: 5px 5px 1px 5px; color: #FFF;float: left;}
   </style>
   
   <script type='text/javascript' src='{{asset('js/jquery.min.js?ver=5.7.2')}}' id='halim-jquery-js'></script>
   <script type='text/javascript' src='{{asset('js/bootstrap.min.js?ver=5.7.2')}}' id='bootstrap-js'></script>
   <script type='text/javascript' src='{{asset('js/owl.carousel.min.js?ver=5.7.2')}}' id='carousel-js'></script>
   <script type='text/javascript' src='{{asset('js/halimtheme-core.min.js?ver=1626273138')}}' id='halim-init-js'></script>
   {{-- Advertising Modal --}}
   <script type="text/javascript">
      $(window).on('load', function() {
         $('#advertisingModal').modal('show');
      })
   </script>
   <!-- Slider -->
   <script type="text/javascript">
      jQuery(document).ready(function(e) {
         e("#halim_related_movies-2").owlCarousel({
            loop: !0,
            margin: 4,
            autoplay: !0,
            autoplayTimeout: 4000,
            autoplayHoverPause: !0,
            nav: !0,
            navText: ['<i class="fa fa-angle-left fa-3x"></i>', '<i class="fa fa-angle-right fa-3x"></i>'],
            responsiveClass: !0,
            responsive: {
               0: { items: 2 },
               480: { items: 3 },
               600: { items: 4 },
               1000: { items: 5 }
            }
         });
      });
   </script>

   <!-- Filter Sidebar Xu hướng -->
   <script type="text/javascript">
      $(document).ready(function() {
         function loadContent(value) {
            $.ajax({
               url: "{{ url('/sap-xep-xu-huong') }}",
               method: "GET",
               data: { value: value },
               success: function(response) {
                  if (value === 0) {
                     $('#ngay #show0').html(response.output0);
                  } else if (value === 1) {
                     $('#tuan #show0').html(response.output0);
                     $('#tuan #show1').html(response.output1);
                  } else if (value === 2) {
                     $('#thang #show0').html(response.output0);
                     $('#thang #show1').html(response.output1);
                     $('#thang #show2').html(response.output2);
                  }
               },
               error: function(xhr, status, error) {
                  console.error('Có lỗi xảy ra:', xhr.responseText);
               }
            });
         }

         $('.filter-sidebar').on('click', function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            var value;
            switch (href) {
               case '#ngay':
                  value = 0;
                  break;
               case '#tuan':
                  value = 1;
                  break;
               case '#thang':
                  value = 2;
                  break;
               default:
                  value = null;
                  break;
            }
            if (value !== null) {
               loadContent(value);
            }
            $('.tab-pane').removeClass('show active');
            $(href).addClass('show active');
         });

         loadContent(0);
         $('.filter-sidebar[href="#ngay"]').trigger('click');
      });
   </script>

   <!-- Trailer -->
   <script type="text/javascript">
      $('.watch_trailer').click(function(e) {
         e.preventDefault();
         var aid = $(this).attr('href');
         $('html,body').animate({ scrollTop: $(aid).offset().top }, 'slow');
      });
   </script>

   <!-- Facebook Comments -->
   <div id="fb-root"></div>
   <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v20.0" nonce="97NBObE3"></script>

   <!-- Search PC -->
   <script type="text/javascript">
      $(document).ready(function() {
         var isRequesting = false;

         $('#search-fix').keyup(function() {
            if (!isRequesting) {
               isRequesting = true;
               var search = $(this).val();
               $('.ui-autocomplete').html('');

               if (search != '') {
                  var expression = new RegExp(search, 'i');
                  $.getJSON('{{ url("json/movies.json") }}', function(data) {
                     $.each(data, function(key, value) {
                        if (value.title.search(expression) != -1 || value.description.search(expression) != -1) {
                           $('.ui-autocomplete').css('display', 'inherit');
                           $('.ui-autocomplete').append(
                              '<li style="cursor:pointer; max-height: 200px;" class="list-group-item link-class">' +
                              '<a style="display:flex;" href="/chi-tiet-phim/' + value.slug + '">' +
                              '<img src="' + '{{ url("uploads/movie/") }}/' + value.image + '" style="width: 100px; height: 130px;" class="" />' +
                              '<div style="flex-direction: column; margin-left: 2px;">' +
                              '<h4  width="100%">' + value.title + '</h4>' +
                              '<span style="display: -webkit-box; max-height: 8.2rem; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; white-space: normal; -webkit-line-clamp: 5; line-height: 1.6rem;" class="text-muted">' +
                              '| ' + value.description +
                              '</span>' +
                              '</div>' +
                              '</a>' +
                              '</li>'
                           );
                        }
                     });
                  }).done(function() {
                     isRequesting = false;
                  });
               } else {
                  $('.ui-autocomplete').css('display', 'none');
                  isRequesting = false;
               }
            }
         });

         $('.ui-autocomplete').on('click', 'li', function(event) {
            event.stopPropagation();
         });
      });
   </script>
   {{-- script đánh giá phim --}}
   <script type="text/javascript">
      function remove_background(movie_id) {
            for (var count = 1; count <= 5; count++) {
               $('#' + movie_id + '-' + count).css('color', '#ccc');
            }
      }

      // Hover chuột đánh giá sao
      $(document).on('mouseenter', '.rating', function () {
            var index = $(this).data("index");
            var movie_id = $(this).data('movie_id');
            remove_background(movie_id);
            for (var count = 1; count <= index; count++) {
               $('#' + movie_id + '-' + count).css('color', '#ffcc00');
            }
      });

      // Nhả chuột không đánh giá
      $(document).on('mouseleave', '.rating', function () {
            var rating = $(this).data("rating");
            var movie_id = $(this).data('movie_id');
            remove_background(movie_id);
            for (var count = 1; count <= rating; count++) {
               $('#' + movie_id + '-' + count).css('color', '#ffcc00');
            }
      });

      // Click đánh giá sao
      $(document).on('click', '.rating', function() {
         var index = $(this).data("index");
         var movie_id = $(this).data('movie_id');
         console.log("Index: ", index, "Movie ID: ", movie_id); // Kiểm tra dữ liệu

         if (index !== undefined && movie_id !== undefined) {
            $.ajax({
                  url: "{{ route('add-rating') }}",
                  method: "POST",
                  data: {
                     rating: index, // Gửi đúng thông tin rating
                     movie_id: movie_id
                  },
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(data) {
                     if (data == 'updated') {
                        alert("Bạn đã cập nhật đánh giá " + index + " trên 5");
                     } else if (data == 'added') {
                        alert("Bạn đã thêm đánh giá " + index + " trên 5");
                     } else {
                        alert("Lỗi đánh giá");
                     }
                     location.reload(); // Tải lại trang sau khi đánh giá
                  }
            });
         } else {
            console.error("Index or Movie ID is undefined.");
         }
      });
   </script>
</body>

</html>