<?php
require_once("inc/base.php");

session_start();

// Authentication
$isUserValid = false;
if (isset($_SESSION['isUserValid'])) {
    $isUserValid = $_SESSION['isUserValid'];
}

// Database Connection
require_once(__DIR__ . '/inc/exceptionHandlers.php');
require_once(__DIR__ . '/inc/dbConnect.php'); // Creates a connection object called $connection.

$connection = null;
$statement = null;
$sql = "
    SELECT `id`, `date`, `venue`, `city`, `region`, `is_sold_out`
    FROM event
    ORDER BY `date` ASC
";

// Execute the query statement
try {
    $connection = dbConnect();
    $statement = $connection->prepare($sql);
} catch (PDOException $e) {
    handleConnectionException($e, $connection);
}
try {
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    handleStatementException($e, $statement);
}

$tourDatesHTML = "";

// If there are upcoming events, generate HTML for the list of tour dates.
if ($row = $statement->fetch()) {
    do {
        $formattedDate = strtoupper(date('D, M j, Y', strtotime($row['date'])));
        $venue = htmlspecialchars($row['venue']);
        $city = htmlspecialchars($row['city']);
        $region = htmlspecialchars($row['region']);

        $soldOutTagHTML = $row['is_sold_out'] ? '<div class="text-center text-sm-end sold-out-tag">Sold out!</div>' : '';
        $tourDatesHTML .= <<<END
            <div class="d-flex flex-column flex-sm-row flex-wrap row-gap-3">
                <div class="d-flex flex-column col-sm-4 justify-content-center text-center text-sm-start col-event-details">
                    <div>$formattedDate</div>
                    <div>$venue</div>
                </div>
                <div class="d-flex flex-column col-sm-4 justify-content-center text-center col-event-location">
                    <div>$city, $region</div>
                </div>
                <div class="d-flex flex-column col-sm-4 justify-content-center col-event-links">
                    <div class="d-flex flex-column flex-sm-row-reverse column-gap-2 row-gap-1 justify-content-center justify-content-sm-start align-items-center">
                       <button type="button" class="btn btn-primary btn-sm">More Info</button>
                       $soldOutTagHTML
                    </div>
                </div>
            </div>
            <hr>
        END;
    } while ($row = $statement->fetch());
} else {
    $tourDatesHTML = <<<END
        <div class="d-flex flex-row">
            <div class="mx-auto h3">Coming Soon</div>
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
        <title>Rocktane - Tour Dates</title>
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" href="/favicon.ico" sizes="16x16 32x32"><!-- 32×32 -->
        <link rel="icon" href="/icon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png"><!-- 180×180 -->
        <link rel="manifest" href="/manifest.webmanifest">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.typekit.net/ukm4sma.css"><!-- Adobe Fonts (Gin) -->
        <link rel="stylesheet" href="css/main.css">
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
            <div class="d-flex flex-column px-4">
                <?= $tourDatesHTML ?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include 'inc/footer.php'; ?>

    <!-- JavaScript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>