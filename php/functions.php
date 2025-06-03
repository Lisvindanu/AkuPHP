<?php

// koneksi ke database
$conn = mysqli_connect("localhost:3306", "root", "password", "tubes");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;

    // Ambil data dari tiap elemen dalam form

    $nama = htmlspecialchars($data["nama"]);
    $brand = htmlspecialchars($data["brand"]);
    $harga = htmlspecialchars($data["harga"]);
    $detail = htmlspecialchars($data["detail"]);
    $kategori = htmlspecialchars($data["kategori"]);

    // Upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // Cek apakah kategori sudah ada di tabel kategori
    $query = "SELECT id FROM kategori WHERE nama = '$kategori'";
    $result = mysqli_query($conn, $query);

    // Jika kategori belum ada, tambahkan ke tabel kategori
    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO kategori (nama) VALUES ('$kategori')";
        mysqli_query($conn, $query);
    }

    // Dapatkan id dari tabel kategori berdasarkan nama kategori
    $query = "SELECT id FROM kategori WHERE nama = '$kategori'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $kategori_id = $row['id'];

    // Query insert data
    $query = "INSERT INTO items (gambar, nama, brand, harga, detail, kategori, kategori_id)
              VALUES ('$gambar', '$nama', '$brand', '$harga', '$detail', '$kategori', '$kategori_id')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}




function upload()
{
    // Cek apakah input file 'gambar' ada
    if (!isset($_FILES['gambar'])) {
        var_dump($_FILES['gambar']);
        return "Gambar tidak ditemukan";
    }

    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        return "Pilih gambar terlebih dahulu";
    }

    // Cek apakah yang diupload adalah gambar
    $ekstensigambarValid = ['jpg', 'jpeg', 'png', 'webp'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if (!in_array($ekstensigambar, $ekstensigambarValid)) {
        return "Yang Anda upload bukan gambar";
    }

    // Cek jika ukurannya terlalu besar
    if ($ukuranfile > 50000000) {
        return "Ukuran gambar terlalu besar";
    }

    // Lolos pengecekan, gambar siap diupload
    // Generate nama gambar baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    move_uploaded_file($tmpName, '../assets/img/' . $namafilebaru);

    return $namafilebaru;
}



function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM items WHERE id = $id");
    return mysqli_affected_rows($conn);
}


// regis
function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $role = isset($data["role"]) ? $data["role"] : ""; // Assign an empty string if the "role" key is not set

    // Cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Username sudah terdaftar!');
        </script>";
        return false;
    }

    // Cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai!');
        </script>";
        return false;
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan user baru ke database dengan role
    mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')");

    return mysqli_affected_rows($conn);
}


function ubah($data)
{
    global $conn;
    // ambil data dari tiap elemen dalam form
    $id = ($data["id"]);
    $nama = htmlspecialchars($data["nama"]);
    $brand = htmlspecialchars($data["brand"]);
    $harga = htmlspecialchars($data["harga"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $detail = htmlspecialchars($data["detail"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);


    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    // query insert data

    $query = "UPDATE items SET

   
     nama = '$nama', 
     brand = '$brand',
     harga = '$harga', 
     gambar = '$gambar' ,
     kategori = '$kategori',
     detail = '$detail'
     WHERE id = $id
     
     ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM items
                WHERE 
            nama LIKE '%$keyword%' OR
            brand LIkE '%$keyword%' OR
            harga LIKE '%$keyword%' OR
            detail LIKE  '%$keyword%'
        ";
    return query($query);
}



function tambahKeKeranjang($conn, $item_id, $kategori_id, $user_id)
{
    $jumlah = 1;

    // Cek apakah produk sudah ada di keranjang
    $result = mysqli_query($conn, "SELECT * FROM keranjang WHERE user_id = '$user_id' AND item_id = '$item_id'");
    if (mysqli_num_rows($result) > 0) {
        // Jika sudah ada, tambahkan jumlah
        $row = mysqli_fetch_assoc($result);
        $jumlah += $row["jumlah"];
        mysqli_query($conn, "UPDATE keranjang SET jumlah = $jumlah WHERE user_id = '$user_id' AND item_id = '$item_id'");
    } else {
        // Jika belum ada, tambahkan produk baru ke keranjang
        if ($kategori_id !== NULL) {
            $query = "SELECT harga FROM items WHERE id = '$item_id'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $harga = $row['harga'];
                mysqli_query($conn, "INSERT INTO keranjang (user_id, item_id, kategori_id, harga, jumlah) VALUES ('$user_id', '$item_id', '$kategori_id', $harga, $jumlah)");
            } else {
                // Jika item tidak ditemukan, berikan nilai default untuk harga
                $harga = 0;
                mysqli_query($conn, "INSERT INTO keranjang (user_id, item_id, kategori_id, harga, jumlah) VALUES ('$user_id', '$item_id', '$kategori_id', $harga, $jumlah)");
            }
        } else {
            // Jika tidak ada kategori, berikan nilai default untuk harga
            $harga = 0;
            mysqli_query($conn, "INSERT INTO keranjang (user_id, item_id, jumlah) VALUES ('$user_id', '$item_id', $jumlah)");
        }
    }

    // Redirect ke halaman keranjang
    header("Location: keranjang.php");
    exit;
}



function prosesPembayaran($conn, $user_id, $metode_pembayaran, $nomor_rekening, $nama_pembeli)
{
    // Set zona waktu ke Waktu Indonesia Barat (WIB)
    date_default_timezone_set('Asia/Jakarta');

    // Ambil data keranjang berdasarkan user_id
    $query = "SELECT * FROM keranjang WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);

    // Periksa apakah ada data keranjang yang ditemukan
    if (mysqli_num_rows($result) > 0) {
        // Ambil total harga dari data keranjang
        $total_harga = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            if (array_key_exists('jumlah', $row) && array_key_exists('harga', $row)) {
                $total_harga += $row['jumlah'] * $row['harga'];
            }
        }

        // Insert data pembayaran ke dalam tabel pembayaran
        $tanggal_pembayaran = date('Y-m-d h:i:s'); // Tanggal dan waktu saat ini
        $total_pembayaran = $total_harga;

        // Generate nomor resi acak
        $resi = generateRandomResi(); // Fungsi generateRandomResi() menghasilkan nomor resi acak

        $insertQuery = "INSERT INTO pembayaran (id, user_id, metode_pembayaran, nomor_rekening, nama_pembeli, total_harga, tanggal_pembayaran, total_pembayaran) 
                        VALUES (NULL, $user_id, '$metode_pembayaran', '$nomor_rekening', '$nama_pembeli', $total_harga, '$tanggal_pembayaran',  $total_pembayaran)";

        if (mysqli_query($conn, $insertQuery)) {
            // Jika berhasil, hapus data keranjang yang sudah dibayar
            $deleteQuery = "DELETE FROM keranjang WHERE user_id = $user_id";
            mysqli_query($conn, $deleteQuery);

            // Kembalikan nilai resi
            return $resi;
        } else {
            // Handle error saat menjalankan query INSERT
            echo "Error: " . mysqli_error($conn);
        }
    }
}

function generateRandomResi()
{
    // Generate nomor resi acak
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $length = 10;
    $randomResi = '';

    for ($i = 0; $i < $length; $i++) {
        $randomResi .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomResi;
}
