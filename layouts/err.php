<?php
    //Mở session
    if(!isset($_SESSION)) session_start(); 
?>

<style>
    h3{
        margin-bottom: 20px;
    }
</style>

<title>Lỗi</title>

<h1>Có lỗi xảy ra</h1>
<h3> Vui lòng thử lại</h3>
<h3>Hoặc</h3>

<h3><a href="/<?php echo $_SESSION["curDir"]??"CT428_WEB/"?>">Về trang chủ</a></h3> 