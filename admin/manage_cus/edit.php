<?php
    $title = "Chỉnh sửa hàng hóa";
    $path = $_SERVER['DOCUMENT_ROOT']."/CT428_WEB";
    require_once "$path/layouts/header-ad.php";
    require $_PATH["dao"];

     // Nếu không có id
     if(!isset($_GET["id"]))
     {
         $err = $_PATH["err"];
         header("Location: $err", true);
     }
 
      // Lấy ra sản phẩm theo id
      $id = $_GET["id"]-1;
      $item = $items[$id];
      // Lấy ra hình
      $img = $imgs[$id];
?>

<!-- Xử lý POST -->
<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && strpos($_SERVER['PHP_SELF'], "edit")) {
        // Cập nhật thông tin
        $items[$id]["TenHH"] = $_POST["TenHH"];
        $items[$id]["TenLoai"] = $_POST["TenLoai"];
        $items[$id]["QuyCach"] = $_POST["QuyCach"];
        $items[$id]["Gia"] = $_POST["Gia"];
        $items[$id]["SoLuongHang"] = $_POST["SoLuongHang"];
        $items[$id]["GhiChu"] = $_POST["GhiChu"];
        var_dump($_POST);
        // header("Location: manage_pro.php");
    }
?>

<h1>Chỉnh Sửa Hàng Hóa</h1>
<hr>

<form class="dk" method="POST" action="edit.php?id=<?php echo $item["MSHH"];?>" onsubmit="isValid()">
    <div>
        <label>Tên hàng hóa</label>
        <input type="text" name="TenHH" id="pro_nam" value="<?php echo $item["TenHH"]; ?>">
    </div>
    <p id="pro_nam_err" class="err">&nbsp</p>
    <!-- Loại nên là dropdown box -->
    <div>
        <lable>Loại</lable>
        <select name="TenLoai">
            <?php
                $Key = array_search($item["TenLoai"], $types);
                echo sprintf('<option value="%s">%s</option>', $Key, $item["TenLoai"]);
                foreach ($types as $key => $value) {
                    if($key !== $Key)
                    {
                        echo sprintf('<option value="%s">%s</option>', $key, $value);
                    }
                }
            ?>
        </select>
    </div>
    <p class="err">&nbsp</p>
    <div>
        <label>Quy cách</label>
        <input type="text" name="QuyCach" id="pro_qc" value="<?php echo $item["QuyCach"]; ?>">
    </div>
    <p id="pro_qc_err" class="err">&nbsp</p>
    <div>
        <label>Giá</label>
        <!-- min = 0 chỉ cho phép số dương -->
        <input type="number" min="0" name="Gia" id="pro_g" value="<?php echo $item["Gia"]; ?>">
    </div>        
    <p id="pro_g_err" class="err">&nbsp</p>
    <div>
        <label>Số lượng</label>
        <input type="number" min="0" name="SoLuongHang" id="pro_sl" value="<?php echo $item["SoLuongHang"]; ?>">
    </div>
    <p id="pro_sl_err" class="err">&nbsp</p>
    <div>
        <label>Ghi chú</label>
        <textarea name="GhiChu"><?php echo $item["GhiChu"]; ?></textarea>
    </div>
    <p class="err">&nbsp</p>
    <button class="btn" type="submit">Sửa</button>
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
    <a href="delete.php?id=<?php echo $item["MSHH"]; ?>"><h3>Xóa hàng hóa</h3></a>
    <a href="manage.php"><h3>Về trang quản lý</h3></a>
</div>
<?php
    require_once $_PATH["footer"];
?>
