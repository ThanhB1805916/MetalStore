<?php require_once "header.php";?>

<!-- Trang giỏ hàng -->
<?php 

    //Các sản phẩm được lưu trong session
    if(!isset($_SESSION["cart"]))
    {
        echo "Không có sản phẩm trong giỏ hàng";
    }   
    else
    {

    }
?>


<div>
    <a href="index.php">Về trang chủ</a>
</div>


<?php require_once "footer.php"; ?>