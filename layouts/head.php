<!DOCTYPE html>
<html lang="vi">

<?php
    //Mở session
    if(!isset($_SESSION)) session_start(); 

    // Lưu các đường dẫn của các trang
    // Đổi đường dẫn chi cần đổi header
    $_PATH = [
        "root" => "CT428_WEB/", 
        "ico" => "src/ico/",
        "img" => "src/img/",
        "css" => "src/css/",
        "dao" => "dao/dao.php",
        "footer" => "layouts/footer.php", 
        "err" => "layouts/err.php"
    ];

    // Thêm khu vực ad
    if(strpos($_SERVER["REQUEST_URI"], "admin"))
    {
        $_PATH["root"] = $_PATH["root"]."admin/";
        foreach ($_PATH as $key => $value) {
            $_PATH[$key] = "../".$value;
        }
    }
    // Chọn đường dẫn cho các trang quản lý
    if(strpos($_SERVER["REQUEST_URI"], "manage"))
    {
        foreach ($_PATH as $key => $value) {
           $_PATH[$key] = "../".$value;
        }
    }

    // Lưu đường dẫn riêng cho trang err
    $_SESSION["curDir"] = $_PATH["root"];
?>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Trang đăng nhập vào quản lý bán hàng">
    <meta name="author" content="ThanhB1805916">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $_PATH["ico"];?>/title-ico.png" />
    <title><?php echo $title??"Không có tiêu đề"; ?></title>
    <link rel="stylesheet" href="<?php echo $_PATH["css"];?>/styles.css">
    <noscript>
        <style>
            .need-js, main, header, footer{
                display: none;
            }

            h1{
                position: fixed;
                top: 100px;
            }
        </style>
        <h1 class="err">Vui lòng không tắt JavaScript</h1>
    </noscript>
</head>