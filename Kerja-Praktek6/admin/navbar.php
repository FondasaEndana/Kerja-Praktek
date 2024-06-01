<style>
    .navbar a {
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .navbar a:active {
        transform: scale(1.1);
        
        /* Ganti dengan warna yang diinginkan */
    }

    .navbar .nav-link:hover {
        
        color: #fff;
    }

    .navbar .nav-link.active {
        
        color: #fff;
    }

    .navbar .nav-link i {
        margin-right: 1rem;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="originalSatnikk.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
            Sahabat Teknik
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto align-items-center">
                <!-- Bagian dari sidebar (ditampilkan hanya pada mode mobile) -->
                <li class="nav-item d-lg-none ">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link" href="produk.php">Produk</a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link" href="penjualan_stok.php">Penjualan</a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link" href="nota.php">Nota</a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link" href="jasa.php">Jasa</a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link" href="laporan.php">Laporan</a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                <!-- Akhir dari bagian sidebar -->
            </ul>
        </div>
    </div>
</nav>