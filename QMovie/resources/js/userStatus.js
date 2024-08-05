document.addEventListener('DOMContentLoaded', () => {
    // Đoạn mã xử lý cho 'online-users-count'
    const onlineUsersCountElement = document.getElementById('online-users-count');
    if (!onlineUsersCountElement) {
        console.error('Element with ID "online-users-count" not found.');
    } else {
        window.Echo.join('online-users')
            .here((users) => {
                onlineUsersCountElement.innerText = `Account: ${users.length}`;
            })
            .joining((user) => {
                const currentCount = parseInt(onlineUsersCountElement.innerText.replace('Account: ', '')) || 0;
                onlineUsersCountElement.innerText = `Account: ${currentCount + 1}`;
            })
            .leaving((user) => {
                const currentCount = parseInt(onlineUsersCountElement.innerText.replace('Account: ', '')) || 0;
                onlineUsersCountElement.innerText = `Account: ${currentCount - 1}`;
            });
    }

    // Đoạn mã xử lý cho 'total-online-users-count'
    const totalOnlineUsersCountElement = document.getElementById('total-online-users-count');
    if (!totalOnlineUsersCountElement) {
        console.error('Element with ID "total-online-users-count" not found.');
    } else {
        window.Echo.channel('online-users-count')
            .listen('.OnlineUsersUpdated', (e) => {
                document.getElementById('total-online-users-count').innerText = 'All: ' + e.count;
            });
    }
});