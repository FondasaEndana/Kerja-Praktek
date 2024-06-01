<?php
require "session.php";
require "../koneksi.php";

// Ambil ID nota dari parameter URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    // Jika ID nota tidak ditemukan, arahkan pengguna ke halaman lain atau tampilkan pesan kesalahan
    header("Location: nota.php");
    exit();
}

$queryNotaServis = mysqli_query($conn, "SELECT * FROM nota_servis WHERE id = '$id'");
$data = mysqli_fetch_array($queryNotaServis);

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

$jenis_barang_options = array(
    1 => "Laptop",
    2 => "CPU",
    3 => "LCD Monitor"
);

?>

<style>
    @media print {
        #printButton {
            display: none;
        }

        /* Atur tata letak cetakan sesuai kebutuhan */
        /* Misalnya, Anda bisa mengatur lebar dan posisi elemen */
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Nota</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="styleAdmin.css">
</head>

<body>
    <?php
    require "navbar.php";
    ?>
    <div class="container mt-3">
        <h2>Detail Nota Servis</h2>

        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/form-data" id="formSubmit">
                <div>
                    <label for="nama" class="mt-1 "> Nama </label>
                    <input type="text" id="nama" name="nama" value="<?php echo $data['nama_servis']; ?>" class="form-control mt-1" autocomplete="off" required>
                </div>

                <div>
                    <label for="nomor" class="mt-1 "> Nomor </label>
                    <input type="number" id="nomor" name="nomor" class="form-control mt-1" value="<?php echo $data['nomor']; ?>">
                </div>

                <div>
                    <label for="kerusakan" class="mt-1 "> Kerusakan </label>
                    <input type="text" name="kerusakan" id="kerusakan" class="form-control mt-1" value="<?php echo $data['servis']; ?>">
                </div>

                <div>
                    <label for="merk" class="mt-1 "> Merk </label>
                    <input type="text" id="merk" name="merk" class="form-control mt-1" value="<?php echo $data['merk']; ?>">
                </div>

                <div>
                    <label for="serial_number" class="mt-1 "> S/N </label>
                    <input type="text" name="sn" id="serial_number" class="form-control" value="<?php echo $data['serial_number']; ?>">
                </div>


                <div>
                    <label for="harga" class="mt-1 "> Biaya </label>
                    <input type="number" class="form-control" value="<?php echo $data['total_biaya']; ?>" name="harga" required>
                </div>

                <div>
                    <div>
                        <label for="tanggal_servis" class="mt-1 "> Tanggal dan Waktu </label>
                        <input type="datetime-local" id="tanggal_servis" name="tanggal_servis" value="<?php echo date('Y-m-d\TH:i', strtotime($data['tanggal_servis'])); ?>" class="form-control" required>
                    </div>
                </div>

                <div>
                    <label for="tanggal_keluar" class="mt-1 "> Tanggal Keluar </label>
                    <input type="datetime-local" id="tanggal_keluar" name="tanggal_keluar" value="<?php echo date('Y-m-d\TH:i', strtotime($data['tanggal_keluar'])); ?>" class="form-control" required>
                </div>

                <div>
                    <label for="jenis_barang"> Jenis Barang </label>
                    <select class="form-select" name="jenis_barang" aria-label="Default select example">
                        <option selected> </option>
                        <?php
                        foreach ($jenis_barang_options as $key => $value) {
                            $selected = ($key == $data['jenis_barang']) ? 'selected' : '';
                            echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
                        }
                        ?>
                    </select>
                </div>


                <div>
                    <label for="keterangan" class="mt-1 "> Keterangan </label>
                    <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <div>
                    <button type="submit" class="btn btn-outline-primary" name="simpan">Edit</button>
                    <button type="submit" class="btn btn-outline-danger ms-auto" name="hapus">Delete</button>
                    <button type="button" class="btn btn-outline-secondary no-print ms-auto" onclick="window.location.href='print_nota_servis.php?id=<?php echo $id; ?>'">Print</button>
                </div>



            </form>
            <?php
            if (isset($_POST['simpan'])) {
                // Ambil nilai dari form dan bersihkan input
                $nama_servis = htmlspecialchars($_POST['nama']);
                $nomor = htmlspecialchars($_POST['nomor']);
                $total_biaya = htmlspecialchars($_POST['harga']);
                $kerusakan = htmlspecialchars($_POST['kerusakan']);
                $tanggal_servis = htmlspecialchars($_POST['tanggal_servis']);
                $tanggal_keluar = htmlspecialchars($_POST['tanggal_keluar']);
                $merk = htmlspecialchars($_POST['merk']);
                $serial_number = htmlspecialchars($_POST['sn']);
                $jenis_barang = htmlspecialchars($_POST['jenis_barang']);
                $keterangan = htmlspecialchars($_POST['keterangan']);

                // Update nota_servis table
                $queryUpdateNota = mysqli_query($conn, "UPDATE nota_servis 
                                                        SET nama_servis = '$nama_servis', 
                                                            nomor = '$nomor', 
                                                            total_biaya = '$total_biaya', 
                                                            servis = '$kerusakan', 
                                                            tanggal_servis = '$tanggal_servis', 
                                                            tanggal_keluar = '$tanggal_keluar', 
                                                            merk = '$merk', 
                                                            serial_number = '$serial_number', 
                                                            jenis_barang = '$jenis_barang', 
                                                            keterangan = '$keterangan' 
                                                        WHERE id = '$id'");

                if ($queryUpdateNota) {
            ?>
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Detail Nota telah Ter-Update
                    </button>
                    <meta http-equiv="refresh" content="2; url = nota.php" />
                <?php
                } else {
                    // Jika query gagal, tampilkan pesan kesalahan
                ?>
                    <div class="alert alert-danger" role="alert">
                        Gagal mengupdate data penjualan!
                    </div>
            <?php
                }
            }
            ?>
            <?php
            if (isset($_POST['hapus'])) {
                $queryHapus = mysqli_query($conn, "DELETE FROM nota_servis WHERE id = '$id'");

                if ($queryHapus) {
            ?>
                    <button class="btn btn-primary justify-content-center text-center" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Nota Terhapus
                    </button>
                    <meta http-equiv="refresh" content="2; url = nota.php" />
            <?php
                }
            }
            ?>
        </div>
    </div>


    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
    <script>
        document.getElementById("printButton").addEventListener("click", function() {
            window.print();
        });
    </script>
</body>

</html>