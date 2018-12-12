<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LockBox</title>
    <link rel="shortcut icon" href="./rsc/favicon.png" type="image/x-icon">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
        crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


    <link rel="stylesheet" href="vault.css">
    <script src="./vault.js"></script>

    <style>
        @font-face {
            font-family: 'Retro Computer';
            src: url('./rsc/Retro\ Computer.ttf')
        }
    </style>
</head>

<body>
    <div class="page-header bg-success">
        <p>Hello</p>
    </div>
    <div class="container">
        <?php
session_start();
if (isset($_SESSION["username"])) {
 $login = $_SESSION["username"];
 echo "<h1 class='text-center'> Welcome back $login </h1><br />";
} else {
 checkLogin();
}

if (isset($_POST["add"])) {
 insert();
} elseif (isset($_POST["delete"])) {
 delete();
} elseif (isset($_POST["edit"])) {
 edit();
} elseif (isset($_POST["change"])) {
 change();
} else {

 print <<<PAGE
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <a href='#collapseOne' class='list-group-item bg-secondary text-white text-center' data-toggle='collapse'>Add New Site Login</a>
            <div id='collapseOne' class='panel-collapse collapse'>
                <br />
                <form method="post" action="vault.php">
                    <table class="table-responsive text-center">
                        <tr>
                            <td>Name:</td>
                            <td><input type="text" name="name" required></td>
                        </tr>
                        <tr>
                            <td>Website:</td>
                            <td><input type="text" name="website" required ></td>
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td><input type="text" name="username" required ></td>
                        </tr>
                            <tr>
                            <td>Password:</td>
                            <td><input type="text" name="password" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" id="center">
                                <br />
                                <input type="submit" value="Enter" name="add" class="button" onclick="checkItem();"/>&nbsp;
                                <input type="reset" value="Reset" class="button" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="col-4"></div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg">
PAGE;

 $host = "fall-2018.cs.utexas.edu";
 $user = "cs329e_mitra_valex8";
 $pwd  = "denote-naval9Deep";
 $dbs  = "cs329e_mitra_valex8";
 $port = "3306";

 $connect = mysqli_connect($host, $user, $pwd, $dbs, $port);

 if (empty($connect)) {
  die("mysqli_connect failed: " . mysqli_connect_error());
 }

 $table   = "Vault";
 $result  = mysqli_query($connect, "SELECT * from $table WHERE Login='$login'");
 $IDarray = array();
 while ($row = $result->fetch_row()) {
  array_push($IDarray, $row[0]);
 }
 $result->free();

 $result = mysqli_query($connect, "SELECT * from $table WHERE Login='$login'");
 $count  = 0;
 while ($row = $result->fetch_row()) {
  print "<a href='#collapse$count' class='list-group-item' data-toggle='collapse'>$row[2]</a>
        <div id='collapse$count' class='panel-collapse collapse'>
            <table class='list-group-item bg-secondary text-white text-center'>
                <tr>
                <td width='800'><b>Website: </b>$row[3]</td>
                <td width='800'><b>Username: </b>$row[4]</td>
                <td width='800'><b>Password: </b>$row[5]</td>
                <td width='800'><button type='button' onclick='showPassword();' id='showPassword'> Show Password </button></td>
                <td>
                    <form method='post' action='vault.php'>
                        <input type='hidden' name='$IDarray[$count]' value='<?php echo $row[2]; ?>'
        />
        <button name='edit' style='background: transparent; border: none'>
            <ion-icon name='create' style='text-decoration: none; color: white; font-size: 28px'></ion-icon>
        </button>
        </form>
        </td>
        <td>
            <form method='post'>
                <input class='delete' type='hidden' name='$IDarray[$count]' />
                <button name='delete' style='background: transparent; border: none'>
                    <ion-icon name='trash' style='text-decoration: none; color: white; font-size: 28px'></ion-icon>
                </button>
            </form>
        </td>
        </tr>
        </table>
    </div>";
    $count++;
    }
    $result->free();
    // Close connection to the database
    mysqli_close($connect);
    }

    function checkLogin()
    {
    // Connect to the database
    $host = "fall-2018.cs.utexas.edu";
    $user = "cs329e_mitra_vtruong";
    $pwd = "Widen3sheep\$visa";
    $dbs = "cs329e_mitra_vtruong";
    $port = "3306";

    $connect = mysqli_connect($host, $user, $pwd, $dbs, $port);

    $table = "Lockbox";

    if (empty($connect)) {
    die("mysqli_connect failed: " . mysqli_connect_error());
    }

    $username = mysqli_real_escape_string($connect, $_POST["username"]);
    $password = mysqli_real_escape_string($connect, $_POST["password"]);
    if (isset($_POST["remember"])) {
    $remember = $_POST["remember"];
    } else {
    $remember = "no";
    }

    $result = mysqli_query($connect, "SELECT * from $table WHERE username='$username' AND pass='$password'");

    if (mysqli_num_rows($result) == 1) {
    $_SESSION["username"] = $username;
    if ($remember == 'yes') {
    setcookie("user", $username, time() + (86400 * 30));
    } else {
    setcookie("user", "", time() - 3600);
    }
    header('Location: ' . $_SERVER['REQUEST_URI']);
    } else {
    header('Location: login.php');
    }
    }

    function insert()
    {
    $host = "fall-2018.cs.utexas.edu";
    $user = "cs329e_mitra_valex8";
    $pwd = "denote-naval9Deep";
    $dbs = "cs329e_mitra_valex8";
    $port = "3306";

    $connect = mysqli_connect($host, $user, $pwd, $dbs, $port);

    if (empty($connect)) {
    die("mysqli_connect failed: " . mysqli_connect_error());
    }

    $table = "Vault";
    $result = mysqli_query($connect, "SELECT * from $table");
    $IDarray = array();
    while ($row = $result->fetch_row()) {
    array_push($IDarray, $row[0]);
    }

    extract($_POST);
    $login = $_SESSION["username"];
    $id = end($IDarray) + 1;
    $name = mysqli_real_escape_string($connect, $_POST["name"]);
    $website = mysqli_real_escape_string($connect, $_POST["website"]);
    $username = mysqli_real_escape_string($connect, $_POST["username"]);
    $passwd = mysqli_real_escape_string($connect, $_POST["password"]);

    $stmt = mysqli_prepare($connect, "INSERT INTO $table VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssssss', $id, $login, $name, $website, $username, $passwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($connect);
    header("Location: vault.php");
    }

    function delete()
    {
    $host = "fall-2018.cs.utexas.edu";
    $user = "cs329e_mitra_valex8";
    $pwd = "denote-naval9Deep";
    $dbs = "cs329e_mitra_valex8";
    $port = "3306";

    $connect = mysqli_connect($host, $user, $pwd, $dbs, $port);

    if (empty($connect)) {
    die("mysqli_connect failed: " . mysqli_connect_error());
    }

    $table = "Vault";
    $login = $_SESSION["username"];
    $result = mysqli_query($connect, "SELECT ID from $table WHERE Login='$login'");

    while ($row = $result->fetch_row()) {
    $count = 0;
    while ($count <= mysqli_num_rows(mysqli_query($connect, "SELECT * from $table" ))) {extract($_POST);if
        (isset($_POST[$count])) {$id=$count; break;} else { $count++;}}} $stmt=mysqli_query($connect,
        "DELETE FROM $table WHERE ID = '$id'" ); $result->free();
        mysqli_close($connect);
        header("Location: vault.php");
        }

        $idEdit = "";
        function edit()
        {
        $host = "fall-2018.cs.utexas.edu";
        $user = "cs329e_mitra_valex8";
        $pwd = "denote-naval9Deep";
        $dbs = "cs329e_mitra_valex8";
        $port = "3306";

        $connect = mysqli_connect($host, $user, $pwd, $dbs, $port);

        if (empty($connect)) {
        die("mysqli_connect failed: " . mysqli_connect_error());
        }
        $table = "Vault";
        $login = $_SESSION["username"];
        $result = mysqli_query($connect, "SELECT * from $table WHERE Login='$login'");
        while ($row = $result->fetch_row()) {
        $count = 0;
        while ($count <= mysqli_num_rows(mysqli_query($connect, "SELECT * from $table" ))) {extract($_POST);if
            (isset($_POST[$count])) {global $idEdit; $idEdit=$count; break;} else { $count++;}}} $stmt=mysqli_query($connect,
            "SELECT * from $table WHERE ID = '$idEdit'" );while ($row=$stmt->fetch_row())
            {
            print
            "<div class='row'>
                <div class='col-2'></div>
                <div class='col-4'>
                    <a href='#collapseOld' class='list-group-item bg-secondary text-white text-center' data-toggle='collapse'>Old
                        Site Login</a>
                    <div id='collapseOld' class='panel-collapse collapse show'>
                        <br />
                        <form method='post' action='vault.php'>
                            <table class='table-responsive text-center'>
                                <tr>
                                    <td><b>Name:</b></td>
                                    <td><input class='delete' type='hidden' name='edit$id' />$row[2]</td>
                                </tr>
                                <tr>
                                    <td><b>Website:</b></td>
                                    <td>$row[3]</td>
                                </tr>
                                <tr>
                                    <td><b>Username:</b></td>
                                    <td>$row[4]</td>
                                </tr>
                                <tr>
                                    <td><b>Password:</b></td>
                                    <td>$row[5]</td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <div class='col-4'>
                    <a href='#collapseNew' class='list-group-item bg-secondary text-white text-center' data-toggle='collapse'>Change
                        Site Login</a>
                    <div id='collapseNew' class='panel-collapse collapse show'>
                        <br />
                        <form method='post' action='edit.php'>
                            <table class='table-responsive text-center'>
                                <input type='hidden' name='id' value='$idEdit'>
                                <tr>
                                    <td><b>Name:</b></td>
                                    <td><input type='text' name='nameChange'></td>
                                </tr>
                                <tr>
                                    <td><b>Website:</b></td>
                                    <td><input type='text' name='websiteChange'></td>
                                </tr>
                                <tr>
                                    <td><b>Username:</b></td>
                                    <td><input type='text' name='usernameChange'></td>
                                </tr>
                                <tr>
                                    <td><b>Password:</b></td>
                                    <td><input type='text' name='passwordChange'></td>
                                </tr>
                                <tr>
                                    <td colspan='2' id'center'>
                                        <input type='submit' value='Submit' name='editInfo' class='button' onclick='checkItem();' />&nbsp;
                                        <input type='submit' value='Cancel Change' name='cancelEdit' class='button' />
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <div class='col-2'></div>
            </div>";
            }
            }


            ?>
            </div>
            </div>
            </div>
</body>

</html>