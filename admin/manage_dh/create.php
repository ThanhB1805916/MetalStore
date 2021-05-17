<?php
$title = "Thêm hóa đơn";
$path = $_SERVER['DOCUMENT_ROOT'] . "/CT428_WEB";
require_once "$path/layouts/header-ad.php";
require_once $_PATH["dao"];

//Khách hàng
$cdao = new KhacHangDAO() ;
$cstmrs = $cdao->getDSKhachHang();

// Sản phẩm
$idao = new ItemDAO();

// Lấy ra tên hàng với mã
$items = $idao->getAllItem();

// Lấy ra sản phẩm đầu
$item = $items[0];

 // Lấy ra hình
 $img = $_PATH["img"].$item["MSHH"]."/".$item["Location"];

?>

<style>
    h1 {
        color: #000;
    }
</style>

<h1>Thêm hóa đơn</h1>
<h3 id="noti" class="err"></h3>
<hr>
<!--  enctype="multipart/form-data" Để đọc file trong $_FILES khi post -->
<form class="dk" enctype="multipart/form-data" method="POST" action="create.php" onsubmit="isValid()">
    <div>
        <lable>Số điện thoại khách hàng</lable> 
        <input type="text" style="width: 40%" name="SoDienThoai" id="kh_sdt" minlength="10" maxlength="10" list="sdt_list">
        <datalist id="sdt_list">
            <?php 
                foreach ($cstmrs as $value) {
                    echo sprintf('<option value="%s">%s</option>', $value["SoDienThoai"], $value["SoDienThoai"]);
                }
            ?>
        </datalist>
    </div>
    <p id="kh_sdt_err" class="err">&nbsp</p>
    <div>
        <label>Tên hàng hóa</label>
        <select name="MaHang" onchange="updateItem()">
            <?php
            foreach ($items as $key => $value) {
                echo sprintf('<option value="%s">%s</option>', $value["MSHH"], $value["TenHH"]);
            }
            ?>
        </select>
    </div>
    <p class="err">&nbsp</p>
    <div>
        <label>Ảnh</label>
        <img id="pro_img" class=img-dis style="width:200px" src="<?php echo $img;?>">
    </div>
    <p class="err">&nbsp</p>
    <div>
        <label>Số lượng</label>
        <input type="number" min="0" max="<?php echo $item["SoLuongHang"]; ?>" name="SoLuongHang" id="pro_sl">
    </div>
    <p></p>
    <div>
        <lable>Còn lại</lable> 
        <label id="pro_rm" style="text-align: left; font-size:30px"><?php echo $item["SoLuongHang"]; ?></label>
    </div>
    <p id="pro_sl_err" class="err">&nbsp</p>
    <div>
        <label>Giá</label>
        <!-- min = 0 chỉ cho phép số dương -->
        <input type="number" min="0" name="Gia" id="pro_g">
    </div>
    <p id="pro_g_err" class="err">&nbsp</p>
    <div>
        <label>Giảm giá</label>
        <input type="number" step="0.01" min="0" max="1" name="GiamGia" id="pro_gg" style="width: 20%;">
    </div>
    <p id="pro_gg_err" class="err">&nbsp</p>
    <div>
        <label>Ngày giao</label> 
        <input type="date" name="NgayGiao" id="pro_gh" style="width: 50%;" required>
    </div>
    <p id="pro_gh_err" class="err">&nbsp</p>
    <div>
        <label>Tổng tiền</label> 
        <label id="pro_tt" style="text-align: left; font-size:30px">0 vnd.</label>
    </div>
    <p id="pro_gg_err" class="err">&nbsp</p>
    <button class="btn btn-1" type="submit">Thêm</button>
</form>

