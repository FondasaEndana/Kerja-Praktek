<?php
   require "session.php";
   require "../koneksi.php";

    $id = $_GET['p'];

    $query = mysqli_query($conn, "SELECT * FROM kategori WHERE id ='$id'");
    $data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?Php require "navbar.php"; ?>

    <div class="container mt-5">
    <h2>Detail Kategori</h2>

    <div class="col-12 col-md-6">
        <form action="" method="post">
            <div>
                <label for="kategori">Kategori</label>
                <input type="text" name="kategori" id="kategori" autocomplete="off" class="form-control" value="<?php 
                echo $data ['nama']; ?>">
            </div>

            <div class="mt-5 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary" name="editBtn"> Edit </button>
                <button type="submit" class="btn btn-danger" name="deleteBtn"> Delete </button>
            </div>
        </form>

        <?php
            if(isset($_POST['editBtn']))
            {
                $kategori = htmlspecialchars($_POST['kategori']);

                if($data['nama']==$kategori){
                    ?>
                        <meta http-equiv="refresh" content="0; url=kategori.php" />
                    <?php
                }
                else
                {
                    $query = mysqli_query($conn, "SELECT * FROM kategori WHERE nama='$kategori'");
                    $jumlahData = mysqli_num_rows($query);
                    
                    if($jumlahData > 0){
                        ?>
                            <div class="alert alert-primary my-3" role="alert">
                                Kategori Sudah Ada!
                            </div>
                        <?php
                    }
                    else{
                        $querySimpan = mysqli_query($conn, "UPDATE kategori SET nama=
                        '$kategori' WHERE id='$id'");
                        if($querySimpan)
                        {
                            ?>
                                <div class="alert alert-primary my-3" role="alert">
                                    Kategori Terupdate!
                                </div>

                            <meta http-equiv="refresh" content="1; url=kategori.php" />
                            <?php
                        }
                        else{
                            echo mysqli_error($conn);
                        }
                    }
                }
            }

            if(isset($_POST['deleteBtn']))
            {
                $queryCheck = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$id'");
                $dataCount = mysqli_num_rows($queryCheck);
            
                if($dataCount > 0){
                    ?>
                    <div class="alert alert-warning my-3" role="alert">
                        Kategori tidak dapat dihapus karena masih digunakan dalam produk!
                    </div>
                    <?php
                } 
                else 
                {
                    $queryDelete = mysqli_query($conn, "DELETE FROM kategori WHERE id='$id'");
            
                    if($queryDelete)
                    {
                        // Tampilkan pesan sukses dan redirect
                        ?>
                        <div class="alert alert-primary my-3" role="alert">
                            Kategori Terhapus!
                        </div>
                        <meta http-equiv="refresh" content="1; url=kategori.php" />
                        <?php
                    }
                    else{
                        echo mysqli_error($conn);
                    }
                }
            }
            
        ?>
    </div>
    </div>



    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>