<?php
require 'functions.php';

// Ambil kategori yang dipilih dari parameter URL
$kategoriValue = $_GET['kategori'];

// Query untuk mendapatkan data berdasarkan kategori
if ($kategoriValue == 'all') {
    $query = "SELECT * FROM items";
} else {

    $query = "SELECT * FROM items WHERE kategori = '$kategoriValue'";
}

$kategori = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="assets/icon/—Pngtree—samurai mask japanese general warrior_6570760.png">
    <title>wibu</title>
    <!-- css bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100" rel="stylesheet" />
    <!-- cssku -->
    <link rel="stylesheet" href="../assets/css/navbwah.css" />
    <link rel="stylesheet" href="../assets/css/slider.css" />

    <!-- script font awesome kit-->
    <script src="https://kit.fontawesome.com/e18581a144.js" crossorigin="anonymous"></script>
</head>

<body style="background-color:#FCBC94;">
    <?php include('../tambahanlain/navkategori.php') ?>
    <!-- Navbar -->

    <style>
        <?php include('../assets/css/slider.css') ?>
    </style>
    <!-- Navbar end -->
    <div style=" padding-top: 120px; background:#FCBC94;" class="container-fluid ">
        <?php if ($kategoriValue == 'all') : ?>
            <h1 style="background: #FCBC94;">Kategori All</h1>

        <?php else : ?>
            <h1 style="background: #FCBC94; ">Kategori <?php echo $kategoriValue; ?></h1>
        <?php endif; ?>
    </div>

    <section id="cardkatalog" style="background-color:#FCBC94; padding-top:20px">
        <div class="container">
            <div class="row">
                <?php foreach ($kategori as $brg) : ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4 gambarnaik">
                        <a class="text-decoration-none" href="./detailitem.php?id=<?= $brg["id"] ?>">
                            <div class="card p-1" style="width: 20rem; background:#D5A3B8;">
                                <img src="../assets/img/<?= $brg['gambar'] ?>" alt="" style="width: 100%; height: 400px;" />
                                <div class="card-body">
                                    <h4 style="color: white;">
                                        <?= $brg['nama'] ?> <br />
                                        <br />
                                        <span style="font-size: 13px; color:white;"><?= $brg['detail']; ?></span>
                                    </h4>
                                    <p style="color:#F96204 !important;">Produk Terbaru</p>
                                    <div class="card-fasilitas">
                                        <h4 style="color: white;">Rp.<?= $brg['harga'] ?></h4>
                                        <p style="color:#F96204 !important;">&nbsp; Diskon</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <?php include('../tambahanlain/futer.php') ?>
    <?php include('../tambahanlain/navbarhp.php') ?>
</body>

</html>