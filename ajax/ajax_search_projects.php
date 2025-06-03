<?php
require '../php/functions.php';

$keywords = $_GET['keywords']; // Menggunakan $_GET['keywords'] sebagai array kata kunci
$query = "SELECT p.*, s.title as service_title FROM projects p 
          LEFT JOIN services s ON p.service_id = s.id 
          WHERE ";
foreach ($keywords as $key => $keyword) {
    if ($key > 0) {
        $query .= " OR ";
    }
    $query .= "p.title LIKE '%$keyword%' OR
             p.description LIKE '%$keyword%' OR
             p.client_name LIKE '%$keyword%' OR
             p.status LIKE '%$keyword%' OR
             s.title LIKE '%$keyword%'";
}

$projects = query($query);
?>

<!-- Kode HTML untuk menampilkan data projects -->
<thead>
    <tr>
        <th scope="col">No</th>
        <th scope="col">Actions</th>
        <th scope="col">Image</th>
        <th scope="col">Title</th>
        <th scope="col">Client</th>
        <th scope="col">Service</th>
        <th scope="col">Status</th>
        <th scope="col">Featured</th>
    </tr>
</thead>
<tbody>
    <?php $i = 1; ?>
    <?php foreach ($projects as $project) : ?>
        <tr>
            <th scope="row"><?= $i ?></th>
            <td>
                <a class="btn btn-sm btn-warning" href="ubah_project.php?id=<?= $project["id"]; ?>">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a class="btn btn-sm btn-danger" href="hapus_project.php?id=<?= $project["id"]; ?>" onclick="return confirm('Yakin ingin hapus?')">
                    <i class="bi bi-trash"></i> Delete
                </a>
            </td>
            <td>
                <img src="../assets/img/<?= $project["image"]; ?>" alt="<?= $project["title"]; ?>" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
            </td>
            <td><strong><?= $project["title"]; ?></strong></td>
            <td><?= $project["client_name"]; ?></td>
            <td><?= $project["service_title"]; ?></td>
            <td>
                <?php if ($project["status"] == "completed") : ?>
                    <span class="badge bg-success">Completed</span>
                <?php elseif ($project["status"] == "in_progress") : ?>
                    <span class="badge bg-warning">In Progress</span>
                <?php else : ?>
                    <span class="badge bg-info">Planning</span>
                <?php endif; ?>
            </td>
            <td>
                <?= $project['featured'] ? '<i class="bi bi-star-fill text-warning"></i>' : '<i class="bi bi-star text-muted"></i>' ?>
            </td>
        </tr>
    <?php
        $i++;
    endforeach ?>
</tbody>
</table>