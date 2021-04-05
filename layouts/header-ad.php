<?php 
    require_once "head.php";
    $usr = $_SESSION["usr"];
?>
<style> 
#rect {
    animation-name: colorful;
    animation-duration: 1s;
    animation-iteration-count: infinite;
    animation-timing-function: ease-out;
  }

    @keyframes colorful{
        0%{
        background-color: antiquewhite;
        }
        50%{
        background-color: #fff;
        }
        100%{
            background-color: #007bff;
            }    
        }
</style>
<body>
<header>
   <!-- Thanh điều hướng -->   
    <nav class="nav-bar">
        <a class="nav-bar-item" style="bottom: 0;" href="/admin/index.php">
            <img src="<?php echo $_PATH["img"]??"../src/img"; ?>/home-ico.png" class="ico">   
        </a>
        <a class="nav-bar-item" href="<?php echo "/admin/index.php"?>" style="font-size:35px">Trang chủ</a>
        <a class="nav-bar-item" href="<?php echo "/admin/manage_pro/manage.php";?>">Quản lý hàng hóa</a>
    </nav>
        
    <!-- Nút đăng xuất -->
    <span class="usr">
        <span  id="rect">Xin chào: <?php echo $usr["eml"]; ?></span>
        <form class="lg-btn" method="POST" action="header-ad.php" onsubmit="IsValid()">
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