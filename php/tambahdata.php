<?php
session_start();

if (!isset($_SESSION["submit"])) {
    header("Location: login.php");
}
$conn = mysqli_connect("localhost:3306", "root", "password", "tubes");
require 'functions.php';

//cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {





    // cek apakah data berhasil di tambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "
           <script> 
            alert('data berhasil ditambahkan!');
            document.location.href = 'admin.php';
           </script>
        ";
    } else
        echo "<script>
    alert('data gagal ditambahkan!);
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
    <title>Add product</title>
    <!-- MyCSS -->
    <link rel="stylesheet" href="../assets/css/tambahdata.css">
    <!-- Metro 4 -->
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4.3.2/css/metro-all.min.css">

    <!-- Icon -->
    <link rel="icon" href="../assets/img/logo-color.png">
</head>

<body style="background-color: #FCBC94;">
    <section class="add-product">
        <div class="container">
            <div class="grid">
                <div class="btn-cancel">
                    <a href="admin.php" onclick="return confirm('Apakah anda yakin ingin kembali?')"><i class="fas fa-times"></i></a>
                </div>
                <div class="row">
                    <div class="cell-10 offset-1">
                        <div class="title">
                            <p>Form Add Product</p>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="field">
                                <!-- Form nama -->
                                <label for="nama">Product Name</label>
                                <input type="text" data-role="input" name="nama" id="nama" require>
                            </div>
                            <div class="field">
                                <!-- Form Brand -->
                                <label for="brand">Brand</label>
                                <input type="text" data-role="input" name="brand" id="brand" require>
                            </div>
                            <div class="field">
                                <!-- Form Brand -->
                                <label for="detail">Detail</label>
                                <input type="text" data-role="input" name="detail" id="detail" require>
                            </div>

                            <div class="field">
                                <!-- Form Harga -->
                                <label for="harga">Price</label>
                                <input type="number" data-role="input" name="harga" id="harga" class="mb-1" data-prepend="<span class='mif-dollar2'></span>" title="">
                            </div>
                            <div class="field">
                                <!-- Form Kategori -->
                                <label for="kategori">Category</label>
                                <input type="text" data-role="input" name="kategori" id="kategori" required>
                            </div>
                            <div class="field">
                                <!-- Form Gambar -->
                                <label for="gambar">Picture</label>
                                <input type="file" name="gambar" class="gambar" onchange="previewImage()" required>

                                <img src="../assets/img/nophoto.png" style="display:block; align-items: center;" class="img-preview w-50">
                            </div>




                            <button type="submit" name="submit" class="button success outline w-100">
                                Add Product
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/6dd84d01cb.js" crossorigin="anonymous"></script>
    <!-- Metro - 4 -->
    <script src="https://cdn.metroui.org.ua/v4.3.2/js/metro.min.js"></script>
    <script src="../js/script.js"></script>


</body>

</html>