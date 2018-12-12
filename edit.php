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