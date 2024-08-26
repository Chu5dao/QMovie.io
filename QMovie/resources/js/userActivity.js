import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
});

// Theo dõi hoạt động người dùng
document.addEventListener('DOMContentLoaded', () => {
    // Gửi sự kiện người dùng online
    window.Echo.join('online-users')
        .here((users) => {
            // Xử lý số người dùng online hiện tại
            const onlineUsersCountElement = document.getElementById('online-users-count');
            if (onlineUsersCountElement) {
                onlineUsersCountElement.innerText = `Tài khoản: ${users.length}`;
            }
        })
        .joining((user) => {
            // Xử lý khi có người dùng mới tham gia
            const onlineUsersCountElement = document.getElementById('online-users-count');
            const currentCount = parseInt(onlineUsersCountElement.innerText.replace('Tài khoản: ', '')) || 0;
            onlineUsersCountElement.innerText = `Tài khoản: ${currentCount + 1}`;
        })
        .leaving((user) => {
            // Xử lý khi người dùng rời đi
            const onlineUsersCountElement = document.getElementById('online-users-count');
            const currentCount = parseInt(onlineUsersCountElement.innerText.replace('Tài khoản: ', '')) || 0;
            onlineUsersCountElement.innerText = `Tài khoản: ${currentCount - 1}`;
        });
});