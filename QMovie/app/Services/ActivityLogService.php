<?php
namespace App\Services;

use Spatie\Activitylog\Models\Activity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ActivityLogService
{
    public function getActivityData()
    {
        $activities = Activity::orderBy('created_at', 'desc')->get();

        $userNames = [];
        foreach ($activities as $activity) {
            if ($activity->subject_id && !isset($userNames[$activity->subject_id])) {
                $user = User::find($activity->subject_id);
                $userNames[$activity->subject_id] = $user ? $user->name : 'Unknown';
            }

            $activity->status = $this->getUserActivityStatus($activity->created_at);
            $activity->time_ago = Carbon::parse($activity->created_at)->diffForHumans();
        }

        $activeUsersCount = $this->getActiveUsersCount($activities);

        return [
            'activities' => $activities,
            'userNames' => $userNames,
            'activeUsersCount' => $activeUsersCount,
        ];
    }

    private function getUserActivityStatus($lastActivity)
    {
        $minutesDiff = Carbon::parse($lastActivity)->diffInMinutes(now());

        if ($minutesDiff <= 5) {
            return 'Đang hoạt động';
        } else {
            return 'Hoạt động ' . Carbon::parse($lastActivity)->diffForHumans();
        }
    }

    private function getActiveUsersCount($activities)
    {
        $uniqueSessions = collect();

        foreach ($activities as $activity) {
            $activityCreatedAt = Carbon::parse($activity->created_at);
            $currentTime = now();
            $minutesDiff = $activityCreatedAt->diffInMinutes($currentTime);

            Log::info('Current Time: ' . $currentTime);
            Log::info('Activity created_at: ' . $activity->created_at);
            Log::info('Minutes Diff: ' . $minutesDiff);

            // Lấy thông tin trình duyệt từ activity
            $userAgent = $activity->properties['browser'] ?? '';

            // Bỏ qua các hoạt động từ WebSocket
            if ($this->isWebSocketUserAgent($userAgent)) {
                continue;
            }

            // Nếu hoạt động xảy ra trong vòng 5 phút qua
            if ($minutesDiff <= 5) {
                $ipAddress = $activity->properties['ip_address'] ?? '';
                $browser = $userAgent;

                // Tạo khóa duy nhất cho mỗi kết hợp IP và trình duyệt
                $key = $ipAddress . '|' . $browser;

                Log::info('Key: ' . $key);

                if (!$uniqueSessions->has($key)) {
                    $uniqueSessions->put($key, $activity);
                }
            }
        }

        Log::info('Active Users Count: ' . $uniqueSessions->count());

        return $uniqueSessions->count();
    }

    private function isWebSocketUserAgent($userAgent)
    {
        // Danh sách các user agent của WebSocket mà bạn muốn loại trừ
        $webSocketAgents = ['ReactPHP'];

        foreach ($webSocketAgents as $agent) {
            if (stripos($userAgent, $agent) !== false) {
                return true; // Nếu user agent chứa 'ReactPHP', trả về true
            }
        }

        return false; // Nếu không chứa, trả về false
    }
}
