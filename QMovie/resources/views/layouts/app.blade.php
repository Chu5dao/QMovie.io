<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Admin Web Phim"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="update-year-film-url" content="{{ url('/update-year-film') }}">
    <title>Admin Web Phim</title>
    <link rel="shortcut icon" href="{{ asset('uploads/logo/'.$info->shortcut_icon) }}" type="image/x-icon" />
    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <!-- Font Awesome (icon) -->
    {{-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> --}}

    <!-- Styles -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="{{ asset('dist/cstm-yearpicker.css') }}" rel="stylesheet">

    <style>
        /* .card .fix-card {
            min-height: 638px;
        }
        .fix-card {
            max-height: 690px;
            overflow-x: hidden;
            overflow-y: auto;
        }
        .fix-container {
            display: flex;
        }
        .fix-card-list {
            width: 100%;
        } */
        .dataTables_scrollHeadInner {
            display: block;margin: 0 auto;
        }
        .dataTables_scrollBody {
            display: block;margin: 0 auto;
        }
        .btn.fix-btn {
            margin-bottom: 10px;
        }
    </style>
    {{-- ============================ new theme ==================================== --}}
    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar() { window.scrollTo(0, 1); }
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('backend/css/bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="{{asset('backend/css/style.css')}}" rel="stylesheet" type="text/css" />
    <!-- font-awesome icons CSS -->
    <link href="{{asset('backend/css/font-awesome.css')}}" rel="stylesheet" />
    <!-- //font-awesome icons CSS-->
    <!-- side nav css file -->
    <link href="{{asset('backend/css/SidebarNav.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <!-- //side nav css file -->
    <!-- js-->
    <script src="{{asset('backend/js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset('backend/js/modernizr.custom.js')}}"></script>
    <!--webfonts-->
    <link
        href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext"
        rel="stylesheet"
    />
    <!--//webfonts-->
    <!-- chart -->
    <script src="{{asset('backend/js/Chart.js')}}"></script>
    <!-- //chart -->
    <!-- Metis Menu -->
    <script src="{{asset('backend/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('backend/js/custom.js')}}"></script>
    <link href="{{asset('backend/css/custom.css')}}" rel="stylesheet" />
    <!--//Metis Menu -->
    <style>
        #chartdiv {
        width: 100%;
        height: 295px;
        }
        .custom-td a,
        .custom-td form {
            margin: 10px; /* Điều chỉnh margin theo ý muốn */
        }
        .dataTables_wrapper .dataTables_filter {
            float: right;
            text-align: right;
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1;
            padding: 10px 0;
        }
        .dataTables_wrapper .dataTables_length {
            float: left;
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1;
            padding: 10px 0;
        }
        .dataTables_wrapper .dataTables_paginate {
            float: right;
            text-align: right;
            position: sticky;
            bottom: 0;
            background-color: white;
            z-index: 1;
            padding: 10px 0;
        }
        .dataTables_wrapper .dataTables_info {
            float: left;
            position: sticky;
            bottom: 0;
            background-color: white;
            z-index: 1;
            padding: 10px 0;
        }
    </style>
    <!--pie-chart -->
    <!-- index page sales reviews visitors pie chart -->
    <script src="{{asset('backend/js/pie-chart.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
        $('#demo-pie-1').pieChart({
            barColor: '#2dde98',
            trackColor: '#eee',
            lineCap: 'round',
            lineWidth: 8,
            onStep: function (from, to, percent) {
            $(this.element)
                .find('.pie-value')
                .text(Math.round(percent) + '%');
            },
        });

        $('#demo-pie-2').pieChart({
            barColor: '#8e43e7',
            trackColor: '#eee',
            lineCap: 'butt',
            lineWidth: 8,
            onStep: function (from, to, percent) {
            $(this.element)
                .find('.pie-value')
                .text(Math.round(percent) + '%');
            },
        });

        $('#demo-pie-3').pieChart({
            barColor: '#ffc168',
            trackColor: '#eee',
            lineCap: 'square',
            lineWidth: 8,
            onStep: function (from, to, percent) {
            $(this.element)
                .find('.pie-value')
                .text(Math.round(percent) + '%');
            },
        });
        });
    </script>
    <!-- //pie-chart -->
    <!-- index page sales reviews visitors pie chart -->
    <!-- requried-jsfiles-for owl -->
    <link href="{{asset('backend/css/owl.carousel.css')}}" rel="stylesheet" />
    <script src="{{asset('backend/js/owl.carousel.js')}}"></script>
    <script>
        $(document).ready(function () {
        $('#owl-demo').owlCarousel({
            items: 3,
            lazyLoad: true,
            autoPlay: true,
            pagination: true,
            nav: true,
        });
        });
    </script>
    <!-- //requried-jsfiles-for owl -->
