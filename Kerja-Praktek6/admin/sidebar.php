<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transform Effect on Click</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .sidebar a {
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .sidebar a:active {
            transform: scale(1.1);
            background-color: #e0e0e0; /* Ganti dengan warna yang diinginkan */
        }
        .sidebar .nav-link:hover {
            background-color: #007bff;
            color: #fff;
        }
        .sidebar .nav-link.active {
            background-color: #0056b3;
            color: #fff;
        }
        .sidebar .nav-link i {
            margin-right: 1rem;
        }
    </style>
</head>
<body>
    <div class="d-none d-lg-flex flex-column p-3 bg-light sidebar" style="width: 280px;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <img src="sahabatTeknik.png" alt="Deskripsi Gambar" style="max-width: 50px; max-height: 50px;">
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="index.php" class="nav-link link-dark">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>

            <li>
                <a href="produk.php" class="nav-link link-dark">
                    <i class="fas fa-box"></i> Produk
                </a>
            </li>

            <li>
                <a href="penjualan_stok.php" class="nav-link link-dark">
                    <i class="fas fa-shopping-cart"></i> Penjualan
                </a>
            </li>

            <li>
                <a href="nota.php" class="nav-link link-dark">
                    <i class="fas fa-align-justify"></i> Nota
                </a>
            </li>

            <li>
                <a href="jasa.php" class="nav-link link-dark">
                    <i class="fas fa-hands-helping"></i> Jasa
                </a>
            </li>

            <li>
                <a href="laporan.php" class="nav-link link-dark">
                    <i class="fas fa-cogs"></i> Laporan
                </a>
            </li>
            
            <li>
                <a href="logout.php" class="nav-link link-dark">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</body>
</html>
