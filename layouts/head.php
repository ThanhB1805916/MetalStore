<!DOCTYPE html>
<html lang="vi">

<?php 
    // Lưu các đường dẫn của các trang
    // Đổi đường dẫn chi cần đổi header
    $_PATH = [ 
        "img" => "/src/img",
        "css" => "/src/css",
        "dao" => "dao/dao.php",
        "footer" => "layouts/footer.php", 
        "err" => "err.php"
        // "home" => "index.php",
        // "manage" => "manage.php",
        // "create" => "create.php",
        // "detail" => "detail.php?id=",
        // "edit" => "edit.php?id=",
        // "delete" => "delete.php?id="
    ];

    // Thêm khu vực ad
    if(strpos($_SERVER["REQUEST_URI"], "admin"))
    {
        $_PATH["err"] = "admin/".$_PATH["err"];
    }
    // Chọn đường dẫn cho quản lý hàng hóa
    if(strpos($_SERVER["REQUEST_URI"], "manage_pro"))
    {
        foreach ($_PATH as $key => $value) {
           $_PATH[$key] = "../../".$value;
        }
    }

    //Mở session
    if(!isset($_SESSION)) session_start(); 
    $_SESSION["curDir"] = realpath($_SERVER["DOCUMENT_ROOT"]);
?>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Trang đăng nhập vào quản lý bán hàng">
    <meta name="author" content="ThanhB1805916">
    <!-- rel="shortcut icon" type="image/x-icon" -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $_PATH["img"];?>/title-ico.png" />
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