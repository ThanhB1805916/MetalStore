<?php
    $title = "Thêm khách hàng";
    $path = $_SERVER['DOCUMENT_ROOT']."/CT428_WEB";
    require_once "$path/layouts/header-ad.php";
    require_once $_PATH["dao"];
    $dao = new KhacHangDAO();
    $cstmrs = $dao->getDSKhachHang();
?>
<style>
    h1{
        color: blue;
    }
    form div input{
        width: 70%;
    }
</style>
<h1>Thêm khách hàng</h1>
<hr>

<form class="dk" method="POST" action="create.php" onsubmit="isValid()">
    <div>
        <label>Số điện thoại</label>
        <input type="text" style="width: 40%" name="SoDienThoai" id="cus_sdt" minlength="10" maxlength="10" list="sdt_list">
        <datalist id="sdt_list">
            <?php 
                foreach ($cstmrs as $value) {
                    echo sprintf('<option value="%s">%s</option>', $value["SoDienThoai"], $value["SoDienThoai"]);
                }
            ?>
        </datalist>
    </div>
    <p id="cus_sdt_err" class="err">&nbsp</p>
    <div>
        <label>Tên khách hàng</label>
        <input type="text" name="HoTenKH" id="cus_nam">
    </div>
    <p id="cus_nam_err" class="err">&nbsp</p>
    <div>
        <label>Tên công ty</label>
        <input type="text" name="TenCongTy" id="cus_ct">
    </div>
    <p id="cus_ct_err" class="err">&nbsp</p>
    <div>
        <label>Email</label>
        <input type="email" name="Email" id="cus_el"m>
    </div>
    <p id="cus_el_err" class="err">&nbsp</p>
    <div>
        <label>Địa chỉ</label>
        <input type="text" name="DiaChi" id="cus_dc">
    </div>
    <p id="cus_dc_err" class="err">&nbsp</p>

    <button class="btn btn-2" type="submit">Thêm</button>
</form>

<script>
    // Danh sách khách hàng
    const cstmrs = <?php echo json_encode($cstmrs) ?>;

    // Kiểm tra hợp lệ của các trường
    let cus_nam = document.getElementById("cus_nam");
    let cus_ct = document.getElementById("cus_ct");
    let cus_sdt = document.getElementById("cus_sdt");
    let cus_el = document.getElementById("cus_el");
    let cus_dc = document.getElementById("cus_dc");

    /* #region  Kiểm tra hợp lệ */

    onload = ()=>{
        cus_ct.addEventListener("keyup", function()
        {
            validTenCT();
        });
        cus_nam.addEventListener("keyup", function()
        {
            validName();
        });
        cus_sdt.addEventListener("keyup", function()
        {
            validSDT();
        });
        cus_el.addEventListener("keyup", function()
        {
            validEL();
        });
        cus_dc.addEventListener("keyup", function()
        {
            validDC();
        });
    };

    function isValid() {
        // Nếu không hợp lệ
        let valid = validName() && validTenCT() && validSDT() && validEL() && validDC();
        if (!valid) {
            event.preventDefault();
        }
    }

    function validTenCT()
    {
        if(cus_ct.value === "")
        {
            cus_ct_err.textContent = "Tên công ty không được bỏ trống";
        }
        else {
            cus_ct_err.textContent = '\xa0';
            return true;
        }

        return false;
    }

    function validName() {
        if (cus_nam.value === "") {
            cus_nam_err.textContent = "Tên khách hàng không được bỏ trống";
        } else {
            cus_nam_err.textContent = '\xa0';
            return true;
        }

        return false;
    }

    function validSDT() {
        if (cus_sdt.value === "") {
            cus_sdt_err.textContent = "Số điện thoại được bỏ trống";
        }
        else if (cus_sdt.value.length !== 10) {
            cus_sdt_err.textContent = "Số điện thoại phải đủ 10 số";
        } 
        else {
            let ex = false;
            for (let i = 0; i < cstmrs.length; i++) {
                if(cstmrs[i]["SoDienThoai"] === cus_sdt.value)
                {
                    ex = true;
                    break;
                }
            }

            if(ex){
                cus_sdt_err.textContent = 'Số điện thoại đã tồn tại vui lòng chọn số khác';
            }
            else{
                cus_sdt_err.textContent = '\xa0';
                return true;
            }
        }

        return false;
    }

    function validEL() {
        if (cus_el.value === "") {
            cus_el_err.textContent = "Email không được bỏ trống";
        } else {
            cus_el_err.textContent = '\xa0';
            return true;
        }

        return false;
    }

    function validDC() {
        if (cus_dc.value === "") {
            cus_dc_err.textContent = "Địa chỉ không được bỏ trống";
        } else {
            cus_dc_err.textContent = '\xa0';
            return true;
        }

        return false;
    }

    /* #endregion */
</script>

<div class="lnk">
<a href="manage.php"><h3>Về trang quản lý</h3></a>
</div>

<?php
    require_once $_PATH["footer"];
?>

<!-- Xử lý POST -->
<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && strpos($_SERVER['PHP_SELF'], "create") && isset($_POST)) {
         //Cập nhật thông tin
         $cst["HoTenKH"] = $_POST["HoTenKH"]??$cst["HoTenKH"];
         $cst["TenCongTy"] = $_POST["TenCongTy"]??$cst["TenCongTy"];
         $cst["SoDienThoai"] = $_POST["SoDienThoai"]??$cst["SoDienThoai"];
         $cst["Email"] = $_POST["Email"]??$cst["Email"];
         $cst["DiaChi"] = $_POST["DiaChi"]??$cst["DiaChi"];
        
         if($dao->addKhachHang($cst))
         {
             echo "<script>alert('Thêm thành công');</script>";
         }
         else
         {
             echo "<script>alert('Lỗi vui lòng thử lại');</script>";
         }
    }
?>