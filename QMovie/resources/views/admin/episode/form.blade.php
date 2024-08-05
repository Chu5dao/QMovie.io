@extends('layouts.app')

@section('content')
    @if (!isset($episode))
        <h2 class="title1">THÊM TẬP PHIM</h2>
    @else
        <h2 class="title1">CẬP NHẬT TẬP PHIM</h2>
    @endif
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <div class="container-fluid fix-container">
        <div class="row justify-content-center" style="width: 50%;">
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
    
                        @if (!isset($episode))
                            {!! Form::open(['route'=>'episode.store', 'method'=>'POST']) !!}
                        @else
                            {!! Form::open(['route'=>['episode.update', $episode->id], 'method'=>'PUT']) !!}
                        @endif
                            <div class="form-group">
                                {!! Form::label('Movie', 'Chọn Phim', []) !!}
                            @if (!isset($episode))
                                {!! Form::select('movie_id', [''=>'--- Chọn Phim ---', 'Phim thêm gần đây'=>$list_movie_with_resolution] , isset($episode) ? $episode->movie_id : '', ['class'=>'form-control select-movie']) !!}
                            @else
                                <input type="text" id="movie_name" name="movie_name" value="{{ isset($episode) ? $movies_with_resolution[$episode->movie_id] : '--- Chọn Phim ---' }}" class="form-control select-movie" readonly>
                                {!! Form::hidden('movie_id', isset($episode) ? $episode->movie_id : '') !!}
                            @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('Link', 'Link Phim', []) !!}
                                {!! Form::text('link', isset($episode) ? $episode->link : '', ['class'=>'form-control', 'placeholder' => 'Nhập dữ liệu...']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Episode', 'Tập Phim', []) !!}
                                @if (!isset($episode))
                                    <select name="episode" id="show_movie" class="form-control">
                                        {{-- script show output ở đây --}}
                                    </select>
                                    <input type="text" id="new_episode" name="new_episode" class="form-control mt-2" placeholder="Nhập tập phim mới...">
                                @else
                                    {!! Form::text('episode_display', $episode->episode, ['class'=>'form-control', 'placeholder' => 'Nhập dữ liệu...', 'readonly']) !!}
                                    {!! Form::hidden('episode', $episode->episode) !!}
                                @endif
                            </div>

                            @if (!isset($episode))
                            <div class="form-group">
                                {!! Form::label('Server', 'Server Phim', []) !!}
                                {!! Form::select('server', $server, '', ['class'=>'form-control']) !!}
                            </div>
                            @else
                            <div class="form-group">
                                {!! Form::label('Server', 'Server Phim', []) !!}
                                {!! Form::select('server', $server, $episode->server, ['class'=>'form-control']) !!}
                            </div>
                            @endif

                            @if (!isset($episode))
                                {!! Form::submit('THÊM TẬP PHIM', ['class' => 'btn btn-success pull-right']) !!}
                            @else
                                {!! Form::submit('CẬP NHẬT', ['class' => 'btn btn-success pull-right']) !!}
                            @endif
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    
        
    </div>
</div>



@endsection
