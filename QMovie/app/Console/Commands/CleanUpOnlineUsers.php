<?php
// comming soon...
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

class CleanUpOnlineUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:online-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up expired online users sessions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $keys = Redis::keys('online-users:*');

        foreach ($keys as $key) {
            if (!Redis::exists($key)) {
                Redis::del($key);
            }
        }

        // Xóa các bản ghi cũ hơn 1 ngày
        DB::table('activity_log')->where('created_at', '<', now()->subDay())->delete();

        $this->info('Expired online users sessions cleaned up successfully.');
    }
}
