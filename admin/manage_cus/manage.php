<!-- Thêm header -->
<?php 
    $title="Quản lý khách hàng"; 
    $path = $_SERVER['DOCUMENT_ROOT']."/CT428_WEB";
    require_once "$path/layouts/header-ad.php";
?>
<h1>Quản lý khách hàng</h1>
<style>
    .btn-crt button:hover::after{
        content: " Thêm khách hàng";
    }
    h1{
        color: blue;
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
            <th>Mã số</th>
            <th>Họ tên</th>
            <th>Tên công ty</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Chi tiết</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        include_once $_PATH["dao"];
        $dao = new KhacHangDAO();
        $cstmrs = $dao->getDSKhachHang();

        $icon = "<img src=\"".$_PATH["ico"]."edit-ico.png\" class=\"ico\">";
        foreach ($cstmrs as $key => $value) {
            echo sprintf(
                "  
                    <tr onclick=\"window.location='detail.php?id=%s';\">
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td><a href=\"edit.php?id=%s\">$icon</a></td>
                    </tr>
                ",
            $value["MSKH"],
            $value["MSKH"],
            $value["HoTenKH"],
            $value["TenCongTy"],
            $value["SoDienThoai"],
            $value["Email"],
            $value["DiaChi"],
            $value["MSKH"]
            );
        }
    ?>
     </tbody>
</table>
<!-- Thêm footer -->
<?php 
    require_once $_PATH["footer"];
?>