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

    <link rel="stylesheet" href="sticky-footer.css">
    <script src="./signup.js"></script>
    <script src="./date.js"></script>

    <style>
        @font-face {
            font-family: 'Retro Computer';
            src: url('./rsc/Retro\ Computer.ttf')
        }
    </style>
</head>

<body>

    <!--Navbar-->
    <nav class="navbar navbar-expand-sm bg-success navbar-dark">
        <a class="navbar-brand" href="home.php">
            <img src="./rsc/LockBox_Logo.png" alt="Logo" style="width: 200px">
        </a>
        <ul class="navbar-nav mr-auto" style="font-family: 'Retro Computer'; font-size: 18pt">
            <li class="nav-item">
                <a class="nav-link" href="about.html">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="donate.html">Donate</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="help.html">Help</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
            </li>
        </ul>
        <form id="searchForm" method="post" action="search.php" class="form-inline" style="font-family: 'Retro Computer';">
            <div class="md-form my-0">
                <input id="searchText" name="searchText" class="form-control mr-sm-2" type="text" placeholder="Search..."
                    aria-label="Search">
                <a>
                    <ion-icon name="search" style="text-decoration: none; color: white; font-size: 28px"></ion-icon>
                </a>
            </div>
        </form>
    </nav>

    <main>
        <div class="container">
            <div class="row">

                <?php
// Connect to the database
$host = "fall-2018.cs.utexas.edu";
$user = "cs329e_mitra_vtruong";
$pwd  = "Widen3sheep\$visa";
$dbs  = "cs329e_mitra_vtruong";
$port = "3306";

$connect = mysqli_connect($host, $user, $pwd, $dbs, $port);

if (empty($connect)) {
 die("mysqli_connect failed: " . mysqli_connect_error());
}

$email     = mysqli_real_escape_string($connect, $_POST["email"]);
$username  = mysqli_real_escape_string($connect, $_POST["username"]);
$password  = mysqli_real_escape_string($connect, $_POST["password"]);
$rpassword = mysqli_real_escape_string($connect, $_POST["rpassword"]);

$valid = true;
$error = "";
// Check to make sure signup info isn't empty
if (!empty($username) && !empty($email) && !empty($password) && !empty($rpassword)) {
 // Check username
 if (strlen($username) < '6' || strlen($username) > '30') {
  $error = "Your username must be between 6 and 30 characters (inclusive)";
  $valid = false;
 }
 // Check password
 if (strlen($password) < '8' || strlen($password) > '30') {
  $error = "Your password must be between 8 and 30 characters (inclusive)";
  $valid = false;
 } elseif (!preg_match("#[0-9]+#", $password)) {
  $error = "Your password must contain at least 1 number";
  $valid = false;
 } elseif (!preg_match("#[A-Z]+#", $password)) {
  $error = "Your password must contain at least 1 uppercase character";
  $valid = false;
 } elseif (!preg_match("#[a-z]+#", $password)) {
  $error = "Your password must contain at least 1 lowercase character";
  $valid = false;
 }
 // Check that passwords match
 if ($password != $rpassword) {
  $error = "Passwords do not match";
  $valid = false;
 }
} else {
 $error = "Please fill out all fields";
 $valid = false;
}

$table = "Lockbox";

