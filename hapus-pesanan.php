<?php

require 'config.php';

$id = $_GET["id"];

if (hapusPesanan($id) > 0) {
    echo "<script>
            alert('data berhasil dihapus!');
            document.location.href = 'pesanan.php';
          </script>";
} else {
    echo "<script>
            alert('data gagal dihapus!');
            document.location.href = 'pesanan.php';
          </script>";
}
