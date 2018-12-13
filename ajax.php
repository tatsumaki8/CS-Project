<?php
    $username = $_REQUEST["username"];
    $email = $_REQUEST["email"];

    $host = "fall-2018.cs.utexas.edu";
    $user = "cs329e_mitra_vtruong";
    $pwd  = "Widen3sheep\$visa";
    $dbs  = "cs329e_mitra_vtruong";
    $port = "3306";

    $connect = mysqli_connect($host, $user, $pwd, $dbs, $port);

    if (empty($connect)) {
        die("mysqli_connect failed: " . mysqli_connect_error());
    }

    $table = "Lockbox";

    $result = mysqli_query($connect, "SELECT * from $table WHERE email='$email'");

    if (mysqli_num_rows($result) > 0){
        mysqli_close($connect);
        echo "Email taken";
    }

    $result = mysqli_query($connect, "SELECT * from $table WHERE username='$username'");

    if (mysqli_num_rows($result) > 0){
        mysqli_close($connect);
        echo "Username taken";
    }