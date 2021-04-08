<?php
abstract class DAO
{

    public $servername;
    public $database;
    public $username;
    public $password;

    // Create connection
    public $cnn;

    public function __construct($servername = "localhost", $username = "root", $password = "", $database = "quanlydathang")
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->cnn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        // Check connection
        if ($this->cnn->connect_error) {
            die("Connection failed: " . $this->cnn->connect_error);
        }
    }
}

/* #region  Item DAO */
class ItemDAO extends DAO
{

    // Lấy ra danh sách hàng hóa
    public function getAllItem()
    {
        $sql = "SELECT hh.*, lhh.TenLoaiHangHoa TenLoai FROM HangHoa hh, LoaiHangHoa lhh
                WHERE hh.MaLoaiHang = lhh.MaLoaiHangHoa;";
        $stmt = $this->cnn->query($sql);

        $items = [];

        while ($r = $stmt->fetch_assoc()) {
            $items[] = $r;
        }

        return $items;
    }

    // Lấy ra loại hàng
    public function getAllItemType()
    {
        $sql = "SELECT * FROM LoaiHangHoa;";
        $stmt = $this->cnn->query($sql);

        $items = [];

        while ($r = $stmt->fetch_assoc()) {
            $items[] = $r;
        }

        return $items;
    }

    // Lấy ra hàng hóa theo id
    public function getItemById($id)
    {
        $sql = "SELECT hh.*, lhh.TenLoaiHangHoa TenLoai FROM HangHoa hh, LoaiHangHoa lhh
                WHERE hh.MaLoaiHang = lhh.MaLoaiHangHoa AND hh.MSHH = ?;";

        $stmt = $this->cnn->prepare($sql);

        $stmt->bind_param("i", $id);


        if ($stmt->execute()) {
            $item = $stmt->get_result()->fetch_assoc();
        }

        return $item;
    }

    // Cập nhật hàng hóa
    public function updateItem($item)
    {
        $sql = "UPDATE HangHoa
                    SET TenHH = ?,
                    MaLoaiHang = ?,
                    QuyCach = ?,
                    Gia = ?,
                    SoLuongHang = ?,
                    Location = ?,
                    GhiChu = ?
                WHERE MSHH = ?
        ;";

        $stmt = $this->cnn->prepare($sql);

        $stmt->bind_param(
            "sisdissi",
            $item["TenHH"],
            $item["MaLoaiHang"],
            $item["QuyCach"],
            $item["Gia"],
            $item["SoLuongHang"],
            $item["Location"],
            $item["GhiChu"],
            $item["MSHH"]
        );

        return $stmt->execute();
    }

    // Thêm hàng hóa
    public function addItem($item)
    {
        $sql = "INSERT INTO HangHoa(TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang, Location, GhiChu) 
                VALUES(?, ?, ?, ?, ?, ?, ?);";

        $stmt = $this->cnn->prepare($sql);

        $stmt->bind_param(
            "ssdiiss",
            $item["TenHH"],
            $item["QuyCach"],
            $item["Gia"],
            $item["SoLuongHang"],
            $item["MaLoaiHang"],
            $item["Location"],
            $item["GhiChu"]
        );

        return $stmt->execute();
    }

    // Xóa hàng hóa 
    public function deleteItem($id)
    {
        $sql = "DELETE FROM HangHoa WHERE MSHH = ?;";

        $stmt = $this->cnn->prepare($sql);

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}
/* #endregion */

class DatHangDAO extends DAO
{
    public function getDSDatHang()
    {
        $sql = "SELECT dt.SoDonDH, kh.HoTenKH, kh.Email, kh.SoDienThoai, ct.GiaDatHang, ct.GiamGia, hh.TenHH FROM HangHoa as hh, ChiTietDathang as ct, Dathang as dt, KhachHang as kh
                WHERE hh.MSHH = ct.MSHH AND ct.SoDonDH = dt.SoDonDH AND dt.MSKH = kh.MSKH;";
        $stmt = $this->cnn->query($sql);

        $items = [];

        while ($r = $stmt->fetch_assoc()) {
            $items[] = $r;
        }

        return $items;
    }

