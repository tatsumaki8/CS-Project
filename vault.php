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

    <link rel="stylesheet" href="sidebar.css">

    <style>
        @font-face {
            font-family: 'Retro Computer';
            src: url('./rsc/Retro\ Computer.ttf')
        }
    </style>
</head>

<body>
    <!--Side Menu-->
    <div class="nav-side-menu">
        <div class="brand bg-success"><a href="./home.php"><img src="./rsc/LockBox_Logo.png" alt="Logo" style="width: 180px"></a></div>
        <div class="list-group">
            <a href="./vault.php" class="list-group-item bg-dark text-white">Password Vault</a>
            <a href="#collapse1" class="list-group-item bg-dark text-white" data-toggle="collapse">Account Info</a>
            <div id="collapse1" class="panel-collapse collapse">
                <a href="#" class="list-group-item bg-secondary text-white">- General</a>
                <a href="#" class="list-group-item bg-secondary text-white">- Change Password</a>
            </div>
            <a href="./help.php" class="list-group-item bg-dark text-white">Help</a>
            <a href="./logout.php" class="list-group-item bg-dark text-white font-weight-bold">Logout</a>
            <a href="#" class="list-group-item bg-dark text-danger font-weight-bold">Delete Account</a>
        </div>
    </div>


    <!--Content-->
    <div class="container">
        <div class="row">
            <div class="col">
                <?php
session_start();
if (isset($_SESSION["username"])){
    $login = $_SESSION["username"];
    echo "<h1 class='text-center'> Welcome back $login </h1>";
} else {
    checkLogin();
}

function checkLogin(){
// Connect to the database
$host = "fall-2018.cs.utexas.edu";
$user = "cs329e_mitra_vtruong";
$pwd  = "Widen3sheep\$visa";
$dbs  = "cs329e_mitra_vtruong";
$port = "3306";

$connect = mysqli_connect($host, $user, $pwd, $dbs, $port);

$table = "Lockbox";

if (empty($connect)) {
 die("mysqli_connect failed: " . mysqli_connect_error());
}

$username  = mysqli_real_escape_string($connect, $_POST["username"]);
$password  = mysqli_real_escape_string($connect, $_POST["password"]);
if (isset($_POST["remember"])){
    $remember = $_POST["remember"];
} else {
    $remember = "no";
}


$result = mysqli_query($connect, "SELECT * from $table WHERE username='$username' AND pass='$password'");

if (mysqli_num_rows($result) == 1){
    $_SESSION["username"] = $username;
    if ($remember == 'yes'){
        setcookie("user", $username, time() + (86400 * 30));
    } else {
        setcookie("user", "", time()-3600);
    }
    header('Location: '.$_SERVER['REQUEST_URI']);
} else {
    header('Location: login.php');
}
}

?>
            </div>
        </div>
    </div>
</body>

</html>