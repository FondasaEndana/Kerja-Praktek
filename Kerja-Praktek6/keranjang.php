<?php
    require "koneksi.php";

    $queryKeranjang = mysqli_query($conn, "SELECT * FROM keranjang");
    $jumlahProduk = mysqli_num_rows($queryKeranjang);

    if(isset($_POST['submit'])){
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $ketersediaan_stok = $_POST['ketersediaan_stok'];
        
        mysqli_query($conn, "INSERT INTO keranjang (nama, harga, ketersediaan_stok) VALUES ('$nama', '$harga', '$ketersediaan_stok')");
    }
?>
    <?php
        // Hitung total pembayaran
        $queryTotal = mysqli_query($conn, "SELECT SUM(harga) AS total FROM keranjang");
        $dataTotal = mysqli_fetch_array($queryTotal);
        $totalPembayaran = $dataTotal['total'];
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Keranjang</title>
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
                <div class="mt-3 mb-5">
                    <h2> LIST DIBELI </h2>

                    <div class="table-responsive mt-5">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama.</th>
                                    <th>Harga</th>
                                    <th>Ketersediaan Stok</th>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($jumlahProduk == 0){
                                ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada Data Untuk Produk</td>
                                        </tr>
                                <?php
                                    }
                                    else
                                    {
                                        $jumlah = 1;
                                        while($dataKeranjang = mysqli_fetch_array($queryKeranjang)){
                                ?>
                                        <tr>
                                            <td><?php echo $jumlah; ?></td>
                                            <td><?php echo $dataKeranjang['nama']; ?></td>
                                            <td><?php echo $dataKeranjang['harga']; ?></td>
                                            <td><?php echo $dataKeranjang['ketersediaan_stok']; ?></td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="nama" value="<?php echo $dataKeranjang['nama']; ?>">
                                                    <button class="btn btn-danger" type="submit" name="hapus"> Hapus </button>
                                                </form>
                                            </td>
                                        </tr>           
                                <?php
                                            $jumlah++;
                                        }
                                    }
                                ?>
                        </table>
                        </tbody>
                                <?php  
                                    if(isset($_POST['hapus'])){
                                        $nama = $_POST['nama'];
                                        $queryHapus = mysqli_query($conn, "DELETE FROM keranjang WHERE nama = '$nama'");

                                        if($queryHapus){
                                ?>
                                            <div class="d-flex justify-content-center">
                                                <div class="alert alert-primary my-3 text-center" role="alert" style="width: 25%;">
                                                    Produk Terhapus!
                                                </div>
                                            </div>




                                            <meta http-equiv="refresh" content="1; url=keranjang.php" />
                                <?php
                                        }
                                    }
                                ?>

                                    <div class="table-responsive mt-5">
                                        <table class="table">
                                            <!-- Isi tabel -->
                                        </table>

                                        <div class="text-end">
                                            <h4>Total Pembayaran: <?php echo $totalPembayaran; ?></h4>
                                            
                                            <form action="" method="post">
                                                <div class="mb-3">
                                                    <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                                                    <select class="form-select" name="metode_pembayaran" id="metode_pembayaran">
                                                        <option value="cash">Cash</option>
                                                        <option value="credit_card">Credit Card</option>
                                                        <option value="transfer_bank">Transfer Bank</option>
                                                    </select>
                                                </div>
                                                
                                                <button class="btn btn-primary" type="submit" name="submit_pembayaran">Submit Pembayaran</button>
                                            </form>
                                        </div>
                                    </div>
<?php

                                    if(isset($_POST['submit_pembayaran'])){
                                        $metodePembayaran = $_POST['metode_pembayaran'];
                                        
                                        // Lakukan tindakan berdasarkan metode pembayaran yang dipilih
                                        switch($metodePembayaran){
                                            case 'cash':
                                                // Logika untuk metode pembayaran cash
                                                break;
                                                
                                            case 'credit_card':
                                                // Logika untuk metode pembayaran credit card
                                                break;
                                                
                                            case 'transfer_bank':
                                                // Logika untuk metode pembayaran transfer bank
                                                break;
                                        }
                                    }

?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class=""></div>
    </div>

    <?php require "footer.php" ?> 
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>
