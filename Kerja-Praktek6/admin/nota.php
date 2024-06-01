<?php
require "session.php";
require "../koneksi.php";

$queryNotaServis = mysqli_query($conn, "SELECT * FROM nota_servis");
$queryNotaSparepart = mysqli_query($conn, "SELECT * FROM nota_sparepart");

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $length > $i; $i++) {
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
    <title>Nota | Admin</title>
</head>

<body>
    <?php
    require "navbar.php";
    ?>
    <div class="d-flex">

        <?php include 'sidebar.php'; ?>

        <div class="container mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="index.php" class="text-muted text-decoration-none">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-align-justify"></i> Nota
                    </li>
                </ol>
            </nav>

            <!-- Tampilkan Nota Servis -->
            <div class="row justify-content-between mt-4">
                <div class="col-md-6">
                    <h2 class="mb-3">Nota Servis</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kerusakan</th>
                                    <th>Tanggal Servis</th>
                                    <th>Total Biaya</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider table-divider-color">
                                <?php
                                $jumlah = 1;
                                while ($data = mysqli_fetch_array($queryNotaServis)) {
                                ?>
                                    <tr>
                                        <td><?php echo $jumlah; ?></td>
                                        <td><?php echo $data['nama_servis']; ?></td>
                                        <td><?php echo $data['servis']; ?></td>
                                        <td><?php echo $data['tanggal_servis']; ?></td>
                                        <td><?php echo $data['total_biaya']; ?></td>
                                        <td>
                                            <a href="detail_nota.php?id=<?php echo $data['id']; ?>" class="btn btn-info">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $jumlah++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 text-center">
                        <a href="tambah_nota.php" class="btn btn-success mb-3">
                            <i class="fas fa-plus fa-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Tampilkan Nota Sparepart -->
                <div class="col-md-6">
                    <h2 class="mb-3">Nota Penjualan</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Sparepart</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider table-divider-color">
                                <?php
                                $jumlah = 1;
                                while ($data = mysqli_fetch_array($queryNotaSparepart)) {
                                ?>
                                    <tr>
                                        <td><?php echo $jumlah; ?></td>
                                        <td><?php echo $data['nama_sparepart']; ?></td>
                                        <td><?php echo $data['total_biaya']; ?></td>
                                        <td><?php echo $data['jumlah_sparepart']; ?></td>
                                        <td>
                                            <a href="detail_nota_sparepart.php?id=<?php echo $data['id']; ?>" class="btn btn-info">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $jumlah++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 text-center">
                        <a href="tambah_nota_sparepart.php" class="btn btn-success mb-3">
                            <i class="fas fa-plus fa-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>