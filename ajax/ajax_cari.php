<?php
require '../php/functions.php';

$keywords = $_GET['keywords']; // Menggunakan $_GET['keywords'] sebagai array kata kunci
$query = "SELECT * FROM services WHERE ";
foreach ($keywords as $key => $keyword) {
    if ($key > 0) {
        $query .= " OR ";
    }
    $query .= "title LIKE '%$keyword%' OR
             description LIKE '%$keyword%' OR
             price_range LIKE '%$keyword%' OR
             status LIKE '%$keyword%'";
}

$services = query($query);
?>

<!-- Kode HTML untuk menampilkan data services -->
<thead>
    <tr>
        <th scope="col">No</th>
        <th scope="col">Actions</th>
        <th scope="col">Image</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Price Range</th>
        <th scope="col">Status</th>
    </tr>
</thead>
<tbody>
    <?php $i = 1; ?>
    <?php foreach ($services as $service) : ?>
        <tr>
            <th scope="row"><?= $i ?></th>
            <td>
                <a class="btn btn-sm btn-warning" href="ubah_service.php?id=<?= $service["id"]; ?>">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a class="btn btn-sm btn-danger" href="hapus_service.php?id=<?= $service["id"]; ?>" onclick="return confirm('Yakin ingin hapus?')">
                    <i class="bi bi-trash"></i> Delete
                </a>
            </td>
            <td>
                <img src="../assets/img/<?= $service["image"]; ?>" alt="<?= $service["title"]; ?>" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
            </td>
            <td><strong><?= $service["title"]; ?></strong></td>
            <td><?= substr($service["description"], 0, 100); ?>...</td>
            <td><span class="badge bg-success"><?= $service["price_range"]; ?></span></td>
            <td>
                <?php if ($service["status"] == "active") : ?>
                    <span class="badge bg-success">Active</span>
                <?php else : ?>
                    <span class="badge bg-secondary">Inactive</span>
                <?php endif; ?>
            </td>
        </tr>
    <?php
        $i++;
    endforeach ?>
</tbody>
</table>