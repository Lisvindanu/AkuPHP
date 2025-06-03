<?php

session_start();

if (!isset($_SESSION["submit"])) {
    header("Location: login.php");
}
// koneksi ke dbms
$conn = mysqli_connect("localhost:3306", "root", "", "tubes");
require 'functions.php';

// ambil data di url
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$brg = query("SELECT * FROM items WHERE id = $id")[0];

//cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {




    // cek apakah data berhasil di ubah atau tidak
    if (ubah($_POST) > 0) {
        echo "
           <script> 
            alert('data berhasil diubah!');
            document.location.href = 'admin.php';
           </script>
        ";
    } else
        echo "<script>
    alert('data gagal diubah!);
    document.location.href = 'admin.php';
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Metro 4 -->
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4.3.2/css/metro-all.min.css">
    <!-- MyCSS -->
    <link rel="stylesheet" href="../assets/css/tambahdata.css">


    <title>ubah data </title>
</head>

<body style="background-color:  #f1d302ff;;">
    <section class="add-product">
        <div class="container">
            <div class="grid">
                <div class="btn-cancel">
                    <a href="admin.php" onclick="return confirm('Apakah anda yakin ingin kembali?')"><i class="fas fa-times"></i></a>
                </div>
                <div class="row">
                    <div class="cell-10 offset-1">
                        <div class="title">
                            <p>Form Change Data</p>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $brg["id"] ?>">
                            <input type="hidden" name="gambarLama" value="<?= $brg["gambar"]; ?>">
                            <div class="field">
                                <label for="nama">Name : </label>
                                <input type="text" name="nama" id="nama" required value="<?= $brg["nama"] ?>">
                            </div>
                            <div class="field">
                                <label for="brand">brand : </label>
                                <input type="text" name="brand" id="brand" required value="<?= $brg["brand"] ?>">
                            </div>
                            <div class="field">
                                <label for="harga">Price : </label>
                                <input type="text" name="harga" id="harga" required value="<?= $brg["harga"] ?>">
                            </div>
                            <div class="field">
                                <label for="kategori">Kategori : </label>
                                <input type="text" name="kategori" id="kategori" value="<?= $brg["kategori"] ?>">
                            </div>
                            <div class="field">
                                <label for="detail">Detail : </label>
                                <input type="text" name="detail" id="detail" value="<?= $brg["detail"] ?>">
                            </div>
                            <div class="field">
                                <label for="gambar">Picture : </label> <br>
                                <input type="file" name="gambar" id="gambar" onchange="previewImage()">

                                <img src="../assets/img/<?= $brg["gambar"]; ?>" style=" display:block; align-items: center;" class="img-preview w-50">
                            </div>
                            <button type="submit" name="submit" class="button success outline w-100">Change Data!</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>





</body>
<!-- FontAwesome -->
<script src="https://kit.fontawesome.com/6dd84d01cb.js" crossorigin="anonymous"></script>
<!-- Metro - 4 -->
<script src="https://cdn.metroui.org.ua/v4.3.2/js/metro.min.js"></script>
<script src="../js/script.js"></script>

</html>