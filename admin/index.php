<!-- Thêm header -->
<?php 
    $title="Trang chủ"; 
    $path = $_SERVER['DOCUMENT_ROOT']."/CT428_WEB";
    require_once "$path/layouts/header-ad.php";
?>

<style>
    h2{
        color: blue;
    }
</style>

<h1>Trang chủ</h1>

<hr>
<h2>Hôm nay bạn muốn làm gì?</h2>
<h3><a href="manage_dh/manage.php">Xem các đơn đặt hàng</a></h3>
<h3><a href="manage_cus/manage.php">Xem khách hàng</a></h3>
<h3><a href="manage_pro/manage.php">Xem hàng hóa hàng</a></h3>


<!-- Thêm footer -->
<?php 
    require_once $_PATH["footer"];
?>