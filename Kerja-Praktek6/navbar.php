<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar E-commerce</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    .dropdown-menu a:hover,
    .dropdown-menu a:focus {
      background-color: blue !important;
      color: white !important;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark warna1">
    <div class="container">
      <a class="navbar-brand me-3" href="index.php">
        <img src="admin/originalSatnikk.png" alt="Logo" style="height: 40px;">
      </a>
      <button class="navbar-toggler card-header warna1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-white card warna1" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white card warna1" href="about-us.php">Tentang Kami</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white card warna1" href="produk.php">Produk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white card warna1" href="keranjang.php">
              <i class=""></i> Keranjang
            </a>
          </li>
        </ul>
        <div class="dropdown">
          <a class="nav-link text-white warna1 d-flex align-items-center" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user fa-lg ms-2"></i> &nbsp;&nbsp;
            <?php echo isset($_SESSION['user']['displayName']) ? $_SESSION['user']['displayName'] : 'Guest'; ?>
          </a>

          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="profile.php">Profil</a></li>
            <li><a class="dropdown-item" href="#">Pengaturan</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="login.php">Keluar</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>

</html>