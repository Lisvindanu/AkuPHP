<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="./assets/img/anaphygon-logo.png" alt="Anaphygon Retro" class="me-2">
            <span style="font-weight: bold; color: var(--retro-orange);">ANAPHYGON RETRO</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#portfolio">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./php/about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
                <?php
                if (isset($_SESSION['submit']) && $_SESSION['submit'] === true) {
                    if ($_SESSION['role'] === 'admin') {
                        echo '<li class="nav-item">
                                <a class="nav-link btn btn-outline-warning btn-sm ms-2" href="./php/admin.php">Admin Panel</a>
                              </li>';
                    }
                    echo '<li class="nav-item">
                            <a class="nav-link btn btn-outline-danger btn-sm ms-2" href="./php/logout.php">Logout</a>
                          </li>';
                } else {
                    echo '<li class="nav-item">
                            <a class="nav-link btn btn-outline-success btn-sm ms-2" href="./php/login.php">Login</a>
                          </li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>