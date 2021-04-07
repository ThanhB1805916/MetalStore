<?php 
    require_once "head.php";
?>
<body>
<header>
   <!-- Thanh điều hướng -->
    <nav class="nav-bar">
        <a class="nav-bar-item" style="bottom: 0;" href="index.php">
            <img src="<?php echo $_PATH["ico"]; ?>home-ico.png" class="ico">   
        </a>
        <a class="nav-bar-item" href="index.php" style="font-size:35px">Trang chủ</a>
        <a class="nav-bar-item" href="info.php">Thông tin thêm</a>
        <a class="nav-bar-item" href="contact.php">Liên hệ</a>
    </nav>
     <!-- Điện thoại đặt hàng -->
     <div class="phone">
        Đặt hàng ngay
        <div>
           <img class="ico" src="<?php echo $_PATH["ico"]; ?>call-ico.png"> 0123456789
        </div>
    </div>
</header>
<main>