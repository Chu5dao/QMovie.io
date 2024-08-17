<?php

namespace App\Http\Controllers;

use App\Services\ActivityLogService;

class ActivityLogController extends Controller
{
    protected $activityLogService;

    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    public function index()
    {
        $data = $this->activityLogService->getActivityData();
        return view('admin.tracker.index', $data);
    }

    // private function getUserActivityStatus($lastActivity)
    // {
    //     $minutesDiff = Carbon::parse($lastActivity)->diffInMinutes(now());

    //     if ($minutesDiff <= 5) {
    //         return 'Đang hoạt động';
    //     } else {
    //         return 'Hoạt động ' . Carbon::parse($lastActivity)->diffForHumans();
    //     }
    // }

    // private function getActiveUsersCount($activities)
    // {
    //     $uniqueSessions = collect();

    //     foreach ($activities as $activity) {
    //         $activityCreatedAt = Carbon::parse($activity->created_at);
    //         $currentTime = now();
    //         $minutesDiff = $activityCreatedAt->diffInMinutes($currentTime);

    //         // Log thông tin về thời gian hiện tại và thời gian hoạt động
    //         Log::info('Current Time: ' . $currentTime);
    //         Log::info('Activity created_at: ' . $activity->created_at);
    //         Log::info('Minutes Diff: ' . $minutesDiff);

    //         // Bỏ qua các hoạt động từ WebSocket
    //         $userAgent = $activity->properties['browser'] ?? '';
    //         if ($this->isWebSocketUserAgent($userAgent)) {
    //             continue;
    //         }

    //         // Nếu hoạt động xảy ra trong vòng 5 phút qua
    //         if ($minutesDiff <= 5) {
    //             // Kết hợp ip_address và trình duyệt để tạo khóa duy nhất
    //             $ipAddress = $activity->properties['ip_address'] ?? '';
    //             $browser = $userAgent; // Trình duyệt
    //             $key = $ipAddress . '|' . $browser;

    //             Log::info('Key: ' . $key);

    //             if (!$uniqueSessions->has($key)) {
    //                 $uniqueSessions->put($key, $activity);
    //             }
    //         }
    //     }

    //     // Log số lượng người dùng hoạt động
    //     Log::info('Active Users Count: ' . $uniqueSessions->count());

    //     return $uniqueSessions->count();
    // }

    // private function isWebSocketUserAgent($userAgent)
    // {
    //     $webSocketAgents = ['ReactPHP']; // Danh sách các user agent cần bỏ qua

    //     foreach ($webSocketAgents as $agent) {
    //         if (stripos($userAgent, $agent) !== false) {
    //             return true;
    //         }
    //     }

    //     return false;
    // }
}
