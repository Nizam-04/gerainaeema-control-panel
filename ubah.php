<?php
  require 'functions.php';

  // Ambil data di URL
  $id = $_GET["id"];

  // query data products berdasarkan id
  $pro = query("SELECT * FROM products WHERE id = $id")[0];

  // Cek apakah tombol submit sudah ditekan atau belum
  if(isset($_POST["submit"])) {
    

    // Cek apakah data berhasil diubah atau tidak
    if(ubah($_POST) > 0) {
      echo "
        <script>
          alert('Data berhasil diubah!');
          document.location.href = 'index.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data gagal diubah!');
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
  <title>Gerainaeema | Ubah Produk</title>
</head>
<body>
  <h1>Ubah Produk</h1>

  <form action="" method="post">
    <input type="hidden" name="id" value="<?= $pro["id"]; ?>">
    <ul>
      <li>
        <label for="kategori">Kategori : </label>
        <input type="text" name="kategori" id="kategori" value="<?= $pro["kategori"]; ?>">
      </li>
      <li>
        <label for="nama">Nama : </label>
        <input type="text" name="nama" id="nama" required value="<?= $pro["nama"]; ?>">
      </li>
      <li>
        <label for="deskripsi">Deskripsi : </label>
        <input type="text" name="deskripsi" id="deskripsi" value="<?= $pro["deskripsi"]; ?>">
      </li>
      <li>
        <label for="harga">Harga : </label>
        <input type="text" name="harga" id="harga" required value="<?= $pro["harga"]; ?>">
      </li>
      <li>
        <label for="gambar">Gambar : </label>
        <input type="text" name="gambar" id="gambar" value="<?= $pro["gambar"]; ?>">
      </li>
      <li>
        <button type="submit" name="submit">Ubah</button>
      </li>
    </ul>
  </form>
</body>
</html>