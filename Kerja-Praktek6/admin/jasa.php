<?php
require "session.php";
require "../koneksi.php";

$queryJasa = mysqli_query($conn, "SELECT * FROM jasa");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="styleAdmin.css">
    <title>Jasa | Admin</title>
</head>

<body>
    <?php
    require "navbar.php";
    ?>
    <div class="d-flex">
        <?php
        require "sidebar.php";
        ?>

        <div class="container mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="index.php" class="text-muted text-decoration-none">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-hands-helping"></i> Jasa
                    </li>
                </ol>
            </nav>

            <form action="tambah_jasa.php" method="POST">
                <div class="mb-3">
                    <label for="nama_jasa" class="form-label">Jenis Jasa</label>
                    <select class="form-control" id="nama_jasa" name="nama_jasa" required>
                        <?php
                        if (mysqli_num_rows($queryJasa) > 0) {
                            while ($row = mysqli_fetch_assoc($queryJasa)) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nama_jasa'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Tidak ada data</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Jasa</button>
            </form>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>