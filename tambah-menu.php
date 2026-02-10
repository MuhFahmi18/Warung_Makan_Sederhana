<?php

session_start();
// meminta session
if (!isset($_SESSION["id_admin"])) {
    echo "<script>alert('Silahkan Login Terlebih Dahulu Untuk Masuk!');
          window.location.href = 'login.php';
          </script>";
    exit;
}

require 'config.php';

if (isset($_POST["submit"])) {
    if (tambahMenu($_POST) > 0) {
        echo "<script>
            alert('data berhasil ditambah!');
            document.location.href = 'daftar_menu.php';
          </script>";
    } else {
        echo "<script>
            alert('data gagal dihapus!');
            document.location.href = 'daftar_menu.php';
          </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>tambah menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="hidden" class="form-control" id="id" />
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Menu</label>
                <input type="text" class="form-control" name="nama" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="text" class="form-control" name="harga" />
            </div>

            <div class="mb-3">
                <label for="kategori">Kategori</label>
                <select class="form-select" id="kategori" name="kategori">
                    <option value="makanan">Makanan</option>
                    <option value="minuman">Minuman</option>
                </select>

            </div>

            <div class="mb-3">
                <label for="kategori">Status</label>
                <select class="form-select" id="kategori" name="status">
                    <option value="tersedia">Tersedia</option>
                    <option value="habis">Habis</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="text" class="form-control" name="stok" />
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Masukan gambar</label>
                <input class="form-control" type="file" id="gambar" name="gambar">
            </div>

            <div class="mb-3">
                <button type="submit" id="submit" name="submit" class="btn btn-primary">
                    Simpan
                </button>
                <a href="index.php" type="button" class="btn btn-danger  btn">Kembali</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>