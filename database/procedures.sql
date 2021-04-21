-- Thủ tục thêm hóa đơn

DELIMITER $$

/* Mã khách hàng, mã nhân viên, ngày giao, mã hàng, số lượng, giá, giảm giá*/
CREATE OR REPLACE PROCEDURE spDatHang (mkh CHAR(10) , mnv INT, ng DATE, mh INT, sl INT, g DECIMAL(15,2), gg DECIMAL(2, 2))
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