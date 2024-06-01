<?php
require "session.php";
require "../koneksi.php";

$queryProfil = mysqli_query($conn, "SELECT * FROM login");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="styleAdmin.css">
    <title>Profile | Admin</title>
    <style>
        .profile-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .profile-info label {
            font-weight: bold;
        }
        .profile-info p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <?php
        require "navbar.php"; // Sertakan navbar jika diperlukan
    ?>

    <div class="container mt-5 profile-container">
        <h2>Admin Profile</h2>
        <div class="profile-info">
            <label>Username:</label>
            <p><?php echo $_SESSION["username"]; ?></p>
        </div>
        
        <!-- Tambahkan informasi profil admin lainnya di sini -->
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
