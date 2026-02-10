CREATE DATABASE db_warungmakan
USE db_warungmakan

-- Tabel Pelanggan
CREATE TABLE Pelanggan (
    ID_Pelanggan INT PRIMARY KEY,
    NamaPelanggan VARCHAR(50) NOT NULL,
    NoTelepon VARCHAR(20),
    Pendapatan DECIMAL (10,2),
    TotalPendapatan DECIMAL (10,2)
);
-- Isi Tabel Pelanggan
INSERT INTO Pelanggan (ID_Pelanggan, NamaPelanggan, NoTelepon, Pendapatan, TotalPendapatan) VALUES
    (1, 'Andi Pratama', '081234567890',50000, 100000),
    (2, 'Naila Sari', '082345678901', 45000, 95000),
    (3, 'Aldo Wijaya', '083456789012', 70000, 110000),
    (4, 'Alika Jastinia', '084567890123', 60000, 120000),
    (5, 'Hasan Amir', '085678901234', 40000, 90000);
    
-- Tabel Pembayaran
CREATE TABLE Pembayaran (
    ID_Pembayaran INT PRIMARY KEY,
    TanggalPembayaran DATE NOT NULL,
    JumlahPembayaran DECIMAL(10,2) NOT NULL,
    ID_Pelanggan INT,
    FOREIGN KEY(ID_Pelanggan) REFERENCES Pelanggan(ID_Pelanggan)
);
-- Isi Tabel Pembayaran
INSERT INTO Pembayaran (ID_Pembayaran, TanggalPembayaran, JumlahPembayaran, ID_Pelanggan) VALUES
    (1, '2023-06-01', 50000, 1),
    (2, '2023-06-02', 75000, 2),
    (3, '2023-06-03', 30000, 3),
    (4, '2023-06-04', 60000, 4),
    (5, '2023-06-05', 45000, 5);

-- Tabel Kategori
CREATE TABLE Kategori (
    ID_Kategori INT PRIMARY KEY,
    NamaKategori VARCHAR(50) NOT NULL,
    JumlahMenu INT
);
-- Isi Tabel Kaegori
INSERT INTO Kategori (ID_Kategori, NamaKategori, JumlahMenu) VALUES
    (1, 'Makanan Utama', 8),
    (2, 'Minuman', 5),
    (3, 'Dessert', 4),
    (4, 'Snack', 5),
    (5, 'Vegetarian', 6);
    
-- Tabel Menu
CREATE TABLE Menu (
    ID_Menu INT PRIMARY KEY,
    NamaMenu VARCHAR(100) NOT NULL,
    Deskripsi TEXT,
    Harga DECIMAL(10,2) NOT NULL,
    ID_Kategori INT,
    FOREIGN KEY (ID_Kategori) REFERENCES Kategori(ID_Kategori)
);
-- Isi Tabel Menu
INSERT INTO Menu (ID_Menu, NamaMenu, Deskripsi, Harga, ID_Kategori) VALUES
    (1, 'Nasi Goreng', 'Nasi goreng dengan campuran sayuran dan daging ayam', 20000, 1),
    (2, 'Es Teh Manis', 'Minuman teh manis segar', 5000, 2),
    (3, 'Pisang Goreng', 'Pisang goreng dengan taburan gula halus', 10000, 3),
    (4, 'Keripik Singkong', 'Keripik singkong renyah dan gurih', 8000, 4),
    (5, 'Sayur Asem', 'Sayur asem dengan campuran sayuran segar', 15000, 5);
    
 -- Tabel PesananDetail
CREATE TABLE DetailPesanan (
    ID_DetailPesanan INT PRIMARY KEY,
    HargaSatuan DECIMAL(10,2) NOT NULL,
    TotalHarga DECIMAL(10,2) NOT NULL,
    Kuantitas INT NOT NULL,
    ID_Pembayaran INT,
    FOREIGN KEY (ID_Pembayaran) REFERENCES Pembayaran(ID_Pembayaran),
    ID_Menu INT,
    FOREIGN KEY (ID_Menu) REFERENCES Menu(ID_Menu)
);
-- Isi Tabel PesananDetail
INSERT INTO DetailPesanan (ID_DetailPesanan, ID_Pembayaran, ID_Menu, Kuantitas, HargaSatuan, TotalHarga) VALUES
    (1, 1, 1, 2, 20000, 40000),
    (2, 1, 2, 1, 5000, 5000),
    (3, 2, 3, 3, 10000, 30000),
    (4, 2, 4, 2, 8000, 16000),
    (5, 3, 5, 1, 15000, 15000);

-- VIEWS
1.
CREATE VIEW TotalPembayaranPelanggan AS 
SELECT 
    Pelanggan.NamaPelanggan, 
    SUM(Pembayaran.JumlahPembayaran) AS TotalPembayaran
    FROM 
	Pelanggan
    JOIN 
	Pembayaran ON Pelanggan.ID_Pelanggan = Pembayaran.ID_Pelanggan
    GROUP BY 
	Pelanggan.NamaPelanggan;

