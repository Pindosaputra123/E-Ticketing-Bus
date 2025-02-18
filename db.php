<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databasename = "bus";

    $con = mysqli_connect($servername,$username,$password,$databasename);

    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        header("location: index.php?error=offline");
    }
?>
