<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\UserOnlineStatus;
use App\Listeners\UpdateOnlineUsersCount;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // Lượt truy cập Tài Khoản
        UserOnlineStatus::class => [
            UpdateOnlineUsersCount::class,
        ],
        // Lượt truy cập trang
        'App\Events\PageViewed' => [
            'App\Listeners\TrackPageView',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
