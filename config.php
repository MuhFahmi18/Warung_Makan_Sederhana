<?php

$conn = mysqli_connect('localhost', 'root', '', 'warungmakan');

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function hapusPesanan($id)
{
    global $conn;
    mysqli_query($conn, "CALL DeletePesanan($id)");
    return mysqli_affected_rows($conn);
}

function hapusMenu($id)
{
    global $conn;
    mysqli_query($conn, "CALL DeleteMenu($id)");
    return mysqli_affected_rows($conn);
}

function tambahMenu($data)
{
    global $conn;

    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $kategori = $_POST["kategori"];
    $status = $_POST["status"];
    $stok = $_POST["stok"];

    $gambar = upgambar();
    if (!$gambar) {
        return false;
    }

    $query = "CALL AddMenu('$nama', '$harga', '$kategori', '$status', '$stok', '$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubahMenu($data)
{
    global $conn;

    $id = $_POST["idMenu"];
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $kategori = $_POST["kategori"];
    $status = $_POST["status"];
    $stok = $_POST["stok"];
    $gambarLama = $_POST["gambarLama"];

    if ($_FILES["gambar"]["error"] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upgambar();
    }

    $query = "CALL UpdateMenu($id, '$nama', '$harga', '$kategori', '$status', '$stok', '$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upgambar()
{
    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    // cek apakah ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
            alert('Pilih gambar terlebih dahulu');
          </script>";
        return false;
    }

    // cek apakah yang diupload adlah gambar
    $ekstensiGambarValid = ["jpg", "jpeg", "png"];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
            alert('Yang anda upload bukan gambar!');
          </script>";
        return false;
    }

    // cek ukuran gambar
    if ($ukuranFile > 10000000) {
        echo "<script>
            alert('Ukuran gambar terlalu besar!');
          </script>";
        return false;
    }

    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // lolos pengecekan
    move_uploaded_file($tmpName, 'images/' . $namaFileBaru);

    return $namaFileBaru;
}

function masukKeranjang($id)
{
    global $conn;
    mysqli_query($conn, "CALL AddToKeranjang($id)");
    return mysqli_affected_rows($conn);
}

function tambahKeranjang($data)
{
    global $conn;

    $nama = $_POST["nama"];
    $meja = $_POST["meja"];
    $waktu = date("Y-m-d H:i:s");
    $totalHarga = $_POST["total"];

    $query = "CALL ProsesPesanan($meja, '$nama', '$waktu', $totalHarga)";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
