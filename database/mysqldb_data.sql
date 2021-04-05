-- Vương Cẩm Thanh B1805916
USE Quanlydathang;

-- Loại hàng hóa
INSERT INTO LoaiHangHoa (TenLoaiHangHoa) 
VALUES('Hộp');
INSERT INTO LoaiHangHoa (TenLoaiHangHoa) 
VALUES('Vuông');
INSERT INTO LoaiHangHoa (TenLoaiHangHoa) 
VALUES('I');
INSERT INTO LoaiHangHoa (TenLoaiHangHoa) 
VALUES('Ống');
INSERT INTO LoaiHangHoa (TenLoaiHangHoa) 
VALUES('V');
INSERT INTO LoaiHangHoa (TenLoaiHangHoa) 
VALUES('La');
INSERT INTO LoaiHangHoa (TenLoaiHangHoa) 
VALUES('V Lỗ');

-- Hàng hóa
INSERT INTO HangHoa(TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang, GhiChu)
VALUES('Hộp 5-10','6-2.35','350000','200','1','');
INSERT INTO HangHoa(TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang, GhiChu)
VALUES('Vuông-4','6-1.25','111800','100','2','');
INSERT INTO HangHoa(TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang, GhiChu)
VALUES('I-100','6-9.46','635000','50','3','');
INSERT INTO HangHoa(TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang, GhiChu)
VALUES('Ống-34','6-1.1','96000','150','4','');
INSERT INTO HangHoa(TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang, GhiChu)
VALUES('V-4','6-0.7','146200','120','5','');
INSERT INTO HangHoa(TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang, GhiChu)
VALUES('La-3','3-0.7','19000','50','6','');
INSERT INTO HangHoa(TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang, GhiChu)
VALUES('V4-Lỗ','3-0.5','30000','50','7','');

-- Địa chỉ
INSERT INTO DiaChiKH(DiaChi, MSKH)
VALUES();

-- Nhân viên
INSERT INTO NhanVien(HoTenNV, ChucVu, DiaChi, SoDienThoai)
VALUES();

-- Đặt hàng
INSERT INTO DatHang(MSKH, MSNV)
VALUES();

-- Chi tiết đặt hàng
INSERT INTO ChiTietDatHang(SoDonDH, MSHH, GiaDatHang)
VALUES();