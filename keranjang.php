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
    if (tambahKeranjang($_POST) > 0) {
        echo "<script>
            alert('data berhasil ditambah!');
            document.location.href = 'daftar_menu.php';
          </script>";
    } else {
        echo "<script>
            alert('data gagal ditambah!');
            document.location.href = 'daftar_menu.php';
          </script>";
    }
}


$keranjang = mysqli_query($conn, "SELECT * FROM keranjang");
$meja = mysqli_query($conn, "SELECT * FROM view_meja_tidak_kosong");

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">

    <title>Yummy</title>
</head>

<body>
    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <h1 class="display-4"><span class="font-weight-bold">Yummy Restaurant</span></h1>
            <hr>
            <p class="lead font-weight-bold">Enjoy Your Healthy<br>Delicious Food :)<br></p>

        </div>
    </div>
    <!-- Akhir Jumbotron -->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg  bg-secondary">
        <div class="container">
            <a class="navbar-brand text-white" href="index.php">Yummy Restaurant</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link mr-4" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-4" href="daftar_menu.php">MENU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-4" href="meja.php">MEJA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-4" href="pesanan.php">PESANAN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-4" href="kasir.php">KASIR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-4" href="keranjang.php">KERANJANG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-4" href="logout.php">LOGOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="card-body" style="background-color: #fff;">
            <H2 class="font-weight-bold text-center mb-3 mt-3">Keranjang Pesan</H2>
            <form action="" method="post">
                <div class="row">
                    <div class="col-6">
                        <div class="col-xl-6 mb-3">
                            <label for="" class="form-label">Masukan Nama Pelanggan</label>
                            <input type="text" name="nama" id="" class="form-control">
                        </div>
                        <div class="col-xl-12 mb-3">
                            <label for="" class="form-label">Pilih Meja</label> <br>
                            <select name="meja" id="meja" class="form-select" aria-label="Default select example">
                                <?php if (mysqli_num_rows($meja) > 0) : ?>
                                    <?php while ($m = mysqli_fetch_assoc($meja)) : ?>
                                        <option value="<?= $m['id_meja']; ?>">Meja nomor <?= htmlspecialchars($m['nomor_meja']) ?> (kap. <?= $m["kapasitas"]; ?> orang)</option>
                                    <?php endwhile; ?>

                                <?php else : ?>
                                    <option value="">Tidak ada meja kosong</option>
                                <?php endif; ?>

                            </select>
                        </div>
                        <?php if (mysqli_num_rows($keranjang) > 0) : ?>
                            <div class="col-12 mb-3 d-flex align-content-center justify-content-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Menu</th>
                                            <th>jumlah</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php while ($p = mysqli_fetch_assoc($keranjang)) : ?>
                                            <tr>
                                                <td><?= $p["nama_menu"]; ?></td>
                                                <td><?= $p["jumlah"]; ?></td>
                                                <td><?= $p["harga"]; ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                        <?php
                                        $totalharga = query("SELECT * FROM view_total_harga_keranjang")[0];
                                        ?>
                                        <tr>
                                            <td colspan="2">Total yang harus dibayar : </td>
                                            <td><input type="text" name="total" value="<?= $totalharga["total_harga"]; ?>" readonly></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6">
                                <button type="submit" name="submit" class="btn btn-primary">check out</button>
                                <a href="kasir.php" class="btn btn-secondary">kembali</a>
                            </div>
                        <?php else : ?>
                            <div class="col-6 mb-3">Tidak ada produk dimasukan</div>
                            <div class="col-6"><a href="kasir.php" class="btn btn-secondary">kembali</a></div>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
</body>

</html>