<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('online-users', function ($user) {
    // Kiểm tra quyền truy cập cho kênh online-users
    // Có thể kiểm tra người dùng đã đăng nhập hay chưa
    return auth()->check(); // Chỉ cho phép người dùng đã đăng nhập
});
