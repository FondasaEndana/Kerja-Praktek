<?php
    require "koneksi.php";

    $nama = htmlspecialchars($_GET['nama']);
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama='$nama'");
    $produk = mysqli_fetch_array($queryProduk);

    $queryProdukTerkait = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id = 
    '$produk[kategori_id]' AND id!='$produk[id]' LIMIT 4");

    if(isset($_POST['submit'])){
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $ketersediaan_stok = $_POST['ketersediaan_stok'];
        
        mysqli_query($conn, "INSERT INTO keranjang (nama, harga, ketersediaan_stok) VALUES ('$nama', '$harga', '$ketersediaan_stok')");
        
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Detail produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-produk.css">
</head>

<body>
    <?php require "navbar.php"; ?> 

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-3">
                    <img src="image/<?php echo $produk['foto']; ?>" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <form action="keranjang.php" method="post">
                        <h1><?php echo $produk['nama']; ?></h1>
                        <input type="hidden" name="nama" value="<?php echo $produk['nama']; ?>"> 

                        <p class="fs-5">
                            <?php echo $produk['detail']; ?>
                        </p>

                        <p class="fs-3 text-harga">
                            Rp.<?php echo $produk['harga']; ?>
                            <input type="hidden" name="harga" value="<?php echo $produk['harga']; ?>"> 
                        </p>

                        <p class="fs-5">
                            Status Ketersediaan : <strong><?php echo $produk['ketersediaan_stok']; ?></strong>
                            <input type="hidden" name="ketersediaan_stok" value="<?php echo $produk['ketersediaan_stok']; ?>"> 
                        </p>

                        <p class="fs-5">
                            <button class="btn btn-outline-primary" type="submit" name="submit"> Beli </button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 warna1">
        <div class="container">
            <h2 class="text-center text-white mb-5"> Produk Terkait </h2>

            <div class="row">
                <?php while($data=mysqli_fetch_array($queryProdukTerkait)){ ?>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>">
                        <img src="image/<?php echo $data['foto']; ?>" class="img-fluid img-thumbnail produk-terkait-image" alt="">
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require "footer.php"; ?>
    
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
