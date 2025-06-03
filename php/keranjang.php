<?php
session_start();
require 'functions.php';
$conn = mysqli_connect("localhost:3306", "root", "", "tubes");

// Cek apakah pengguna sudah login
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Pengecekan jika ada data item_id dan kategori_id dari form submission
if (isset($_POST['tambah_keranjang'])) {
    // Panggil fungsi tambahKeKeranjang dan lakukan tindakan yang sesuai
    tambahKeKeranjang($conn, $_POST['item_id'], $_POST['kategori_id'], $_SESSION['user_id']);
    // Redirect atau tampilkan pesan sukses, sesuai kebutuhan
    header("Location: keranjang.php"); // Misalnya, redirect ke halaman keranjang setelah berhasil menambahkan item
    exit(); // Hentikan eksekusi script setelah redirect
}

// Pengecekan jika tombol "Bayar" diklik
// Pengecekan jika tombol "Bayar" diklik
if (isset($_POST['bayar'])) {
    // Panggil fungsi prosesPembayaran dan dapatkan data resi
    $resi = prosesPembayaran($conn, $_SESSION['user_id'], $_POST['metode_pembayaran'], $_POST['nomor_rekening'], $_POST['nama_pembeli']);
}


// Ambil data barang-barang yang ada di keranjang pengguna
$user_id = $_SESSION["user_id"];
$query = "SELECT keranjang.id, items.gambar, items.nama, items.harga, items.kategori, keranjang.jumlah, keranjang.lunas FROM keranjang
          INNER JOIN items ON keranjang.item_id = items.id
          WHERE keranjang.user_id = $user_id";
$items = mysqli_query($conn, $query);

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <h1>Keranjang Belanja</h1>
    <div class="container">
        <div class="row">
            <?php foreach ($items as $item) : ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="../assets/img/<?= $item['gambar'] ?>" alt="" style="width: 100%; height: 100%;" />
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $item["nama"]; ?></h5>
                                    <p class="card-text">Harga: <?php echo $item["harga"]; ?></p>
                                    <p class="card-text">Kategori: <?php echo $item["kategori"]; ?></p>
                                    <p class="card-text">Jumlah: <?php echo $item["jumlah"]; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <form method="post">
            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select class="form-select" id="metode_pembayaran" name="metode_pembayaran">
                    <option value="transfer_bank">Transfer Bank</option>
                    <option value="kartu_kredit">Kartu Kredit</option>
                    <option value="e-wallet">E-Wallet</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
                <input type="text" class="form-control" id="nomor_rekening" name="nomor_rekening">
            </div>
            <div class="mb-3">
                <label for="nama_pembeli" class="form-label">Nama Pembeli</label>
                <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli">
            </div>
            <button type="submit" name="bayar" class="btn btn-primary">Bayar</button>
        </form>



        <?php if (isset($resi)) : ?>
            <h3>Resi Pembayaran:</h3>
            <p><?php echo $resi; ?></p>
        <?php endif; ?>
    </div>
    </div>

    <!-- tambahkan konten lainnya -->
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</html>