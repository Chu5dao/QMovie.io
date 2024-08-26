<?php
// All
namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PageViewed;
use Illuminate\Support\Facades\Redis;

class TrackPageView
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
    public function handle(PageViewed $event)
    {
        $ipAddress = $event->ipAddress;
        $key = 'page-views:' . $ipAddress;

        Redis::set($key, now());
        Redis::expire($key, 600);

        // Lưu thông tin lượt truy cập với thời gian sống 600 giây (10 phút)
        Redis::setex($key, 600, true);
    }
}
