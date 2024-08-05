<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UpdateOnlineUsers;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;


class UpdateOnlineUsersCount implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UpdateOnlineUsers $event)
    {
        // Đếm số người dùng online bằng cách đếm các khóa trong Redis với prefix 'online-users:'
        $onlineUsersKeys = Redis::keys('online-users:*');
        $onlineUsersCount = count($onlineUsersKeys);
        Log::info('Broadcasting online users count: ' . $onlineUsersCount);

        // Phát sự kiện cập nhật số người dùng online
        event(new \App\Events\OnlineUsersUpdated($onlineUsersCount));
    }
}
