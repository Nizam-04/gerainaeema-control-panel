<?php
  // Koneksi ke database
  $conn = mysqli_connect("localhost", "root", "", "gerainaeema");

  function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    return $rows;
  }

  function tambah($data) {
    global $conn;

    $kategori = htmlspecialchars($data["kategori"]);
    $nama = htmlspecialchars($data["nama"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $harga = htmlspecialchars($data["harga"]);
    $gambar = htmlspecialchars($data["gambar"]);

    $query = "INSERT INTO products
                VALUES
              ('', '$kategori', '$nama', '$deskripsi', '$harga', '$gambar')
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");

    return mysqli_affected_rows($conn);
  }

  function ubah($data) {
    global $conn;

    $id = $data["id"];
    $kategori = htmlspecialchars($data["kategori"]);
    $nama = htmlspecialchars($data["nama"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $harga = htmlspecialchars($data["harga"]);
    $gambar = htmlspecialchars($data["gambar"]);

    $query = "UPDATE products SET
                kategori = '$kategori',
                nama = '$nama',
                deskripsi = '$deskripsi', 
                harga = '$harga',
                gambar = '$gambar'
              WHERE id = $id
              ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }
?>