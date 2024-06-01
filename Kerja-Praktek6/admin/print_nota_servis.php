<?php
require "session.php";
require "../koneksi.php";

// Get ID from URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: nota.php");
    exit();
}

$queryNotaServis = mysqli_query($conn, "SELECT * FROM nota_servis WHERE id = '$id'");
$data = mysqli_fetch_array($queryNotaServis);

if (!$data) {
    header("Location: nota.php");
    exit();
}

$jenis_barang_options = array(
    1 => "Laptop",
    2 => "CPU",
    3 => "LCD Monitor"
);

$jenis_barang = $jenis_barang_options[$data['jenis_barang']];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Servis</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
    @media print {
            #printButton {
                display: none;
            }

            .nota-container {
                width: 100%; /* Mengatur lebar kontainer agar sesuai dengan kertas cetak */
                margin: 0; /* Menghilangkan margin */
                border: none; /* Menghilangkan border */
                padding: 0; /* Menghilangkan padding */
            }

            .nota-header img {
                width: 80px; /* Mengatur ukuran gambar logo */
                height: auto; /* Biarkan tinggi gambar menyesuaikan dengan lebar */
                float: left; /* Membuat gambar berada di sebelah kiri */
                margin-right: 10px; /* Memberikan jarak antara gambar dan teks */
            }

            .nota-details,
            .nota-footer {
                margin-bottom: 20px; /* Memberikan jarak antara bagian-bagian konten */
            }
        }

        .nota-container {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            width: 70%;
            font-family: Arial, sans-serif;
        }

        .nota-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .nota-header h1 {
            margin: 0;
        }

        .nota-details table,
        .nota-footer table {
            width: 100%;
        }

        .nota-details th,
        .nota-footer th,
        .nota-details td,
        .nota-footer td {
            padding: 8px;
            text-align: left;
        }

        .nota-footer th,
        .nota-footer td {
            border-top: 1px solid #ccc;
        }

        .nota-signatures {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        .signature {
            text-align: center;
            width: 45%;
        }

        .signature p {
            margin-top: 60px;
            border-top: 1px solid #000;
        }

        .text-center {
            text-align: center;
        }

        .mt-3 {
            margin-top: 20px;
        }

        #printButton {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="nota-container">
        <div class="nota-header">
        <img src="originalSatnikk.png" alt="CV Satnik Solutions Logo" style="width: 80px; height: auto; float: left; margin-right: 4px;">
            <h1>CV SATNIK SOLUTIONS</h1>
            <h2>SAHABAT TEKNIK</h2>
            <p>Jl. Raya Boteng No.09, Prambon, Boboh, Kec. Menganti, Kabupaten Gresik, Jawa Timur 61174</p>
            <p><?php echo date('d M Y', strtotime($data['tanggal_servis'])); ?></p>
        </div>
        <div class="nota-details">
            <table>
                <tr>
                    <th>Nama Servis:</th>
                    <td><?php echo $data['nama_servis']; ?></td>
                </tr>
                <tr>
                    <th>Nomor:</th>
                    <td><?php echo $data['nomor']; ?></td>
                </tr>
                <tr>
                    <th>Kerusakan:</th>
                    <td><?php echo $data['servis']; ?></td>
                </tr>
                <tr>
                    <th>Merk:</th>
                    <td><?php echo $data['merk']; ?></td>
                </tr>
                <tr>
                    <th>Serial Number:</th>
                    <td><?php echo $data['serial_number']; ?></td>
                </tr>
                <tr>
                    <th>Total Biaya:</th>
                    <td>Rp.<?php echo number_format($data['total_biaya'], 0, ',', '.'); ?></td>
                </tr>
            </table>
        </div>
        <div class="nota-footer">
            <table>
                <tr>
                    <th>Jenis Barang:</th>
                    <?php
                    $jenis_barang = $jenis_barang_options[$data['jenis_barang']];
                    ?>
                    <td><?php echo $jenis_barang; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Servis:</th>
                    <td><?php echo date('d M Y H:i', strtotime($data['tanggal_servis'])); ?></td>
                </tr>
                <tr>
                    <th>Tanggal Keluar:</th>
                    <td><?php echo date('d M Y H:i', strtotime($data['tanggal_keluar'])); ?></td>
                </tr>
                <tr>
                    <th>Keterangan:</th>
                    <td><?php echo $data['keterangan']; ?></td>
                </tr>
            </table>
        </div>

        <div class="nota-signatures">
            <div class="signature">
                <p>Customer</p>
            </div>
            <div class="signature">
                <p>CV SAHABAT TEKNIK</p>
            </div>
        </div>
        <div class="text-center mt-3">
            <button id="printButton" class="btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
</body>

</html>