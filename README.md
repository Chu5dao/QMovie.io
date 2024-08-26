# DỰ ÁN: WEB XEM PHIM ONLINE
Đây là một dự án được thực hiện trong phạm vi cá nhân còn rất nhiều sai sót nhỏ và không thực sự clean code, mục tiêu vẫn chỉ là nhỏ gọn và nhanh chóng đã học theo những người đi trước. Lưu ý: Dự án vẫn còn đang phát triển
- Các công nghệ, thư viện, ngôn ngữ được sử dụng trong dự án này:
    + PHP - Framework Laravel v8.x
    + Auth FE Authentication UI - Laravel v6.x
	+ DB MySQL
    + Google Auth - Google APIs
    + Laravel Socialite
    + Theme User (HTML/CSS/JS) - Sưu tầm và có tùy biến lại
    + Theme Admin (HTML/CSS/JS) - Glance Design Dashboard an Admin Panel Category Flat Bootstrap Responsive
      Website Template | Home :: w3layouts
    + Bootstrap, FontAwesome
    + JQuery, Ajax, DataTables
    + Tích hợp Comment, Like, Share, Bookmark, Meta seo,... của Facebook
    + Laravel mix, Laravel WebSockets, Pusher và Laravel Echo
    + Redis, laravel-activitylog (gồm các gói hỗ trợ jenssegers/agent, guzzlehttp/guzzle)
- Các công nghệ có thể tích hợp:
    + Toastr (Yoeunes): https://github.com/yoeunes/toastr
    + Site map: https://github.com/LaraPalCom/laravel-sitemap
- Các phần dự án sẽ phát triển:
    + Sắp xếp theo lượt xem (theo ngày tuần tháng)
    + Sử dụng các công cụ Analytics, Third-Party Services tích hợp để quản lý lượt xem, traffic của website,...
    + QL Quảng cáo
    + Thêm Đạo diễn, Diễn viên
    + ...
# HÌNH ẢNH VỀ DỰ ÁN
Hình ảnh demo website:
- Trang chủ
![trang-chu](https://github.com/user-attachments/assets/f4e03bc0-b025-48b6-a69e-ced802143e4c)
- Trang admin
![trang-admin](https://github.com/user-attachments/assets/c93303b9-7c4f-4023-9f81-16d4358a7412)
- Trang xem phim
![trang-xem](https://github.com/user-attachments/assets/52b76565-2bb7-40c6-87c9-b86a6e020508)
- Trang quản lý người dùng
![danh-sach-nguoi-dung](https://github.com/user-attachments/assets/59adefe5-adcf-441f-9e1f-635a6fd4ac8b)
- Trang danh sách phim api
![danh-sach-phim-api](https://github.com/user-attachments/assets/671c5e2c-47d8-43a2-ba8f-9939cdb926a5)
- Trang thống kê lượt truy cập
![activity-user](https://github.com/user-attachments/assets/ad71146f-dec7-41c7-b62b-eeeca87ded78)
- Trang admin của vai trò Contributor
![trang-admin-contributor](https://github.com/user-attachments/assets/9d4906e5-b5e9-4379-9f57-89e50bb7e591)

# CÀI ĐẶT CẤU HÌNH KẾT NỐI
Cài đặt ở Localhost file ```.env```
```
<?php
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=qmovie
DB_USERNAME=root
DB_PASSWORD=
?>
```
Sử dụng Xampp để tạo và thêm dữ liệu bảng qmovie (cùng tên file dữ liệu qmovie.sql)

Ngoài ra cài đặt các phiên bản ```Redis```, ```WebSockets```,.. có trong file ```composer.json``` và các gói được liệt kê ở trên sao cho phù hợp.

# VIDEO DEMO
https://ok.ru/video/8095872846422

# PHÂN RÃ CHỨC NĂNG TRONG DỰ ÁN
1. Người dùng
    - Trang chủ
    - Tìm kiếm
    - Đăng nhập (có đnhap Google)/ Đăng ký
    - Quên mật khẩu (reset mật khẩu email)
    - Xem các trang phim theo:
        + Thể loại
        + Quốc gia
        + Năm
        + Danh mục
        + Lọc phim
    - Chi tiết phim
    - Xem phim, chuyển tập, chuyển server phim
    - Đánh giá phim
    - Bình luận, thích, lưu (Facebook)
2. Nhân viên Contributor
    - Tổng quan
    - QL Cá nhân
    - QL Phim
    - QL Tập Phim
3. Admin
    - Tổng quan
    - QL Cá nhân
    - QL DM Phim
    - QL Thể loại
    - QL Quốc gia
    - QL Phim
    - QL Tập Phim
    - QL Server Phim
    - QL Người dùng
    - QL API Phim
    - QL Thông tin trang
4. Các thành phần khác
    - Sắp xếp phim theo cột Thịnh thành (ngày tuần tháng)
    - Lọc Tag phim theo tìm 
    - Popup quảng cáo

# THÔNG TIN LIÊN HỆ
- Author: Lê Trần Minh Quang
- Gmail: quang3560396@gmail.com
- Gmail: minhqlee1794@gmail.com
- Github: https://github.com/Chu5dao


