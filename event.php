<?php
session_start();

// Authentication
$isUserValid = false;
if (isset($_SESSION['isUserValid'])) {
    $isUserValid = $_SESSION['isUserValid'];
}

if (isset($_GET['id'])) {
    $eventId = $_GET['id'];

    // Database Connection
    require_once(__DIR__ . '/inc/exceptionHandlers.php');
    require_once(__DIR__ . '/inc/dbConnect.php'); // Creates a connection object called $connection.

    $connection = null;
    $statement = null;
    $sql = "
        SELECT `id`, `date`, `venue`, `city`, `region`, `is_sold_out`
        FROM event
        WHERE `id` = :eventId
    ";

    // Execute the query statement
    try {
        $connection = dbConnect();
        $statement = $connection->prepare($sql);
    } catch (PDOException $e) {
        handleConnectionException($e, $connection);
    }
    try {
        $statement->bindParam(':eventId', $eventId);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        handleStatementException($e, $statement);
    }

    $nextStopHTML = "";

    // If there are upcoming events, generate HTML for the list of tour dates.
    if ($row = $statement->fetch()) {
        $formattedDate = date('M/d/y', strtotime($row['date']));
        $venue = htmlspecialchars($row['venue']);
        $city = htmlspecialchars($row['city']);
        $region = htmlspecialchars($row['region']);

        $nextStopHTML = <<<END
            <section class="flex-column mb-3">
                <div class="flex-row">
                    <h2 class="next-event-label">Next Stop:</h2>
                </div>
                <div class="d-flex flex-column flex-md-row column-gap-4 my-4 px-md-4 justify-content-center">
                    <div class="d-flex flex-column col-md-6 col-xl-5 justify-content-center">
                        <p class="next-event-date display-1">$formattedDate</p>
                    </div>
                    <div class="d-flex flex-column col-md-6 col-xl-5 justify-content-around">
                        <p class="next-event-city h3">$city, $region</p>
                        <p class="next-event-venue h3">$venue</p>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-primary btn-lg w-auto mx-auto">Buy Tickets</button>
            </section>
        END;
    } else {
        $nextStopHTML = <<<END
            <div class="d-flex flex-row">
                <div class="mx-auto h3">This event doesn't exist.</div>
            </div>
            <hr>
        END;
    }
} else {
    $nextStopHTML = <<<END
        <div class="d-flex flex-row">
            <div class="mx-auto h3">Invalid URL</div>
        </div>
        <hr>
    END;
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
        <title>Rocktane - Event Details</title>
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
    <main class="d-flex flex-column flex-grow-1 container-fluid p-0 theme-bg-dark">

        <section class="container-lg py-4 text-center upcoming-event-dates">
            <h1 class="event-title mb-4">
                <span class="event-title-the display-4">The</span>
                <span class="display-1">Ride or Die Tour</span>
            </h1>
            <hr class="header-hr">
            <section class="splash container-fluid pb-4 text-center">
                <div class="flex-column next-event-info col-lg-10 mx-auto p-4">
                    <?= $nextStopHTML ?>
                </div>
            </section>
        </section>
    </main>

    <!-- Footer -->
    <?php include 'inc/footer.php'; ?>

    <!-- JavaScript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>