SELECT * FROM TotalPembayaranPelanggan;

2.
CREATE VIEW DetailPesananView AS
SELECT 
    DetailPesanan.ID_DetailPesanan, 
    Pembayaran.TanggalPembayaran, 
    Pelanggan.NamaPelanggan, 
    Menu.NamaMenu, 
    DetailPesanan.Kuantitas, 
    DetailPesanan.HargaSatuan, 
    DetailPesanan.TotalHarga
    FROM 
	DetailPesanan
    JOIN 
	Pembayaran ON DetailPesanan.ID_Pembayaran = Pembayaran.ID_Pembayaran
    JOIN 
	Pelanggan ON Pembayaran.ID_Pelanggan = Pelanggan.ID_Pelanggan
    JOIN 
	Menu ON DetailPesanan.ID_Menu = Menu.ID_Menu;

SELECT * FROM DetailPesananView;

3.
CREATE VIEW MenuPalingSeringDipesan AS
SELECT 
    Menu.NamaMenu, 
    SUM(DetailPesanan.Kuantitas) AS TotalDipesan
    FROM 
	DetailPesanan
    JOIN 
	Menu ON DetailPesanan.ID_Menu = Menu.ID_Menu
    GROUP BY 
	Menu.NamaMenu
    ORDER BY 
	TotalDipesan DESC;

SELECT * FROM MenuPalingSeringDipesan;

4.
CREATE VIEW PendapatanPerKategori AS
SELECT 
    Kategori.NamaKategori, 
    SUM(DetailPesanan.TotalHarga) AS TotalPendapatan
    FROM 
	DetailPesanan
    JOIN 
	Menu ON DetailPesanan.ID_Menu = Menu.ID_Menu
    JOIN 
	Kategori ON Menu.ID_Kategori = Kategori.ID_Kategori
    GROUP BY 
	Kategori.NamaKategori;

SELECT * FROM PendapatanPerKategori;

5.
CREATE VIEW InformasiPembayaran AS
SELECT 
    Pembayaran.ID_Pembayaran, 
    Pembayaran.TanggalPembayaran, 
    Pembayaran.JumlahPembayaran, 
    Pelanggan.NamaPelanggan
    FROM 
	Pembayaran
    JOIN 
	Pelanggan ON Pembayaran.ID_Pelanggan = Pelanggan.ID_Pelanggan;

SELECT * FROM InformasiPembayaran;

-- STORED PROCEDURE ------
1. 
DELIMITER//
CREATE PROCEDURE Tambah_Menu (
    IN p_NamaMenu VARCHAR(100),
    IN p_Deskripsi TEXT,
    IN p_Harga DECIMAL(10,2),
    IN p_ID_Kategori INT
)
BEGIN
    INSERT INTO Menu (NamaMenu, Deskripsi, Harga, ID_Kategori)
    VALUES (p_NamaMenu, p_Deskripsi, p_Harga, p_ID_Kategori);
END//
DELIMITER;

CALL Tambah_Menu('Ayam Bakar', 'Ayam bakar dengan bumbu rempah', 25000, 1);
SELECT * FROM Menu;


2.
DELIMITER//
CREATE PROCEDURE sp_UpdatePelanggan (
    IN p_ID_Pelanggan INT,
    IN p_NamaPelanggan VARCHAR(50),
    IN p_NoTelepon VARCHAR(20),
    IN p_Pendapatan DECIMAL(10,2),
    IN p_TotalPendapatan DECIMAL(10,2)
   )
BEGIN
    UPDATE Pelanggan
    SET
        NamaPelanggan = p_NamaPelanggan,
        NoTelepon = p_NoTelepon,
        Pendapatan = p_Pendapatan,
        TotalPendapatan = p_TotalPendapatan
    WHERE
        ID_Pelanggan = p_ID_Pelanggan;
END//
DELIMITER;
CALL sp_UpdatePelanggan(1, 'Andi Pratama Baru', '089876543210', 55000, 105000);
SELECT * FROM Pelanggan
3.
DELIMITER //
CREATE PROCEDURE UpdateHargaMenu (
    IN p_ID_Kategori INT,
    IN p_PersenKenaikan DECIMAL(5,2)
)
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE v_ID_Menu INT;
    DECLARE v_Harga DECIMAL(10,2);
    
    DECLARE menuCursor CURSOR FOR 
        SELECT ID_Menu, Harga FROM Menu WHERE ID_Kategori = p_ID_Kategori;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    
    OPEN menuCursor;
    
    menu_loop: LOOP
        FETCH menuCursor INTO v_ID_Menu, v_Harga;
        
        IF done THEN
            LEAVE menu_loop;
        END IF;
        
        UPDATE Menu
        SET Harga = v_Harga + (v_Harga * p_PersenKenaikan / 100)
        WHERE ID_Menu = v_ID_Menu;
    END LOOP;
    CLOSE menuCursor;
