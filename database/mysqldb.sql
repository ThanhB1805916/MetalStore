-- Vương Cẩm Thanh B1805916
CREATE OR REPLACE DATABASE Quanlydathang;
USE Quanlydathang;

-- Loại Hàng Hóa
CREATE TABLE LoaiHangHoa
(
	MaLoaiHangHoa INT AUTO_INCREMENT PRIMARY KEY, -- Mã loại hàng hóa
	TenLoaiHangHoa NVARCHAR(30) NOT NULL -- Tên loại hàng hóa
);

-- Hàng hóa
CREATE TABLE HangHoa
(
	MSHH INT AUTO_INCREMENT PRIMARY KEY, -- Mã hàng hóa
	TenHH NVARCHAR(30) NOT NULL, -- Tên hàng hóa
	QuyCach CHAR(7) NOT NULL, -- Quy cách 000X000
	Gia DECIMAL(15, 2) NOT NULL, -- Giá thành
	SoLuongHang INT NOT NULL, -- Số lượng hàng hóa
	MaLoaiHang INT NOT NULL, -- Mã loại hàng hóa khóa ngoại
	FOREIGN KEY (MaLoaiHang) REFERENCES LoaiHangHoa(MaLoaiHangHoa),
	Location VARCHAR(128), -- Lưu địa chỉ hình ảnh
	GhiChu NVARCHAR(128) -- Ghi chú thêm về hàng hóa
);

-- Khách hàng
CREATE TABLE KhachHang
(
	MSKH INT AUTO_INCREMENT PRIMARY KEY, -- Mã khách hàng
	HoTenKH NVARCHAR(50) NOT NULL, -- Họ tên khách hàng
	TenCongTy NVARCHAR(30), -- Tên công ty
	SoDienThoai CHAR(10) NOT NULL UNIQUE, -- Số điện thoại
	Email VARCHAR(50) NOT NULL UNIQUE -- Email
);

-- Địa chỉ khách hàng
CREATE TABLE DiaChiKH
(
	MaDC INT AUTO_INCREMENT PRIMARY KEY, -- Mã địa chỉ
	DiaChi NVARCHAR(30) NOT NULL, -- Địa chỉ
	MSKH INT NOT NULL, -- Mã khách hàng khóa ngoại
	FOREIGN KEY (MSKH) REFERENCES KhachHang(MSKH)
);

-- Nhân viên
CREATE TABLE NhanVien(
	MSNV INT AUTO_INCREMENT PRIMARY KEY, -- Mã nhân viên
	HoTenNV NVARCHAR(30) NOT NULL, -- Họ tên nhân viên
	ChucVu NVARCHAR(30), -- Chức vụ
	DiaChi NVARCHAR(30) NOT NULL, -- Địa chỉ
	SoDienThoai CHAR(10) NOT NULL UNIQUE -- Số điện thoại
);

-- Đặt hàng
CREATE TABLE DatHang
(
	SoDonDH INT AUTO_INCREMENT PRIMARY KEY, -- Số đơn đặt hàng ??
	MSKH INT NOT NULL, -- Mã khách hàng
 	FOREIGN KEY (MSKH) REFERENCES KhachHang(MSKH),
	MSNV INT NOT NULL, -- Mã nhân viên
	FOREIGN KEY (MSNV) REFERENCES NhanVien(MSNV),
	NgayDH DATE NOT NULL DEFAULT NOW(), -- Ngày đặt hàng
	NgayGH DATE NOT NULL DEFAULT NOW() CHECK(NgayDH <= NgayGH) -- Ngày giao hàng
);

-- Chi tiết đặt hàng
CREATE TABLE ChiTietDatHang
(
	SoDonDH INT NOT NULL, -- Số đơn đặt hàng
 	FOREIGN KEY (SoDonDH) REFERENCES DatHang(SoDonDH),
	MSHH INT NOT NULL, -- Mã hàng hóa
	FOREIGN KEY (MSHH) REFERENCES HangHoa(MSHH),
	SoLuong INT NOT NULL DEFAULT 1, -- Số lượng hàng hóa
	GiaDatHang DECIMAL(15,2) NOT NULL, -- Đơn giá
	GiamGia DECIMAL(2,2), -- Giảm giá
	-- Khóa chính
	PRIMARY KEY(SoDonDH, MSHH)
);

USE Quanlydathang;

-- Trigger kiểm tra số lượng trong chi tiết đặt hàng <= số lượng hàng trong bảng hàng hóa
DELIMITER $$
CREATE OR REPLACE TRIGGER INSERT_ChiTietDatHang
BEFORE INSERT ON ChiTietDatHang
FOR EACH ROW
BEGIN
	DECLARE sl_hh INT; -- Số lượng hàng hóa
	SELECT HH.SoLuongHang INTO sl_hh FROM HangHoa AS HH
	WHERE NEW.MSHH = HH.MSHH;
	
	IF NEW.SoLuong > sl_hh
	THEN
		SIGNAL SQLSTATE '45000'
   		SET MESSAGE_TEXT = 'so luong trong chi tiet dat hang > so luong trong bang hang hoa';
	END IF;
END $$

-- Vương Cẩm Thanh B1805916