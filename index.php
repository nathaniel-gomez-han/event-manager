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
            <div class="flex-column next-event-info col-lg-10 mx-auto p-4">
                <h1 class="event-title mb-4">
                    <span class="event-title-the display-4">The</span>
                    <span class="display-1">Ride or Die Tour</span>
                </h1>
                <section class="flex-column my-4">
                    <div class="flex-row">
                        <h2 class="next-event-label">Next Stop:</h2>
                    </div>
                    <div class="d-flex flex-row column-gap-4 my-4 px-sm-4 justify-content-center">
                        <div class="d-flex flex-column col col-xl-5 justify-content-center">
                            <p class="next-event-date display-1">06.17.23</p>
                        </div>
                        <div class="d-flex flex-column col col-xl-5 justify-content-around">
                            <p class="next-event-city h3">City, Region</p>
                            <p class="next-event-venue h3">Metropolitan Venue Center</p>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-lg w-auto mx-auto">Buy Tickets</button>
                </section>
            </div>
        </div>
        <div class="container-fluid pt-2 theme-bg-dark">
            <section class="container-lg pb-4 upcoming-event-dates">
                <h2>Upcoming Tour Dates:</h2>
                <hr class="header-hr">
                <div class="d-flex flex-column px-4">
                    <div class="d-flex flex-row">
                        <div class="d-flex flex-column col col-md-4 col-event-details justify-content-center">
                            <div>SAT, JUN 17, 2023</div>
                            <div>Metropolitan Venue Center</div>
                        </div>
                        <div class="d-flex flex-column col col-md-4 col-event-location justify-content-center text-center">
                            <div>City, Region</div>
                        </div>
                        <div class="d-flex flex-column col col-md-4 col-event-links justify-content-center">
                            <div class="d-flex flex-row column-gap-2 justify-content-end align-items-center">
                                <div class="sold-out-tag">Sold out!</div>
                                <button type="button" class="btn btn-primary btn-sm w-auto">More Info</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex flex-row">
                        <div class="d-flex flex-column col col-md-4 col-event-details justify-content-center">
                            <div>SAT, JUN 17, 2023</div>
                            <div>Metropolitan Venue Center</div>
                        </div>
                        <div class="d-flex flex-column col col-md-4 col-event-location justify-content-center text-center">
                            <div>City, Region</div>
                        </div>
                        <div class="d-flex flex-column col col-md-4 col-event-links justify-content-center">
                            <div class="d-flex flex-row column-gap-2 justify-content-end align-items-center">
                                <div class="sold-out-tag">Sold out!</div>
                                <button type="button" class="btn btn-primary btn-sm w-auto">More Info</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex flex-row">
                        <div class="d-flex flex-column col col-md-4 col-event-details justify-content-center">
                            <div>SAT, JUN 17, 2023</div>
                            <div>Metropolitan Venue Center</div>
                        </div>
                        <div class="d-flex flex-column col col-md-4 col-event-location justify-content-center text-center">
                            <div>City, Region</div>
                        </div>
                        <div class="d-flex flex-column col col-md-4 col-event-links justify-content-center">
                            <div class="d-flex flex-row column-gap-2 justify-content-end align-items-center">
                                <div class="sold-out-tag">Sold out!</div>
                                <button type="button" class="btn btn-primary btn-sm w-auto">More Info</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex flex-row">
                        <div class="d-flex flex-column col col-md-4 col-event-details justify-content-center">
                            <div>SAT, JUN 17, 2023</div>
                            <div>Metropolitan Venue Center</div>
                        </div>
                        <div class="d-flex flex-column col col-md-4 col-event-location justify-content-center text-center">
                            <div>City, Region</div>
                        </div>
                        <div class="d-flex flex-column col col-md-4 col-event-links justify-content-center">
                            <div class="d-flex flex-row column-gap-2 justify-content-end align-items-center">
                                <div class="sold-out-tag">Sold out!</div>
                                <button type="button" class="btn btn-primary btn-sm w-auto">More Info</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </section>
        </div>

    </main>

    <!-- Footer -->
    <?php include 'inc/footer.php'; ?>

    <!-- JavaScript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>