if ($valid) {
// Check if email is taken in the database
 $result = mysqli_query($connect, "SELECT * from $table WHERE email='$email'");
 if (mysqli_num_rows($result) == 0) {
  $result = mysqli_query($connect, "SELECT * from $table WHERE username='$username'");
  // Check if the username is taken in the database
  if (mysqli_num_rows($result) == 0) {
   $data = mysqli_prepare($connect, "INSERT INTO $table VALUES (?, ?, ?)");
   mysqli_stmt_bind_param($data, 'sss', $username, $email, $password);
   mysqli_stmt_execute($data);
   mysqli_stmt_close($data);
   mysqli_close($connect);
   print <<<SUCCESS
    <div class="col text-center mt-3">
        <h3 style="font-family: 'Retro Computer';">Signup Successful! You may now login.</h3>
        <a href="./home.php"><button type="button" class="btn btn-lg btn-success mt-3">Return to Homepage</button></a>
    </div>
SUCCESS;
  } else {
   mysqli_close($connect);
   print <<<FAIL
    <div class="col mt-3">
    <h3 style="font-family: 'Retro Computer';">Registration</h3>
    <form id="signup" action="signup.php" method="POST" onsubmit="return validate();">
        <div class="text-danger font-italic mt-3" id="signup-response">Username taken</div>
        <div class="form-group">
            <label><b>Email</b></label>
            <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email"
                required data-toggle="tooltip" data-placement="right" title="Make sure to enter a valid email address.">
        </div>
        <div class="form-group">
            <label><b>Username</b></label>
            <input type="text" class="form-control" placeholder="Enter Username" name="username"
                required data-toggle="tooltip" data-placement="right" title="Usernames must be between 6 and 30 characters (inclusive).">
        </div>
        <div class="form-group">
            <label><b>Password</b></label>
            <input type="password" class="form-control" placeholder="Enter Password" name="password"
                required data-toggle="tooltip" data-placement="right" title="Passwords must be between 8 and 30 characters (inclusive). Must have at least 1 uppercase, 1 lowercase, and 1 number character.">
        </div>
        <div class="form-group">
            <label><b>Repeat Password</b></label>
            <input type="password" class="form-control" placeholder="Enter Password Again" name="rpassword"
                required data-toggle="tooltip" data-placement="right" title="Passwords must match.">
        </div>
        <a href="./home.php"><button type="button" class="btn btn-secondary">Cancel</button></a>
        <button type="submit" class="btn btn-success">Complete Signup</button>
    </form>
    </div>
FAIL;
  }
 } else {
  mysqli_close($connect);
  print <<<FAIL
    <div class="col mt-3">
    <h3 style="font-family: 'Retro Computer';">Registration</h3>
    <form id="signup" action="signup.php" method="POST" onsubmit="return validate();">
        <div class="text-danger font-italic mt-3" id="signup-response">Email taken</div>
        <div class="form-group">
            <label><b>Email</b></label>
            <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email"
                required data-toggle="tooltip" data-placement="right" title="Make sure to enter a valid email address.">
        </div>
        <div class="form-group">
            <label><b>Username</b></label>
            <input type="text" class="form-control" placeholder="Enter Username" name="username"
                required data-toggle="tooltip" data-placement="right" title="Usernames must be between 6 and 30 characters (inclusive).">
        </div>
        <div class="form-group">
            <label><b>Password</b></label>
            <input type="password" class="form-control" placeholder="Enter Password" name="password"
                required data-toggle="tooltip" data-placement="right" title="Passwords must be between 8 and 30 characters (inclusive). Must have at least 1 uppercase, 1 lowercase, and 1 number character.">
        </div>
        <div class="form-group">
            <label><b>Repeat Password</b></label>
            <input type="password" class="form-control" placeholder="Enter Password Again" name="rpassword"
                required data-toggle="tooltip" data-placement="right" title="Passwords must match.">
        </div>
        <a href="./home.php"><button type="button" class="btn btn-secondary">Cancel</button></a>
        <button type="submit" class="btn btn-success">Complete Signup</button>
    </form>
    </div>
FAIL;
 }
} else {
 mysqli_close($connect);
 print <<<FAIL
     <div class="col mt-3">
     <h3 style="font-family: 'Retro Computer';">Registration</h3>
     <form id="signup" action="signup.php" method="POST" onsubmit="return validate();">
         <div class="text-danger font-italic mt-3" id="signup-response">$error</div>
         <div class="form-group">
             <label><b>Email</b></label>
             <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email"
                 required data-toggle="tooltip" data-placement="right" title="Make sure to enter a valid email address.">
         </div>
         <div class="form-group">
             <label><b>Username</b></label>
             <input type="text" class="form-control" placeholder="Enter Username" name="username"
                 required data-toggle="tooltip" data-placement="right" title="Usernames must be between 6 and 30 characters (inclusive).">
         </div>
         <div class="form-group">
             <label><b>Password</b></label>
             <input type="password" class="form-control" placeholder="Enter Password" name="password"
                 required data-toggle="tooltip" data-placement="right" title="Passwords must be between 8 and 30 characters (inclusive). Must have at least 1 uppercase, 1 lowercase, and 1 number character.">
         </div>
         <div class="form-group">
             <label><b>Repeat Password</b></label>
             <input type="password" class="form-control" placeholder="Enter Password Again" name="rpassword"
                 required data-toggle="tooltip" data-placement="right" title="Passwords must match.">
         </div>
         <a href="./home.php"><button type="button" class="btn btn-secondary">Cancel</button></a>
         <button type="submit" class="btn btn-success">Complete Signup</button>
     </form>
     </div>
FAIL;
}

?>
            </div>
        </div>
    </main>

    <!--Footer-->
    <footer class="footer bg-dark text-white mt-5">
        <div class="container">
            <div class="row text-center d-flex justify-content-center pt-5 mb-3">
                <div class="col-md-3 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        © 2018 LockBox LLC
                    </h6>
                </div>
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        Support
                    </h6>
                </div>
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        Privacy
                    </h6>
                </div>
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        Terms of Service
                    </h6>
                </div>
                <div class="col-md-3 mb-3">
                    <h6 class="text-uppercase font-weight-bold" id="currentDate">
                    </h6>
                    <script>
                        window.addEventListener("load", function () {
                            currentDate();
                        });
                    </script>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>