    public function getHD($SoDonDH)
    {
        $sql = "SELECT * FROM LoaiHangHoa as l, HangHoa as hh, ChiTietDathang as ct, Dathang as dt, KhachHang as kh
                WHERE l.MaLoaiHangHoa = hh.MaLoaiHang AND hh.MSHH = ct.MSHH AND ct.SoDonDH = dt.SoDonDH AND dt.MSKH = kh.MSKH
                AND dt.SoDonDH = ?;";
         $stmt = $this->cnn->prepare($sql);

         $stmt->bind_param("i", $SoDonDH);
 
 
         if ($stmt->execute()) {
             $item = $stmt->get_result()->fetch_assoc();
         }
 
         return $item;
    }
}

// Cửa hàng sắt
// Loại - Tên lấy từ csdl
// Quy cách chiều dài(mét)-cân nặng(kg)/mét
// Giá vnd đồng
$dao = new DatHangDAO();
// var_dump($dao->getDSDatHang());
// var_dump($dao->getItemById("10 OR 1=1 --"));

// $items = $dao->getAllItem();
// $types = $dao->getAllItemType();
/*SELECT kh.HoTenKH, kh.Email, kh.SoDienThoai, ct.GiaDatHang, ct.GiamGia, hh.TenHH FROM HangHoa as hh, ChiTietDathang as ct, Dathang as dt, KhachHang as kh
WHERE hh.MSHH = ct.MSHH AND ct.SoDonDH = dt.SoDonDH AND dt.MSKH = kh.MSKH;  */

/* #region  Dummy */
$typess = [
    "h" => "Hộp",
    "vu" => "Vuông",
    "i" => "I",
    "o" => "Ống",
    "v" => "V",
    "l" => "La",
    "v-l" => "V Lỗ"
];

static $Items = [
    [
        "MSHH" => "1",
        "TenHH" => "Hộp 5-10",
        "QuyCach" => "6-2.35",
        "Gia" => "350.000",
        "SoLuongHang" => "200",
        "TenLoai" => "Hộp",
        "GhiChu" => ""
    ],
    [
        "MSHH" => "2",
        "TenHH" => "Vuông-4",
        "QuyCach" => "6-1.25",
        "Gia" => "111.800",
        "SoLuongHang" => "100",
        "TenLoai" => "Vuông",
        "GhiChu" => "",
    ],
    [
        "MSHH" => "3",
        "TenHH" => "I-100",
        "QuyCach" => "6-9.46",
        "Gia" => "635.000",
        "SoLuongHang" => "50",
        "TenLoai" => "I",
        "GhiChu" => ""
    ],
    [
        "MSHH" => "4",
        "TenHH" => "Ống-34",
        "QuyCach" => "6-1.1",
        "Gia" => "96.000",
        "SoLuongHang" => "150",
        "TenLoai" => "Ống",
        "GhiChu" => ""
    ],
    [
        "MSHH" => "5",
        "TenHH" => "V-4",
        "QuyCach" => "6-0.7",
        "Gia" => "146.200",
        "SoLuongHang" => "120",
        "TenLoai" => "V",
        "GhiChu" => ""
    ],
    [
        "MSHH" => "6",
        "TenHH" => "La-3",
        "QuyCach" => "3-0.7",
        "Gia" => "19.000",
        "SoLuongHang" => "50",
        "TenLoai" => "La",
        "GhiChu" => ""
    ],
    [
        "MSHH" => "7",
        "TenHH" => "V4-Lỗ",
        "QuyCach" => "3-0.5",
        "Gia" => "30.000",
        "SoLuongHang" => "50",
        "TenLoai" => "V Lỗ",
        "GhiChu" => ""
    ]
];
/* #endregion */
$item = $Items[0];
$item["MaLoaiHang"] = "1";
$item["TenHH"] = "Vuông-5";
$item["Location"] = "h-5x10.jpg";
$item["Gia"] = 350001;
// $item["QuyCach"] = "6x3.2";

// var_dump($item);
// var_dump($dao->deleteItem(2));
// var_dump($dao->addItem($item));
// var_dump($dao->getItemById(8));
