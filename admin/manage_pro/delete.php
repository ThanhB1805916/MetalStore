<?php
    $title = "Xóa hàng hóa";
    $path = $_SERVER['DOCUMENT_ROOT']."/CT428_WEB";
    require_once "$path/layouts/header-ad.php";
    require_once $_PATH["dao"];

    // Nếu không có id
    if(!isset($_GET["id"]))
    {
        $err = $_PATH["err"];
        header("Location: $err", true);
    }

     // Lấy ra hàng hóa theo id
     $id = $_GET["id"];
     $item = $dao->getItemById($id);
     // Lấy ra hình
     $img = $_PATH["img"].$item["MSHH"]."/".$item["Location"];
?>

<!-- Xử lý POST -->
<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Xóa khỏi CSDL
        if($dao->deleteItem($item["MSHH"]))
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

<h1>Xóa hàng hóa</h1>

<hr>
<div class="dtl">
    <img class=img-dis src="<?php echo $img;?>">
    <div>
        <div>Tên hàng hóa: <?php echo $item["TenHH"]; ?></div>
        <div>Tên loại: <?php echo $item["TenLoai"]; ?></div>
        <div>Quy cách: <?php 
            $qc = explode("-",$item["QuyCach"]);
            echo $qc[0]." mét - ".$qc[1]." mét<sub>/kg</sub>";
        ?></div>           
        <div>Giá: <?php echo $item["Gia"]." vnd"; ?></div> 
    </div>
</div>

<div style="margin:70px">
    <form method="POST" onsubmit="isValid()">
        <button class="btn btn-2" style="font-size:30px;" onclick="conf()" type="submit">Xóa hàng hóa</button>
    </form>
</div>


<script>

    // Hủy xóa nếu người dùng chon cancel
    let abort;
    function conf()
    {
        abort = !confirm("Bạn thật sự muốn xóa hàng hóa");
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
    <a href="edit.php?id=<?php echo $item["MSHH"];?>"><h3>Chỉnh sửa thông tin</h3></a>
    <a href="manage.php"><h3>Về trang quản lý</h3></a>
</div>

<?php
    require_once $_PATH["footer"];
?>
