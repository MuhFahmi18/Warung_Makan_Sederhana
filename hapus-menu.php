<?php

require 'config.php';

$id = $_GET["id"];

if (hapusMenu($id) > 0) {
    echo "<script>
            alert('data berhasil dihapus!');
            document.location.href = 'daftar_menu.php';
          </script>";
} else {
    echo "<script>
            alert('data gagal dihapus!');
            document.location.href = 'daftar_menu.php';
          </script>";
}