END//
DELIMITER ;

SELECT * FROM Menu
CALL UpdateHargaMenu(4, 5.00);
SELECT * FROM Menu WHERE ID_Kategori = 4;


4. 
DELIMITER//
CREATE PROCEDURE TambahDetailPesanan (
    IN p_ID_Pembayaran INT,
    IN p_ID_Menu INT,
    IN p_Kuantitas INT,
    IN p_HargaSatuan DECIMAL(10,2)
)
BEGIN
    DECLARE totalPembayaran DECIMAL(10,2);
    DECLARE totalHarga DECIMAL(10,2);
    
    SET totalHarga = p_Kuantitas * p_HargaSatuan;
    
    SELECT JumlahPembayaran
    INTO totalPembayaran
    FROM Pembayaran
    WHERE ID_Pembayaran = p_ID_Pembayaran;
    
    IF totalPembayaran >= totalHarga THEN
        INSERT INTO DetailPesanan (ID_Pembayaran, ID_Menu, Kuantitas, HargaSatuan, TotalHarga)
        VALUES (p_ID_Pembayaran, p_ID_Menu, p_Kuantitas, p_HargaSatuan, totalHarga);
        
        UPDATE Pembayaran
        SET JumlahPembayaran = JumlahPembayaran - totalHarga
        WHERE ID_Pembayaran = p_ID_Pembayaran;
    END IF;
END//
DELIMITER;

SELECT * FROM DetailPesanan
CALL TambahDetailPesanan(1, 3, 2, 15000);
SELECT * FROM DetailPesanan WHERE ID_Pembayaran = 1;


5. 
DELIMITER //
CREATE PROCEDURE UpdateJumlahPembayaran (
    IN p_ID_Pelanggan INT,
    IN p_JumlahTambahan DECIMAL(10,2)
)
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE v_ID_Pembayaran INT;
    DECLARE v_JumlahPembayaran DECIMAL(10,2);
    
    DECLARE pembayaranCursor CURSOR FOR 
        SELECT ID_Pembayaran, JumlahPembayaran FROM Pembayaran WHERE ID_Pelanggan = p_ID_Pelanggan;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    
    OPEN pembayaranCursor;
    
    pembayaran_loop: LOOP
        FETCH pembayaranCursor INTO v_ID_Pembayaran, v_JumlahPembayaran;
        
        IF done THEN
            LEAVE pembayaran_loop;
        END IF;
        
        UPDATE Pembayaran
        SET JumlahPembayaran = v_JumlahPembayaran + p_JumlahTambahan
        WHERE ID_Pembayaran = v_ID_Pembayaran;
    END LOOP;
    
    CLOSE pembayaranCursor;
END//
DELIMITER ;

SELECT * FROM pembayaran
CALL UpdateJumlahPembayaran(1, 25000);
SELECT * FROM Pembayaran WHERE ID_Pelanggan = 1;



-- TRIGGER ------
1. 
DELIMITER //
CREATE TRIGGER tambah_jumlah_menu_kategori
AFTER INSERT ON Menu
FOR EACH ROW
BEGIN
    UPDATE Kategori
    SET JumlahMenu = JumlahMenu + 1
    WHERE ID_Kategori = NEW.ID_Kategori;
END //
DELIMITER;

-- contoh pengisian data
SELECT * FROM Kategori;
UPDATE Kategori SET NamaKategori = 'Makanan', JumlahMenu = 0 WHERE ID_Kategori = 1;

-- pemicu trigger

INSERT INTO Menu (ID_Menu, ID_Kategori, NamaMenu, Deskripsi, Harga) VALUES (7, 1, 'Es Campur','Minuman segar buah serta jelly didalamnya', 6000);
SELECT * FROM Menu;

SELECT * FROM Kategori;

2.
DELIMITER //
CREATE TRIGGER UpdateTotalPendapatanAfterUpdatePembayaran
AFTER UPDATE ON Pembayaran
FOR EACH ROW
BEGIN
    UPDATE Pelanggan
    SET TotalPendapatan = TotalPendapatan - OLD.JumlahPembayaran + NEW.JumlahPembayaran
    WHERE ID_Pelanggan = OLD.ID_Pelanggan;
END//
DELIMITER;

SELECT * FROM Pelanggan;
SELECT * FROM Pembayaran;

UPDATE Pembayaran
SET JumlahPembayaran = 70000
WHERE ID_Pembayaran = 1;

SELECT * FROM Pelanggan;


3.
DELIMITER //
CREATE TRIGGER UpdateJumlahMenuAfterDeleteMenu
AFTER DELETE ON Menu
FOR EACH ROW
BEGIN
    UPDATE Kategori
    SET JumlahMenu = JumlahMenu - 1
    WHERE ID_Kategori = OLD.ID_Kategori;
END//
DELIMITER;

SELECT * FROM Kategori;
SELECT * FROM Menu;

DELETE FROM Menu WHERE ID_Menu = 6;

SELECT * FROM Kategori;
