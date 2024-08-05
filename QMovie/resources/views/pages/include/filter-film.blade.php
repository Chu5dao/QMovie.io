<style>
    .style-filter {
    border: none;
    background-color: #12171b;
    color: #ffffff;
    }

    .btn-filter {
    border: 0 #b2b7bb;
    background-color: #12171b;
    color: #ffffff;
    padding: 9px;
    }
</style>
<form action="{{route('filter-film')}}" method="get">
    <div class="col-md-2">
        <div class="form-group">
            <select class="form-control style-filter" name="order">
                <option value="">--Sắp xếp--</option>
                <option value="date_cr">Ngày đăng</option>
                <option value="year">Năm sản xuất</option>
                <option value="title">Tên phim</option>
                <option value="top_view">Lượt xem</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <select class="form-control style-filter" name="genre">
            <option>-- Thể loại --</option>
            @foreach ($genre_user as $key=>$gen_filter)
                <option {{ isset($_GET['genre']) && $_GET['genre'] == $gen_filter->id ? 'selected' : '' }} value="{{$gen_filter->id}}">{{$gen_filter->title}}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <select class="form-control style-filter" name="country">
            <option>-- Quốc gia --</option>
            @foreach ($country_user as $key=> $cou_filter)
                <option {{ isset($_GET['country']) && $_GET['country'] == $cou_filter->id ? 'selected' : '' }} value="{{$cou_filter->id}}">{{$cou_filter->title}}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            @php
                if (isset($_GET['year'])) {
                    $year = $_GET['year'];
                } else {
                    $year = null;
                }
            @endphp
            {!! Form::selectYear('year', 1970, 2024, $year, ['class'=>'form-control style-filter', 'placeholder'=>'-- Năm phim --']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input type="submit" class="form-control btn-default btn-filter" value="Lọc Phim">
        </div>
    </div>
</form>