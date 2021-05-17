<?php 
    require_once "head.php";
    $usr = $_SESSION["usr"];
?>
<style> 
#rect {
    animation-name: colorful;
    animation-duration: 5s;
    animation-iteration-count: infinite;
    animation-timing-function: ease-out;
  }

    @keyframes colorful{
        50%{
            color: red;
        }
    }
</style>
<body>
<header>
   <!-- Thanh điều hướng -->   
    <nav class="nav-bar">
        <a class="nav-bar-item" style="bottom: 0;" href="<?php echo "/".$_PATH["root"]."index.php"; ?>">
            <img src="<?php echo $_PATH["ico"]; ?>/home-ico.png" class="ico">   
        </a>
        <a class="nav-bar-item" href="<?php echo "/".$_PATH["root"]."index.php"; ?>" style="font-size:35px">Trang chủ</a>
        <a class="nav-bar-item" href="<?php echo "/".$_PATH["root"]."manage_pro/manage.php";?>">Quản lý hàng hóa</a>
        <a class="nav-bar-item" href="<?php echo "/".$_PATH["root"]."manage_dh/manage.php";?>">Quản lý đặt hàng</a>
        <a class="nav-bar-item" href="<?php echo "/".$_PATH["root"]."manage_cus/manage.php";?>">Quản lý khách hàng</a>
    </nav>
        
    <!-- Nút đăng xuất -->
    <span class="usr">
        <span  id="rect">Xin chào: <?php echo $usr["HoTenNV"]; ?></span>
        <form class="lg-btn" method="POST" action="<?php echo $_PATH["layouts"]."header-ad.php"; ?>" onsubmit="IsValid()">
            <button type="submit">Đăng xuất</button>
        </form>
        <script>
            /* Xác nhận form */
            function IsValid()
            {
                if(!confirm("Bạn thật sự muốn đăng xuất"))
                {
                    event.preventDefault();
                }
            }
        </script>
    </span>
</header>

<?php
     // Kiểm tra đăng nhập
     if(!isset($_SESSION["usr"]) && !strpos($_SERVER['PHP_SELF'], "login"))
     {
         // Về trang đăng nhập
        header("Location: ../admin/login.php", true, 301);
     }

    //Xử lý POST đăng xuất
    if ($_SERVER["REQUEST_METHOD"] === "POST" && strpos($_SERVER['PHP_SELF'], "header-ad")) {
        // Dành cho đăng xuất
        //Xóa session
        session_unset ();
        //Về trang đăng nhập
        header("Location: ../admin/login.php", true, 301);
    }
?>

<main>