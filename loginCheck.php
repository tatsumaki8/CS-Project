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

    <link rel="stylesheet" href="loginCheck.css">
    <link rel="stylesheet" href="sticky-footer.css">
    <script src="./home.js"></script>

    <style>
        @font-face {
            font-family: 'Retro Computer';
            src: url('./rsc/Retro\ Computer.ttf')
        }
    </style>
</head>

<div class="nav-side-menu">
    <div class="brand bg-success"><img src="./rsc/LockBox_Logo.png" alt="Logo" style="width: 180px"></div>

    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    <div class="menu-list">
        <ul id="menu-content" class="menu-content collapse out">
            <li>
                <a><i class="fa fa-user fa-lg"></i>&emsp; All Items </a>
            </li>
            <li>
                <a><i class="fa fa-user fa-lg"></i>&emsp; Favorite</a>
            </li>
            <li><br /></li>
            <li data-toggle="collapse" data-target="#account" class="collapsed">
                <a href="#"><i class="fa fa-gift fa-lg"></i>&emsp; Account</a>
            </li>
            <ul class="sub-menu collapse" id="account">
                <li>
                    <a><i class="fa fa-user fa-lg"></i> General </a>
                </li>
                <li>
                    <a><i class="fa fa-user fa-lg"></i> Email </a>
                </li>
                <li>
                    <a><button name="#"><i class="fa fa-user fa-lg"></i> Change Password </a>
                </li>
                <li>
                    <a><button name="#"><i class="fa fa-user fa-lg"></i> Delete Account </a>
                </li>
            </ul>
            <li data-toggle="collapse" data-target="#settings" class="collapsed">
                <a href="#"><i class="fa fa-gift fa-lg"></i>&emsp; Settings</a>
            </li>
            <ul class="sub-menu collapse" id="settings">
                <li>
                    <a><i class="fa fa-user fa-lg"></i> General </a>
                </li>
                <li>
                    <a><i class="fa fa-user fa-lg"></i> Privacy </a>
                </li>
            </ul>
            <li>
                <a href="help.php"><i class="fa fa-user fa-lg"></i>&emsp; Help</a>
            </li>
            <li>
                <a><i class="fa fa-user fa-lg"></i>&emsp; Logout</a>
            </li>
        </ul>
    </div>
</div>
<div class="container" id="main">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-md-8">
        </div>
        <div class="col-2"></div>
    </div>
</div>

<?php
if (isset($_POST["help"])){
	header("Location: help.php");
}
?>
