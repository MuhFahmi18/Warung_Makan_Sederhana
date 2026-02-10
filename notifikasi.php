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
    <div class="container">
        <div class="row">
            <div class="col-10 offset-1">
                <h4 class="font-weight-bold text-center mt-2 mb-5">Notifikasi</h4>
                <a href="daftar_menu.php" class="btn btn-secondary mb-2 mt-2">kembali</a>
                <table class="table">
                    <thead>
                        <tr>

                            <th scope="col">Waktu</th>
                            <th scope="col">Aksi</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php if (mysqli_num_rows($notifikasi) > 0) : ?>
                            <?php while ($n = mysqli_fetch_assoc($notifikasi)) : ?>
                                <tr>
                                    <td><?= $n["waktu"]; ?></td>
                                    <td><?= $n["aksi"]; ?></td>
                                    <td><?= $n["keterangan"]; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada notifikasi</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>