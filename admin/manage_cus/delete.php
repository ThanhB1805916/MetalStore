<?php
    $title = "Chi tiết khách hàng";
    $path = $_SERVER['DOCUMENT_ROOT']."/CT428_WEB";
    require_once "$path/layouts/header-ad.php";
    require_once $_PATH["dao"];
    $dao = new KhacHangDAO();
    
    // Lấy ra khách hàng theo id
    $id = $_GET["id"];
    $cst = $dao->getKhachHang($id);

    // Nếu không tồn tại
    if(!isset($cst))
    {
        $err = $_PATH["err"];
        header("Location: $err", true);
    }
?>

<!-- Xử lý POST -->
<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Xóa khỏi CSDL
        if($dao->deleteKhachHang($cst["MSKH"]))
        {
            // Xóa xong về trang chủ
            header("Location: manage.php", true);
        }
        else
        {
            // Báo lỗi
            echo "<script>alert('Lỗi vui lòng thử lại');</script>";
        }
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

<h1>Xóa khách hàng</h1>

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
    

<div style="margin:70px">
    <form method="POST" onsubmit="isValid()">
        <button class="btn btn-2" style="font-size:30px;" onclick="conf()" type="submit">Xóa khách hàng</button>
    </form>
</div>


<script>

    // Hủy xóa nếu người dùng chon cancel
    let abort;
    function conf()
    {
        abort = !confirm("Bạn thật sự muốn xóa khách hàng");
    }

    function isValid()
    {
        if(abort)
        {
            event.preventDefault();
        }
    }
</script>

<div class="lnk">
    <a href="edit.php?id=<?php echo $cst["MSKH"];?>"><h3>Chỉnh sửa thông tin</h3></a>
    <a href="manage.php"><h3>Về trang quản lý</h3></a>
</div>

<?php
    require_once $_PATH["footer"];
?>
