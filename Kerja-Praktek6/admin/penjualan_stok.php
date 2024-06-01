<?php
require "session.php";
require "../koneksi.php";

$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b 
ON a.kategori_id=b.id ORDER BY a.tanggal DESC");

$jumlahProduk = mysqli_num_rows($query);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="styleAdmin.css">
    <title>Penjualan | Admin</title>
</head>

<body>

    <?php
    require "navbar.php";
    ?>
    <div class="d-flex">
        <?php include "sidebar.php" ?>
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="text-muted text-decoration-none">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-shopping-cart"></i> Penjualan
                </li>
            </ol>
        </nav>
        <h2 class="mb-4"> Data Penjualan </h2>
        <div class="table-responsive mt-3">
            <table class="table">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Stok Barang</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <tbody class="table-group-divider table-divider-color">
                    <?php
                    if ($jumlahProduk == 0) {
                    ?>
                        <tr>
                            <td colspan=6 class="text-center">Tidak ada Data Untuk Produk</td>
                        </tr>
                        <?php
                    } else {
                        $jumlah = 1;
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $jumlah; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['nama_kategori']; ?></td>
                                <td><?php echo $data['harga']; ?></td>
                                <td><?php echo $data['tanggal']; ?></td>
                                <td><?php echo $data['stok_barang']; ?> </td>
                                <td>
                                    <a href="detail-penjualan.php?p=<?php echo $data['id']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a>
                                </td>
                            </tr>
                    <?php
                            $jumlah++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        </div>
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>