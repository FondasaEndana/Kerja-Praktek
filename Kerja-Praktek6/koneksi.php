<?php

    $conn = mysqli_connect("localhost","root","1234","studi_kasus");

    if (mysqli_connect_errno()){
        echo "Failed to login" . mysqli_connect_error();
        exit();
    }
?>