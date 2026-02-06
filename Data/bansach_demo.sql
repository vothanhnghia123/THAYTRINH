
-- ================= VAI TRO =================
CREATE TABLE VaiTro (
    IDVaiTro INT AUTO_INCREMENT PRIMARY KEY,
    TenVaiTro VARCHAR(50) NOT NULL
);

-- ================= NGUOI DUNG =================
CREATE TABLE NguoiDung (
    IDNguoiDung INT AUTO_INCREMENT PRIMARY KEY,
    HoTen VARCHAR(100) NULL,
    Email VARCHAR(100) NULL,
    MatKhau VARCHAR(255) NOT NULL,
    DienThoai VARCHAR(15) NULL,
    DiaChi VARCHAR(255) NULL,
    IDVaiTro INT NOT NULL,
    FOREIGN KEY (IDVaiTro) REFERENCES VaiTro(IDVaiTro)
);

-- ================= DANH MUC =================
CREATE TABLE DanhMuc (
    IDDanhMuc INT AUTO_INCREMENT PRIMARY KEY,
    TenDanhMuc VARCHAR(100) NOT NULL
);

-- ================= THE LOAI =================
CREATE TABLE TheLoai (
    IDTheLoai INT AUTO_INCREMENT PRIMARY KEY,
    TenTheLoai VARCHAR(100) NOT NULL,
    IDDanhMuc INT NOT NULL,
    FOREIGN KEY (IDDanhMuc) REFERENCES DanhMuc(IDDanhMuc)
);

-- ================= NHA XUAT BAN =================
CREATE TABLE NhaXuatBan (
    IDNXB INT AUTO_INCREMENT PRIMARY KEY,
    TenNXB VARCHAR(150) NOT NULL,
    DiaChi VARCHAR(255) NULL,
    DienThoai VARCHAR(15) NULL
);

-- ================= TAC GIA =================
CREATE TABLE TacGia (
    IDTacGia INT AUTO_INCREMENT PRIMARY KEY,
    TenTacGia VARCHAR(150) NOT NULL,
    TieuSu TEXT NULL
);

-- ================= SACH =================
CREATE TABLE Sach (
    IDSach INT AUTO_INCREMENT PRIMARY KEY,
    TenSach VARCHAR(200) NOT NULL,
    IDTheLoai INT NOT NULL,
    IDNXB INT NOT NULL,
    IDTacGia INT NOT NULL,
    GiaBan DECIMAL(12,2) NOT NULL,
    SoLuong INT NOT NULL,
    MoTa TEXT NULL,
    HinhAnh VARCHAR(255) NULL,
    NamXB INT NULL,
    NgayNhap DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (IDTheLoai) REFERENCES TheLoai(IDTheLoai),
    FOREIGN KEY (IDNXB) REFERENCES NhaXuatBan(IDNXB),
    FOREIGN KEY (IDTacGia) REFERENCES TacGia(IDTacGia)
);

-- ================= DON HANG =================
CREATE TABLE DonHang (
    IDDonHang INT AUTO_INCREMENT PRIMARY KEY,
    IDNguoiDung INT NOT NULL,
    NgayDat DATETIME DEFAULT CURRENT_TIMESTAMP,
    TongTien DECIMAL(14,2) NOT NULL,
    TrangThai VARCHAR(50) NULL,
    FOREIGN KEY (IDNguoiDung) REFERENCES NguoiDung(IDNguoiDung)
);

-- ================= CHI TIET DON HANG =================
CREATE TABLE ChiTietDonHang (
    IDCTDH INT AUTO_INCREMENT PRIMARY KEY,
    IDDonHang INT NOT NULL,
    IDSach INT NOT NULL,
    SoLuong INT NOT NULL,
    DonGia DECIMAL(12,2) NOT NULL,
    FOREIGN KEY (IDDonHang) REFERENCES DonHang(IDDonHang),
    FOREIGN KEY (IDSach) REFERENCES Sach(IDSach)
);

-- ================= DANH GIA =================
CREATE TABLE DanhGia (
    IDDanhGia INT AUTO_INCREMENT PRIMARY KEY,
    IDSach INT NOT NULL,
    IDNguoiDung INT NOT NULL,
    SoSao INT CHECK (SoSao BETWEEN 1 AND 5),
    NoiDung TEXT NULL,
    NgayDanhGia DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (IDSach) REFERENCES Sach(IDSach),
    FOREIGN KEY (IDNguoiDung) REFERENCES NguoiDung(IDNguoiDung)
);
