<?php
    $title = "Cửa hàng sắt Thanh Vương";
    require_once "layouts/header.php"
?>
<h1 class="hdr">Cửa Hàng Sắt Thép Thanh Vương</h1>
<div class="pro-area">
    <h2 class="hdr">Các Loại Hàng Hóa</h2>
    <div class="pro-cont">
        <?php 
        include_once $_PATH["dao"];
        $i = 0;
        foreach ($items as $key => $value) {
            echo sprintf( 
            '
            <div class="pro">
                <a href="detail.php?id=%s"><img class="ico" src="%s"></a>
                <div style="text-align:center">
                    <h3>Các loại %s</h3>
                    <h3><a href="detail.php?id=%s">Xem thêm</a></h3>
                </div>
            </div>
            ', 
            $value["MSHH"],  // Lấy id
            $imgs[$i++], // Lấy link hình
            $value["TenLoai"], // Lấy tên loại
            $value["MSHH"]); // Lấy id
        }
    ?>
    </div>
</div>


<?php require_once $_PATH["footer"]; ?>