<?php
require '../php/functions.php';

$keywords = $_GET['keywords']; // Menggunakan $_GET['keywords'] sebagai array kata kunci
$query = "SELECT * FROM items WHERE ";
foreach ($keywords as $key => $keyword) {
    if ($key > 0) {
        $query .= " OR ";
    }
    $query .= "nama LIKE '%$keyword%' OR
             brand LIKE '%$keyword%' OR
             harga LIKE '%$keyword%' OR
             kategori LIKE '%$keyword%' OR
             detail LIKE '%$keyword%'";
}

$items = query($query);
?>

<!-- Kode HTML untuk menampilkan data items -->

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