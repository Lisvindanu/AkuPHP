<?php
session_start();
// Menghubungkan dengan file php lainya
require 'functions.php';
$team = query("SELECT * FROM team LIMIT 4");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About - Anaphygon Retro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/navbwah.css" />
    <link rel="stylesheet" href="../assets/css/slider.css" />
    <link rel="stylesheet" href="../assets/css/company.css" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/e18581a144.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('../tambahanlain/navbar-internal.php') ?>
    
    <style>
        .hero-about {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 120px 0 80px 0;
            margin-top: 77px;
        }
        
        .value-card {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            height: 100%;
        }
        
        .value-card:hover {
            transform: translateY(-5px);
        }
        
        .value-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem auto;
        }
        
        .team-card {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            overflow: hidden;
        }
        
        .team-card:hover {
            transform: translateY(-5px);
        }
        
        .team-img {
            height: 250px;
            object-fit: cover;
        }
        
        .stats-section {
            background: #f8f9fa;
            padding: 80px 0;
        }
        
        .stat-item {
            text-align: center;
            padding: 20px;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            color: #667eea;
        }
        
        .mission-vision {
            padding: 80px 0;
            background: white;
        }
        
        .mission-card, .vision-card {
            padding: 40px;
            border-radius: 15px;
            height: 100%;
        }
        
        .mission-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .vision-card {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
        }
    </style>

    <!-- Hero Section -->
    <section class="hero-about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">About Anaphygon Retro</h1>
                    <p class="lead mb-4">
                        We are a passionate team of digital innovators dedicated to creating exceptional 
                        digital experiences that drive business growth and transform the way companies 
                        connect with their audiences.
                    </p>
                    <p class="mb-4">
                        Founded with a vision to bridge the gap between technology and business success, 
                        we combine creativity, technical expertise, and strategic thinking to deliver 
                        solutions that make a real impact.
                    </p>
                </div>
                <div class="col-lg-6">
                    <img src="../assets/img/about-hero.svg" alt="About Us" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="mission-vision">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="mission-card">
                        <div class="mb-4">
                            <i class="fas fa-bullseye fa-3x"></i>
                        </div>
                        <h3 class="mb-4">Our Mission</h3>
                        <p class="mb-0">
                            To empower businesses with innovative digital solutions that enhance their 
                            online presence, streamline operations, and drive sustainable growth. We 
                            strive to be the trusted partner that helps organizations navigate the 
                            digital landscape with confidence and success.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="vision-card">
                        <div class="mb-4">
                            <i class="fas fa-eye fa-3x text-primary"></i>
                        </div>
                        <h3 class="mb-4">Our Vision</h3>
                        <p class="mb-0">
                            To be the leading digital solutions provider that transforms how businesses 
                            operate in the digital age. We envision a future where technology seamlessly 
                            integrates with business goals, creating meaningful connections between 
                            companies and their customers worldwide.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-5" style="background-color: #ffffff;">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold mb-3">Our Values</h2>
                    <p class="lead text-muted">The principles that guide everything we do</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card value-card">
                        <div class="card-body text-center p-4">
                            <div class="value-icon">
                                <i class="fas fa-lightbulb fa-2x text-white"></i>
                            </div>
                            <h5 class="card-title">Innovation</h5>
                            <p class="card-text">We constantly explore new technologies and creative approaches to solve complex challenges.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card value-card">
                        <div class="card-body text-center p-4">
                            <div class="value-icon">
                                <i class="fas fa-users fa-2x text-white"></i>
                            </div>
                            <h5 class="card-title">Collaboration</h5>
                            <p class="card-text">We believe in the power of teamwork and building strong partnerships with our clients.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card value-card">
                        <div class="card-body text-center p-4">
                            <div class="value-icon">
                                <i class="fas fa-star fa-2x text-white"></i>
                            </div>
                            <h5 class="card-title">Excellence</h5>
                            <p class="card-text">We are committed to delivering the highest quality solutions that exceed expectations.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card value-card">
                        <div class="card-body text-center p-4">
                            <div class="value-icon">
                                <i class="fas fa-shield-alt fa-2x text-white"></i>
                            </div>
                            <h5 class="card-title">Integrity</h5>
                            <p class="card-text">We maintain transparency, honesty, and ethical practices in all our interactions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold mb-3">Our Impact</h2>
                    <p class="lead text-muted">Numbers that speak for themselves</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">150+</div>
                        <h5>Projects Delivered</h5>
                        <p class="text-muted">Successful projects across various industries</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <h5>Happy Clients</h5>
                        <p class="text-muted">Long-term partnerships built on trust</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">5+</div>
                        <h5>Years Experience</h5>
                        <p class="text-muted">Proven track record in digital solutions</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">99%</div>
                        <h5>Client Satisfaction</h5>
                        <p class="text-muted">Exceeding expectations consistently</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Preview Section -->
    <section class="py-5" style="background-color: #ffffff;">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold mb-3">Meet Our Team</h2>
                    <p class="lead text-muted">The talented people behind our success</p>
                </div>
            </div>
            <div class="row g-4">
                <?php if ($team && count($team) > 0) : ?>
                    <?php foreach ($team as $member) : ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card team-card">
                                <img src="../assets/img/team/<?= $member['photo'] ?>" class="card-img-top team-img" alt="<?= $member['name'] ?>">
                                <div class="card-body text-center p-4">
                                    <h5 class="card-title"><?= $member['name'] ?></h5>
                                    <p class="text-primary mb-2"><?= $member['position'] ?></p>
                                    <p class="card-text text-muted small"><?= substr($member['bio'], 0, 100) ?>...</p>
                                    <div class="mt-3">
                                        <a href="mailto:<?= $member['email'] ?>" class="btn btn-outline-primary btn-sm me-2">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                        <a href="<?= $member['linkedin'] ?>" class="btn btn-outline-primary btn-sm" target="_blank">
                                            <i class="fab fa-linkedin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <!-- Default team members if no data -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card team-card">
                            <img src="../assets/img/team/default1.jpg" class="card-img-top team-img" alt="Team Member">
                            <div class="card-body text-center p-4">
                                <h5 class="card-title">John Doe</h5>
                                <p class="text-primary mb-2">CEO & Founder</p>
                                <p class="card-text text-muted small">Passionate about technology and innovation...</p>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-outline-primary btn-sm me-2">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-primary btn-sm">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card team-card">
                            <img src="../assets/img/team/default2.jpg" class="card-img-top team-img" alt="Team Member">
                            <div class="card-body text-center p-4">
                                <h5 class="card-title">Jane Smith</h5>
                                <p class="text-primary mb-2">CTO</p>
                                <p class="card-text text-muted small">Expert in software architecture and development...</p>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-outline-primary btn-sm me-2">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-primary btn-sm">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card team-card">
                            <img src="../assets/img/team/default3.jpg" class="card-img-top team-img" alt="Team Member">
                            <div class="card-body text-center p-4">
                                <h5 class="card-title">Mike Johnson</h5>
                                <p class="text-primary mb-2">Lead Designer</p>
                                <p class="card-text text-muted small">Creative designer with eye for detail...</p>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-outline-primary btn-sm me-2">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-primary btn-sm">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card team-card">
                            <img src="../assets/img/team/default4.jpg" class="card-img-top team-img" alt="Team Member">
                            <div class="card-body text-center p-4">
                                <h5 class="card-title">Sarah Wilson</h5>
                                <p class="text-primary mb-2">Project Manager</p>
                                <p class="card-text text-muted small">Ensures projects are delivered on time...</p>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-outline-primary btn-sm me-2">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-primary btn-sm">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="text-center mt-5">
                <a href="team.php" class="btn btn-primary btn-lg">View Full Team</a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h2 class="display-5 fw-bold mb-4">Ready to Work With Us?</h2>
                    <p class="lead mb-4">
                        Let's discuss how we can help transform your digital presence and achieve your business goals.
                    </p>
                    <a href="contact.php" class="btn btn-light btn-lg">Start Your Project</a>
                </div>
            </div>
        </div>
    </section>

    <?php include('../tambahanlain/navbarhp.php') ?>
    <?php include('../tambahanlain/footer.php') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>