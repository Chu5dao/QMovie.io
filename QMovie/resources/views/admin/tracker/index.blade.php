@extends('layouts.app')

@section('content')
@include('layouts.statistical')
<br>
<h2 class="title1">THỐNG KÊ TRẠNG THÁI NGƯỜI DÙNG</h2>
<div class="blank-page widget-shadow scroll" id="style-2 div1">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" id="table-wrapper">
                        <table class="table table-striped" id="table_leech">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th>Trình duyệt</th>
                                    <th>Trạng thái</th>
                                    <th>Tên người dùng</th>
                                    <th>Thiết bị</th>
                                    <th>Hệ điều hành</th>
                                    <th>Địa chỉ IP</th>
                                    <th>Quốc gia</th>
                                    <th>Truy cập</th>
                                    <th>Thời gian hoạt động</th>
                                    <th>Tổng trang truy cập</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $key => $activity)
                                <tr>
                                    <th scope="row"><center>{{ $key + 1 }}</center></th> <!-- Đảm bảo số thứ tự chính xác -->
                                    <td>{{ $activity->properties['browser'] ?? 'N/A' }}</td>
                                    <td>{{ $activity->status }}</td>
                                    <td>
                                        {{ $activity->log_name }} {{ $userNames[$activity->subject_id] ?? 'Guest' }}
                                    </td>
                                    <td>{{ $activity->properties['device'] ?? 'N/A' }}</td>
                                    <td>{{ $activity->properties['os'] ?? 'N/A' }}</td>
                                    <td>{{ $activity->properties['ip_address'] ?? 'N/A' }}</td>
                                    <td>{{ $activity->properties['country'] ?? 'N/A' }}</td>
                                    <td>{{ $activity->properties['log'] ?? 'N/A' }}</td>
                                    <td>{{ $activity->time_ago }}</td>
                                    <td>{{ $activity->properties['total_pages_accessed'] ?? 'N/A' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- script --}}
<!-- Load userStatus.js -->
<script src="{{ mix('js/userStatus.js') }}" defer></script>
<!-- Initialize Echo -->
<script src="{{ mix('js/userActivity.js') }}" defer></script>
@endsection