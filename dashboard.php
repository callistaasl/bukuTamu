<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) { // keamanan
    header("Location: login.php");
    exit;
}
?>

<html>
    <head>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
        <title>Dashboard</title>
        <style>
            body {
                font-family: 'Lato', sans-serif;
                background-image: url('dashboard.png');
                background-size: cover;
                background-position: center;
                margin: 0;
                padding: 0;
            }

            .navbar {
                background-color: #162860;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 20px;
                font-family: 'Lato', sans-serif;
            }

            .navbar-center {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                display: flex;
                align-items: center;
            }

            .navbar a {
                color: #f3f3f3;
                text-decoration: none;
                margin-right: 15px;
            }

            .navbar-right {
                margin-left: auto;
            }

            .logout-btn {
                display: inline-block;
                padding: 10px 20px;
                background-color: #ffd9ea;
                color: #162860;
                text-decoration: none;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div class="navbar">
            <div class="navbar-center">
                <a href="dashboard.php">Home</a>
                <a href="buku_tamu.php">Buku Tamu</a>
            </div>
            <div class="navbar-right">
                <a href="logout.php" class="logout-btn" style="color: #162860;">Logout</a>
            </div>
        </div>
    </body>
</html>