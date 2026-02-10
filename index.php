<?php

session_start();
// meminta session
if (!isset($_SESSION["id_admin"])) {
  echo "<script>alert('Silahkan Login Terlebih Dahulu Untuk Masuk!');
          window.location.href = 'login.php';
          </script>";
  exit;
}

$notifikasi = mysqli_query($conn, "SELECT * FROM view_notifikasi_terbaru");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="index.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <title>Yummy Restaurant</title>
</head>

<body>

  <!-- Jumbotron -->
  <div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
      <h1 class="display-4 font-weight-bold">Yummy Restaurant</h1>
      <hr>
      <p class="lead font-weight-bold">Enjoy Your Healthy<br>Delicious Food :)<br></p>
    </div>
  </div>
  <!-- Akhir Jumbotron -->

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
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
  <!-- Akhir Navbar -->

  <!-- Menu -->
  <div class="container">
    <div class="judul text-center mt-5">
      <h3 class="font-weight-bold">Yummy Restaurant</h3>
      <h5>Jl. Gurita No.l, Sesetan, Kec. Denpasar Sel., Kota Denpasar, Bali 80223<br>Buka Jam <strong>09:00 - 21:00</strong><br>Nomor Telp : <strong>081236336612 / 081236336613 / 0895390003267</strong></h5>
    </div>

    <div class="row mb-5 mt-5">
      <div class="col-md-6 d-flex justify-content-end">
        <div class="card bg-dark text-white border-light">
          <img src="images/background/menu2.jpg" class="card-img" alt="Lihat Daftar Menu">
          <div class="card-img-overlay mt-5 text-center">
            <a href="daftar_menu.php" class="btn btn-primary">LIHAT DAFTAR MENU</a>
          </div>
        </div>
      </div>

      <div class="col-md-6 d-flex justify-content-start">
        <div class="card bg-dark text-white border-light">
          <img src="images/background/menu3.jpg" class="card-img" alt="Lihat Pesanan">
          <div class="card-img-overlay mt-5 text-center">
            <a href="pesanan.php" class="btn btn-primary">LIHAT PESANAN</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Menu -->

  <!-- Awal Footer -->
  <div class="footer">
    <div class="container">
      <div class="row footer-body">
        <div class="col-md-6">
          <div class="copyright">
            <strong>Copyright</strong> <i class="far fa-copyright"></i> 2024 - Designed by Syafira & Tyas
          </div>
        </div>

        <div class="col-md-6 d-flex justify-content-end">
          <div class="icon-contact">
            <label class="font-weight-bold">Follow Us</label>
            <a href="#"><img src="images/icon/fb.png" class="mr-3 ml-4" data-toggle="tooltip" title="Facebook"></a>
            <a href="#"><img src="images/icon/ig.png" class="mr-3" data-toggle="tooltip" title="Instagram"></a>
            <a href="#"><img src="images/icon/twitter.png" class="" data-toggle="tooltip" title="Twitter"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Footer -->

  <!-- Optional JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>