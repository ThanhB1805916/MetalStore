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
INSERT INTO NhanVien(HoTenNV, ChucVu, DiaChi, SoDienThoai)
VALUES(N'THANH Vương', 'Quản lý', '733 NTT NK, CT', '123456789');
INSERT INTO NhanVien(HoTenNV, ChucVu, DiaChi, SoDienThoai)
VALUES(N'Alex Vương', 'Quản lý', '933 NTT NK, CT', '123456788');

-- Đặt hàng
INSERT INTO DatHang(MSKH, MSNV)
VALUES('1', '1');

-- Chi tiết đặt hàng
INSERT INTO ChiTietDatHang(SoDonDH, MSHH, GiaDatHang, GiamGia)
VALUES('1', '1', '35000000', '0.2');