<?php
require "session.php";
require "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    // Jika ID nota tidak ditemukan, arahkan pengguna ke halaman lain atau tampilkan pesan kesalahan
    header("Location: nota.php");
    exit();
}

$queryNotaSparepart = mysqli_query($conn, "SELECT * FROM nota_sparepart WHERE id = '$id'");
$data = mysqli_fetch_array($queryNotaSparepart);

// Pastikan $data tidak kosong
if (!$data) {
    // Jika data nota tidak ditemukan, arahkan pengguna ke halaman lain atau tampilkan pesan kesalahan
    header("Location: nota.php");
    exit();
}

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="styleAdmin.css">
    <title>Detail Nota Sparepart</title>
</head>

<body>
    <?php
    require "navbar.php";
    ?>
    <div class="container mt-3">
        <h2>Tambah Nota Sparepart</h2>

        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/form-data" id="formSubmit">
                <div>
                    <label for="nama" class="mt-1 "> Nama Sparepart </label>
                    <input type="text" id="nama" name="nama" value="<?php echo $data['nama_sparepart']; ?>" class="form-control mt-1" autocomplete="off" required>
                </div>

                <div>
                    <label for="merk" class="mt-1 "> Merk </label>
                    <input type="text" id="merk" name="merk" value="<?php echo $data['merk']; ?>" class="form-control mt-1">
                </div>

                <div>
                    <label for="jumlah_sparepart" class="mt-1 "> Jumlah Sparepart </label>
                    <input type="number" id="jumlah_sparepart" name="jumlah_sparepart" value="<?php echo $data['jumlah_sparepart']; ?>" class="form-control mt-1">
                </div>

                <div>
                    <label for="serial_number" class="mt-1 "> S/N </label>
                    <input type="text" name="sn" id="serial_number" value="<?php echo $data['serial_number']; ?>" class="form-control">
                </div>


                <div>
                    <label for="total_biaya" class="mt-1 "> Total Biaya </label>
                    <input type="number" class="form-control" name="total_biaya" value="<?php echo $data['total_biaya']; ?>" required>
                </div>

                <div>
                    <div>
                        <label for="tanggal" class="mt-1 mb-2 "> Tanggal </label>
                        <input type="datetime-local" id="tanggal" name="tanggal" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($data['tanggal'])); ?>" required>
                    </div>
                </div>

                <div>
                    <label for="keterangan" class="mt-1 "> Keterangan </label>
                    <textarea name="keterangan" id="keterangan" cols="30" rows="10" value="<?php echo $data['keterangan']; ?>" class="form-control"></textarea>
                </div>


                <div>
                    <button type="submit" class="btn btn-outline-primary" name="simpan">Edit</button>
                </div>

            </form>
            <?php
            if (isset($_POST['simpan'])) {
                // Ambil nilai dari form
                $nama_sparepart = htmlspecialchars($_POST['nama']);
                $total_biaya = htmlspecialchars($_POST['total_biaya']);
                $jumlah_sparepart = htmlspecialchars($_POST['jumlah_sparepart']);
                $tanggal = htmlspecialchars($_POST['tanggal']);
                $merk = htmlspecialchars($_POST['merk']);
                $serial_number = htmlspecialchars($_POST['sn']);
                $keterangan = htmlspecialchars($_POST['keterangan']);

                // Insert into nota_servis table
                $queryUpdateNota = mysqli_query($conn, "UPDATE nota_sparepart 
                    SET 
                    jumlah_sparepart = '$jumlah_sparepart', 
                    total_biaya = '$total_biaya', 
                    tanggal = '$tanggal', 
                    merk = '$merk', 
                    serial_number = '$serial_number', 
                    keterangan = '$keterangan' 
                    WHERE 
                    id = '$id'");



                if ($queryUpdateNota) {
            ?>
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Data Nota Sparepart telah Ditambahkan
                    </button>
                    <meta http-equiv="refresh" content="2; url = nota.php" />
            <?php
                } else {
                    // Jika query gagal, tampilkan pesan kesalahan
                    echo '<div class="alert alert-danger" role="alert">Gagal menambahkan data penjualan!</div>';
                }
            }
            ?>

        </div>
    </div>


    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>