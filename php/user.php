<?php
session_start();
// Menghubungkan dengan file php lainya
require 'functions.php';
//melakukan query
$items = query("SELECT * FROM items");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="assets/icon/—Pngtree—samurai mask japanese general warrior_6570760.png">
    <title>wibu</title>
    <!-- css bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100" rel="stylesheet" />
    <!-- cssku -->
    <link rel="stylesheet" href="../assets/css/navbwah.css" />
    <link rel="stylesheet" href="../assets/css/slider.css" />
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css' rel='stylesheet' />

    <!-- script font awesome kit-->
    <script src="https://kit.fontawesome.com/e18581a144.js" crossorigin="anonymous"></script>

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js'></script>


    <style>
        .grid-wrapper {
            margin-top: 200px;
        }

        .image-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 10px;
        }

        .image-item img {
            width: 100%;
            height: auto;
        }

        @media only screen and (max-width: 767px) {
            .image-grid {
                grid-template-columns: repeat(2, 4fr);
            }
        }

        .popup-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .popup-container.show {
            opacity: 1;
            pointer-events: auto;
        }

        .popup-image {
            max-width: 80%;
            max-height: 80%;
        }

        .popup-close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px;
            background-color: transparent;
            border: none;
            font-size: 24px;
            color: #fff;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <!-- navbar -->
    <?php include('../tambahanlain/navatasuser.php') ?>
    <style>
        <?php include('../assets/css/slider.css') ?>
    </style>

    <!-- navbar end -->


    <!-- jumbotron show item -->
    <!-- <section class="show1 " style="margin-top: 30px !important;background: #FCBC94;">
    <div class="container mt-3 py-2">
      <div class="row">
        <div class="col-lg-6 px-4 py-5 d-flex mobile">
          <div class="px-4 py-5 mobile tom">
            <img style="width: 95%" src="./assets/img/2.png" alt="" />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="px-4 py-5">
            <img src="./assets/img/hero1.jpeg" class="py-5 w-100 responsivewidthfull" />
          </div>
          <div class="px-4 py-1">

            <p>
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut
              culpa, quisquam iure voluptatem rem sint, aspernatur quo non
              cupiditate eos excepturi explicabo ipsam optio facere saepe
              similique dolores aliquid reprehenderit?
            </p>
          </div>
          <div class="px4 py-1 promo">
            <img src="./assets/img/adidasMU.jpg" alt="" style="width: 50%" />
            <button style="margin-left: 100px; width: 100px" type="button" class="btn btn-outline-danger loginhp">
              BUY
            </button>
          </div>
        </div>
      </div>
    </div>
  </section> -->
    <section class="show1" style="margin-top: 70px !important; background: #FCBC94;">
        <div class="container mt-5 py-3">
            <div class="image-grid">
                <div class="image-item">
                    <a href="afterloginkategori.php?kategori=pria"><img src="../assets/img/MENSWEAR_auto_x2.png" alt="" /></a>
                </div>
                <div class="image-item">
                    <a href="afterloginkategori.php?kategori=wanita"><img src="../assets/img/WOMENSWEAR_auto_x2.png" alt="" /></a>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-6 col-md-3 mt-3 ">
                    <div class="image-item">
                        <a href="afterloginkategori.php?kategori=all"><img src="../assets/img/ALL.jpg" alt="" /></a>
                    </div>
                </div>
                <div class="col-6 col-md-3 mt-3">
                    <div class="image-item">
                        <a href="afterloginkategori.php?kategori=baju"><img src="../assets/img/TOPWEARS.png" alt="" /></a>
                    </div>
                </div>
                <div class="col-6 col-md-3 mt-3 ">
                    <div class="image-item">
                        <a href="afterloginkategori.php?kategori=celana"><img src="../assets/img/BOTTOMS1.png" alt="" /></a>
                    </div>
                </div>
                <div class="col-6 col-md-3 mt-3">
                    <div class="image-item">
                        <a href="afterloginkategori.php?kategori=aksesoris"><img src="../assets/img/accessories.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- jumbotron end -->

    <section class="aboutPromo" style="background-color: #FCBC94;">
        <div class="container-fluid
    ">
            <div class="row">
                <div class="col-lg-12 py-3 my-3">
                    <!-- carousel slide tampil -->
                    <div id="carouselExampleIndicators" class="carousel slide">
                        <div class="carousel-inner mx-auto">
                            <div class="carousel-item active">
                                <img src="../assets/img/jpun.png" alt="" class="d-block w-100 mx-auto" />
                            </div>
                            <div class="carousel-item">
                                <img src="../assets/img/harajukubanner.png" alt="" class="d-block w-100 mx-auto" />
                            </div>
                            <div class="carousel-item">
                                <img src="../assets/img/harajukuben.png" alt="" class="d-block w-100 mx-auto" />
                            </div>
                            <div class="carousel-item">
                                <img src="../assets/img/bagus.png" alt="" class="d-block w-100 mx-auto" />
                            </div>
                        </div>

                        <!-- carousel tampil button -->

                        <div class="carousel-indicators py-5 turun">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active thumbnail" aria-current="true" aria-label="Slide 1">
                                <img src="../assets/img/jpun.png" class="d-block w-100" alt="..." />
                            </button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="thumbnail" aria-label="Slide 2">
                                <img src="../assets/img/harajukubanner.png" class="d-block w-100" alt="..." />
                            </button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" class="thumbnail" aria-label="Slide 3">
                                <img src="../assets/img/harajukuben.png" class="d-block w-100" alt="..." />
                            </button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" class="thumbnail" aria-label="Slide 4">
                                <img src="../assets/img/bagus.png" class="d-block w-100" alt="..." />
                            </button>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- jumbotron show item end -->
    <!-- card promo item  start-->

    <!-- <section id="cardkatalog" style="background-color:#FCBC94; padding-top:20px">
        <div class="container">
            <?php if ($items) : ?>
                <div class="row">
                    <?php foreach ($items as $brg) : ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4 gambarnaik">
                            <div class="card p-1" style="width: 20rem; background:#D5A3B8;">
                                <a class="text-decoration-none" href="detailuser.php?id=<?= $brg["id"] ?>">
                                    <img src="../assets/img/<?= $brg["gambar"]; ?>" alt="foto" style="width: 100%; height: 400px;"></td>
                                    <div class="card-body">
                                        <h4>
                                            <?= $brg['nama'] ?> <br />
                                            <br />
                                            <span style="font-size: 13px; color:red;"><?= $brg['detail']; ?></span>
                                        </h4>
                                        <p>Produk Terbaru</p>
                                    </div>
                                </a>
                                <div class="card-fasilitas">
                                    <h4>Rp. <?= $brg['harga'] ?></h4>
                                    <p>&nbsp; Diskon</p>
                                    <form method="POST" action="keranjang.php">
                                        <input type="hidden" name="item_id" value="<?= $brg['id'] ?>">
                                        <?php if (isset($brg['kategori_id'])) : ?>
                                            <input type="hidden" name="kategori_id" value="<?= $brg['kategori_id'] ?>">
                                        <?php endif; ?>
                                        <button type="submit" name="tambah_keranjang" class="btn btn-primary">Tambahkan ke Keranjang</button>
                                    </form>

                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">
                            gaada
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section> -->
    <!-- card promo item end -->



    <div class="popup-container" id="popupContainer">
        <button class="popup-close-button" id="popupCloseButton">&times;</button>
        <img class="popup-image" src="../assets/img/ALL.jpg" alt="Popup Image">
    </div>
    <!-- card promo item end -->





    <section style="background: #FCBC94;">

        <div class="container" id="cardkatalog">
            <div class="row d-flex">
                <div class="col-lg-6 col-sm-6 pt-1">

                    <h3>OUR CONTACT</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, iure tenetur deleniti nulla quisquam sapiente. Quidem rerum dolorum deleniti, voluptatem, pariatur placeat nisi, sint sequi ducimus quae non sit molestiae!</p>
                </div>
                <div class="col-lg-6 col-sm-6 text-dark mb-3 ">
                    <h3>OUR LOCATION</h3>
                    <p>For more information, you can visit our location.</p>
                    <div class="d-flex " id="map" style="width: 600px; height:200px;"></div>
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
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/scriptUserLive.js"></script>
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoibGlzdmluZGFudSIsImEiOiJjbGkyOWhjc3UwMWFyM2NuejB1b3Z3ODd3In0.tihPfdMfJgp21xhCTku37Q';
    const map = new mapboxgl.Map({
        container: 'map', // container ID
        style: 'mapbox://styles/mapbox/streets-v12', // style URL
        center: [107.592096, -6.867794], // starting position [lng, lat]
        zoom: 18, // starting zoom
    });
    // Tambahkan marker
    var marker = new mapboxgl.Marker()
        .setLngLat([107.592096, -6.867794])
        .setPopup(new mapboxgl.Popup().setHTML("<h5>24e HarakujuHues</h5>"))
        .addTo(map);

    var zoomControl = new mapboxgl.NavigationControl();
    map.addControl(zoomControl);

    // Atur tingkat zoom
    map.on('load', function() {
        map.resize(); // Perbarui ukuran peta setelah memuatnya sepenuhnya
        map.flyTo({
            center: [107.592096, -6.867794],
            zoom: 18
        });
    });
</script>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        var cardkatalogSection = document.getElementById('cardkatalog');
        var popupContainer = document.getElementById('popupContainer');
        var popupCloseButton = document.getElementById('popupCloseButton');

        var showPopup = function() {
            popupContainer.classList.add('show');
        };

        // Periksa apakah popup telah ditampilkan sebelumnya
        if (!localStorage.getItem('popupShown')) {
            var cardkatalogSectionOffset = cardkatalogSection.offsetTop;
            var windowHeight = window.innerHeight;

            var handleScroll = function() {
                var scrollPosition = window.pageYOffset;

                if (scrollPosition + windowHeight >= cardkatalogSectionOffset) {
                    showPopup();
                    window.removeEventListener('scroll', handleScroll);
                    localStorage.setItem('popupShown', true); // Simpan informasi bahwa popup telah ditampilkan
                }
            };

            window.addEventListener('scroll', handleScroll);

            popupCloseButton.addEventListener('click', function() {
                popupContainer.classList.remove('show');
                localStorage.setItem('popupShown', true); // Simpan informasi bahwa popup telah ditampilkan
            });
        }
    });
</script>




<!-- script bootstrap -->

<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>

</html>