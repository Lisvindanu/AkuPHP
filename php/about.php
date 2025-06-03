<?php
session_start();
// Menghubungkan dengan file php lainya
require 'functions.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/navbwah.css" />
    <link rel="stylesheet" href="../assets/css/slider.css" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100" rel="stylesheet" />
</head>

<body>
    <?php include('../tambahanlain/navatasuser.php') ?>
    <style>
        <?php include('../assets/css/slider.css') ?>
    </style>



    <section id="about" style="background-color:#FCBC94;">
        <div class="container center " style="margin-top: 70px; padding-top:30px;">
            <div class="row">

                <div class="col-12">
                    <img class="m-auto" src="../assets/img/harajukuabout.jpg" alt="" style="display: block; margin: 0 auto; width: 500px;">
                </div>
                <div class="col-12 pb-4 text-center">
                    <p>Welcome to HarajukuHues. <br>
                        ハラジュクヒューズ </p>
                    <p>a platform dedicated to showcasing the uniqueness and beauty of Harajuku fashion! We curate a collection of clothing, accessories, and fashion inspiration for those who love bold and creative self-expression. Discover vibrant colors, unique designs, and the latest trends in Harajuku's popular culture.</p>
                </div>

            </div>
        </div>
    </section>




    <!-- nav hp -->
    <?php include('../tambahanlain/navbarhpuser.php') ?>
    <!-- nav hp end -->



    <!-- footer -->
    <?php include('../tambahanlain/futer.php') ?>
    <!-- footer end -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>