<?php
  require 'functions.php';
  $products = query("SELECT * FROM products");

  // Tombol cari ditekan
  if(isset($_POST["cari"])) {
    $products = cari($_POST["keyword"]);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerainaeema | Halaman Admin</title>
  <style>
    body {
      font-family: sans-serif;
      display: flex;
      justify-content: center;
    }

    .container {
      max-width: 1200px;
      text-align: center;
      padding: 15px;
      border: 1px solid gray;
      border-radius: 15px;
      box-shadow: 0 25px 45px rgba(0, 0, 0, 0.5);
      text-decoration: none;
      color: black;
    }

    a {
      text-decoration: none;
      color: black;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Daftar Produk</h1>

    <a href="tambah.php">Tambah Produk</a>
    <br><br>

    <form action="" method="post">
      <input type="text" name="keyword" size="40" autofocus placeholder="Masukkan keyword pencarian..." autocomplete="off">
      <button type="submit" name="cari">Cari</button>
    </form>
    <br>

    <table border="1" cellpadding="10" cellspacing="0">

      <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>Kategori</th>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Harga</th>
      </tr>

      <?php $i = 1; ?>
      <?php foreach($products as $row) : ?>
      <tr>
        <td><?= $i; ?></td>
        <td>
          <a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a><br><br>
          <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
        </td>
        <td><img src="img/<?= $row["gambar"]; ?>" alt="" width="50"></td>
        <td><?= $row["kategori"]; ?></td>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["deskripsi"]; ?></td>
        <td><?= $row["harga"]; ?></td>
      </tr>
      <?php $i++; ?>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>