<?php
require_once("inc/base.php"); // Defines $root
require_once("inc/TourDate.php");

if (isset($_GET['id'])) {
    $tourDateId = $_GET['id'];

    // Database Connection
    require_once(__DIR__ . '/inc/exceptionHandlers.php');
    require_once(__DIR__ . '/inc/dbConnect.php');

    $connection = null;
    $statement = null;
    $sql = "
        SELECT `id`, `show_starts_at`, `venue`, `city`, `region`, `is_sold_out`
        FROM `tour_date`
        WHERE `id` = :tourDateId
    ";

    // Execute the query statement
    try {
        $connection = dbConnect();
        $statement = $connection->prepare($sql);
    } catch (PDOException $e) {
        handleConnectionException($e, $connection);
    }
    try {
        $statement->bindParam(':tourDateId', $tourDateId);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        handleStatementException($e, $statement);
    }

    $tourDateInfoHTML = "";

    // If there are upcoming tourDates, generate HTML for the list of tour dates.
    if ($row = $statement->fetch()) {
        $tourDate = new TourDate(
            $row['id'],
            $row['show_starts_at'],
            $row['venue'],
            $row['city'],
            $row['region'],
            '',
            $row['is_sold_out'],
        );

        $formattedDate = $tourDate->getShowStartDateTime()->format('M/d/y');
        $formattedTime = $tourDate->getShowStartDateTime()->format('g:iA');
        $venue = htmlspecialchars($tourDate->getVenue());
        $city = htmlspecialchars($tourDate->getCity());
        $region = htmlspecialchars($tourDate->getRegion());
        $isSoldOut = $tourDate->getIsSoldOut() ? true : false;

        $tourDateInfoHTML = <<<END
                <img src="$root/img/rocktane-logo.svg" alt="Rocktane Logo" class="col-11 col-sm-6 col-xl-4 mb-4">
                <h1 class="tour-title mb-4">
                    <span class="tour-title-the display-4">The</span>
                    <span class="display-1">Ride or Die Tour</span>
                </h1>
                <section class="flex-column mb-4 text-center">
                    <p>
                        <h2 class="h4">TIME:</h2>
                        <span class="h3">$formattedTime</span>
                        <span class="h3">$formattedDate</span>
                    </p>
                    <p>
                        <h2 class="h4">CITY:</h2>
                        <span class="h3">$city, $region</span>
                    </p>
                    <p>
                        <h2 class="h4">VENUE:</h2>
                        <span class="h3">$venue</span>
                    </p>
                </section>
        END;
        if ($isSoldOut) {
            $tourDateInfoHTML .= <<<END
                <button type="button" class="btn btn-outline-primary disabled btn-lg w-auto mx-auto" disabled>Sold Out</button>
            END;
        } else {
            $tourDateInfoHTML .= <<<END
                <button type="button" class="btn btn-outline-primary btn-lg w-auto mx-auto">Buy Tickets</button>
            END;
        }

    } else {
        $tourDateInfoHTML = <<<END
            <hr>
            <div class="d-flex flex-row">
                <div class="mx-auto h1">tourDate Not Found</div>
            </div>
            <hr>
        END;
    }
} else {
    $tourDateInfoHTML = <<<END
        <hr>
        <div class="d-flex flex-row">
            <div class="mx-auto h1">Invalid URL</div>
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
        <title>Rocktane - Tour Date Details</title>
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
        <section class="container-lg py-4 text-center upcoming-tour-dates">
            <?= $tourDateInfoHTML ?>
        </section>
    </main>

    <!-- Footer -->
    <?php include 'inc/footer.php'; ?>

    <!-- JavaScript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>