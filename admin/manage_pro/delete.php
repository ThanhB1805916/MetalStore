<?php
    $title = "Xóa hàng hóa";
    require_once "../header-ad.php";
    require_once $_PATH["dao"];

    // Nếu không có id
    if(!isset($_GET["id"]))
    {
        $err = $_PATH["err"];
        header("Location: $err", true);
    }

     // Lấy ra hàng hóa theo id
     $id = $_GET["id"]-1;
     $item = $items[$id];
     // Lấy ra hình
     $img = $imgs[$id];
?>

<h1>Xóa hàng hóa</h1>

<div>
    <hr>
        <div class="dtl">
            <img class=img-dis src="../../<?php echo $img;?>">
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
</div>

<div>
    <form method="POST" onsubmit="isValid()">
        <button class="btn" style="height:50px; background-color:blue" onclick="conf()" type="submit">Xóa hàng hóa</button>
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


<!-- Xử lý POST -->
<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        var_dump($id);
        var_dump($_POST);
        $items[$id] = null;
        var_dump($items);
        // Xóa xong về trang chủ
        header("Location: index.php", true);
    }
?>