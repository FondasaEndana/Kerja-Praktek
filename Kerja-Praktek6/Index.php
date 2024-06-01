<?php
require "sessionToko.php";
require "koneksi.php";

$queryProduk = mysqli_query($conn, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> TOKO ONLINE | HOME </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="Javascript/carousel.js">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

</head>

<style>
    .c-img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        filter: brightness(0.6);
    }

    .owl-carousel .item {
        position: relative;
        overflow: hidden;
    }

    .owl-carousel .item img {
        width: 100%;
    }

    .owl-carousel .item .carousel-caption {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        width: 100%;
        padding: 20px;
        color: #fff;
    }

    .owl-carousel .item img {
        width: 100%;
        height: 600px;
        /* Adjust this value as needed */
    }

    .kategori-ram1 {
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
            url('Background_image/BGram.jpeg');
        background-size: cover;
        background-position: center;
    }

    .kategori-ssd1 {
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
            url('Background_image/BGssd.jpeg');
        background-size: cover;
        background-position: center;
    }

    .kategori-keyboard1 {
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
            url('Background_image/BGkeyboard.jpeg');
        background-size: cover;
        background-position: center;
    }

    .banner1 {
        height: 85vh;
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
            url('Background_image/BGssd.jpeg');
    }
</style>

<body>
    <?php require "navbar.php"; ?>

    <!-- Banner -->
    <div class="container-fluid banner1 d-flex align-items-center mb-5">
        <div class="container warnatulisan text-center">
            <h1> SAHABAT TEKNIK </h1>
            <h3> Apa Yang Ingin Dicari? </h3>

            <div class="col-md-8 offset-md-2">
                <form action="produk.php" method="get">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Nama Barang" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn warna3"> Telusuri </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Banner end -->

    <!-- Carousel -->
    <section class="owl-carousel owl-theme" id="hero-carousel">
        <div class="item">
            <img src="Background_image/BG_SahabatTeknik2.png" alt="Slide 1" class="c-img">
            <div class="carousel-caption">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
            </div>
        </div>
        <div class="item">
            <img src="Background_image/BG_SahabatTeknik.png" alt="Slide 2" class="c-img">
            <div class="carousel-caption">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
            </div>
        </div>
        <div class="item">
            <img src="Background_image/BG_SahabatTeknik3.png" alt="Slide 3" class="c-img">
            <div class="carousel-caption">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
            </div>
        </div>
    </section>
    <!-- Carousel end-->

    <!-- Kategori Highlight -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3> Kategori Terlaris </h3>

            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div class="highlight-kategori kategori-ram1 d-flex justify-content-center
            align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=RAM"> RAM </a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlight-kategori kategori-ssd1 d-flex justify-content-center
            align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=SSD"> SSD </a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlight-kategori kategori-keyboard1 d-flex justify-content-center
            align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Keyboard"> Keyboard </a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gighlight End -->


    <!-- about us -->

    <div class="container-fluid warna2 py-5">
        <div class="container text-center">
            <h3 class="text-white"> About Us </h3>
            <p class="fs-5 mt-3 text-white fa-align-justify">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, doloribus perspiciatis, aut consequuntur corrupti ducimus hic nulla
                consectetur quasi odio harum quidem natus doloremque ex, tenetur aspernatur veniam! Modi est tempore ea necessitatibus eum magnam,
                saepe exercitationem aliquam fugit esse repellendus at corporis reiciendis non ut iusto, quidem aut repellat dolorum harum? Voluptatem aspernatur,
                asperiores suscipit rerum, vel delectus harum earum ex, odio veritatis commodi minus odit debitis amet! Earum nisi illo consequatur molestias ullam voluptatibus maxime quasi harum praesentium!
            </p>
        </div>
    </div>

    <!-- produk -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>

            <div class="row mt-5">
                <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>
                    <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="image/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $data['nama']; ?></h4>
                                <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
                                <p class="card-text text-harga">Rp.<?php echo $data['harga']; ?></p>
                                <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn warna2 text-white">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php require "footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#hero-carousel").owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 5000, // 5 seconds
                autoplayHoverPause: true,
                smartSpeed: 1000, // Smooth transition speed
                nav: true,
                navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"]
            });
        });
    </script>


</body>

</html>