<?php
$home = file_get_contents("https://fall-2018.cs.utexas.edu/cs329e-mitra/valex8/project/home.html");
$homePage = "home.html";
$about = file_get_contents("https://fall-2018.cs.utexas.edu/cs329e-mitra/valex8/project/about.html");
$aboutPage = "about.html";
$help = file_get_contents("https://fall-2018.cs.utexas.edu/cs329e-mitra/valex8/project/help.html");
$helpPage = "help.html";
$donate = file_get_contents("https://fall-2018.cs.utexas.edu/cs329e-mitra/valex8/project/donate.html");
$donatePage = "donate.html";
$contact = file_get_contents("https://fall-2018.cs.utexas.edu/cs329e-mitra/valex8/project/contact.html");
$contactPage = "contact.html";

$search = $_POST["searchText"];

print <<<TOP1
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Donate</title>
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

    <link rel="stylesheet" href="donate.css">
    <link rel="stylesheet" href="sticky-footer.css">
    <script src="./home.js"></script>

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
        <a class="navbar-brand" href="home.html">
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
                <input id="searchText" name="searchText" class="form-control mr-sm-2" type="text" placeholder="Search..." aria-label="Search">
                <a>
                    <ion-icon name="search" style="text-decoration: none; color: white; font-size: 28px"></ion-icon>
                </a>
            </div>
        </form>
    </nav>
    <main>
        <div class="container pt-5">
            <h2 class="text-center"> Search Results For "
TOP1;
    echo $search;

print <<<TOP2
        "</h2>
        <div class="row">
        <div class="col-2"></div>
        <div class="col-8 text-center pt-3">
TOP2;

if (stripos($home, $search) !== false){
    echo '<a href="'.$homePage.'">'."Home".'</a><br />';
}
if (stripos($about, $search) !== false){
    echo '<a href="'.$aboutPage.'">'."About".'</a><br />';
}
if (stripos($help, $search) !== false){
    echo '<a href="'.$helpPage.'">'."Help".'</a><br />';
}
if (stripos($donate, $search) !== false){
    echo '<a href="'.$donatePage.'">'."Donate".'</a><br />';
}
if (stripos($contact, $search) !== false){
    echo '<a href="'.$contactPage.'">'."Contact".'</a><br />';
}

if (stripos($home, $search) == false && stripos($about, $search) == false && stripos($help, $search) == false && stripos($donate, $search) == false && stripos($contact, $search) == false){
    echo "No results were found.";
}
                <div class="col-2"></div>
            </div>
        </div>
    </main>
    <br />
</body>

</html>
BOTTOM;
?>
