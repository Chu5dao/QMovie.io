<?php
// All
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class UpdatePageViews implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $count;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $keys = Redis::keys('page-views:*');
        $this->count = count($keys);
        Log::info('Broadcasting online users count: ' . $this->count);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('page-views-count');
    }

    public function broadcastWith()
    {
        return ['count' => $this->count];
    }
    
    public function broadcastAs()
    {
        return 'UpdatePageViews';  // Đảm bảo tên sự kiện khớp
    }
}
