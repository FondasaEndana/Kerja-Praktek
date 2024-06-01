<?php
require "session.php";
require "../koneksi.php";

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
if (isset($_POST['stok_barang']) && is_numeric($_POST['stok_barang'])) {
    $stok_barang = intval($_POST['stok_barang']);
} else {
    // Nilai default atau penanganan kasus kesalahan lainnya
    $stok_barang = 0; // Misalnya, Anda dapat memberikan nilai default 0
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    form div {
        margin-bottom: 12px;
        font-family: sans-serif;
        font-size: larger;
    }

    #notification {
        margin-top: 10px;
        /* Atur jarak notifikasi dari elemen di atasnya */
    }
</style>

<body>
    <?Php require "navbar.php"; ?>

    <div class="container mt-3">
        <h2>Detail Produk</h2>

        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/form-data">
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
                    <label for="ketersedian_stok"> Ketersedian </label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="<?php echo $data['ketersediaan_stok']; ?>">
                            <?php echo $data['ketersediaan_stok']; ?> </option>
                        <?php
                        if ($data['ketersediaan_stok'] == 'tersedia') {
                        ?>
                            <option value="habis">Habis</option>
                        <?php
                        } else {
                        ?>
                            <option value="tersedia">Tersedia</option>
                        <?php
                        }
                        ?>

                    </select>

                    <div>
                        <label for="stok_barang"> Jumlah Stok </label>
                        <input type="number" class="form-control" name="stok_barang" value="<?php echo $data['stok_barang']; ?>">
                    </div>

                </div>

                <div>
                    <button type="submit" class="btn btn-outline-primary" name="simpan">Submit</button>
                    <button type="submit" class="btn btn-outline-danger" name="hapus">Delete</button>
                </div>
            </form>

            <?php
            if (isset($_POST['simpan'])) {
                // Ambil nilai dari form
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori_id']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);
                $stok_barang = htmlspecialchars($_POST['stok_barang']);

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
                                    harga = '$harga', detail = '$detail', ketersediaan_stok = '$ketersediaan_stok', stok_barang = '$stok_barang', foto = '$new_name' WHERE id=$id");

                                if ($queryUpdate) {
                                    // Jika query berhasil, tampilkan pesan sukses dan alihkan ke halaman penjualan_stok.php
                                    echo '<div class="alert alert-success" role="alert">Data Penjualan Berhasil Terupdate</div>';
                                    header('Location: produk.php');
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
                                harga = '$harga', detail = '$detail', ketersediaan_stok = '$ketersediaan_stok', stok_barang = '$stok_barang' WHERE id=$id");

                        if ($queryUpdate) {
            ?>
                            <button class="btn btn-primary" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Produk telah Ter-Update
                            </button>
                            <meta http-equiv="refresh" content="2; url = produk.php" />
                    <?php
                        } else {
                            // Jika query gagal, tampilkan pesan kesalahan
                            echo '<div class="alert alert-danger" role="alert">Gagal mengupdate data penjualan!</div>';
                        }
                    }
                }
            }


            if (isset($_POST['hapus'])) {
                $queryHapus = mysqli_query($conn, "DELETE FROM produk WHERE id = '$id'");

                if ($queryHapus) {
                    ?>
                    <button class="btn btn-primary justify-content-center text-center" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Produk terhapus
                    </button>
                    <meta http-equiv="refresh" content="2; url = produk.php" />
            <?php
                }
            }
            ?>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
    <script>
        // Get the notification element
        const notification = document.getElementById('notification');

        // Check if the notification is displayed
        if (notification.style.display === 'block') {
            // If it is, fade it out after 3 seconds
            setTimeout(() => {
                notification.style.opacity = 1;
                const fadeOut = setInterval(() => {
                    if (notification.style.opacity <= 0) {
                        notification.style.display = 'none';
                        clearInterval(fadeOut);
                    } else {
                        notification.style.opacity -= 0.1;
                    }
                }, 50);
            }, 3000);
        }
    </script>

</body>

</html>