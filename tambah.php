<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tambah Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
</head>

<body>
  <div class="container">
    <form action="" method="post">
      <div class="mb-3">
        <label class="form-label">Nama Pemilik</label>
        <input type="text" class="form-control" name="nama" id="tnama" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Nama Hewan</label>
        <input type="text" class="form-control" name="hewan" id="thewan" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Jenis Hewan</label>
        <input type="text" class="form-control" name="jenis" id="tjenis" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Jenis Kelamin </label>
        <input type="text" class="form-control" name="kelamin" id="tkelamin" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Datang</label>
        <input type="text" class="form-control" name="datang" id="tdatang" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Diambil</label>
        <input type="text" class="form-control" name="ambil" id="tambil" required />
      </div>

  </div>

  <div class="mb-3">
    <button type="submit" id="submit" name="submit" class="btn btn-primary">
      Tambah Data
    </button>
    <a href="index.php" type="button" class="btn btn-danger  btn">Kembali</a>
  </div>
  </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>