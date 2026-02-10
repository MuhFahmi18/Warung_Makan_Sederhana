<?php

require 'config.php';

$id = $_GET["id"];

if (masukKeranjang($id) > 0) {
    echo "<script>
            alert('data berhasil ditambah!');
            document.location.href = 'kasir.php';
          </script>";
} else {
    echo "<script>
            alert('data gagal ditambah!');
            document.location.href = 'kasir.php';
          </script>";
}
