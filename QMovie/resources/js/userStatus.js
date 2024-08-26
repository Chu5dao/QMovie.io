document.addEventListener('DOMContentLoaded', () => {
    // Đoạn mã xử lý cho 'online-users-count'
    const onlineUsersCountElement = document.getElementById('online-users-count');
    if (!onlineUsersCountElement) {
        console.error('Element with ID "online-users-count" not found.');
    } else {
        // Lắng nghe sự kiện OnlineUsersUpdated từ Laravel Echo
        window.Echo.channel('online-users')
            .listen('.OnlineUsersUpdated', (e) => {
                onlineUsersCountElement.innerText = `Tài khoản: ${e.count}`;
            });
    }

    // Đoạn mã xử lý cho 'page-views-count'
    const pageViewsCountElement = document.getElementById('page-views-count');
    if (!pageViewsCountElement) {
        console.error('Element with ID "page-views-count" not found.');
    } else {
        window.Echo.channel('page-views-count')
            .listen('.UpdatePageViews', (e) => {
                pageViewsCountElement.innerText = 'Lượt truy cập: ' + e.count;
            });
    }
});