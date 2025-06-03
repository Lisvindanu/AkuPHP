<?php
session_start();
require 'functions.php';

// Ambil semua services yang aktif
$services = query("SELECT * FROM services WHERE status = 'active' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Our Services - Anaphygon Retro</title>
    
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100" rel="stylesheet" />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css" />
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/e18581a144.js" crossorigin="anonymous"></script>

    <style>
        :root {
            --retro-orange: #FF6B35;
            --retro-pink: #F7931E;
            --retro-purple: #9B59B6;
            --retro-blue: #3498DB;
            --retro-dark: #2C3E50;
            --retro-light: #ECF0F1;
        }

        body {
            font-family: 'Courier New', monospace;
            background: var(--retro-light);
            color: var(--retro-dark);
        }

        .hero-services {
            background: linear-gradient(135deg, var(--retro-dark) 0%, var(--retro-purple) 100%);
            color: white;
            padding: 120px 0 80px 0;
            margin-top: 77px;
        }

        .service-card {
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
            overflow: hidden;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--retro-orange), var(--retro-pink));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem auto;
        }

        .service-image {
            height: 200px;
            object-fit: cover;
            border-radius: 15px 15px 0 0;
        }

        .price-badge {
            background: linear-gradient(135deg, var(--retro-orange), var(--retro-pink));
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: bold;
            border: none;
        }

        .btn-service {
            background: linear-gradient(135deg, var(--retro-orange), var(--retro-pink));
            color: white;
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-service:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: white;
        }

        .process-section {
            background: white;
            padding: 80px 0;
        }

        .process-step {
            text-align: center;
            padding: 30px;
            position: relative;
        }

        .process-step::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -50%;
            width: 100%;
            height: 2px;
            background: var(--retro-orange);
            z-index: 1;
        }

        .process-step:last-child::after {
            display: none;
        }

        .process-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--retro-orange), var(--retro-pink));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem auto;
            position: relative;
            z-index: 2;
        }

        .cta-section {
            background: linear-gradient(135deg, var(--retro-dark) 0%, var(--retro-purple) 100%);
            color: white;
            padding: 80px 0;
        }

        @media (max-width: 768px) {
            .process-step::after {
                display: none;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: rgba(44, 62, 80, 0.95); backdrop-filter: blur(10px);">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <span style="font-weight: bold; color: var(--retro-orange);">ANAPHYGON RETRO</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="portfolio.php">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-services">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Our Services</h1>
                    <p class="lead mb-4">
                        We provide comprehensive digital solutions to help your business thrive in the digital age.
                        From creative design to robust development, we've got you covered.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid Section -->
    <section class="py-5" style="background: var(--retro-light); margin-top: -40px;">
        <div class="container">
            <div class="row g-4">
                <?php foreach ($services as $service) : ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-card">
                            <?php if ($service['image'] && $service['image'] != 'nophoto.png') : ?>
                                <img src="../assets/img/<?= $service['image'] ?>" alt="<?= $service['title'] ?>" class="service-image w-100">
                            <?php endif; ?>
                            
                            <div class="card-body p-4">
                                <div class="service-icon">
                                    <i class="<?= $service['icon'] ?> fa-2x text-white"></i>
                                </div>
                                
                                <h4 class="mb-3" style="color: var(--retro-dark);"><?= $service['title'] ?></h4>
                                <p class="text-muted mb-4"><?= $service['description'] ?></p>
                                
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="price-badge"><?= $service['price_range'] ?></span>
                                </div>
                                
                                <a href="contact.php?service=<?= $service['id'] ?>" class="btn btn-service w-100">
                                    Get Started
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="process-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold mb-3" style="color: var(--retro-dark);">Our Process</h2>
                    <p class="lead text-muted">How we bring your ideas to life</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="process-step">
                        <div class="process-icon">
                            <i class="fas fa-comments fa-3x text-white"></i>
                        </div>
                        <h5 style="color: var(--retro-dark);">1. Consultation</h5>
                        <p class="text-muted">We discuss your needs, goals, and vision to understand your project requirements.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="process-step">
                        <div class="process-icon">
                            <i class="fas fa-drafting-compass fa-3x text-white"></i>
                        </div>
                        <h5 style="color: var(--retro-dark);">2. Planning</h5>
                        <p class="text-muted">We create a detailed project plan with timelines, milestones, and deliverables.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="process-step">
                        <div class="process-icon">
                            <i class="fas fa-code fa-3x text-white"></i>
                        </div>
                        <h5 style="color: var(--retro-dark);">3. Development</h5>
                        <p class="text-muted">Our team brings your project to life with cutting-edge technologies and best practices.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="process-step">
                        <div class="process-icon">
                            <i class="fas fa-rocket fa-3x text-white"></i>
                        </div>
                        <h5 style="color: var(--retro-dark);">4. Launch</h5>
                        <p class="text-muted">We deploy your project and provide ongoing support to ensure everything runs smoothly.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5" style="background: var(--retro-light);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h3 class="text-center mb-5" style="color: var(--retro-dark);">Frequently Asked Questions</h3>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                    How long does a typical project take?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Project timelines vary depending on complexity. Simple websites take 2-4 weeks, while complex applications can take 3-6 months. We'll provide a detailed timeline during consultation.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                    Do you provide ongoing support?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, we offer maintenance packages including updates, security monitoring, and technical support to keep your project running optimally.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                    What's included in the price?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Our prices include consultation, design, development, testing, deployment, and initial support. Additional features or extended support may have separate costs.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h2 class="display-5 fw-bold mb-4">Ready to Start Your Project?</h2>
                    <p class="lead mb-4">
                        Let's discuss how we can help bring your vision to life with our expert services.
                    </p>
                    <a href="contact.php" class="btn btn-service btn-lg me-3">Get Free Consultation</a>
                    <a href="portfolio.php" class="btn btn-outline-light btn-lg">View Our Work</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include('../includes/footer.php') ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>