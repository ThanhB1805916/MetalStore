<?php
    $title = "Thông tin hóa đơn";
    $path = $_SERVER['DOCUMENT_ROOT']."/CT428_WEB";
    require_once "$path/layouts/header-ad.php";
    require_once $_PATH["dao"];
    $dao = new DatHangDAO();

    // Lấy ra hàng hóa theo id
    $id = $_GET["id"];
    $item = $dao->getHD($id);

    // Nếu không tồn tại
    if(!isset($item))
    {
        $err = $_PATH["err"];
        header("Location: $err", true);
    }

    // Lấy ra hình
    $img = $_PATH["img"].$item["MSHH"]."/".$item["Location"];
?>

<!-- Xử lý POST -->
<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Xóa khỏi CSDL
        if($dao->delDH($id))
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
    h2{
        color: blue;
    }
</style>
<h1>Thông tin hóa đơn</h1>

<hr>
<h2>Khách hàng</h2>
<div class="dtl" style="display:block">
    <div>
        <div>Họ Tên khách hàng: <?php echo $item["HoTenKH"]; ?></div>
        <div>Email: <?php echo $item["Email"]; ?></div>
        <div>Số điện thoại: <?php echo $item["SoDienThoai"]; ?></div>
        <div>Tên công ty: <?php echo $item["TenCongTy"]; ?></div>
        <div>Địa chỉ: <?php echo $item["DiaChi"]; ?></div>          
    </div>
</div>
<hr>
<hr>
<h2>Hàng hóa</h2>
<div class="dtl">
    <img class=img-dis src="<?php echo $img;?>">
    <div>
        <div>Tên hàng hóa: <?php echo $item["TenHH"]; ?></div>
        <div>Tên loại: <?php echo $item["TenLoaiHangHoa"]; ?></div>
        <div>Quy cách: <?php 
            $qc = explode("-",$item["QuyCach"]);
            echo $qc[0]." mét - ".$qc[1]." mét<sub>/kg</sub>";
        ?></div>           
        <div>Giá: <?php echo $item["Gia"]." vnd"; ?></div> 
    </div>
</div>
<hr>
<hr>
<h2>Hóa đơn</h2>
<div class="dtl" style="display:block">
    <div>
        <div>Số lượng đặt: <?php echo $item["SoLuong"]; ?></div>
        <div>Tổng tiền: <?php echo $item["GiaDatHang"]." vnd"; ?></div>
        <div>Giảm giá: <?php echo $item["GiamGia"]; ?></div>
        <div>Ngày đặt hàng: <?php echo $item["NgayDH"]; ?></div>
        <div>Ngày giao hàng: <?php echo $item["NgayGH"]; ?></div>
    </div>
</div>
<div style="margin:70px">
    <form method="POST" onsubmit="isValid()">
        <button class="btn btn-2" style="font-size:30px;" onclick="conf()" type="submit">Hủy hóa đơn</button>
    </form>
</div>


<script>

    // Hủy xóa nếu người dùng chon cancel
    let abort;
    function conf()
    {
        abort = !confirm("Bạn thật sự muốn hủy hóa đơn");
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
    <a href="manage.php"><h3>Về trang quản lý</h3></a>
</div>

<?php
    require_once $_PATH["footer"];
?>
