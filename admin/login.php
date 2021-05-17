<?php 
    $title = "Đăng nhập";
    require_once "../layouts/head.php";
?>

<div class="lgn-frm need-js">
    <h1>Đăng Nhập</h1>
    <h3 id="noti" class="err"></h3>
    <form method="POST" onsubmit="isValid()">
        <div class="lgn-ipt">
            <span><img src="<?php echo $_PATH["ico"]?>eml-ico.png" class="ico"></span>
            <input type="text" id="msnv" name="msnv" placeholder="Mã nhân viên">
        </div>
        <p id="eml_err" class="err">&nbsp</p>
        <div class="lgn-ipt">
            <span><img src="<?php echo $_PATH["ico"]?>lock-ico.png" class="ico"></span>
            <input type="password" id="pwd" name="password" placeholder="Mật khẩu">
        </div>
        <p id="pwd_err" class="err">&nbsp</p>
        <button type="submit" class="btn btn-1"> Đăng nhập </button>
    </form>
</div>

<script>
    /* #region  Kiểm tra hợp lệ */
    function doc_id(id) {
        return document.getElementById(id);
    }

    function isValid() {
        // Nếu không hợp lệ
        let valid = validEml() && validPwd();
        if (!valid) {
            event.preventDefault();
        }
    }

    // Lấy ra trường tài khoản và mật khẩu
    const msnv = doc_id("msnv");
    const pwd = doc_id("pwd");

    // Kiểm tra trong lúc nhập
    onload = ()=>{
        msnv.addEventListener("keyup", function()
        {
            noti.textContent="";
            validEml();
        });

        pwd.addEventListener("keyup", function()
        {
            noti.textContent="";
            validPwd();
        });
    };

    function validEml() {
        if (msnv.value == "") {
            eml_err.textContent = "Mã nhân viên không được để trống";
        } else if (msnv.value.length != 5) {
            eml_err.textContent = "Mã nhân viên phải đúng 5 ký tự";
        } else {
            eml_err.textContent = '\xa0';
            return true;
        }

        return false;
    }

    function validPwd() {
        if (pwd.value == "") {
            pwd_err.textContent = "Mật khẩu không được để trống";
        } else if (pwd.value.length < 3) {
            pwd_err.textContent = "Mật khẩu phải dài hơn 3 ký tự";
        } else {
            pwd_err.textContent = '\xa0';
            return true;
        }

        return false;
    }
    /* #endregion */
</script>
<?php require_once "../layouts/footer.php"; ?>

<!-- Xử lý POST -->
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Xác thực tài khoản
    // urllencode https://www.php.net/manual/en/function.urlencode.php https://www.w3schools.com/tags/ref_urlencode.ASP 
    $msnv = strtolower(urlencode($_POST["msnv"]));
    $pwd = strtolower(urlencode($_POST["password"]));

    // Double check
    if (isset($msnv) && isset($pwd)) {
        include_once $_PATH["dao"];

        // Lấy ra người dùng theo tài khoản từ csdl
        $dao = new EmpDAO();
        $usr = $dao->getEmpByMSNV($msnv);

        $pwd = md5($pwd.$msnv);
        // Kiểm tra mật khẩu hợp lệ
        if ($pwd === $usr["Pwd"]) {
            // Lưu người dùng đang đăng nhập
            $_SESSION["usr"] = $usr;
            // Sang trang chủ
            header("Location: index.php", true, 301);
        } else {
            // Báo lỗi
            echo '<script>noti.textContent="Tài khoản hoặc mật khẩu không tồn tại"</script>';
        }
    }
}