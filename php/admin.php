<?php
session_start();

if (!isset($_SESSION["submit"])) {
    header("Location: login.php");
    exit;
}

// Cek peran pengguna
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Anda tidak memiliki akses ke halaman ini.";
    exit;
}

require 'functions.php';

// Ambil statistik untuk dashboard
$totalServices = count(query("SELECT * FROM services"));
$totalProjects = count(query("SELECT * FROM projects"));
$totalTestimonials = count(query("SELECT * FROM testimonials"));
$totalMessages = count(query("SELECT * FROM contact_messages"));
$newMessages = count(query("SELECT * FROM contact_messages WHERE status = 'new'"));

// Pagination untuk services
$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM services"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// ketika tombol cari ditekan
if (isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];
    $services = cariServices($keyword);
} else {
    $services = query("SELECT * FROM services LIMIT $awalData, $jumlahDataPerHalaman");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - Anaphygon Retro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --retro-orange: #FF6B35;
            --retro-pink: #F7931E;
            --retro-purple: #9B59B6;
            --retro-dark: #2C3E50;
            --retro-light: #ECF0F1;
        }

        body {
            font-family: 'Courier New', monospace;
            background: var(--retro-light);
            color: var(--retro-dark);
        }

        .admin-header {
            background: linear-gradient(135deg, var(--retro-dark) 0%, var(--retro-purple) 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .stats-card {
            background: white;
            border-left: 5px solid var(--retro-orange);
            border-radius: 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .stats-icon {
            font-size: 3rem;
            color: var(--retro-orange);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--retro-dark);
        }

        .admin-nav {
            background: var(--retro-dark);
            border-radius: 0;
            margin-bottom: 2rem;
        }

        .admin-nav .nav-link {
            color: var(--retro-light);
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 0;
        }

        .admin-nav .nav-link.active {
            background: var(--retro-orange);
            color: white;
        }

        .admin-nav .nav-link:hover {
            background: var(--retro-pink);
            color: white;
        }

        .table-custom {
            background: white;
            border-radius: 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .table-custom th {
            background: var(--retro-dark);
            color: white;
            border: none;
            font-weight: bold;
            text-transform: uppercase;
        }

        .btn-retro {
            background: linear-gradient(45deg, var(--retro-orange), var(--retro-pink));
            color: white;
            border: none;
            border-radius: 0;
            font-weight: bold;
            text-transform: uppercase;
            box-shadow: 3px 3px 0px var(--retro-dark);
            transition: all 0.3s ease;
        }

        .btn-retro:hover {
            transform: translate(-1px, -1px);
            box-shadow: 4px 4px 0px var(--retro-dark);
            color: white;
        }

        .badge-new {
            background: var(--retro-orange);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
    </style>
</head>

<body>
    <!-- Admin Header -->
    <div class="admin-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1><i class="bi bi-speedometer2 me-2"></i>Admin Panel</h1>
                    <p class="mb-0">Welcome back, <?= $_SESSION['username'] ?>!</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="../index.php" class="btn btn-outline-light me-2">
                        <i class="bi bi-house"></i> Back to Site
                    </a>
                    <a href="logout.php" class="btn btn-outline-danger">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3">
                            <i class="bi bi-gear"></i>
                        </div>
                        <div>
                            <div class="stats-number"><?= $totalServices ?></div>
                            <div class="text-muted">Services</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3">
                            <i class="bi bi-folder"></i>
                        </div>
                        <div>
                            <div class="stats-number"><?= $totalProjects ?></div>
                            <div class="text-muted">Projects</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3">
                            <i class="bi bi-chat-quote"></i>
                        </div>
                        <div>
                            <div class="stats-number"><?= $totalTestimonials ?></div>
                            <div class="text-muted">Testimonials</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats-card p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div>
                            <div class="stats-number">
                                <?= $totalMessages ?>
                                <?php if ($newMessages > 0) : ?>
                                    <span class="badge badge-new ms-2"><?= $newMessages ?> new</span>
                                <?php endif; ?>
                            </div>
                            <div class="text-muted">Messages</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Navigation -->
        <ul class="nav nav-tabs admin-nav">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#services">
                    <i class="bi bi-gear me-2"></i>Services
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#projects">
                    <i class="bi bi-folder me-2"></i>Projects
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#testimonials">
                    <i class="bi bi-chat-quote me-2"></i>Testimonials
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#messages">
                    <i class="bi bi-envelope me-2"></i>Messages
                    <?php if ($newMessages > 0) : ?>
                        <span class="badge badge-new ms-1"><?= $newMessages ?></span>
                    <?php endif; ?>
                </a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Services Tab -->
            <div class="tab-pane fade show active" id="services">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Manage Services</h3>
                    <a href="tambah_service.php" class="btn btn-retro">
                        <i class="bi bi-plus"></i> Add Service
                    </a>
                </div>

                <!-- Search Form -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <form method="post">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Search services..." value="<?= isset($_POST['keyword']) ? $_POST['keyword'] : '' ?>">
                                <button type="submit" name="cari" class="btn btn-outline-secondary">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Services Table -->
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Price Range</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = $awalData + 1; ?>
                            <?php foreach ($services as $service) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td>
                                        <img src="../assets/img/<?= $service['image'] ?>" alt="<?= $service['title'] ?>" style="width: 60px; height: 60px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <strong><?= $service['title'] ?></strong><br>
                                        <small class="text-muted"><?= substr($service['description'], 0, 50) ?>...</small>
                                    </td>
                                    <td><span class="badge bg-success"><?= $service['price_range'] ?></span></td>
                                    <td>
                                        <?php if ($service['status'] == 'active') : ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else : ?>
                                            <span class="badge bg-secondary">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="ubah_service.php?id=<?= $service['id'] ?>" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="hapus_service.php?id=<?= $service['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($halamanAktif > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                            <li class="page-item <?= ($i == $halamanAktif) ? 'active' : '' ?>">
                                <a class="page-link" href="?halaman=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($halamanAktif < $jumlahHalaman) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>

            <!-- Projects Tab -->
            <div class="tab-pane fade" id="projects">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Manage Projects</h3>
                    <a href="tambah_project.php" class="btn btn-retro">
                        <i class="bi bi-plus"></i> Add Project
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Client</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $projects = query("SELECT p.*, s.title as service_title FROM projects p 
                                              LEFT JOIN services s ON p.service_id = s.id 
                                              ORDER BY p.created_at DESC");
                            $i = 1;
                            ?>
                            <?php foreach ($projects as $project) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td>
                                        <img src="../assets/img/<?= $project['image'] ?>" alt="<?= $project['title'] ?>" style="width: 60px; height: 60px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <strong><?= $project['title'] ?></strong><br>
                                        <small class="text-muted"><?= $project['service_title'] ?></small>
                                    </td>
                                    <td><?= $project['client_name'] ?></td>
                                    <td>
                                        <?php if ($project['status'] == 'completed') : ?>
                                            <span class="badge bg-success">Completed</span>
                                        <?php elseif ($project['status'] == 'in_progress') : ?>
                                            <span class="badge bg-warning">In Progress</span>
                                        <?php else : ?>
                                            <span class="badge bg-info">Planning</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= $project['featured'] ? '<i class="bi bi-star-fill text-warning"></i>' : '<i class="bi bi-star text-muted"></i>' ?>
                                    </td>
                                    <td>
                                        <a href="ubah_project.php?id=<?= $project['id'] ?>" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="hapus_project.php?id=<?= $project['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Testimonials Tab -->
            <div class="tab-pane fade" id="testimonials">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Manage Testimonials</h3>
                    <a href="tambah_testimonial.php" class="btn btn-retro">
                        <i class="bi bi-plus"></i> Add Testimonial
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Photo</th>
                                <th>Client</th>
                                <th>Rating</th>
                                <th>Project</th>
                                <th>Featured</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $testimonials = query("SELECT t.*, p.title as project_title FROM testimonials t 
                                                  LEFT JOIN projects p ON t.project_id = p.id 
                                                  ORDER BY t.created_at DESC");
                            $i = 1;
                            ?>
                            <?php foreach ($testimonials as $testimonial) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td>
                                        <img src="../assets/img/<?= $testimonial['client_photo'] ?>" alt="<?= $testimonial['client_name'] ?>" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <strong><?= $testimonial['client_name'] ?></strong><br>
                                        <small class="text-muted"><?= $testimonial['client_position'] ?>, <?= $testimonial['client_company'] ?></small>
                                    </td>
                                    <td>
                                        <?php for ($j = 0; $j < $testimonial['rating']; $j++) : ?>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        <?php endfor; ?>
                                    </td>
                                    <td><?= $testimonial['project_title'] ?></td>
                                    <td>
                                        <?= $testimonial['featured'] ? '<i class="bi bi-star-fill text-warning"></i>' : '<i class="bi bi-star text-muted"></i>' ?>
                                    </td>
                                    <td>
                                        <a href="ubah_testimonial.php?id=<?= $testimonial['id'] ?>" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="hapus_testimonial.php?id=<?= $testimonial['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Messages Tab -->
            <div class="tab-pane fade" id="messages">
                <h3>Contact Messages</h3>
                
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Service Interest</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $messages = query("SELECT cm.*, s.title as service_title FROM contact_messages cm 
                                              LEFT JOIN services s ON cm.service_interest = s.id 
                                              ORDER BY cm.created_at DESC");
                            ?>
                            <?php foreach ($messages as $message) : ?>
                                <tr class="<?= $message['status'] == 'new' ? 'table-warning' : '' ?>">
                                    <td><?= date('d/m/Y H:i', strtotime($message['created_at'])) ?></td>
                                    <td>
                                        <strong><?= $message['name'] ?></strong><br>
                                        <small class="text-muted"><?= $message['email'] ?></small>
                                    </td>
                                    <td><?= $message['subject'] ?></td>
                                    <td><?= $message['service_title'] ?? 'General' ?></td>
                                    <td>
                                        <?php
                                        $statusColors = [
                                            'new' => 'bg-warning',
                                            'read' => 'bg-info',
                                            'replied' => 'bg-success',
                                            'archived' => 'bg-secondary'
                                        ];
                                        ?>
                                        <span class="badge <?= $statusColors[$message['status']] ?>"><?= ucfirst($message['status']) ?></span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info" onclick="viewMessage(<?= $message['id'] ?>)">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <a href="hapus_message.php?id=<?= $message['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Message Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Message Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="messageContent">
                    <!-- Content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function viewMessage(id) {
            // Load message content via AJAX
            fetch('view_message.php?id=' + id)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('messageContent').innerHTML = data;
                    new bootstrap.Modal(document.getElementById('messageModal')).show();
                });
        }
    </script>
</body>

</html>