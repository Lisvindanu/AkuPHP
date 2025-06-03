<?php
session_start();
require 'php/functions.php';

// Ambil data untuk homepage
$featuredServices = query("SELECT * FROM services WHERE status = 'active' LIMIT 4");
$featuredProjects = query("SELECT p.*, s.title as service_title FROM projects p 
                          LEFT JOIN services s ON p.service_id = s.id 
                          WHERE p.featured = 1 AND p.status = 'completed' 
                          ORDER BY p.completion_date DESC LIMIT 6");
$featuredTestimonials = query("SELECT t.*, p.title as project_title FROM testimonials t 
                              LEFT JOIN projects p ON t.project_id = p.id 
                              WHERE t.featured = 1 AND t.status = 'active' LIMIT 3");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="assets/icon/anaphygon-logo.png">
    <title>Anaphygon Retro - Creative Design Studio</title>
    
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100" rel="stylesheet" />
    
    <!-- Custom JS -->
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Navbar background change on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.style.background = 'rgba(44, 62, 80, 0.98)';
            } else {
                navbar.style.background = 'rgba(44, 62, 80, 0.95)';
            }
        });
    </script>
</body>

</html> CSS -->
    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./assets/css/navbar.css" />
    
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
            background: linear-gradient(135deg, var(--retro-dark) 0%, var(--retro-purple) 100%);
            color: var(--retro-light);
        }

        .hero-section {
            min-height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('./assets/img/retro-hero-bg.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: repeating-linear-gradient(
                90deg,
                transparent,
                transparent 2px,
                rgba(255, 107, 53, 0.1) 2px,
                rgba(255, 107, 53, 0.1) 4px
            );
            animation: scan 2s linear infinite;
        }

        @keyframes scan {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .hero-title {
            font-size: 4rem;
            font-weight: bold;
            color: var(--retro-orange);
            text-shadow: 3px 3px 0px var(--retro-pink);
            margin-bottom: 2rem;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: var(--retro-light);
            margin-bottom: 3rem;
        }

        .btn-retro {
            background: linear-gradient(45deg, var(--retro-orange), var(--retro-pink));
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 0;
            box-shadow: 5px 5px 0px var(--retro-dark);
            transition: all 0.3s ease;
        }

        .btn-retro:hover {
            transform: translate(-2px, -2px);
            box-shadow: 7px 7px 0px var(--retro-dark);
            color: white;
        }

        .section-title {
            font-size: 3rem;
            color: var(--retro-orange);
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--retro-pink);
        }

        .service-card {
            background: var(--retro-dark);
            border: 3px solid var(--retro-orange);
            border-radius: 0;
            padding: 2rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 107, 53, 0.2), transparent);
            transition: all 0.5s ease;
        }

        .service-card:hover::before {
            left: 100%;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .service-icon {
            font-size: 3rem;
            color: var(--retro-pink);
            margin-bottom: 1rem;
        }

        .project-card {
            background: var(--retro-light);
            color: var(--retro-dark);
            border-radius: 0;
            overflow: hidden;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .project-card:hover {
            transform: scale(1.05);
        }

        .project-image {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }

        .testimonial-card {
            background: var(--retro-dark);
            border-left: 5px solid var(--retro-orange);
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
        }

        .testimonial-card::before {
            content: '"';
            font-size: 4rem;
            color: var(--retro-pink);
            position: absolute;
            top: -10px;
            left: 20px;
        }

        .rating {
            color: var(--retro-pink);
        }

        .contact-section {
            background: var(--retro-dark);
            padding: 5rem 0;
        }

        .form-control {
            background: var(--retro-light);
            border: 2px solid var(--retro-orange);
            border-radius: 0;
            color: var(--retro-dark);
        }

        .form-control:focus {
            background: var(--retro-light);
            border-color: var(--retro-pink);
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
            color: var(--retro-dark);
        }

        .navbar-custom {
            background: rgba(44, 62, 80, 0.95) !important;
            backdrop-filter: blur(10px);
        }

        .navbar-brand img {
            height: 50px;
        }

        .nav-link {
            color: var(--retro-light) !important;
            font-weight: bold;
            text-transform: uppercase;
        }

        .nav-link:hover {
            color: var(--retro-orange) !important;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include('./includes/navbar.php') ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="hero-title">ANAPHYGON<br>RETRO</h1>
                    <p class="hero-subtitle">Creative Design Studio Specializing in Retro & Vintage Aesthetics</p>
                    <p class="lead mb-4">Kami menciptakan identitas visual yang memorable dengan sentuhan nostalgia dan inovasi modern. Dari web design hingga brand identity, kami menghadirkan karya yang timeless.</p>
                    <a href="#services" class="btn btn-retro me-3">Our Services</a>
                    <a href="#contact" class="btn btn-outline-light btn-lg">Get In Touch</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5" style="background: var(--retro-light); color: var(--retro-dark);">
        <div class="container">
            <h2 class="section-title" style="color: var(--retro-dark);">Our Services</h2>
            <div class="row">
                <?php foreach ($featuredServices as $service) : ?>
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="<?= $service['icon'] ?>"></i>
                            </div>
                            <h4 style="color: var(--retro-orange);"><?= $service['title'] ?></h4>
                            <p class="mb-3"><?= $service['description'] ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success fs-6"><?= $service['price_range'] ?></span>
                                <a href="./php/services.php" class="btn btn-sm btn-outline-warning">Learn More</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center">
                <a href="./php/services.php" class="btn btn-retro">View All Services</a>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-5">
        <div class="container">
            <h2 class="section-title">Featured Projects</h2>
            <div class="row">
                <?php foreach ($featuredProjects as $project) : ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="project-card">
                            <img src="./assets/img/<?= $project['image'] ?>" alt="<?= $project['title'] ?>" class="project-image">
                            <div class="card-body">
                                <h5 class="card-title"><?= $project['title'] ?></h5>
                                <p class="card-text"><?= substr($project['description'], 0, 100) ?>...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted"><?= $project['client_name'] ?></small>
                                    <span class="badge bg-primary"><?= $project['service_title'] ?></span>
                                </div>
                                <?php if ($project['project_url']) : ?>
                                    <a href="<?= $project['project_url'] ?>" target="_blank" class="btn btn-sm btn-outline-primary mt-2">View Project</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center">
                <a href="./php/portfolio.php" class="btn btn-retro">View All Projects</a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-5" style="background: var(--retro-light); color: var(--retro-dark);">
        <div class="container">
            <h2 class="section-title" style="color: var(--retro-dark);">What Our Clients Say</h2>
            <div class="row">
                <?php foreach ($featuredTestimonials as $testimonial) : ?>
                    <div class="col-lg-4 mb-4">
                        <div class="testimonial-card">
                            <p class="mb-3"><?= $testimonial['testimonial_text'] ?></p>
                            <div class="d-flex align-items-center">
                                <img src="./assets/img/<?= $testimonial['client_photo'] ?>" alt="<?= $testimonial['client_name'] ?>" class="rounded-circle me-3" width="60" height="60">
                                <div>
                                    <h6 class="mb-0" style="color: var(--retro-orange);"><?= $testimonial['client_name'] ?></h6>
                                    <small><?= $testimonial['client_position'] ?>, <?= $testimonial['client_company'] ?></small>
                                    <div class="rating mt-1">
                                        <?php for ($i = 0; $i < $testimonial['rating']; $i++) : ?>
                                            <i class="fas fa-star"></i>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <h2 class="section-title">Get In Touch</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form action="./php/contact.php" method="post" class="contact-form">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="service_interest" class="form-label">Service Interest</label>
                                <select class="form-control" id="service_interest" name="service_interest">
                                    <option value="">Select a service</option>
                                    <?php 
                                    $allServices = query("SELECT * FROM services WHERE status = 'active'");
                                    foreach ($allServices as $service) : ?>
                                        <option value="<?= $service['id'] ?>"><?= $service['title'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="budget_range" class="form-label">Budget Range</label>
                                <select class="form-control" id="budget_range" name="budget_range">
                                    <option value="">Select budget range</option>
                                    <option value="< 5jt">< 5 Juta</option>
                                    <option value="5jt - 15jt">5 - 15 Juta</option>
                                    <option value="15jt - 30jt">15 - 30 Juta</option>
                                    <option value="> 30jt">> 30 Juta</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-retro">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include('./includes/footer.php') ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    
    <!-- Custom