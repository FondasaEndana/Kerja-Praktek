<?php
require "session.php";
require "../koneksi.php";

$querykategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahkategori = mysqli_num_rows($querykategori);

$queryproduk = mysqli_query($conn, "SELECT * FROM produk");
$jumlahproduk = mysqli_num_rows($queryproduk);

$queryNota = mysqli_query($conn, "SELECT * FROM nota_servis");
$jumlahNota = mysqli_num_rows($queryNota);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Admin</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">

    <style>
        body {
            background-image: url('originalSatnikk.png');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .kotak {
            border: solid;
        }

        .summary-kategori {
            background-color: #4DD0E1;
            border-radius: 15px;
            border: 2px solid #4DD0E1;
            /* Penyesuaian border */
        }

        .summary-produk {
            background-color: #03A9F4;
            border-radius: 15px;
            border: 2px solid #03A9F4;
            /* Penyesuaian border */
        }

        .summary-nota {
            background-color: #154c79;
            border-radius: 15px;
            border: 2px solid #154c79;
            /* Penyesuaian border */
        }

        .no-decoration {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-4">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-home"></i> Home
                </li>
            </ol>
        </nav>
        <h1 class=" text-center">HALO: <?php echo $_SESSION['username'] ?></h1>

        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 summary-kategori p-3 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <i class="fas fa-align-justify fa-5x "></i>
                        </div>
                        <div class="col-7 text-white">
                            <h3 class="fs-2">Kategori</h3>
                            <p class="fs-4"><?php echo $jumlahkategori; ?> Kategori</p>
                            <p><a href="kategori.php" class="no-decoration text-white">Tampilkan...</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 summary-produk p-3 mb-3 ms-auto">
                    <div class="row">
                        <div class="col-5">
                            <i class="fas fa-box fa-5x "></i>
                        </div>
                        <div class="col-7 text-white">
                            <h3 class="fs-2">Produk</h3>
                            <p class="fs-4"><?php echo $jumlahproduk; ?> Produk</p>
                            <p><a href="produk.php" class=" no-decoration text-white">Tampilkan...</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 summary-nota p-3 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <i class="fas fa-receipt fa-5x"></i>
                        </div>
                        <div class="col-7 text-white">
                            <h3 class="fs-2">Nota</h3>
                            <p class="fs-4"><?php echo $jumlahNota; ?> Total</p>
                            <p><a href="nota.php" class=" no-decoration text-white">Tampilkan...</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 summary-nota p-3 mb-3 ms-auto">
                    <div class="row">
                        <div class="col-5">
                            <i class="fas fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-7 text-white">
                            <h3 class="fs-2">Penjualan</h3>
                            <p class="fs-4">Total <?php echo $jumlahproduk; ?> Produk</p>
                            <p><a href="penjualan_stok.php" class=" no-decoration text-white">Tampilkan...</a></p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>