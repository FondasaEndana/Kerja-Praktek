<?php
require "session.php";
require "../koneksi.php";

// Ambil data bulan dan tahun dari dropdown
if (isset($_POST['submit'])) {
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    // Query untuk mendapatkan data laporan berdasarkan bulan dan tahun yang dipilih
    // Anda perlu menyesuaikan query ini sesuai dengan struktur tabel Anda
    $query = mysqli_query($conn, "SELECT SUM(total_biaya) AS total_servis FROM nota_servis WHERE MONTH(tanggal_servis) = '$bulan' AND YEAR(tanggal_servis) = '$tahun'");
    $data = mysqli_fetch_assoc($query);
    $total_servis = $data['total_servis'];

    // Query untuk mendapatkan data penjualan produk
    // Anda perlu menyesuaikan query ini sesuai dengan struktur tabel Anda
    // $query_penjualan = mysqli_query($conn, "SELECT SUM(total_harga) AS total_penjualan FROM penjualan WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'");
    // $data_penjualan = mysqli_fetch_assoc($query_penjualan);
    // $total_penjualan = $data_penjualan['total_penjualan'];

    // Query untuk mendapatkan data penjualan sparepart
    // Anda perlu menyesuaikan query ini sesuai dengan struktur tabel Anda
    $query_sparepart = mysqli_query($conn, "SELECT SUM(total_biaya) AS total_sparepart FROM nota_sparepart WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'");
    $data_sparepart = mysqli_fetch_assoc($query_sparepart);
    $total_sparepart = $data_sparepart['total_sparepart'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <title>Laporan | Admin</title>
</head>

<body>
    <?php
    require "navbar.php"
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
                        <i class="fas fa-cogs"></i> Laporan
                    </li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-6">
                    <h2>Laporan Kantor</h2>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="bulan" class="form-label">Pilih Bulan</label>
                            <select class="form-select" id="bulan" name="bulan" required>
                                <option value="">Pilih Bulan</option>
                                <?php
                                // Generate dropdown untuk bulan
                                for ($i = 1; $i <= 12; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Pilih Tahun</label>
                            <select class="form-select" id="tahun" name="tahun" required>
                                <option value="">Pilih Tahun</option>
                                <?php
                                // Generate dropdown untuk tahun, misalnya dari tahun 2010 hingga tahun sekarang
                                $tahun_sekarang = date('Y');
                                for ($i = 2010; $i <= $tahun_sekarang; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Cari</button>
                    </form>

                    <?php
                    if (isset($_POST['submit'])) {
                    ?>
                        <!-- Detail total servis -->
                        <div>
                            <h3 class="mt-4">Detail Laporan Bulanan & Tahunan</h3>
                            <table class="table table-striped">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Nota</th>
                                        <th>Tanggal Servis</th>
                                        <th>Kerusakan</th>
                                        <th>Total Biaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Query untuk mendapatkan detail nota servis berdasarkan bulan dan tahun yang dipilih
                                    $query_detail = mysqli_query($conn, "SELECT * FROM nota_servis WHERE MONTH(tanggal_servis) = '$bulan' AND YEAR(tanggal_servis) = '$tahun'");
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($query_detail)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . $row['nama_servis'] . "</td>";
                                        echo "<td>" . $row['tanggal_servis'] . "</td>";
                                        echo "<td>" . $row['servis'] . "</td>";
                                        echo "<td>" . $row['total_biaya'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <h3 class="mt-4">Detail Nota Penjualan</h3>
                            <table class="table table-striped">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Sparepart</th>
                                        <th>Tanggal</th>
                                        <th>Total Biaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Query untuk mendapatkan detail nota sparepart berdasarkan bulan dan tahun yang dipilih
                                    $query_sparepart_detail = mysqli_query($conn, "SELECT * FROM nota_sparepart WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'");
                                    $no = 1;
                                    while ($row_sparepart = mysqli_fetch_assoc($query_sparepart_detail)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . $row_sparepart['nama_sparepart'] . "</td>";
                                        echo "<td>" . $row_sparepart['tanggal'] . "</td>";
                                        echo "<td>" . $row_sparepart['total_biaya'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-end">
                            <h4 class="text-center">
                                Bulan: <?php echo $bulan; ?>
                                <div></div>
                                Tahun: <?php echo $tahun; ?> &nbsp;&nbsp;
                            </h4>
                            <h4 class="text-center">
                                Total Servis: <?php echo $total_servis; ?>
                            </h4>
                            <h4 class="text-center">
                                Total Penjualan: <?php echo $total_sparepart; ?>
                            </h4>
                        </div>
                    <?php
                    }
                    ?>

                </div>

                <div class="col-md-6">
                    <!-- Laporan Tahunan -->
                </div>
            </div>
        </div>
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>