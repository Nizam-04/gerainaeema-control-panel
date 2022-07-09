<?php
  require 'functions.php';
  $products = query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerainaeema | Halaman Admin</title>
  <style>
    
  </style>
</head>
<body>
  <h1>Daftar Produk</h1>

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
        <a href="">Ubah</a> |
        <a href="">Hapus</a>
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
</body>
</html>