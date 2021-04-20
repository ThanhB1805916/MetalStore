<?php
    $title = "Chi tiết khách hàng";
    $path = $_SERVER['DOCUMENT_ROOT']."/CT428_WEB";
    require_once "$path/layouts/header-ad.php";
    require_once $_PATH["dao"];
    $dao = new KhacHangDAO();
    
    // Lấy ra hàng hóa theo id
    $id = $_GET["id"];
    $cst = $dao->getKhachHang($id);

    // Nếu không tồn tại
    if(!isset($cst))
    {
        $err = $_PATH["err"];
        header("Location: $err", true);
    }
?>

<style>
    .dtl{
        display: flow-root;
    }

    h1{
        color: blue;
    }
</style>

<h1>Thông tin chi tiết khách hàng</h1>
<hr>
    <div class="dtl">
        <div>
            <div>Mã khách hàng: <?php echo $cst["MSKH"];?></div>
            <div>Tên khách hàng: <?php echo $cst["HoTenKH"];?></div>
            <div>Tên công ty: <?php echo $cst["TenCongTy"];?></div>
            <div>Số điện thoại: <?php echo $cst["SoDienThoai"];?></div>
            <div>Email: <?php echo $cst["Email"];?></div>
            <div>Địa chỉ: <?php echo $cst["DiaChi"];?></div>
        </div>
    </div>
    
<div class="lnk">
    <a href="edit.php?id=<?php echo $cst["MSKH"];?>"><h3>Chỉnh sửa thông tin</h3></a>
    <a href="manage.php"><h3>Về trang quản lý</h3></a>
</div>

<?php
    require_once $_PATH["footer"];
?>