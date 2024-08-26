<?php
// Lượt truy cập Tài Khoản
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserOnlineStatus
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $userId;
    public $isOnline;

    public function __construct($userId, $isOnline)
    {
        $this->userId = $userId;
        $this->isOnline = $isOnline;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');

        // Sử dụng PrivateChannel nếu bạn chỉ muốn phát sự kiện đến một số người dùng nhất định
        // return new PrivateChannel('user.' . $this->userId);

        // Sử dụng PresenceChannel nếu bạn muốn phát sự kiện đến tất cả người dùng trong kênh đó
        return new Channel('online-users');
    }
    /**
     * Define the event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'user.online.status';
    }
}
