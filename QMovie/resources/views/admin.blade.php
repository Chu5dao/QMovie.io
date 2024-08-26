@extends('layouts.app')

@section('content')
<?php
// try {
//     $redis = new Redis();
//     $redis->connect('127.0.0.1', 6379);
//     echo "Connected to Redis!";
// } catch (Exception $e) {
//     echo "Could not connect to Redis: ", $e->getMessage();
// }
?>
    <!-- admin widget -->
    @if(auth()->user()->isAdmin('admin'))
        @include('layouts.statistical')
    @endif
    {{-- @if(auth()->check())
        @include('layouts.statistical')
    @endif --}}

    <div class="row-one widgettable">
        
    </div>
    {{-- ======================================================= --}}
    <div class="panel panel-success"> <div class="panel-heading"> <h3 class="panel-title">{{ __('Đăng nhập thành công!') }}</h3> </div> <div class="panel-body"> 
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        Xin chào {{ Auth::user()->role }} {{ Auth::user()->name }}
    </div> </div>
@endsection
