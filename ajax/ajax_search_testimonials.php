<?php
require '../php/functions.php';

$keywords = $_GET['keywords']; // Menggunakan $_GET['keywords'] sebagai array kata kunci
$query = "SELECT t.*, p.title as project_title FROM testimonials t 
          LEFT JOIN projects p ON t.project_id = p.id 
          WHERE ";
foreach ($keywords as $key => $keyword) {
    if ($key > 0) {
        $query .= " OR ";
    }
    $query .= "t.client_name LIKE '%$keyword%' OR
             t.client_company LIKE '%$keyword%' OR
             t.client_position LIKE '%$keyword%' OR
             t.testimonial_text LIKE '%$keyword%' OR
             p.title LIKE '%$keyword%'";
}

$testimonials = query($query);
?>

<!-- Kode HTML untuk menampilkan data testimonials -->
<thead>
    <tr>
        <th scope="col">No</th>
        <th scope="col">Actions</th>
        <th scope="col">Photo</th>
        <th scope="col">Client</th>
        <th scope="col">Company</th>
        <th scope="col">Project</th>
        <th scope="col">Rating</th>
        <th scope="col">Featured</th>
    </tr>
</thead>
<tbody>
    <?php $i = 1; ?>
    <?php foreach ($testimonials as $testimonial) : ?>
        <tr>
            <th scope="row"><?= $i ?></th>
            <td>
                <a class="btn btn-sm btn-warning" href="ubah_testimonial.php?id=<?= $testimonial["id"]; ?>">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a class="btn btn-sm btn-danger" href="hapus_testimonial.php?id=<?= $testimonial["id"]; ?>" onclick="return confirm('Yakin ingin hapus?')">
                    <i class="bi bi-trash"></i> Delete
                </a>
            </td>
            <td>
                <img src="../assets/img/<?= $testimonial["client_photo"]; ?>" alt="<?= $testimonial["client_name"]; ?>" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
            </td>
            <td><strong><?= $testimonial["client_name"]; ?></strong></td>
            <td><?= $testimonial["client_company"]; ?></td>
            <td><?= $testimonial["project_title"]; ?></td>
            <td>
                <?php for ($j = 0; $j < $testimonial['rating']; $j++) : ?>
                    <i class="bi bi-star-fill text-warning"></i>
                <?php endfor; ?>
                (<?= $testimonial["rating"]; ?>/5)
            </td>
            <td>
                <?= $testimonial['featured'] ? '<i class="bi bi-star-fill text-warning"></i>' : '<i class="bi bi-star text-muted"></i>' ?>
            </td>
        </tr>
    <?php
        $i++;
    endforeach ?>
</tbody>
</table>