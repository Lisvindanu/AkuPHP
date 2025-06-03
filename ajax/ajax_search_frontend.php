<?php
require '../php/functions.php';

$type = $_GET['type'] ?? 'all'; // services, projects, testimonials, atau all
$keywords = $_GET['keywords'] ?? []; // Array kata kunci

if (empty($keywords)) {
    echo '<div class="alert alert-info">Masukkan kata kunci untuk mencari...</div>';
    exit;
}

$allResults = [];

// Search Services
if ($type == 'all' || $type == 'services') {
    $serviceQuery = "SELECT *, 'service' as type FROM services WHERE status = 'active' AND (";
    foreach ($keywords as $key => $keyword) {
        if ($key > 0) {
            $serviceQuery .= " OR ";
        }
        $serviceQuery .= "title LIKE '%$keyword%' OR description LIKE '%$keyword%'";
    }
    $serviceQuery .= ")";
    $services = query($serviceQuery);
    $allResults = array_merge($allResults, $services);
}

// Search Projects
if ($type == 'all' || $type == 'projects') {
    $projectQuery = "SELECT p.*, s.title as service_title, 'project' as type FROM projects p 
                     LEFT JOIN services s ON p.service_id = s.id 
                     WHERE p.status = 'completed' AND (";
    foreach ($keywords as $key => $keyword) {
        if ($key > 0) {
            $projectQuery .= " OR ";
        }
        $projectQuery .= "p.title LIKE '%$keyword%' OR p.description LIKE '%$keyword%' OR p.client_name LIKE '%$keyword%'";
    }
    $projectQuery .= ")";
    $projects = query($projectQuery);
    $allResults = array_merge($allResults, $projects);
}

// Search Testimonials
if ($type == 'all' || $type == 'testimonials') {
    $testimonialQuery = "SELECT t.*, p.title as project_title, 'testimonial' as type FROM testimonials t 
                         LEFT JOIN projects p ON t.project_id = p.id 
                         WHERE t.status = 'active' AND (";
    foreach ($keywords as $key => $keyword) {
        if ($key > 0) {
            $testimonialQuery .= " OR ";
        }
        $testimonialQuery .= "t.client_name LIKE '%$keyword%' OR t.client_company LIKE '%$keyword%' OR t.testimonial_text LIKE '%$keyword%'";
    }
    $testimonialQuery .= ")";
    $testimonials = query($testimonialQuery);
    $allResults = array_merge($allResults, $testimonials);
}

if (empty($allResults)) {
    echo '<div class="alert alert-warning">
            <i class="bi bi-search"></i> Tidak ada hasil yang ditemukan untuk "' . implode(' ', $keywords) . '"
          </div>';
    exit;
}
?>

<div class="search-results">
    <div class="search-header mb-3">
        <h5><i class="bi bi-search"></i> Hasil Pencarian (<?= count($allResults) ?> ditemukan)</h5>
        <small class="text-muted">Kata kunci: "<?= implode(' ', $keywords) ?>"</small>
    </div>

    <div class="row">
        <?php foreach ($allResults as $result) : ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <?php if ($result['type'] == 'service') : ?>
                    <!-- Service Card -->
                    <div class="card search-result-card service-card">
                        <img src="../assets/img/<?= $result['image'] ?>" class="card-img-top" alt="<?= $result['title'] ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-primary">Service</span>
                                <span class="badge bg-success"><?= $result['price_range'] ?></span>
                            </div>
                            <h6 class="card-title"><?= $result['title'] ?></h6>
                            <p class="card-text"><?= substr($result['description'], 0, 100) ?>...</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">Service</small>
                                <a href="./php/services.php" class="btn btn-sm btn-outline-primary">Learn More</a>
                            </div>
                        </div>
                    </div>

                <?php elseif ($result['type'] == 'project') : ?>
                    <!-- Project Card -->
                    <div class="card search-result-card project-card">
                        <img src="../assets/img/<?= $result['image'] ?>" class="card-img-top" alt="<?= $result['title'] ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-info">Project</span>
                                <?= $result['featured'] ? '<i class="bi bi-star-fill text-warning"></i>' : '' ?>
                            </div>
                            <h6 class="card-title"><?= $result['title'] ?></h6>
                            <p class="card-text"><?= substr($result['description'], 0, 100) ?>...</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">Client: <?= $result['client_name'] ?></small>
                                <?php if ($result['project_url']) : ?>
                                    <a href="<?= $result['project_url'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-box-arrow-up-right"></i> View
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                <?php elseif ($result['type'] == 'testimonial') : ?>
                    <!-- Testimonial Card -->
                    <div class="card search-result-card testimonial-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-warning text-dark">Testimonial</span>
                                <div class="rating">
                                    <?php for ($i = 0; $i < $result['rating']; $i++) : ?>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <img src="../assets/img/<?= $result['client_photo'] ?>" alt="<?= $result['client_name'] ?>" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0"><?= $result['client_name'] ?></h6>
                                    <small class="text-muted"><?= $result['client_position'] ?>, <?= $result['client_company'] ?></small>
                                </div>
                            </div>
                            <p class="card-text">"<?= substr($result['testimonial_text'], 0, 120) ?>..."</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">Project: <?= $result['project_title'] ?></small>
                                <?= $result['featured'] ? '<i class="bi bi-star-fill text-warning"></i>' : '' ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.search-result-card {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.search-result-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
}

.service-card {
    border-left: 4px solid var(--retro-orange);
}

.project-card {
    border-left: 4px solid var(--retro-blue);
}

.testimonial-card {
    border-left: 4px solid var(--retro-pink);
}

.search-header {
    border-bottom: 2px solid var(--retro-orange);
    padding-bottom: 10px;
}
</style>