<script>
    // Danh sách sản phẩm
    const items = <?php echo json_encode($items) ?>;
    // Sản phẩm đang được chọn
    item = items[0];

    // Danh sách khách hàng
    const cstmrs = <?php echo json_encode($cstmrs) ?>;

    let kh_sdt = document.getElementById("kh_sdt"); 
    let pro_g = document.getElementById("pro_g");
    let pro_gg = document.getElementById("pro_gg");
    let pro_sl = document.getElementById("pro_sl");
    let pro_rm = document.getElementById("pro_rm");
    let pro_tt = document.getElementById("pro_tt");
    let pro_gh = document.getElementById("pro_gh");

    /* #region  Kiểm tra hợp lệ */

    // Kiểm tra hợp lệ của các trường

    onload = () => {
        kh_sdt.addEventListener("keyup", function() {
            validSDT();
        });
        pro_g.addEventListener("keyup", function() {
            validG();
        });
        pro_g.addEventListener("input", function() {
            validGG();
        });
        pro_gg.addEventListener("keyup", function() {
            validGG();
        });
        pro_sl.addEventListener("keyup", function() {
            validSL();
        });
        pro_sl.addEventListener("input", function() {
            updateNum();
        });
        pro_gh.addEventListener("input", function() {
            validGH();
        });
    };

    function isValid() {
        // Nếu không hợp lệ
        let valid = validSDT() && validG() && validSL() && validGH();
        if (!valid) {
            event.preventDefault();
        }
    }

    function validSDT() {
        if (kh_sdt.value === "") {
            kh_sdt_err.textContent = "Số điện thoại không hợp lệ";
        } else{
            let ex = false;
            for (let i = 0; i < cstmrs.length; i++) {
                if(cstmrs[i]["SoDienThoai"] === kh_sdt.value)
                {
                    ex = true;
                    break;
                }
            }

            if(!ex){
                kh_sdt_err.innerHTML = 'Số điện thoại không tồn tại vui lòng thêm khách hàng mới <a href="../manage_pro/create.php">tại đây.</a>';
            }
            else{  
                kh_sdt_err.textContent = '\xa0';
                return true;
            }
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

    // Thêm giảm giá
    function validGG() {
        if (pro_gg.value !== "" && pro_gg.value >= 0 && pro_gg.value <= 1) {
            // Cập nhật giá giảm
            pro_tt.textContent = pro_g.value*( 1 - pro_gg.value ) + " vnd.";
            
            return true;
        }
        else{
            
            pro_tt.textContent = pro_g.value + " vnd.";
        }

        return false;
    }

    function validSL() {
        if (pro_sl.value === "") {
            pro_sl_err.textContent = "Số lượng không được bỏ trống";
        }
        else if(item["SoLuongHang"] - pro_sl.value < 0){
            pro_sl_err.textContent = "Số lượng quá mức cho phép";
        } 
        else {
            pro_sl_err.textContent = '\xa0';
            return true;
        }

        return false;
    }

    function validGH(){
        var userEntered = new Date(pro_gh.value);
        var now = new Date();
        var today = new Date(Date.UTC(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate() ));
        if(userEntered.getTime() < today.getTime())
        {
            pro_gh_err.textContent = "Ngày không được nhỏ hơn hôm nay";

        }else{

            pro_gh_err.textContent = '\xa0';
            return true;
        }

        return false;
    }

    /* #endregion */
    
    /* #region  Cập nhật hàng */
    function updateItem() {
        let hang = document.getElementsByName("MaHang")[0];
        item = items[hang.value-1];
        pro_rm.textContent = item["SoLuongHang"];
        //Cập nhật hình
        img = <?php echo json_encode($_PATH["img"]); ?>+item["MSHH"]+"/"+item["Location"];
        document.getElementById("pro_img").src = img;
    }

    // Cập nhật số lượng
    function updateNum(){
        rm = item["SoLuongHang"] - pro_sl.value;
        if(rm >= 0)
        {
            pro_rm.textContent = rm;
            // Thêm giá
            pro_g.value = pro_sl.value*item["Gia"];

            // Cập nhật giá
            validGG();
        }
    }
    /* #endregion */
</script>

<div class="lnk">
    <a href="manage.php">
        <h3>Về trang quản lý</h3>
    </a>
</div>

<?php
require_once $_PATH["footer"];
?>

<!-- Xử lý POST -->
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && strpos($_SERVER['PHP_SELF'], "create") && isset($_POST)) {
    // Lấy ra khách hàng theo số điện thoại
    $sdt = $_POST["SoDienThoai"];

    // Lấy ra mã khách hàng
    $MSKH = 1;
    foreach ($cstmrs as $value) {
        if($value["SoDienThoai"] === $sdt){
            $MSKH = $value["MSKH"];
            break;
        }
    }
    
    $MSNV = $usr["MSNV"]; 
    $NgayGH = $_POST["NgayGiao"];
    $MSHH = $_POST["MaHang"]; 
    $SoLuongHang = $_POST["SoLuongHang"];
    $Gia = $_POST["Gia"];
    $GiamGia = $_POST["GiamGia"];

    $dao = new DatHangDAO();

    if ($dao->creHD($MSKH, $MSNV, $NgayGH, $MSHH, $SoLuongHang, $Gia, $GiamGia)) {
        echo "<script>alert('Thêm hóa đơn thành công');</script>";
    } else {
        echo "<script>alert('Lỗi vui lòng thử lại');</script>";
    }
}
?>