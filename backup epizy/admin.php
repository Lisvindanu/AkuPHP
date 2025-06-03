<?php
session_start();

if (!isset($_SESSION["submit"])) {
    header("Location: login.php");
    exit;
}

// Cek peran pengguna
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Pengguna bukan admin, tampilkan pesan atau arahkan ke halaman lain yang sesuai
    echo "Anda tidak memiliki akses ke halaman ini.";
    exit;
}

require 'functions.php';

// pagination 
// konfigurasi
$jumlahDataPerHalaman = 2;
$jumlahData = count(query("SELECT * FROM items"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
//  halaman = 2, awalData = 2
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// ketika tombol cari ditekan
if (isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];
    $items = cari($keyword);
} else {
    $items = query("SELECT * FROM items LIMIT $awalData, $jumlahDataPerHalaman");
}
?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/tabel.css">
    <link rel="stylesheet" href="../assets/css/navbwah.css" />
    <link rel="stylesheet" href="../assets/css/slider.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/adminhp.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        @media screen and (max-width: 600px) {
            .mobile {
                padding-top: 0px !important;
                margin-top: 0px !important;
                padding-bottom: 0px !important;
                color: red !important;
            }
        }
    </style>
</head>


<body>
    <?php include('../tambahanlain/navadmin.php') ?>

    <section class="admin mobile" style="margin-top:30px !important">



        <div class="container py-2 mobile tom " style="padding-top: 60px !important; ">
            <div class="row justify-content-between mobile">
                <div class="col-6 col-lg-2 px-4 py-5 mobile ">
                    <div class="tambah py-2">
                        <a class="btn btn-outline-danger px-3" role="button" href="../php/tambahdata.php">Add Product</a>
                    </div>

                </div>
                <div class="col-6 col-lg-2  py-5 mobile ">
                    <div class="cari">
                        <form action="" method="get">
                            <input type="text" name="keyword" class="keyword" placeholder="Cari disini.." data-role="input" autofocus>
                            <button type="submit" name="cari" class="button secondary outline tombol-cari"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered admin-container">

                <div class="row">
                    <div class="col-12">
                        <p class="text-center"><?php
                                                if (isset($_COOKIE["username"])) {
                                                    echo "Halo, " .  "<span id='ucapan_salam'></span> " . $_COOKIE["username"] . ". Selamat bekerja";
                                                } else {
                                                    echo "Selamat datang!";
                                                }
                                                ?></p>



                        <p class="text-center">Admin diharapkan memiliki waktu tidur yang cukup</p>
                    </div>
                </div>
        </div>

        <!-- navigasi -->



        <div class="section">
            <div class="container col-12 m-0 ">
                <div class="row">
                    <!-- Tombol "Backward" -->
                    <div class="col-12">
                        <?php if ($halamanAktif > 1) : ?>
                            <a href="?halaman=<?= $halamanAktif - 1; ?>" class="btn btn-outline-primary">&lt; </a>
                        <?php endif; ?>

                        <!-- Tautan Halaman -->
                        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                            <?php if ($i == $halamanAktif) : ?>
                                <a href="?halaman=<?= $i; ?>" style="font-weight:bold; color:red;"><?= $i; ?></a>
                            <?php else : ?>
                                <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                            <?php endif; ?>
                            <?php if ($i != $jumlahHalaman) : ?>
                                <span>&nbsp;</span> <!-- Tambahkan spasi di antara angka -->
                            <?php endif; ?>
                        <?php endfor; ?>

                        <!-- Tombol "Forward" -->
                        <?php if ($halamanAktif < $jumlahHalaman) : ?>
                            <a href="?halaman=<?= $halamanAktif + 1; ?>" class="btn btn-outline-primary"> &gt;</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>


        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Aksi</th>
                <th scope="col">Gambar</th>
                <th scope="col">Nama</th>
                <th scope="col">Brand</th>
                <th scope="col">Harga</th>
                <th scope="col">Kategori</th>
                <th scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($items as $brg) : ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td>
                        <a href="ubah.php?id=<?= $brg["id"]; ?>">ubah</a> |
                        <a href="hapus.php?id=<?= $brg["id"]; ?>" onclick="return confirm('yakin?')">hapus</a>
                    </td>
                    <td><img src="../assets/img/<?= $brg["gambar"]; ?>" alt="foto" style="width: 150px;"></td>
                    <td><?= $brg["nama"]; ?></td>
                    <td><?= $brg["brand"]; ?></td>
                    <td><?= $brg["harga"]; ?></td>
                    <td><?= $brg["kategori"]; ?></td>
                    <td><?= $brg["detail"]; ?></td>
                </tr>
            <?php
                $i++;
            endforeach ?>
        </tbody>
        </table>
        </div>



    </section>

    <!-- nav hp -->
    <?php include('../tambahanlain/navbarhp.php') ?>
    <!-- nav hp end -->

</body>
<script>
    // javascript untuk ucapan selamat (pagi, siang, sore, malam)
    function updateSalam() {
        var now = new Date();
        var hour = now.getHours();
        var salam;

        if (hour >= 4 && hour < 11) {
            salam = "Selamat pagi";
        } else if (hour >= 11 && hour < 14) {
            salam = "Selamat siang";
        } else if (hour >= 14 && hour < 18) {
            salam = "Selamat sore";
        } else {
            salam = "Selamat malam";
        }

        document.getElementById('ucapan_salam').innerHTML = salam;
        setTimeout(updateSalam, 3600000);
    }

    // Memanggil fungsi updateSalam untuk pertama kali
    updateSalam();
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://kit.fontawesome.com/6dd84d01cb.js" crossorigin="anonymous"></script>
<script src="../js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</html>