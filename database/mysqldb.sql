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
	MSNV CHAR(5) PRIMARY KEY, -- Mã nhân viên
	Pwd CHAR(32), -- Mật khẩu
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
	MSNV CHAR(5) NOT NULL, -- Mã nhân viên
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

-- Vương Cẩm Thanh B1805916
USE Quanlydathang;

-- Loại hàng hóa
INSERT INTO LoaiHangHoa (TenLoaiHangHoa) 
VALUES(N'Hộp');
INSERT INTO LoaiHangHoa (TenLoaiHangHoa) 
VALUES(N'Vuông');
INSERT INTO LoaiHangHoa (TenLoaiHangHoa) 
VALUES(N'I');
INSERT INTO LoaiHangHoa (TenLoaiHangHoa) 
VALUES('Ống');
INSERT INTO LoaiHangHoa (TenLoaiHangHoa) 
VALUES('V');
INSERT INTO LoaiHangHoa (TenLoaiHangHoa) 
VALUES('La');
INSERT INTO LoaiHangHoa (TenLoaiHangHoa) 
VALUES('V Lỗ');

-- Hàng hóa
INSERT INTO HangHoa(TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang, Location, GhiChu) 
VALUES('Hộp 5-10','6-2.35','350000','200','1','h-5x10.jpg', '');
INSERT INTO HangHoa(TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang, Location, GhiChu) 
VALUES('Vuông-4','6-1.25','111800','100','2','vu-4.jpg','');
INSERT INTO HangHoa(TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang, Location, GhiChu) 
VALUES('I-100','6-9.46','635000','50','3','i-100.jpg', '') ;
INSERT INTO HangHoa(TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang, Location, GhiChu) 
VALUES('Ống-34','6-1.1','96000','150','4','ong-34.jpg', '') ;
INSERT INTO HangHoa(TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang, Location, GhiChu) 
VALUES('V-4','6-0.7','146200','120','5','v-4.jpg', '') ;
INSERT INTO HangHoa(TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang, Location, GhiChu) 
VALUES('La-3','3-0.7','19000','50','6','la-3.jpg', '') ;
INSERT INTO HangHoa(TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang, Location, GhiChu) 
VALUES('V4-Lỗ','3-0.5','30000','50','7','v-lo.jpg', '') ;

-- Khách hàng
INSERT INTO KhachHang(HoTenKH, TenCongTy, SoDienThoai, Email)
VALUES(N'Thanh Vương', 'Cty THHH Thanh Vương', '0123456789', 'thanh@gmail.com');
INSERT INTO KhachHang(HoTenKH, TenCongTy, SoDienThoai, Email)
VALUES(N'Alexander Vương', 'Cty THHH Thanh Vương', '0123456788', 'alex@gmail.com');

-- Địa chỉ
INSERT INTO DiaChiKH(DiaChi, MSKH)
VALUES('345 3/2 NK, CT', '1');
INSERT INTO DiaChiKH(DiaChi, MSKH)
VALUES('345 3/2 NK, CT', '2');

-- Nhân viên
-- pass = 123456
INSERT INTO NhanVien VALUES('NV001', '32c89ddc3fb0a3f86bf2c8a30037c793', N'THANH Vương', 'Quản lý', '733 NTT NK, CT', '123456789');
-- pass = 123456
INSERT INTO NhanVien VALUES('NV002', 'ed3b921e1065e707c9269e373c62306c', N'Alex Vương', 'Quản lý', '933 NTT NK, CT', '123456788');

-- Đặt hàng
INSERT INTO DatHang(MSKH, MSNV)
VALUES('1', 'NV001');

-- Chi tiết đặt hàng
INSERT INTO ChiTietDatHang(SoDonDH, MSHH, GiaDatHang, GiamGia)
VALUES('1', '1', '35000000', '0.2');

-- Thủ tục thêm hóa đơn
USE QuanLyDatHang;

DELIMITER $$

/* Mã khách hàng, mã nhân viên, ngày giao, mã hàng, số lượng, giá, giảm giá*/
CREATE OR REPLACE PROCEDURE spDatHang (mkh INT , mnv CHAR(5), ng DATE, mh INT, sl INT, g DECIMAL(15,2), gg DECIMAL(2, 2))
BEGIN    
	-- Transaction
	SET autocommit = 0;
    
    -- Lấy ra id đặt hàng
    SET @id = 0;
 	SELECT `AUTO_INCREMENT` INTO @id FROM INFORMATION_SCHEMA.TABLES
    WHERE TABLE_SCHEMA = 'quanlydathang' AND TABLE_NAME = 'dathang';
    
    -- Thêm vô bảng đặt hàng
    INSERT INTO DatHang(MSKH, MSNV, NgayGH) VALUES(mkh, mnv, ng);
    
    -- Thêm vô bảng chi tiết hàng hóa
    INSERT INTO ChiTietDatHang(SoDonDH, MSHH, SoLuong, GiaDatHang, GiamGia)
	VALUES(@id, mh, sl, g, gg);

    -- Cập nhật số lượng còn lại của hàng hóa
    -- Lấy ra số lượng hàng cũ
    SET @old_sl = 0;
    SELECT SoLuongHang INTO @old_sl FROM HangHoa WHERE MSHH = mh;
    UPDATE HangHoa SET SoLuongHang = @old_sl-sl WHERE MSHH = mh; 

    -- Lưu
    COMMIT;
END$$

DELIMITER ;

-- Xóa hóa đơn

DELIMITER $$

/* SoDonDH*/
CREATE OR REPLACE PROCEDURE spHuyDatHang (sddh INT)
BEGIN    
	-- Transaction
	SET autocommit = 0;

    -- Xóa chi tiết hàng hóa
    DELETE FROM ChiTietDatHang WHERE SoDonDH= sddh;


     -- Xóa đặt hàng
    DELETE  FROM DatHang WHERE SoDonDH= sddh;
    
    -- Lưu
    COMMIT;
END$$

DELIMITER ;

-- Thêm khách hàng

DELIMITER $$

/* Họ tên khách hàng, tên công ty, số điện thoại, email, địa chỉ*/
CREATE OR REPLACE PROCEDURE spAddKhachHang (HoTenKH NVARCHAR(50), TenCongTy NVARCHAR(30), SoDienThoai CHAR(10), Email VARCHAR(50), dc NVARCHAR(30))
BEGIN    
	-- Transaction
	SET autocommit = 0;
	
    -- Lấy ra mã khách hàng
    SET @mskh = 0;
    SELECT `AUTO_INCREMENT` INTO @mskh FROM INFORMATION_SCHEMA.TABLES
    WHERE TABLE_SCHEMA = 'quanlydathang' AND TABLE_NAME = 'khachhang';
    
    -- Thêm khách hàng
   	INSERT INTO KhachHang(HoTenKH, TenCongTy, SoDienThoai, Email)
	VALUES(HoTenKH, TenCongTy, SoDienThoai, Email);
    
    -- Thêm địa chỉ
    INSERT INTO DiaChiKH(DiaChi, MSKH) VALUES(dc, @mskh);
    
    -- Lưu
    COMMIT;
END$$

DELIMITER ;

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