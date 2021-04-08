<!-- Thêm header -->
<?php 
    $title="Quản lý đặt hàng"; 
    $path = $_SERVER['DOCUMENT_ROOT']."/CT428_WEB";
    require_once "$path/layouts/header-ad.php";
?>
<h1>Quản lý đặt hàng</h1>

<style>
    .btn-crt button:hover::after{
        content: " Thêm hóa đơn";
    }
</style>

<div class="btn-crt">
    <a href="create.php">
        <button class="btn btn-1"><img class="ico" src="<?php echo $_PATH["ico"]; ?>plus-ico.png"></button>
    </a>
</div>
<table class="content-table">
    <thead>
        <tr>
            <th>Họ Tên Khách Hàng</th>
            <th>Email</th>
            <th>Số Điện Thoại</th>
            <th>Tổng Giá</th>
            <th>Giảm Giá</th>
            <th>Tên Hàng Hóa</th>
            <th>Chi Tiết</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        include_once $_PATH["dao"];
        $dao = new DatHangDAO();
        $items = $dao->getDSDatHang();
        
        $icon = "<img src=\"".$_PATH["ico"]."edit-ico.png\" class=\"ico\">";
        foreach ($items as $key => $value) {
            echo sprintf(
                "  
                    <tr onclick=\"window.location='detail.php?id=%s';\">
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td><a href=\"detail.php?id=%s\">$icon</a></td>
                    </tr>
                ",
            $value["SoDonDH"],
            $value["HoTenKH"],
            $value["Email"],
            $value["SoDienThoai"],
            $value["GiaDatHang"],
            $value["GiamGia"],
            $value["TenHH"],
            $value["SoDonDH"]
            );
        }
    ?>
     </tbody>
</table>
<!-- Thêm footer -->
<?php 
    require_once $_PATH["footer"];
?>