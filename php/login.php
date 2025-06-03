<?php
session_start();
require 'functions.php';

// Cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // Ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT id, username, role FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // Cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['submit'] = true;
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['user_id'] = $row['id'];
    }
}

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    // Cek username
    if (mysqli_num_rows($result) === 1) {
        // Cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // Set session
            $_SESSION["submit"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $row['role'];
            $_SESSION["user_id"] = $row['id'];

            // Set cookie untuk kalimat selamat datang
            setcookie("username", $username, time() + 3600);

            // Cek remember me
            if (isset($_POST['remember'])) {
                // Buat cookie
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            // Redirect ke halaman sesuai peran
            if ($row['role'] === 'admin') {
                header("Location: admin.php");
                exit;
            } else {
                header("Location: ../index.php");
                exit;
            }
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Anaphygon Retro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/auth.css">
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
            background: linear-gradient(135deg, var(--retro-dark) 0%, var(--retro-purple) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .auth-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 0;
            border: 4px solid var(--retro-orange);
            box-shadow: 10px 10px 0px var(--retro-dark);
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .auth-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--retro-orange), var(--retro-pink), var(--retro-purple));
        }

        .auth-title {
            color: var(--retro-dark);
            font-weight: bold;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.5rem;
            text-transform: uppercase;
        }

        .form-control {
            border-radius: 0;
            border: 2px solid var(--retro-orange);
            font-family: 'Courier New', monospace;
            font-weight: bold;
        }

        .form-control:focus {
            border-color: var(--retro-pink);
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
        }

        .btn-retro {
            background: linear-gradient(45deg, var(--retro-orange), var(--retro-pink));
            color: white;
            border: none;
            border-radius: 0;
            font-weight: bold;
            text-transform: uppercase;
            box-shadow: 5px 5px 0px var(--retro-dark);
            transition: all 0.3s ease;
        }

        .btn-retro:hover {
            transform: translate(-2px, -2px);
            box-shadow: 7px 7px 0px var(--retro-dark);
            color: white;
        }

        .btn-cancel {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--retro-dark);
        }

        .error-message {
            background: var(--retro-orange);
            color: white;
            padding: 10px;
            border-radius: 0;
            margin-bottom: 1rem;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="auth-container">
                    <button class="btn-cancel" onclick="window.location.href='../index.php'">
                        <i class="fas fa-times"></i>
                    </button>
                    
                    <h3 class="auth-title">Login</h3>
                    
                    <form action="" method="post">
                        <?php if (isset($error)) : ?>
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Username atau Password salah!
                            </div>
                        <?php endif; ?>
                        
                        <div class="form-floating mb-3">
                            <input class="form-control" type="text" name="username" id="username" placeholder="Username" autocomplete="off" required autofocus>
                            <label for="username">Username</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="true" name="remember" id="remember">
                            <label for="remember" class="form-check-label">Remember Me</label>
                        </div>
                        
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" name="submit" class="btn btn-retro btn-lg">Login</button>
                        </div>
                        
                        <div class="text-center">
                            <p>Belum memiliki akun? <a href="registrasi.php" class="text-decoration-none" style="color: var(--retro-orange); font-weight: bold;">Daftar Disini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/6dd84d01cb.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>

</html>