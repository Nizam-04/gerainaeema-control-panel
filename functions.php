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

    // Upload gambar
    $gambar = upload();
    if(!$gambar) {
      return false;
    }

    $query = "INSERT INTO products
                VALUES
              ('', '$kategori', '$nama', '$deskripsi', '$harga', '$gambar')
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah tidak ada gambar yang diupload
    if($error === 4) {
      echo "<script>
                alert('Pilih gambar terlebih dahulu!');
            </script>";
      return false;
    }

    // Cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'jpe', 'jfif', 'bmp', 'heif', 'webp', 'svg'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      echo "<script>
              alert('Yang anda upload bukan gambar!');
            </script>";
      return false;
    }

    // Cek jika ukurannya terlalu besar
    if($ukuranFile > 1000000) {
      echo "<script>
              alert('Ukuran gambar terlalu besar! (Max. 1MB)');
            </script>";
      return false;
    }

    // Lolos pengecekkan, gambar siap diupload
    // Generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
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
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // Cek apakah user pilih gambar baru atau tidak
    if($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarLama;
    } else {
      $gambar = upload();
    }

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

  function cari($keyword) {
    $query = "SELECT * FROM products
                WHERE
              kategori LIKE '%$keyword%' OR
              nama LIKE '%$keyword%' OR
              deskripsi LIKE '%$keyword%' OR
              harga LIKE '%$keyword%'
            ";
    return query($query);
  }

  function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // Cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)) {
      echo "<script>
              alert('Username sudah terdaftar!');
            </script>";
      return false;
    }

    // Cek konfirmasi password
    if($password !== $password2) {
      echo "<script>
              alert('Konfirmasi password tidak sesuai!');
            </script>";
      return false;
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
  }
?>