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
        min-width: 300px;
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
</style>
<aside id="" class="">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title fix-section-title">
                <span class="fix-section-title-span">Phim Đề Cử</span>
                
            </div>
        </div>
        <section class="tab-content" id="pills-tabContent">
            <div role="tabpanel" class="" aria-labelledby="pills-home-tab">
                <div id="halim-ajax-popular-post" class="popular-post">
                    @foreach($phimhot_sidebar as $key => $hot_sidebar)
                    <div class="item post-37176">
                        <a href="{{route('detail', $hot_sidebar->slug)}}" title="{{$hot_sidebar->title}}">
                            <div class="item-link">
                                <img src="{{asset('uploads/movie/'.$hot_sidebar->image)}}" alt="{{$hot_sidebar->title}}" title="{{$hot_sidebar->title}}" />
                                <span class="is_trailer">
                                    @switch($hot_sidebar->resolution)
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
                                        Lỗi không xác định
                                    @endswitch
                                </span>
                            </div>
                            <p class="title">{{$hot_sidebar->title}}</p>
                        </a>
                        <div class="viewsCount" style="color: #9d9d9d;">{{$hot_sidebar->views}} lượt xem</div>
                        <div class="viewsCount" style="color: #9d9d9d;">{{$hot_sidebar->year}}</div>
                        <ul class="list-inline rating" title="Average Rating">
                            @for($count = 1; $count <= 5; $count++)
                                @php
                                    $color = ($count <= $hot_sidebar->average_rating) ? 'color:#ffcc00;' : 'color:#ccc;';
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