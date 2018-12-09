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
        <!--Content-->
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3 class="mt-3" style="font-family: 'Retro Computer';">Login</h3>
                    <div class="text-danger font-italic mt-3" id="login-response">Username or password is incorrect.</div>
                    <form id="login" action="./vault.php" method="POST">
                        <?php
                            if (isset($_COOKIE["user"])){
                            $user = $_COOKIE["user"];

                                    print <<<LOGIN
                            <div class="form-group">
                                <label><b>Username</b></label>
                                <input type="text" class="form-control" placeholder="Enter Username" name="username"
                                    required value="$user">
                            </div>
                            <div class="form-group">
                                <label><b>Password</b></label>
                                <input type="password" class="form-control" placeholder="Enter Password" name="password"
                                    required>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember" value="yes" checked>
                                <label class="form-check-label" for="remember">Remember Username</label>
                            </div>        

LOGIN;
                            } else {
                            print <<<LOGIN2
                            <div class="form-group">
                                <label><b>Username</b></label>
                                <input type="text" class="form-control" placeholder="Enter Username" name="username"
                                    required>
                            </div>
                            <div class="form-group">
                                <label><b>Password</b></label>
                                <input type="password" class="form-control" placeholder="Enter Password" name="password"
                                    required>
                            </div>
                            <div class="form-group form-check">

                                <input type="checkbox" class="form-check-input" id="remember" name="remember" value="yes">
                                <label class="form-check-label" for="remember">Remember Username</label>
                            </div>                            
LOGIN2;
                            }
                            ?>
                        <a href="./home.php"><button type="button" class="btn btn-secondary">Cancel</button></a>
                        <button type="submit" class="btn btn-success">Login</button>
                    </form>
                </div>
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