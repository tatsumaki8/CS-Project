<?php

 $host = "fall-2018.cs.utexas.edu";
 $user = "cs329e_mitra_valex8";
 $pwd  = "denote-naval9Deep";
 $dbs  = "cs329e_mitra_valex8";
 $port = "3306";

 $connect = mysqli_connect($host, $user, $pwd, $dbs, $port);

 if (empty($connect)) {
  die("mysqli_connect failed: " . mysqli_connect_error());
 }

 $name     = mysqli_real_escape_string($connect, $_POST["nameChange"]);
 $website  = mysqli_real_escape_string($connect, $_POST["websiteChange"]);
 $username = mysqli_real_escape_string($connect, $_POST["usernameChange"]);
 $passwd   = mysqli_real_escape_string($connect, $_POST["passwordChange"]);
 $id = $_POST["id"];
 $table    = "Vault";
 $login    = $_SESSION["username"];

 // Encrypts the password for the database
 $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
 $passwd = my_encrypt($passwd, $key);

 function my_encrypt($data, $key) {
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
    // Generate an initialization vector
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    // Encrypt the data using AES 256 encryption in CBC mode using our encryption key
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    // The $iv is just as important as the key for decrypting, so save it with our encrypted data
    return base64_encode($encrypted . '::' . $iv);
}


 if ($name != "") {
  $stmt1 = mysqli_query($connect, "UPDATE $table SET Name='$name' WHERE ID='$id'");
 }
 if ($website != "") {
  $stmt2 = mysqli_query($connect, "UPDATE $table SET Website='$website' WHERE ID='$id'");
 }
 if ($username != "") {
  $stmt3 = mysqli_query($connect, "UPDATE $table SET Username='$username' WHERE ID='$id'");
 }
 if ($passwd != "") {
  $stmt4 = mysqli_query($connect, "UPDATE $table SET Password='$passwd' WHERE ID='$id'");
 }
 mysqli_close($connect);

 header("Location: vault.php");