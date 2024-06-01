<?php
require "session.php";
require "../koneksi.php";

$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b 
   ON a.kategori_id=b.id ");
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
    <title>Produk | Admin</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="styleAdmin.css">
</head>

<style>
    form div {
        margin-bottom: 10px;
    }
</style>

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
                        <i class="fas fa-box"></i> Produk
                    </li>
                </ol>
            </nav>

            <!-- Tambah Produk -->
            <div class="my-4 col-12 col-md-6">
                <h3>Tambah Produk</h3>
                <!-- enctype: Upload File -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="nama"> Nama </label>
                        <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
                    </div>
                    <div>
                        <label for="kategori"> Kategori </label>
                        <select name="kategori_id" id="kategori" class="form-control" required>
                            <option> Pilih </option>
                            <?php
                            while ($data = mysqli_fetch_array($queryKategori)) {
                            ?>
                                <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label for="harga"> Harga </label>
                        <input type="number" class="form-control" name="harga" required>
                    </div>

                    <div>
                        <label for="foto"> Foto </label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>

                    <div>
                        <label for="detail"> Detail </label>
                        <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div>
                        <label for="ketersedian_stok"> Ketersedian </label>
                        <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                            <option value="tersedia"> tersedia </option>
                            <option value="habis"> habis </option>
                        </select>
                    </div>

                    <div>
                        <label for="stok_barang"> Jumlah Stok </label>
                        <input type="number" class="form-control" name="stok_barang">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-outline-primary" name="simpan">Submit</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['simpan'])) {
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori_id']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);
                    if (empty($_POST['stok_barang']) || !is_numeric($_POST['stok_barang'])) {
                        // Jika nilai 'stok_barang' kosong atau tidak valid
                        echo '<div class="alert alert-danger" role="alert">Jumlah stok barang harus diisi dengan nilai numerik yang valid!</div>';
                    } else {
                        // Jika nilai 'stok_barang' valid, lanjutkan dengan query INSERT
                        $stok_barang = htmlspecialchars($_POST['stok_barang']);
                        $target_dir = "../image/";
                        $nama_file = basename($_FILES["foto"]["name"]);
                        $target_file = $target_dir . $nama_file;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $image_size = $_FILES['foto']['size'];
                        $random_name = generateRandomString(20);
                        $new_name = $random_name . "." . $imageFileType;

                        if ($nama == '' || $kategori == '' || $harga == '') {
                ?>
                            <div class="alert alert-primary my-3" role="alert">
                                Nama, Kategori dan Harga Wajib diisi!
                            </div>
                            <?php
                        } else {
                            if ($nama_file != '') {
                                if ($image_size > 500000) {
                            ?>
                                    <div class="alert alert-primary my-3" role="alert">
                                        File tidak boleh lebih dari 500kb!
                                    </div>
                                    <?php
                                } else {
                                    if (
                                        $imageFileType != 'jpg' &&  $imageFileType != 'png' &&
                                        $imageFileType != 'gif'
                                    ) {
                                    ?>
                                        <div class="alert alert-primary my-3" role="alert">
                                            File wajib bertipe jpg, png, gif!
                                        </div>
                            <?php
                                    } else {
                                        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                                    }
                                }
                            }
                        }

                        //query input to database and product table
                        $queryProduk = mysqli_query($conn, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, ketersediaan_stok, stok_barang) 
                    VALUES ('$kategori','$nama','$harga','$new_name','$detail','$ketersediaan_stok','$stok_barang')");



                        if ($queryProduk) {
                            ?>
                            <button class="btn btn-primary justify-content-center text-center" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Data Penjualan telah Ter-Update
                            </button>
                            <meta http-equiv="refresh" content="2; url = penjualan_stok.php" />
                <?php
                        } else {
                            echo mysqli_error($conn);
                        }
                    }
                }
                ?>


            </div>

            <div class="mt-3 mb-5">
                <h2> LIST PRODUK </h2>

                <div class="table-responsive mt-5">
                    <table class="table">
                        <thead class="table-primary">
                            <tr>
                                <th>No.</th>
                                <th>Nama.</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Ketersediaan</th>
                                <th>Stok Barang</th>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
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
                                    <tr class="">
                                        <td><?php echo $jumlah; ?></td>
                                        <td><?php echo $data['nama']; ?></td>
                                        <td><?php echo $data['nama_kategori']; ?></td>
                                        <td><?php echo $data['harga']; ?></td>
                                        <td><?php echo $data['ketersediaan_stok']; ?></td>
                                        <td><?php echo $data['stok_barang']; ?> </td>
                                        <td>
                                            <a href="produk-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a>
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
        </div>
    </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>