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
    + Laravel mix, Laravel Laravel WebSockets, Pusher và Laravel Echo
    + Redis, laravel-activitylog (gồm các gói hỗ trợ jenssegers/agent, guzzlehttp/guzzle)
- Các công nghệ có thể tích hợp:
    + Toastr (Yoeunes): https://github.com/yoeunes/toastr
    + Site map: https://github.com/LaraPalCom/laravel-sitemap
- Các phần dự án sẽ phát triển:
    + Sử dụng các công cụ Analytics, Third-Party Services tích hợp để quản lý lượt xem, traffic của website,...
    + Sử dụng các bên thứ ba bên hỗ trợ quảng cáo
    + Thêm Đạo diễn, Diễn viên
    + ...
# Hình ảnh về dự án
Link demo website:

Hình ảnh demo website:

![Img_Demo_Web](https://user-images.githubusercontent.com/132061931/261525668-e7fa38cb-8ce8-47ab-af66-090226b41d1c.png)

![Img_Admin1](https://user-images.githubusercontent.com/132061931/261525408-84d04690-c100-4848-a201-a620cb1c00b4.png)

Mô hình dữ liệu quan hệ

![Img_SQL](https://user-images.githubusercontent.com/132061931/243055036-c7891f06-a01c-44af-a4df-f365f6de8527.png)

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

# CÁC CHỨC NĂNG TRONG DỰ ÁN
1. Người dùng
    - Trang chủ
    - Xem cửa hàng
    - Liên hệ
    - Đăng nhập/Đăng ký
    - Tìm kiếm sản phẩm
    - Giỏ hàng
    - Lịch sử đặt hàng
    - Sản phẩm yêu thích
    - Thanh toán
2. NV Bán hàng
    - QL Danh mục sản phẩm
    - QL Sản phẩm
    - QL Bình luận
    - QL Đơn hàng
    - QL Liên hệ
3. NV QL Kho
    - QL Danh mục sản phẩm
    - QL Sản phẩm
    - QL Nhà cung cấp
4. NV Tài chính
    - QL Nhân viên
    - QL Sản phẩm - Thu chi
    - QL Liên hệ
    - QL Nhân viên