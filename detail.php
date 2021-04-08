<?php
    $title = "Chi tiết hàng hóa";
    require_once "layouts/header.php";
    require_once $_PATH["dao"];

     // Lấy ra hàng hóa theo id
     $id = $_GET["id"];
     $dao = new ItemDAO();
     $item =  $dao->getItemById($id);

     // Nếu không tồn tại
     if(!isset($item))
     {
         $err = $_PATH["err"];
         header("Location: $err", true);
     }

     // Lấy ra hình
     $img = $_PATH["img"].$item["MSHH"]."/".$item["Location"];
?>

<h1>Thông tin chi tiết hàng hóa</h1>
<h2 class="hdr" style="color:blue">Tên hàng hóa: <?php echo $item["TenHH"];?> </h2>
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
    
<div style="margin: 50px">
    <a href="index.php"><h3>Về trang chủ</h3></a>
</div>

<?php
    require_once $_PATH["footer"];
?>