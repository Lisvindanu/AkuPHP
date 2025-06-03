<?php

// melakukan query 

require 'functions.php';
$id = $_GET["id"];
$brg = query("SELECT * FROM items WHERE id = $id")[0];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/tabel.css">


    <link rel="stylesheet" href="../assets/css/navbwah.css" />
    <link rel="stylesheet" href="../assets/css/slider.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body style="background-color:#FCBC94 ;">
    <?php include('../tambahanlain/navatasuser.php') ?>
    <!-- Navbar -->

    <style>
        <?php include('../assets/css/slider.css') ?>
    </style>
    <!-- Navbar end -->
    <section class="detail-product " style="margin-top: 45px !important;">
        <div class="container ">
            <div class="row">
                <div class="col-6">

                    <div class="detail mt-2">
                        <h3 class="nama-sep atu "><?= $brg['brand'] ?> <?= $brg['nama'] ?></h3>

                        <img width="50%" src="../assets/img/<?= $brg["gambar"]; ?>" alt="" style="margin: auto;">
                        <!--  -->
                    </div>

                </div>
                <div class="col-6">

                    <div class="detail mt-5">
                        <h6>Brand : <?= $brg['brand'] ?></h6>

                        <h6>Price : Rp.<?= $brg['harga'] ?></h6>

                        <form method="POST" action="keranjang.php">
                            <input type="hidden" name="item_id" value="<?= $brg['id'] ?>">
                            <?php if (isset($brg['kategori_id'])) : ?>
                                <input type="hidden" name="kategori_id" value="<?= $brg['kategori_id'] ?>">
                            <?php endif; ?>
                            <button type="submit" name="tambah_keranjang" class="btn btn-primary mt-2">Tambahkan ke Keranjang</button>
                        </form>
                        <div class="mt-5">

                            <a href="user.php" class="text-right"><button class="btn btn-success"> Tambahkan item lagi?</button> </a>
                        </div>
                    </div>

                </div>
            </div>


        </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include('../tambahanlain/futer.php') ?>
    <?php include('../tambahanlain/navbarhp.php') ?>
    <!-- fontawesome icon -->
    <script src="https://kit.fontawesome.com/6dd84d01cb.js" crossorigin="anonymous"></script>
    <!-- My Script -->
    <script src="js/script.js"></script>
    <!-- Metro - 4 -->
    <script src="https://cdn.metroui.org.ua/v4.3.2/js/metro.min.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>