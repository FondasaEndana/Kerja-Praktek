<?php
require "session.php";
require "../koneksi.php";

if (isset($_GET['p'])) {
    $id = $_GET['p'];

    $query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b 
        ON a.kategori_id=b.id WHERE a.id='$id'");
    $data = mysqli_fetch_array($query);

    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

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
} else {
    // header('Location: halaman_error.php');
    // exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penjualan</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<style>
    form div {
        margin-bottom: 12px;
        font-family: sans-serif;
        font-size: larger;
    }
</style>

<body>
    <?Php require "navbar.php";
    ?>

    <div class="container mt-3">
        <h2>Detail Produk</h2>

        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/form-data" id="formSubmit">
                <div>
                    <label for="nama" class="mt-1"> Nama </label>
                    <input type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>" class="form-control" autocomplete="off" required>
                </div>

                <div>
                    <label for="kategori"> Kategori </label>
                    <select name="kategori_id" id="kategori" class="form-control" required>
                        <option value="<?php echo $data['kategori_id'] ?>"><?php echo $data['nama_kategori'] ?> </option>
                        <?php
                        while ($dataKategori = mysqli_fetch_array($queryKategori)) {
                        ?>
                            <option value="<?php echo $dataKategori['id']; ?>"><?php echo $dataKategori['nama']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga"> Harga </label>
                    <input type="number" class="form-control" value="<?php echo $data['harga']; ?>" name="harga" required>
                </div>

                <div>
                    <label for="currentFoto"> Foto Produk Yang Digunakan: </label>
                    <img src="../image/<?php echo $data['foto'] ?>" alt="" width="200px">
                </div>

                <div>
                    <label for="foto"> Foto </label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>

                <div>
                    <label for="detail"> Detail </label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">
                    <?php echo $data['detail']; ?>
                </textarea>
                </div>

                <div>
                    <div>
                        <label for="tanggal"> Tanggal dan Waktu </label>
                        <input type="datetime-local" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d\TH:i', strtotime($data['tanggal'])); ?>" class="form-control" required>
                    </div>
                </div>

                <div>
                    <label for="stok_barang"> Jumlah Stok </label>
                    <input type="number" class="form-control" name="stok_barang" value="<?php echo $data['stok_barang']; ?>">
                </div>

                <div>
                    <button type="submit" class="btn btn-outline-primary" name="simpan">Submit</button>
                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Launch demo modal
                    </button> -->
                </div>

                <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div> -->

            </form>
            <?php
            if (isset($_POST['simpan'])) {
                // Ambil nilai dari form
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori_id']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $tanggal = htmlspecialchars($_POST['tanggal']);
                $stok_barang = htmlspecialchars($_POST['stok_barang']);

                $tanggalLama = $data['tanggal']; // Ambil tanggal lama dari database
                $tanggal_timestamp = date('Y-m-d H:i:s', strtotime($tanggal)); // Ambil tanggal saat ini dalam format timestamp
                if ($tanggalLama != $tanggal_timestamp) {
                    // Jika ada perubahan tanggal, update juga tanggal pada bagian penjualan
                    $queryUpdatePenjualan = mysqli_query($conn, "UPDATE produk SET tanggal = '$tanggal' WHERE id = $id");
                    // Tambahkan pengecekan kesuksesan query
                    if (!$queryUpdatePenjualan) {
                        // Tampilkan pesan kesalahan jika query gagal
                        echo '<div class="alert alert-danger" role="alert">Gagal mengupdate data penjualan!</div>';
                    }
                }

                // Lakukan validasi form
                if (empty($nama) || empty($kategori) || empty($harga)) {
                    // Jika ada field yang kosong, tampilkan pesan kesalahan
                    echo '<div class="alert alert-danger" role="alert">Nama, Kategori, dan Harga wajib diisi!</div>';
                } else {
                    // Folder untuk mengupload foto
                    $target_dir = "../image/";

                    // Periksa apakah file foto diunggah
                    if (!empty($_FILES['foto']['name'])) {
                        $nama_file = basename($_FILES["foto"]["name"]);
                        $target_file = $target_dir . $nama_file;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $image_size = $_FILES['foto']['size'];
                        $random_name = generateRandomString(20);
                        $new_name = $random_name . "." . $imageFileType;

                        // Periksa tipe file dan ukuran file
                        if ($image_size > 500000) {
                            echo '<div class="alert alert-danger" role="alert">File tidak boleh lebih dari 500kb!</div>';
                        } elseif (!in_array($imageFileType, array('jpg', 'png', 'gif'))) {
                            echo '<div class="alert alert-danger" role="alert">File wajib bertipe jpg, png, gif!</div>';
                        } else {
                            // Pindahkan file foto yang diunggah
                            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name)) {
                                // Jika berhasil upload, update data produk ke database
                                $queryUpdate = mysqli_query($conn, "UPDATE produk SET kategori_id = '$kategori', nama = '$nama', 
                            harga = '$harga', detail = '$detail', tanggal = '$tanggal', stok_barang = '$stok_barang', foto = '$new_name' WHERE id=$id");

                                if ($queryUpdate) {
                                    // Jika query berhasil, tampilkan pesan sukses dan alihkan ke halaman penjualan_stok.php
                                    echo '<div class="alert alert-success" role="alert">Data Penjualan Berhasil Terupdate</div>';
                                    header('Location: penjualan_stok.php');
                                    exit();
                                } else {
                                    // Jika query gagal, tampilkan pesan kesalahan
                                    echo '<div class="alert alert-danger" role="alert">Gagal mengupdate data penjualan!</div>';
                                }
                            } else {
                                // Jika gagal upload, tampilkan pesan kesalahan
                                echo '<div class="alert alert-danger" role="alert">Gagal mengunggah file foto!</div>';
                            }
                        }
                    } else {
                        // Jika tidak ada file foto yang diunggah, update data produk ke database tanpa foto baru
                        $queryUpdate = mysqli_query($conn, "UPDATE produk SET kategori_id = '$kategori', nama = '$nama', 
                            harga = '$harga', detail = '$detail', tanggal = '$tanggal', stok_barang = '$stok_barang' WHERE id=$id");

                        if ($queryUpdate) {
            ?>
                            <button class="btn btn-primary" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Data Penjualan telah Ter-Update
                            </button>
                            <meta http-equiv="refresh" content="2; url = penjualan_stok.php" />
            <?php
                        } else {
                            // Jika query gagal, tampilkan pesan kesalahan
                            echo '<div class="alert alert-danger" role="alert">Gagal mengupdate data penjualan!</div>';
                        }
                    }
                }
            }
            ?>
        </div>

    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function showLoading() {
            // Tampilkan pesan loading
            document.getElementById('loading').style.display = 'block';
            // Nonaktifkan tombol submit untuk mencegah pengiriman ganda
            document.getElementById('submitBtn').disabled = true;
            // Tunda pengalihan ke halaman penjualan_stok.php selama 2 detik
            setTimeout(function() {
                window.location.href = 'penjualan_stok.php';
            }, 2000);
        }
    </script>
</body>

</html>