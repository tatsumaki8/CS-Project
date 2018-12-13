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
    <link rel="stylesheet" href="sticky-footer.css">
    <script src="./date.js"></script>
    <script src="./vault.js"></script>

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
            <?php
session_start();
if (isset($_SESSION["username"])) {
 $login = $_SESSION["username"];
} else {
 checkLogin();
}
if (isset($_POST["add"])) {
 insert();
} elseif (isset($_POST["delete"])) {
 delete();
} elseif (isset($_POST["edit"])) {
 edit();
} elseif (isset($_POST["deleteAccount"])) {
    deleteAccount();
} elseif (isset($_POST["changeAccount"])) {
    changeAccount();
} elseif (isset($_POST["change"])) {
 change();
} else {
 echo "<h1 class='text-center mt-3' style='font-family:\"Retro Computer\";'> Welcome back $login </h1>";
 print <<<PAGE1
    <div class="row">
        <div class="col-2"></div>
        <div class="col-4 text-center">
            <a href='#collapseOne' class='btn btn-success text-white text-center mb-3' data-toggle='collapse'>Add New Site Login</a>
        </div>
        <div class="col-4 text-center">
            <a href='#collapseTwo' class='btn btn-success text-white text-center mb-3' data-toggle='collapse'>Change Account Information</a>
        </div>
        <div class="col-2"></div>
    </div>
    <div class="row panel-collapse collapse" id='collapseOne'>
        <div class="col">
            <form method="post" action="vault.php">
                    <div class="form-group">
                        <label>Name:</label>
                        <input class="form-control" type="text" name="name" required placeholder="Example">
                    </div>
                    <div class="form-group">
                        <label>Website:</label>
                        <input class="form-control" type="text" name="website" required placeholder="www.example.com">
                    </div>
                    <div class="form-group">
                        <label>Username:</label>
                        <input class="form-control" type="text" name="username" required placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input id="new_pw" class="form-control" type="text" name="password" required placeholder="Enter Password">
                    </div>
                    <input type="submit" value="Enter" name="add" class="btn btn-success"/>&nbsp;
                    <input type="reset" value="Reset" class="btn btn-secondary" />
            </form>
        </div>
        <div class="col">
        <!--Password Generator-->
        <h2 class="text-center" style="font-family: 'Retro Computer';">Password Generator</h2>
        <div class="row mb-3">
            <div class="col-2"></div>
            <div class="col-8 text-center">
                <button type="button" class="btn btn-lg btn-success mb-3" onclick="generatePassword();" id="generatePassword">Generate
                    Password</button><br>
                <input type="text" class="mb-1 text-center text-info" name="generated_pw" id="generated_pw"
                    readonly><br />
                <script>
                    window.addEventListener("load", function() {
                        generatePassword();
                    });
                </script>
                <button type="button" class="btn btn-sm btn-primary" onclick="copy();">Copy</button><br />
                <div id="copied" class="font-italic text-muted"></div><br />
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="gen_pw_AZ" id="gen_pw_AZ" checked
                            oninput="generatePassword();">
                        <label class="form-check-label" for="gen_pw_AZ">A-Z</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="gen_pw_az" id="gen_pw_az" checked
                            oninput="generatePassword();">
                        <label class="form-check-label" for="gen_pw_AZ">a-z</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="gen_pw_09" id="gen_pw_num" checked
                            oninput="generatePassword();">
                        <label class="form-check-label" for="gen_pw_num">0-9</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="gen_pw_misc" id="gen_pw_misc" oninput="generatePassword();">
                        <label class="form-check-label" for="gen_pw_misc">!@#$%^&*</label>
                    </div>
                    <div class="form-row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <input type="number" name="gen_pw_length_text" id="gen_pw_length_text" min=8 max=30
                                oninput="sliderValue('gen_pw_length_text','gen_pw_length');" value="8">&nbsp;
                            <input type="range" name="gen_pw_length" id="gen_pw_length" min="8" max="30" oninput="sliderValue('gen_pw_length', 'gen_pw_length_text');"
                                value="8">
                        </div>
                        <div class="col-2"></div>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
        </div>
    </div>
PAGE1;

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

    $username = $_SESSION["username"];
    $table = "Lockbox";
    $result  = mysqli_query($connect, "SELECT * from $table WHERE username='$username'");
    while ($row = $result->fetch_row()) {
        print "<div class='row panel-collapse collapse' id='collapseTwo'>
        <div class='col-6'>
            <div class='form-group'>
                <label><b>Old Email:</b></label>
                <input class='form-control type=' text' placeholder='$row[1]' readonly>
                </div>
            <div class='form-group'>
                <label><b>Old Username: </b></label>
                <input class='form-control type=' text' placeholder='$row[0]' readonly>
            </div>
        </div>";
    }
    print <<<PAGE2
        <div class="col-6">
            <form method="post" action="vault.php">
                    <div class="form-group">
                        <label> New Email:</label>
                        <input class="form-control" type="text" name="newEmail" placeholder="name@example.com">
                    </div>
                    <div class="form-group">
                        <label> New Username:</label>
                        <input class="form-control" type="text" name="newUsername" placeholder="Example">
                    </div>
                    <input type="submit" value="Enter" name="changeAccount" class="btn btn-success"/>&nbsp;
                    <input type="reset" value="Reset" class="btn btn-secondary" />
            </form>
        </div>
        <div class="col"></div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg">
PAGE2;
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
  // Decrypts the stored passwords using the key
  $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
  $row[5] = my_decrypt($row[5], $key);
  print
   "<a href='#collapse$count' class='list-group-item' data-toggle='collapse'>$row[2]</a>
        <div id='collapse$count' class='panel-collapse collapse'>
            <table class='list-group-item bg-secondary text-white text-center'>
                <tr>
                <td width='800'><b>Website: </b><i>$row[3]</i></td>
                <td width='800'><b>Username: </b><i>$row[4]</i></td>
                <td width='800'><b>Password: </b><i>$row[5]</i></td>
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
        $result = mysqli_query($connect, "SELECT pass from $table WHERE username='$username'");
        $row = mysqli_fetch_row($result);
        if (mysqli_num_rows($result) == 1) {
        if (password_verify($password, $row[0])){
        $_SESSION["username"] = $username;
        }
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
        // Encrypts the password for the database
        $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
        $passwd = my_encrypt($passwd, $key);
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
        $result = mysqli_query($connect, "SELECT * from $table");
        $IDarray = array();
        while ($row = $result->fetch_row()) {
        array_push($IDarray, $row[0]);
        }
        $result->free();
        $result = mysqli_query($connect, "SELECT ID from $table WHERE Login='$login'");
        while ($row = $result->fetch_row()) {
        $count = 0;
        while ($count <= end($IDarray) + 1) {extract($_POST);if (isset($_POST[$count])) {$id=$count; break;} else {
            $count++;}}} $stmt=mysqli_query($connect, "DELETE FROM $table WHERE ID = '$id'" ); $result->free();
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
            $result = mysqli_query($connect, "SELECT * from $table");
            $IDarray = array();
            while ($row = $result->fetch_row()) {
            array_push($IDarray, $row[0]);
            }
            $result->free();
            $result = mysqli_query($connect, "SELECT * from $table WHERE Login='$login'");
            while ($row = $result->fetch_row()) {
            $count = 0;
            while ($count <= end($IDarray) + 1) {extract($_POST);if (isset($_POST[$count])) {global $idEdit; $idEdit=$count;
                break;} else { $count++;}}} $stmt=mysqli_query($connect, "SELECT * from $table WHERE ID = '$idEdit'"
                );while ($row=$stmt->fetch_row()) {
                $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
                $row[5] = my_decrypt($row[5], $key);
                echo "<h1 class='text-center mt-3' style='font-family:\"Retro Computer\";'> Edit Info </h1>";
                print
                "<form method='post' action='edit.php'>
                    <div class='row'>
                        <div class='col-4'>
                            <h3 class='text-center mt-3' style='font-family:\"Retro Computer\";'>Old</h3>
                            <div class='form-group'>
                                <label><b>Name:</b></label>
                                <input class='form-control type=' text' placeholder='$row[2]' readonly>
                            </div>
                            <div class='form-group'>
                                <label><b>Website: </b></label>
                                <input class='form-control type=' text' placeholder='$row[3]' readonly>
                            </div>
                            <div class='form-group'>
                                <label><b>Username:</b></label>
                                <input class='form-control type=' text' placeholder='$row[4]' readonly>
                            </div>
                            <div class='form-group'>
                                <label><b>Password:</b></label>
                                <input class='form-control type=' text' placeholder='$row[5]' readonly>
                            </div>
                        </div>
                        <div class='col-4'>
                            <h3 class='text-center mt-3' style='font-family:\"Retro Computer\";'>New</h3>
                            <div>
                                <input type='hidden' name='id' value='$idEdit'>
                                <div class='form-group'>
                                    <label><b>Name:</b></label>
                                    <input class='form-control type=' text' placeholder='Example' name='nameChange'>
                                </div>
                                <div class='form-group'>
                                    <label><b>Website:</b></label>
                                    <input class='form-control type=' text' placeholder='www.example.com' name='websiteChange'>
                                </div>
                                <div class='form-group'>
                                    <label><b>Username:</b></label>
                                    <input class='form-control type=' text' placeholder='Enter Username' name='usernameChange'>
                                </div>
                                <div class='form-group'>
                                    <label><b>Password:</b></label>
                                    <input class='form-control type=' text' placeholder='Enter Password' name='passwordChange' id='new_pw'>
                                </div>
                            </div>
                        </div>";
                        print <<<PAGE

                        <div class="col-4 text-center">
                        <h3 class='text-center mt-3' style='font-family:"Retro Computer";'>Password Generator</h3>
                <button type="button" class="btn btn-lg btn-success mb-3" onclick="generatePassword();" id="generatePassword">Generate
                    Password</button><br>
                <input type="text" class="mb-1 text-center text-info" name="generated_pw" id="generated_pw"
                    readonly><br />
                <script>
                    window.addEventListener("load", function() {
                        generatePassword();
                    });
                </script>
                <button type="button" class="btn btn-sm btn-primary" onclick="copy();">Copy</button><br />
                <div id="copied" class="font-italic text-muted"></div><br />
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="gen_pw_AZ" id="gen_pw_AZ" checked
                            oninput="generatePassword();">
                        <label class="form-check-label" for="gen_pw_AZ">A-Z</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="gen_pw_az" id="gen_pw_az" checked
                            oninput="generatePassword();">
                        <label class="form-check-label" for="gen_pw_AZ">a-z</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="gen_pw_09" id="gen_pw_num" checked
                            oninput="generatePassword();">
                        <label class="form-check-label" for="gen_pw_num">0-9</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="gen_pw_misc" id="gen_pw_misc" oninput="generatePassword();">
                        <label class="form-check-label" for="gen_pw_misc">!@#$%^&*</label>
                    </div>
                    <div class="form-row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <input type="number" name="gen_pw_length_text" id="gen_pw_length_text" min=8 max=30
                                oninput="sliderValue('gen_pw_length_text','gen_pw_length');" value="8">&nbsp;
                            <input type="range" name="gen_pw_length" id="gen_pw_length" min="8" max="30" oninput="sliderValue('gen_pw_length', 'gen_pw_length_text');"
                                value="8">
                        </div>
                        <div class="col-2"></div>
                    </div>
                </div>

PAGE;

                       print "</div>
                    </div>
                    <div class='text-center'>
                        <input type='submit' value='Submit' name='editInfo' class='btn btn-success' />
                        <input type='submit' value='Cancel Change' name='cancelEdit' class='btn btn-secondary' />
                    </div>
                </form>";
                }
                }
                echo "<div class='row'><div class='col-4'></div><div class='col-2'><div class='text-center mt-3'><form method='post' action='vault.php'><button name='deleteAccount' class='btn btn-dark text-white'>Delete Account</button></form></div></div>";
                echo "<div class='col-2'><div class='text-center mt-3'><a href='logout.php'><button class='btn btn-danger'>Logout</button></a></div></div><div class='col-4'></div></div>";
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
                function my_decrypt($data, $key) {
                // Remove the base64 encoding from our key
                $encryption_key = base64_decode($key);
                // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
                list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
                return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
                }

                function deleteAccount(){
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

                    $table = "Lockbox";
                    $username = $_SESSION["username"];
                    $stmt = mysqli_query($connect, "DELETE FROM $table WHERE username = '$username'");
                    mysqli_close($connect);

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
                    $username = $_SESSION["username"];
                    $stmt = mysqli_query($connect, "DELETE FROM $table WHERE Login = '$username'");
                    mysqli_close($connect);

                    session_start();

                    session_unset();
                    session_destroy();
                    header("Location: ./home.php");
                }
                function changeAccount(){
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

                    $table = "Lockbox";
                    $username = $_SESSION["username"];
                    extract($_POST);
                    $newEmail = $_POST["newEmail"];
                    $newUsername = $_POST["newUsername"];
                    if ($newEmail!="") {
                		$stmt1 = mysqli_query($connect, "UPDATE $table SET email='$newEmail' WHERE username='$username'");
                	}
                	if ($newUsername!="") {
                		$stmt2 = mysqli_query($connect, "UPDATE $table SET username='$newUsername' WHERE username='$username'");
                	}
                    mysqli_close($connect);

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
                    $username = $_SESSION["username"];
                    $newUsername = $_POST["newUsername"];
                    if ($newUsername!="") {
                		$stmt2 = mysqli_query($connect, "UPDATE $table SET Login='$newUsername' WHERE Login='$username'");
                	}
                    mysqli_close($connect);

                    session_start();

                    session_unset();
                    session_destroy();
                    header("Location: ./home.php");
                }
                ?>
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
