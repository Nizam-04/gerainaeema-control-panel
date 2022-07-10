<?php
  require 'functions.php';

  // Cek apakah tombol submit sudah ditekan atau belum
  if(isset($_POST["submit"])) {
    

    // Cek apakah data berhasil ditambahkan atau tidak
    if(tambah($_POST) > 0) {
      echo "
        <script>
          alert('Data berhasil ditambahkan!');
          document.location.href = 'index.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data gagal ditambahkan!');
          document.location.href = 'index.php';
        </script>
      ";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerainaeema | Tambah Produk</title>
</head>
<body>
  <h1>Tambah Produk</h1>

  <form action="" method="post" enctype="multipart/form-data">
    <ul>
      <li>
        <label for="kategori">Kategori : </label>
        <input type="text" name="kategori" id="kategori">
      </li>
      <li>
        <label for="nama">Nama : </label>
        <input type="text" name="nama" id="nama" required>
      </li>
      <li>
        <label for="deskripsi">Deskripsi : </label>
        <input type="text" name="deskripsi" id="deskripsi">
      </li>
      <li>
        <label for="harga">Harga : </label>
        <input type="text" name="harga" id="harga" required>
      </li>
      <li>
        <label for="gambar">Gambar : </label>
        <input type="file" name="gambar" id="gambar">
      </li>
      <li>
        <button type="submit" name="submit">Tambah</button>
      </li>
    </ul>
  </form>
</body>
</html>