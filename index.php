<?php
session_start();

// Authentication
$isUserValid = false;
if (isset($_SESSION['isUserValid'])) {
    $isUserValid = $_SESSION['isUserValid'];
}

// Dynamic Page Content
$currentYear = date("Y");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!--
            Author: Nathaniel Gomez-Han
            Date: May 1 2023
        -->
        <meta http-equiv="X-UA-Compatible" content ="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Event Manager</title>
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" href="/favicon.ico" sizes="16x16 32x32"><!-- 32×32 -->
        <link rel="icon" href="/icon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png"><!-- 180×180 -->
        <link rel="manifest" href="/manifest.webmanifest">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body class="d-flex flex-column">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand h1 mb-lg-0" href="index.php">
                <img src="img/rocktane-logo.svg" alt="Rocktane Logo" height="30">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tour</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Content -->
    <main class="flex-grow-1">
        <h1>Event Manager</h1>
        <h2>Upcoming Events:</h2>

    </main>
    <!-- Footer -->
    <footer class="text-center">
        <!-- Copyright -->
        <div class="text-center p-3 bg-dark text-bg-dark">
            &copy; <?= $currentYear ?> Nathaniel Gomez-Han
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>