</head>
<body class="cbp-spmenu-push">
    {{-- <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @if(Auth::id())
                <div class="container-fluid">
                    @include('layouts.main-content')
                </div>
            @endif
            @yield('content')
        </main>
    </div> --}}
    {{-- @if(Auth::check()) --}}
    @if(Auth::check())
        @include('layouts.main-content')
    @elseif(request()->is('password/reset/*')) {{-- Kiểm tra nếu đang ở trang reset mật khẩu --}}
        <style>
            .main-page.signup-page{
                margin: 1em auto;
            }
        </style>
        <div class="main-page signup-page">
            <h2 class="title1">ĐẶT LẠI MẬT KHẨU</h2>
            <div class="sign-up-row widget-shadow">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <h6>Thông tin mật khẩu :</h6>
                    <div class="sign-u">
                        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="{{ __('Mật khẩu mới') }}" required="">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="clearfix"> </div>
                    </div>
                    <div class="sign-u">
                        <input id="password-confirm" type="password" name="password_confirmation" placeholder="{{ __('Xác nhận mật khẩu') }}" required="">
                    </div>
                    <div class="clearfix"> </div>
                    <div class="sub_home">
                        <input type="submit" value="Đặt lại">
                        <div class="clearfix"> </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        @yield('layouts.form-login')
    @endif

    {{-- ============================ new theme ======================================= --}}
    <!-- new added graphs chart js-->
    <script src="{{asset('backend/js/Chart.bundle.js')}}"></script>
    <script src="{{asset('backend/js/utils.js')}}"></script>
    <script>
        var MONTHS = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];
        var color = Chart.helpers.color;
        var barChartData = {
            labels: [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            ],
            datasets: [
            {
                label: 'Dataset 1',
                backgroundColor: color(window.chartColors.red)
                .alpha(0.5)
                .rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                ],
            },
            {
                label: 'Dataset 2',
                backgroundColor: color(window.chartColors.blue)
                .alpha(0.5)
                .rgbString(),
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                ],
            },
            ],
        };

        window.onload = function () {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                position: 'top',
                },
                title: {
                display: true,
                text: 'Chart.js Bar Chart',
                },
            },
            });
        };

        document
            .getElementById('randomizeData')
            .addEventListener('click', function () {
            var zero = Math.random() < 0.2 ? true : false;
            barChartData.datasets.forEach(function (dataset) {
                dataset.data = dataset.data.map(function () {
                return zero ? 0.0 : randomScalingFactor();
                });
            });
            window.myBar.update();
            });

        var colorNames = Object.keys(window.chartColors);
        document
            .getElementById('addDataset')
            .addEventListener('click', function () {
            var colorName =
                colorNames[barChartData.datasets.length % colorNames.length];
            var dsColor = window.chartColors[colorName];
            var newDataset = {
                label: 'Dataset ' + barChartData.datasets.length,
                backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                borderColor: dsColor,
                borderWidth: 1,
                data: [],
            };

            for (var index = 0; index < barChartData.labels.length; ++index) {
                newDataset.data.push(randomScalingFactor());
            }

            barChartData.datasets.push(newDataset);
            window.myBar.update();
            });

        document.getElementById('addData').addEventListener('click', function () {
            if (barChartData.datasets.length > 0) {
            var month = MONTHS[barChartData.labels.length % MONTHS.length];
            barChartData.labels.push(month);

            for (var index = 0; index < barChartData.datasets.length; ++index) {
                //window.myBar.addData(randomScalingFactor(), index);
                barChartData.datasets[index].data.push(randomScalingFactor());
            }

            window.myBar.update();
            }
        });

        document
            .getElementById('removeDataset')
            .addEventListener('click', function () {
            barChartData.datasets.splice(0, 1);
            window.myBar.update();
            });

        document
            .getElementById('removeData')
            .addEventListener('click', function () {
            barChartData.labels.splice(-1, 1); // remove the label first

            barChartData.datasets.forEach(function (dataset, datasetIndex) {
                dataset.data.pop();
            });

            window.myBar.update();
            });
    </script>
    <!-- new added graphs chart js-->
    <!-- Classie -->
    <!-- for toggle left push menu script -->
    <script src="{{asset('backend/js/classie.js')}}"></script>
    <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

        showLeftPush.onclick = function () {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };

        function disableOther(button) {
            if (button !== 'showLeftPush') {
            classie.toggle(showLeftPush, 'disabled');
            }
        }
    </script>
    <!-- //Classie -->
    <!-- //for toggle left push menu script -->
    <!--scrolling js-->
    <script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('backend/js/scripts.js')}}"></script>
        <!--//scrolling js-->
        <!-- side nav js -->
    <script src="{{asset('backend/js/SidebarNav.min.js')}}" type="text/javascript"></script>
    <script>$('.sidebar-menu').SidebarNav();</script>
    <!-- //side nav js -->
    <!-- for index page weekly sales java script -->
    <script src="{{asset('backend/js/SimpleChart.js')}}"></script>
    <script>
        var graphdata1 = {
            linecolor: '#CCA300',
            title: 'Monday',
            values: [
            { X: '6:00', Y: 10.0 },
            { X: '7:00', Y: 20.0 },
            { X: '8:00', Y: 40.0 },
            { X: '9:00', Y: 34.0 },
            { X: '10:00', Y: 40.25 },
            { X: '11:00', Y: 28.56 },
            { X: '12:00', Y: 18.57 },
            { X: '13:00', Y: 34.0 },
            { X: '14:00', Y: 40.89 },
            { X: '15:00', Y: 12.57 },
            { X: '16:00', Y: 28.24 },
            { X: '17:00', Y: 18.0 },
            { X: '18:00', Y: 34.24 },
            { X: '19:00', Y: 40.58 },
            { X: '20:00', Y: 12.54 },
            { X: '21:00', Y: 28.0 },
            { X: '22:00', Y: 18.0 },
            { X: '23:00', Y: 34.89 },
            { X: '0:00', Y: 40.26 },
            { X: '1:00', Y: 28.89 },
            { X: '2:00', Y: 18.87 },
            { X: '3:00', Y: 34.0 },
            { X: '4:00', Y: 40.0 },
            ],
        };
        var graphdata2 = {
            linecolor: '#00CC66',
            title: 'Tuesday',
            values: [
            { X: '6:00', Y: 100.0 },
            { X: '7:00', Y: 120.0 },
            { X: '8:00', Y: 140.0 },
            { X: '9:00', Y: 134.0 },
            { X: '10:00', Y: 140.25 },
            { X: '11:00', Y: 128.56 },
            { X: '12:00', Y: 118.57 },
            { X: '13:00', Y: 134.0 },
            { X: '14:00', Y: 140.89 },
            { X: '15:00', Y: 112.57 },
            { X: '16:00', Y: 128.24 },
            { X: '17:00', Y: 118.0 },
            { X: '18:00', Y: 134.24 },
            { X: '19:00', Y: 140.58 },
            { X: '20:00', Y: 112.54 },
            { X: '21:00', Y: 128.0 },
            { X: '22:00', Y: 118.0 },
            { X: '23:00', Y: 134.89 },
            { X: '0:00', Y: 140.26 },
            { X: '1:00', Y: 128.89 },
            { X: '2:00', Y: 118.87 },
            { X: '3:00', Y: 134.0 },
            { X: '4:00', Y: 180.0 },
            ],
        };
        var graphdata3 = {
            linecolor: '#FF99CC',
            title: 'Wednesday',
            values: [
            { X: '6:00', Y: 230.0 },
            { X: '7:00', Y: 210.0 },
            { X: '8:00', Y: 214.0 },
            { X: '9:00', Y: 234.0 },
            { X: '10:00', Y: 247.25 },
            { X: '11:00', Y: 218.56 },
            { X: '12:00', Y: 268.57 },
            { X: '13:00', Y: 274.0 },
            { X: '14:00', Y: 280.89 },
            { X: '15:00', Y: 242.57 },
            { X: '16:00', Y: 298.24 },
            { X: '17:00', Y: 208.0 },
            { X: '18:00', Y: 214.24 },
            { X: '19:00', Y: 214.58 },
            { X: '20:00', Y: 211.54 },
            { X: '21:00', Y: 248.0 },
            { X: '22:00', Y: 258.0 },
            { X: '23:00', Y: 234.89 },
            { X: '0:00', Y: 210.26 },
            { X: '1:00', Y: 248.89 },
            { X: '2:00', Y: 238.87 },
            { X: '3:00', Y: 264.0 },
            { X: '4:00', Y: 270.0 },
            ],
        };
        var graphdata4 = {
            linecolor: 'Random',
            title: 'Thursday',
            values: [
            { X: '6:00', Y: 300.0 },
            { X: '7:00', Y: 410.98 },
            { X: '8:00', Y: 310.0 },
            { X: '9:00', Y: 314.0 },
            { X: '10:00', Y: 310.25 },
            { X: '11:00', Y: 318.56 },
            { X: '12:00', Y: 318.57 },
            { X: '13:00', Y: 314.0 },
            { X: '14:00', Y: 310.89 },
            { X: '15:00', Y: 512.57 },
            { X: '16:00', Y: 318.24 },
            { X: '17:00', Y: 318.0 },
            { X: '18:00', Y: 314.24 },
            { X: '19:00', Y: 310.58 },
            { X: '20:00', Y: 312.54 },
            { X: '21:00', Y: 318.0 },
            { X: '22:00', Y: 318.0 },
            { X: '23:00', Y: 314.89 },
            { X: '0:00', Y: 310.26 },
            { X: '1:00', Y: 318.89 },
            { X: '2:00', Y: 518.87 },
            { X: '3:00', Y: 314.0 },
            { X: '4:00', Y: 310.0 },
            ],
        };
        var Piedata = {
            linecolor: 'Random',
            title: 'Profit',
            values: [
            { X: 'Monday', Y: 50.0 },
            { X: 'Tuesday', Y: 110.98 },
            { X: 'Wednesday', Y: 70.0 },
            { X: 'Thursday', Y: 204.0 },
            { X: 'Friday', Y: 80.25 },
            { X: 'Saturday', Y: 38.56 },
            { X: 'Sunday', Y: 98.57 },
            ],
        };
        $(function () {
            $('#Bargraph').SimpleChart({
            ChartType: 'Bar',
            toolwidth: '50',
            toolheight: '25',
            axiscolor: '#E6E6E6',
            textcolor: '#6E6E6E',
            showlegends: true,
            data: [graphdata4, graphdata3, graphdata2, graphdata1],
            legendsize: '140',
            legendposition: 'bottom',
            xaxislabel: 'Hours',
            title: 'Weekly Profit',
            yaxislabel: 'Profit in $',
            });
            $('#sltchartype').on('change', function () {
            $('#Bargraph').SimpleChart('ChartType', $(this).val());
            $('#Bargraph').SimpleChart('reload', 'true');
            });
            $('#Hybridgraph').SimpleChart({
            ChartType: 'Hybrid',
            toolwidth: '50',
            toolheight: '25',
            axiscolor: '#E6E6E6',
            textcolor: '#6E6E6E',
            showlegends: true,
            data: [graphdata4],
            legendsize: '140',
            legendposition: 'bottom',
            xaxislabel: 'Hours',
            title: 'Weekly Profit',
            yaxislabel: 'Profit in $',
            });
            $('#Linegraph').SimpleChart({
            ChartType: 'Line',
            toolwidth: '50',
            toolheight: '25',
            axiscolor: '#E6E6E6',
            textcolor: '#6E6E6E',
            showlegends: false,
            data: [graphdata4, graphdata3, graphdata2, graphdata1],
            legendsize: '140',
            legendposition: 'bottom',
            xaxislabel: 'Hours',
            title: 'Weekly Profit',
            yaxislabel: 'Profit in $',
            });
            $('#Areagraph').SimpleChart({
            ChartType: 'Area',
            toolwidth: '50',
            toolheight: '25',
            axiscolor: '#E6E6E6',
            textcolor: '#6E6E6E',
            showlegends: true,
            data: [graphdata4, graphdata3, graphdata2, graphdata1],
            legendsize: '140',
            legendposition: 'bottom',
            xaxislabel: 'Hours',
            title: 'Weekly Profit',
            yaxislabel: 'Profit in $',
            });
            $('#Scatterredgraph').SimpleChart({
            ChartType: 'Scattered',
            toolwidth: '50',
            toolheight: '25',
            axiscolor: '#E6E6E6',
            textcolor: '#6E6E6E',
            showlegends: true,
            data: [graphdata4, graphdata3, graphdata2, graphdata1],
            legendsize: '140',
            legendposition: 'bottom',
            xaxislabel: 'Hours',
            title: 'Weekly Profit',
            yaxislabel: 'Profit in $',
            });
            $('#Piegraph').SimpleChart({
            ChartType: 'Pie',
            toolwidth: '50',
            toolheight: '25',
            axiscolor: '#E6E6E6',
            textcolor: '#6E6E6E',
            showlegends: true,
            showpielables: true,
            data: [Piedata],
            legendsize: '250',
            legendposition: 'right',
            xaxislabel: 'Hours',
            title: 'Weekly Profit',
            yaxislabel: 'Profit in $',
            });

            $('#Stackedbargraph').SimpleChart({
            ChartType: 'Stacked',
            toolwidth: '50',
            toolheight: '25',
            axiscolor: '#E6E6E6',
            textcolor: '#6E6E6E',
            showlegends: true,
            data: [graphdata3, graphdata2, graphdata1],
            legendsize: '140',
            legendposition: 'bottom',
            xaxislabel: 'Hours',
            title: 'Weekly Profit',
            yaxislabel: 'Profit in $',
            });

            $('#StackedHybridbargraph').SimpleChart({
            ChartType: 'StackedHybrid',
            toolwidth: '50',
            toolheight: '25',
            axiscolor: '#E6E6E6',
            textcolor: '#6E6E6E',
            showlegends: true,
            data: [graphdata3, graphdata2, graphdata1],
            legendsize: '140',
            legendposition: 'bottom',
            xaxislabel: 'Hours',
            title: 'Weekly Profit',
            yaxislabel: 'Profit in $',
            });
        });
    </script>
    <!-- //for index page weekly sales java script -->
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('backend/js/bootstrap.js')}}"></script>
    <!-- //Bootstrap Core JavaScript -->
    {{-- ============================ end new theme ======================================= --}}
    <!-- Scripts -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('dist/cstm-yearpicker.js') }}" defer></script>

    {{-- toastr --}}
    <script>
        @if(Session::has('status'))
            toastr.success("{{ Session::get('status') }}");
        @endif
        @if(Session::has('errors'))
            @foreach (Session::get('errors')->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
    
    <script type="text/javascript">
        // cập nhật năm
        // $('.select-year').change(function(){
        //     var year = $(this).find(':selected').val();
        //     var id_film = $(this).attr('id');
        //     // alert(year);
        //     // alert(id_film);
        //     $.ajax({
        //         url:"{{url('/update-year-film')}}",
        //         method:"GET",
        //         data:{year:year, id_film:id_film},
        //         success:function(){
        //             alert('Thay đổi năm phim '+year+' thành công');
        //         }
        //     });
        // })

        // ==================================================================
        $(document).ready(function() {
            // Cập nhật Top view
            $(document).on('click', '.select-topview-option .dropdown-item', function() {
                var topview = $(this).data('value');
                var dropdownButton = $(this).closest('.dropdown').find('.select-topview');
                var id_film = dropdownButton.data('id');
                var text;

                switch (topview) {
                    case 'NULL':
                        text = 'Choose';
                        topview = null;
                        break;
                    case 0:
                        text = 'Ngày';
                        break;
                    case 1:
                        text = 'Tuần';
                        break;
                    case 2:
                        text = 'Tháng';
                        break;
                    default:
                        break;
                }

                $.ajax({
                    url: "{{ url('/update-topview-film') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        topview: topview,
                        id_film: id_film
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        dropdownButton.text(text);
                    },
                    error: function(xhr, status, error) {
                        console.error('Có lỗi xảy ra:', xhr.responseText);
                    }
                });
            });

            // Cập nhật Category
            $(document).on('click', '.select-category-option .dropdown-item', function(e) {
                e.preventDefault();
                var categoryId = $(this).data('value');
                var movieId = $(this).data('id');
                var dropdownButton = $('#categoryDropdownMenuButton_' + movieId);

                $.ajax({
                    url: "{{ url('/update-category') }}",
                    method: "POST",
                    data: {
                        category_id: categoryId,
                        movie_id: movieId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            dropdownButton.text(response.category_title);
                            toastr.success(response.message);
                        } else {
                            alert('Cập nhật không thành công.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + error);
                    }
                });
            });

            // Cập nhật Country
            $(document).on('click', '.select-country-option .dropdown-item', function(e) {
                e.preventDefault();
                var countryId = $(this).data('value');
                var movieId = $(this).data('id');
                var dropdownButton = $('#countryDropdownMenuButton_' + movieId);

                $.ajax({
                    url: "{{ url('/update-country') }}",
                    method: "POST",
                    data: {
                        country_id: countryId,
                        movie_id: movieId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            dropdownButton.text(response.country_title);
                            toastr.success(response.message);
                        } else {
                            alert('Cập nhật không thành công.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + error);
                    }
                });
            });

            // Cập nhật Subtitled
            $(document).on('click', '.select-subtitled-option .dropdown-item', function() {
                var subtitled = $(this).data('value');
                var dropdownButton = $(this).closest('.dropdown').find('.select-subtitled');
                var id_film = dropdownButton.data('id');
                var text;

                switch (subtitled) {
                    case 'NULL':
                        text = 'Choose';
                        subtitled = null;
                        break;
                    case 0:
                        text = 'Vietsub';
                        break;
                    case 1:
                        text = 'Thuyết Minh';
                        break;
                    case 2:
                        text = 'Eng-sub';
                        break;
                    default:
                        text = 'Khác';
                        break;
                }

                $.ajax({
                    url: "{{ url('/update-subtitled') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        subtitled: subtitled,
                        id_film: id_film
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        dropdownButton.text(text);
                    },
                    error: function(xhr, status, error) {
                        console.error('Có lỗi xảy ra:', xhr.responseText);
                    }
                });
            });

            // Cập nhật resolution
            $(document).on('click', '.select-resolution-option .dropdown-item', function(e) {
                e.preventDefault();
                var resolution = $(this).data('value');
                var movieId = $(this).data('id');
                var resolutionTextSpan = $('#resolutionText_' + movieId);

                $.ajax({
                    url: "{{ url('/update-resolution') }}",
                    method: "POST",
                    data: {
                        resolution: resolution,
                        movie_id: movieId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            var newText;
                            switch(resolution) {
                                case 0:
                                    newText = '<span class="badge badge-primary">HD</span>';
                                    break;
                                case 1:
                                    newText = '<span class="badge badge-info">SD</span>';
                                    break;
                                case 2:
                                    newText = '<span class="badge badge-success">HD-Cam</span>';
                                    break;
                                case 3:
                                    newText = '<span class="badge badge-warning">Cam</span>';
                                    break;
                                case 4:
                                    newText = '<span class="badge badge-danger">FULL-HD</span>';
                                    break;
                                default:
                                    newText = '<span class="badge badge-secondary">Trailer</span>';
                                    break;
                            }
                            resolutionTextSpan.html(newText);
                            toastr.success(response.message);
                        } else {
                            alert('Cập nhật không thành công.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + error);
                    }
                });
            });

            // Cập nhật Hình ảnh Ajax
            $(document).on('change', '.file_image', function() {
                var movie_id = $(this).data('movie_id');
                var form_data = new FormData();
                form_data.append("file", document.getElementById("file-" + movie_id).files[0]);
                form_data.append("movie_id", movie_id);

                $.ajax({
                    url: "{{ route('update-image') }}",
                    method: 'POST',
                    data: form_data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        location.reload();
                        toastr.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + error);
                    }
                });
            });

            // Cập nhật film hot
            $('.toggle-hot').on('click', function(e) {
                e.preventDefault();
                var movieId = $(this).data('id');
                var element = $(this);

                $.ajax({
                    url: "{{ url('/toggle-hot') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: movieId
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.hot) {
                                element.removeClass('color-svg-initial').addClass('color-svg');
                            } else {
                                element.removeClass('color-svg').addClass('color-svg-initial');
                            }
                            toastr.success(response.message);
                        } else {
                            console.error('Cập nhật thất bại.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Có lỗi xảy ra:', xhr.responseText);
                    }
                });
            });

            // Cập nhật Status
            $('.toggle-status').on('click', function(e) {
                e.preventDefault();
                var movieId = $(this).data('id');
                var element = $(this);

                $.ajax({
                    url: "{{ url('/toggle-status') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: movieId
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.status) {
                                element.html('<i class="fa fa-eye"></i>').removeClass('color-svg-initial');
                            } else {
                                element.html('<i class="fa fa-eye-slash"></i>').addClass('color-svg-initial');
                            }
                            toastr.success(response.message);
                        } else {
                            toastr.error('Cập nhật thất bại.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Có lỗi xảy ra:', xhr.responseText);
                        toastr.error('Có lỗi xảy ra.');
                    }
                });
            });

            // Select option Tập phim
            $('.select-movie').change(function(e) {
                var id = $(this).val();
                $.ajax({
                    url: "{{ url('/select-movie') }}",
                    method: "GET",
                    data: { id: id },
                    success: function(response) {
                        if (response.error) {
                            alert(response.error);
                        } else {
                            $('#show_movie').html(response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + error);
                    }
                });
            });
            $('#show_movie').change(function() {
                var value = $(this).val();
                if (value === "") {
                    $('#new_episode').show(); // Hiển thị input mới khi không chọn tập nào
                } else {
                    $('#new_episode').hide(); // Ẩn input mới khi có giá trị từ select
                }
            });
            // Trước khi submit form
            $('form').submit(function() {
                var selectedEpisode = $('#show_movie').val();
                var newEpisode = $('#new_episode').val();
                if (selectedEpisode === "") {
                    if (newEpisode !== "") {
                        $('#show_movie').val(newEpisode); // Đặt giá trị của input mới vào dropdown
                    }
                }
            });

            // Kéo thả =============================================================
            $('.order_position').sortable({
                placeholder: 'ui-state-highlight',
                update: function(event, ui) {
                    var array_id = [];
                    $('.order_position tr').each(function() {
                        array_id.push($(this).attr('id'));
                    });

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('resorting') }}",
                        method: "POST",
                        data: { array_id: array_id },
                        success: function(data) {
                            // alert('Sắp xếp thứ tự thành công');
                            toastr.success(data.message);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error: " + error);
                        }
                    });
                }
            });
            $(".order_position").disableSelection();

            // Sortable
            $( "#sortable_navbar" ).sortable({
                placeholder: "ui-state-highlight",
                update: function(event, ui) {
                    var array_id = [];
                    $('.cate_position li').each(function() {
                        array_id.push($(this).attr('id'));
                    });

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('resorting-navbar') }}",
                        method: "POST",
                        data: { array_id: array_id },
                        success: function(data) {
                            // alert('Sắp xếp thứ tự thành công');
                            toastr.success(data.message);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error: " + error);
                        }
                    });
                }
            });
            $( "#sortable_navbar" ).disableSelection();

            $( ".sortable_movie" ).sortable({
                placeholder: "ui-state-highlight",
                update: function(event, ui) {
                    var array_id = [];
                    $('.movie_position .well').each(function() {
                        array_id.push($(this).attr('id'));
                    });

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('resorting-movie') }}",
                        method: "POST",
                        data: { array_id: array_id },
                        success: function(data) {
                            // alert('Sắp xếp thứ tự thành công');
                            toastr.success(data.message);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error: " + error);
                        }
                    });
                }
            });
            $( ".sortable_movie" ).disableSelection();

            // DataTables
            // $('#table_phim').DataTable({
            //     scrollX: true,
            //     scrollCollapse: true,
            //     paging: true,
            // });
            try {
                if ($.fn.DataTable.isDataTable('#table_phim')) {
                    $('#table_phim').DataTable().destroy();
                }
                $('#table_phim').DataTable({
                    responsive: true,
                    columnDefs: [
                        { className: 'custom-width', targets: [1, 2, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17,19] },
                        { className: 'custom-width1', targets: [12] },
                        { className: 'custom-width2', targets: [18] },
                        { className: 'custom-width3', targets: [0] }
                    ]
                });

                // Bảng ở danh sách phim theo tập phim
                if ($('#table_phim_tap').length) {
                    $('#table_phim_tap').DataTable({
                        responsive: true,
                        fixedHeader: true,
                        columnDefs: [
                            { className: 'custom-width', targets: [0, 1, 2, 3, 4, 5, 6, 7] }
                        ],
                        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        pageLength: 10
                    });

                    // Make filter, length, paginate, and info sections sticky
                    $('.dataTables_filter').css('position', 'sticky').css('top', '0').css('background-color', 'white').css('z-index', '1').css('padding', '10px 0');
                    $('.dataTables_length').css('position', 'sticky').css('top', '0').css('background-color', 'white').css('z-index', '1').css('padding', '10px 0');
                    $('.dataTables_paginate').css('position', 'sticky').css('bottom', '0').css('background-color', 'white').css('z-index', '1').css('padding', '10px 0');
                    $('.dataTables_info').css('position', 'sticky').css('bottom', '0').css('background-color', 'white').css('z-index', '1').css('padding', '10px 0');
                }

                // Bảng ở danh sách Leech
                if ($.fn.DataTable.isDataTable('#table_leech')) {
                    $('#table_leech').DataTable().destroy();
                }
                $('#table_leech').DataTable({
                    responsive: true,
                    fixedHeader: true,
                });

                let tableWrapper = document.getElementById('table-wrapper');
                let isDown = false;
                let startX;
                let scrollLeft;

                tableWrapper.addEventListener('mousedown', (e) => {
                    isDown = true;
                    tableWrapper.classList.add('active');
                    startX = e.pageX - tableWrapper.offsetLeft;
                    scrollLeft = tableWrapper.scrollLeft;
                });

                tableWrapper.addEventListener('mouseleave', () => {
                    isDown = false;
                    tableWrapper.classList.remove('active');
                });

                tableWrapper.addEventListener('mouseup', () => {
                    isDown = false;
                    tableWrapper.classList.remove('active');
                });

                tableWrapper.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - tableWrapper.offsetLeft;
                    const walk = (x - startX) * 3; //scroll-fast
                    tableWrapper.scrollLeft = scrollLeft - walk;
                });
                console.log('DataTable initialized successfully');
            } catch (error) {
                console.error('Error initializing DataTable:', error);
            }
        });

        // Chuyển đổi slug =============================================================
        function ChangeToSlug(){
            var slug;
            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
        // Model show chi tiết tập phim
        $('.show_video').click(function() {
            var movie_id = $(this).data('movie_video_id');
            var episode_id = $(this).data('video_episode');

            $.ajax({
                url: '{{ route("watch-video") }}',
                method: 'POST',
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    movie_id: movie_id,
                    episode_id: episode_id
                },
                success: function(data) {
                    $('#video_title').html(data.video_title);
                    $('#video_link').html(data.video_link);
                    $('#video_desc').html(data.video_desc);
                    $('#videoModal').modal('show');
                }
            });
        });
    </script>

    {{-- Xóa bằng checkbox --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkAll = document.getElementById('checkAll');
            const checkboxes = document.querySelectorAll('.episode-checkbox');

            checkAll.addEventListener('change', function () {
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = checkAll.checked;
                });
            });

            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    if (!checkbox.checked) {
                        checkAll.checked = false;
                    }
                    if (document.querySelectorAll('.episode-checkbox:checked').length === checkboxes.length) {
                        checkAll.checked = true;
                    }
                });
            });
        });
    </script>
    {{-- Chuyển mục lục trang Tài khoản cá nhân --}}
    @if(Auth::check())
    <script>
        $(document).ready(function() {
            $('#change-password-link').click(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('password.change') }}",
                    type: 'GET',
                    success: function(response) {
                        $('#panel-content').html(response);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#change-password').click(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('password.change') }}",
                    type: 'GET',
                    success: function(response) {
                        $('#panel-content').html(response);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
            
            $('#user-info-link').click(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('user.content', ['id' => $authUser->id]) }}",
                    type: 'GET',
                    success: function(response) {
                        $('#panel-content').html(response);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
    @endif
</body>
</html>
