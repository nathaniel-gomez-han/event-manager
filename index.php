<?php
session_start();

// Authentication
$isUserValid = false;
if (isset($_SESSION['isUserValid'])) {
    $isUserValid = $_SESSION['isUserValid'];
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!--
            Author: Nathaniel Gomez-Han
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
        <link rel="stylesheet" href="https://use.typekit.net/ukm4sma.css"><!-- Adobe Fonts (Gin) -->
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <?php include 'inc/navbar.php'; ?>

    <!-- Page Content -->
    <main class="flex-grow-1 container-fluid h-100 p-0">

        <div class="splash container-lg pb-4 text-center">
            <div class="flex-column next-event-info col-lg-10 mx-auto p-2 pt-4">
                <h1 class="event-title">
                    <span class="event-title-the display-4">The</span>
                    <span class="display-1">Ride or Die Tour</span>
                </h1>
                <section class="flex-column py-4">
                    <div class="flex-row">
                        <h2 class="next-event-label">Next Stop:</h2>
                    </div>
                    <div class="d-flex flex-row p-2 px-sm-4 justify-content-center">
                        <div class="d-flex flex-column col-sm-6 col-xl-5 justify-content-center">
                            <p class="next-event-date display-1">06.13.23</p>
                        </div>
                        <div class="d-flex flex-column col-sm-6 col-xl-5 justify-content-around">
                            <p class="next-event-city h3">Place, Region</p>
                            <p class="next-event-venue h3">Metropolitan Venue Center</p>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-lg w-auto mx-auto mt-4">Buy Tickets</button>
                </section>
            </div>
        </div>
        <div class="container-fluid">
        </div>

    </main>

    <!-- Footer -->
    <?php include 'inc/footer.php'; ?>

    <!-- JavaScript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>