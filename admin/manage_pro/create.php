<?php
    $title = "Thêm hàng hóa";
    require_once "../header-ad.php";
    require_once $_PATH["dao"];
?>
<h1>Thêm hàng hóa</h1>
<h3 id="noti" class="err"></h3>
<hr>
<form class="dk" method="POST" action="create.php" onsubmit="isValid()">
    <div>
        <label>Tên hàng hóa</label>
        <input type="text" name="TenHH" id="pro_nam">
    </div>
    <p id="pro_nam_err" class="err">&nbsp</p>
    <!-- Loại nên là dropdown box -->
    <div>
        <lable>Loại</lable>
        <select name="TenLoai">
            <?php
                foreach ($types as $key => $value) {
                    echo sprintf('<option value="%s">%s</option>', $key, $value);
                }
            ?>
        </select>
    </div>
    <p class="err">&nbsp</p>
    <div>
        <label>Quy cách</label>
        <input type="text" name="QuyCach" id="pro_qc">
    </div>
    <p id="pro_qc_err" class="err">&nbsp</p>
    <div>
        <label>Giá</label>
        <!-- min = 0 chỉ cho phép số dương -->
        <input type="number" min="0" name="Gia" id="pro_g">
    </div>        
    <p id="pro_g_err" class="err">&nbsp</p>
    <div>
        <label>Số lượng</label>
        <input type="number" min="0" name="SoLuongHang" id="pro_sl">
    </div>
    <p id="pro_sl_err" class="err">&nbsp</p>
    <div>
        <label>Ghi chú</label>
        <textarea name="GhiChu"></textarea>
    </div>
    <p class="err">&nbsp</p>
    <button type="submit">Thêm</button>
</form>

<script>
    /* #region  Kiểm tra hợp lệ */
    
    // Kiểm tra hợp lệ của các trường
    let pro_nam = document.getElementById("pro_nam");
    let pro_qc = document.getElementById("pro_qc");
    let pro_g = document.getElementById("pro_g");
    let pro_sl = document.getElementById("pro_sl");

    onload = ()=>{
        pro_qc.addEventListener("keyup", function()
        {
            validQC();
        });
        pro_nam.addEventListener("keyup", function()
        {
            validName();
        });
        pro_g.addEventListener("keyup", function()
        {
            validG();
        });
        pro_sl.addEventListener("keyup", function()
        {
            validSL();
        });
    };

    function isValid() {
        // Nếu không hợp lệ
        let valid = validName() && validQC() && validG() && validSL();
        if (!valid) {
            event.preventDefault();
        }
    }

    function validQC()
    {
        if(pro_qc.value === "")
        {
            pro_qc_err.textContent = "Quy cách không được bỏ trống";
        }
        else if(!/^\d\--?\d*\.?\d*$/.test(pro_qc.value))
        {
            pro_qc_err.textContent = "Định dạng không hợp lệ (mét - mét/kg)";
        }
        else {
            pro_qc_err.textContent = '\xa0';
            return true;
        }

        return false;
    }

    function validName() {
        if (pro_nam.value === "") {
            pro_nam_err.textContent = "Tên hàng hóa không được bỏ trống";
        } else {
            pro_nam_err.textContent = '\xa0';
            return true;
        }

        return false;
    }

    function validG() {
        if (pro_g.value === "") {
            pro_g_err.textContent = "Giá không được bỏ trống";
        } else {
            pro_g_err.textContent = '\xa0';
            return true;
        }

        return false;
    }

    function validSL() {
        if (pro_sl.value === "") {
            pro_sl_err.textContent = "Số lượng không được bỏ trống";
        } else {
            pro_sl_err.textContent = '\xa0';
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

        $exist = false;
        foreach ($items as $key => $value) {
            if(strtolower($value["TenHH"]) === strtolower($_POST["TenHH"]))
            {
                echo '<script>noti.textContent="Hàng hóa đã tồn tại"</script>';
                $exist=true;
                break;
            }
        }

        // Kiểm tra không tồn tại mới thêm
        if(!$exist){
            $item = $_POST;
            $item["MSHH"] = $items[count($items)-1]["MSHH"]+1;
            $items[] = $item;
            echo '<script>alert("Thêm thành công");</script>';
        }
        
        var_dump($items);
    }
?>