<?php 
class DAO{

    public $servername = "localhost";
    public $database = "quanlydathang";
    public $username = "root";
    public $password = "";
    
    // Create connection
    public $cnn;
    
    public function __construct()
    {
        $this->cnn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        // Check connection
        if ($this->cnn->connect_error) {
            die("Connection failed: " . $this->cnn->connect_error);
        }
    }

    public function getAllItem(){
        $sql = "SELECT hh.*, lhh.TenLoaiHangHoa TenLoai FROM HangHoa hh, LoaiHangHoa lhh
                WHERE hh.MaLoaiHang = lhh.MaLoaiHangHoa;";
        $rs = $this->cnn->query($sql);
        
        $items = [];
        
        while($r = $rs->fetch_assoc())
        {
            $items[] = $r;
        }

        return $items;
    }
}

// $dao = new DAO();

// var_dump($dao->getAllItem());
// $items = $dao->getAllItem();
// $rs = $dao->cnn->query("SELECT * FROM usr;");
// $rS=[];
// while($r = $rs->fetch_assoc())    
//     $rS[]=$r;
// var_dump($rS);   

// Cửa hàng sắt
// Loại - Tên lấy từ csdl
// Quy cách chiều dài(mét)-cân nặng(kg)/mét
// Giá vnd đồng
$imgs = [
    "src/img/h-5x10.jpg",
    "src/img/vu-4.jpg",
    "src/img/i-100.jpg",
    "src/img/ong-34.jpg",
    "src/img/v-4.jpg",
    "src/img/la-3.jpg",
    "src/img/v-lo.jpg"
];

$types = [
    "h" => "Hộp",
    "vu" => "Vuông",
    "i" => "I",
    "o" => "Ống",
    "v" => "V",
    "l" => "La",
    "v-l" => "V Lỗ"
];

$items = [
    [
        "MSHH"=> "1",
        "TenHH"=> "Hộp 5-10",
        "QuyCach"=> "6-2.35",
        "Gia"=> "350.000",
        "SoLuongHang" => "200",
        "TenLoai"=>"Hộp",
        "GhiChu"=>""
    ],
    [
        "MSHH"=> "2",
        "TenHH"=> "Vuông-4",
        "QuyCach"=> "6-1.25",
        "Gia"=> "111.800",
        "SoLuongHang" => "100",
        "TenLoai"=>"Vuông",
        "GhiChu"=>"",
    ],
    [
        "MSHH"=> "3",
        "TenHH"=> "I-100",
        "QuyCach"=> "6-9.46",
        "Gia"=> "635.000",
        "SoLuongHang" => "50",
        "TenLoai"=>"I",
        "GhiChu"=>""
    ],
    [
        "MSHH"=> "4",
        "TenHH"=> "Ống-34",
        "QuyCach"=> "6-1.1",
        "Gia"=> "96.000",
        "SoLuongHang" => "150",
        "TenLoai"=>"Ống",
        "GhiChu"=>""
    ],
    [
        "MSHH"=> "5",
        "TenHH"=> "V-4",
        "QuyCach"=> "6-0.7",
        "Gia"=> "146.200",
        "SoLuongHang" => "120",
        "TenLoai"=>"V",
        "GhiChu"=>""
    ],
    [
        "MSHH"=> "6",
        "TenHH"=> "La-3",
        "QuyCach"=> "3-0.7",
        "Gia"=> "19.000",
        "SoLuongHang" => "50",
        "TenLoai"=>"La",
        "GhiChu"=>""
    ],
    [
        "MSHH"=> "7",
        "TenHH"=> "V4-Lỗ",
        "QuyCach"=> "3-0.5",
        "Gia"=> "30.000",
        "SoLuongHang" => "50",
        "TenLoai"=>"V Lỗ",
        "GhiChu"=>""
    ]
];
?>


