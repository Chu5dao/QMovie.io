<style>
    .fix-section-title {
        display: flex;
        flex-direction: column;
    }
    .section-title.fix-section-title {
        margin-bottom: 4px;
    }
    .fix-section-title-span {
        align-self: flex-start; /* Đảm bảo nó không bị kéo dãn */
    }
    .section-title .fix-halim-popular-tab {
        padding: 1px;
        margin-top: 20px; /* Thêm khoảng cách nếu cần */
        list-style: none;
        display: flex; /* Để các thẻ li nằm ngang, nếu muốn dọc thì bỏ */
        justify-content: flex-end; /* Canh phải nếu cần */
        left: 0;
        top: 0;
        right: auto;
    }
    .section-title .fix-halim-popular-tab{
        margin-top: 8px; /* Thêm khoảng cách nếu cần */
    }
    .section-title .fix-halim-popular-tab li {
        width: calc(300px/3);
    }
    .tab-content {
        margin-top: 25px;
    }
    .popular-post .item.post-37176{
        margin-top: 2px;
        margin-left: 2px;
        min-height: 122px;
    }
    .popular-post .item.post-37176 img {
        min-height: 122px;
    }
    .item-link {
        width: 75px;
    }
    .nav-pills>li.active>a,
    .nav-pills>li.active>a:hover,
    .nav-pills>li.active>a:focus {
        color: #fff;
        background-color: #3577b1;
    }
    .nav-pills>li>a {
        border: 1px solid #1b2b3a;
        border-radius: 0px;
        text-align: center;
        background-color: #11171f;
    }
    .nav-pills>li.active>a:hover,
    .nav>li>a:hover {
        color: #fff;
        background-color: #86add0;
    }
    .tab-content {
        margin-top: 0;
    }
    .section-bar.section-bar {
        margin-bottom: 0px;
    }
    .section-bar.section-bar a{
        font-size: 13px;
    }
    #halim-ajax-popular-post.popular-post {
        margin: 0;
    }
    /* ////////////////////////////// */
    .label {
    display: inline-block;
    padding: 0.2em 0.6em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: normal;
    vertical-align: baseline;
    border-radius: 0.25rem;
    }

    .label-primary { background-color: #007bff; }
    .label-secondary { background-color: #6c757d; }
    .label-success { background-color: #28a745; }
    .label-danger { background-color: #dc3545; }
    .label-warning { background-color: #ffc107; }
    .label-info { background-color: #17a2b8; }
    .label-light { background-color: #f8f9fa; color: #212529; }
    .label-dark { background-color: #343a40; }

    .label .badge {
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: normal; /* Đảm bảo thẻ span sẽ xuống dòng */
    }
</style>
<aside id="" class="">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title fix-section-title">
                    <span class="fix-section-title-span">Phim Sắp Chiếu</span>
            </div>
        </div>
        <section class="tab-content" id="pills-tabContent">
            <div role="tabpanel" class="" aria-labelledby="pills-home-tab">
                <div id="halim-ajax-popular-post" class="popular-post">
                    
                    @foreach($trailer as $key => $f_trailer)
                    <div class="item post-37176">
                        <a href="{{route('detail', $f_trailer->slug)}}" title="{{$f_trailer->title}}">
                            <div class="item-link">
                                <img src="{{asset('uploads/movie/'.$f_trailer->image)}}" alt="{{$f_trailer->title}}" title="{{$f_trailer->title}}" />
                                <span class="is_trailer">
                                    @switch($f_trailer->resolution)
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
                            </div>
                            <p class="title">{{$f_trailer->title}}</p>
                        </a>
                        <div class="viewsCount" style="color: #9d9d9d;">
                            @php
                                echo rand(1,9999);
                            @endphp
                            lượt quan tâm
                        </div>
                        <ul class="list-inline rating" title="Average Rating">
                            @for($count = 1; $count <= 5; $count++)
                                @php
                                    $color = ($count <= $f_trailer->average_rating) ? 'color:#ffcc00;' : 'color:#ccc;';
                                @endphp
                                <li style="cursor: default; {{$color}} font-size:24px; padding:0;">&#9733;</li>
                            @endfor
                        </ul>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
</aside>
<aside id="" class="">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title fix-section-title">
                <span class="fix-section-title-span">Thịnh Hành</span>
                <ul class="fix-halim-popular-tab nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link filter-sidebar active" id="pills-home-tab" data-toggle="pill" href="#ngay" role="tab" aria-controls="pills-home" aria-selected="true">Ngày</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link filter-sidebar" id="pills-profile-tab" data-toggle="pill" href="#tuan" role="tab" aria-controls="pills-profile" aria-selected="false">Tuần</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link filter-sidebar" id="pills-contact-tab" data-toggle="pill" href="#thang" role="tab" aria-controls="pills-contact" aria-selected="false">Tháng</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="ngay" role="tabpanel" aria-labelledby="pills-home-tab">
                <div id="halim-ajax-popular-post-ngay" class="popular-post">
                    <span id="show0"></span>{{-- Dữ liệu ở đây --}}
                </div>
            </div>
            <div class="tab-pane fade" id="tuan" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div id="halim-ajax-popular-post-tuan" class="popular-post">
                    <span id="show0"></span>{{-- Dữ liệu ở đây --}}
                    <span id="show1"></span>{{-- Dữ liệu ở đây --}}
                </div>
            </div>
            <div class="tab-pane fade" id="thang" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div id="halim-ajax-popular-post-thang" class="popular-post">
                    <span id="show0"></span>{{-- Dữ liệu ở đây --}}
                    <span id="show1"></span>{{-- Dữ liệu ở đây --}}
                    <span id="show2"></span>{{-- Dữ liệu ở đây --}}
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</aside>

<aside id="" class="">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title fix-section-title">
                    <span class="fix-section-title-span">Từ Khóa Nổi Bật</span>
                    
            </div>
        </div>
        <section class="tab-content" id="pills-tabContent">
            <div role="tabpanel" class="" aria-labelledby="pills-home-tab">
                <div id="halim-ajax-popular-post" class="popular-post">
            @foreach($tags_by_views as $tag)
                @php
                    // Tách chuỗi tags thành mảng bằng dấu phẩy
                    $tags_array = explode(',', $tag->tags);
                    // Lấy giá trị đầu tiên và loại bỏ khoảng trắng ở đầu và cuối
                    $first_tag = trim($tags_array[0]);
                @endphp
                <a class="label label-warning" href="{{url('tu-khoa/'.$first_tag)}}">
                    <span class="badge">{{$first_tag}}</span>
                </a>
            @endforeach
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
</aside>