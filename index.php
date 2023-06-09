<?php
require_once("inc/base.php");
require_once("inc/TourDate.php");

// Database Connection
require_once(__DIR__ . '/inc/exceptionHandlers.php');
require_once(__DIR__ . '/inc/dbConnect.php');

$connection = null;
$statement = null;
$sql = "
    SELECT `id`, `show_starts_at`, `venue`, `city`, `region`, `is_sold_out`
    FROM `tour_date`
    WHERE `show_starts_at` >= UTC_DATE()
    ORDER BY `show_starts_at` ASC
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

$tourDates = [];
$nextStopHTML = "";
$upcomingTourDatesHTML = "";

// If there are upcoming tour dates, generate HTML for the splash and upcoming tour date sections.
if ($row = $statement->fetch()) {
    do {
        $tourDates []= new TourDate(
            $row['id'],
            $row['show_starts_at'],
            $row['venue'],
            $row['city'],
            $row['region'],
            '',
            $row['is_sold_out'],
        );
    } while ($row = $statement->fetch());

    $formattedDate = $tourDates[0]->getShowStartDateTime()->format('M/d/y');
    $formattedTime = $tourDates[0]->getShowStartDateTime()->format('g:i');
    $formattedMeridiem = $tourDates[0]->getShowStartDateTime()->format('A');
    $venue = htmlspecialchars($tourDates[0]->getVenue());
    $city = htmlspecialchars($tourDates[0]->getCity());
    $region = htmlspecialchars($tourDates[0]->getRegion());

    $nextStopHTML = <<<END
        <section class="flex-column mb-3">
            <div class="flex-row">
                <h2 class="next-tour-date-label">Next Stop:</h2>
            </div>
            <div class="d-flex flex-column flex-md-row column-gap-4 my-4 px-md-4 justify-content-center">
                <div class="d-flex flex-column col-md-6 col-xl-5 justify-content-center">
                    <p class="next-tour-date-info display-3">$formattedTime <span class="next-tour-date-info display-6">$formattedMeridiem</span></p>
                    <p class="next-tour-date-info display-1">$formattedDate</p>
                </div>
                <div class="d-flex flex-column col-md-6 col-xl-5 justify-content-center row-gap-3">
                    <p class="next-tour-date-info h2">$venue</p>
                    <p class="next-tour-date-info h2">$city, $region</p>
                </div>
            </div>
            <button type="button" class="btn btn-outline-primary btn-lg w-auto mx-auto">Buy Tickets</button>
        </section>
    END;

    foreach ($tourDates as $tourDate) {
        $formattedDate = strtoupper($tourDate->getShowStartDateTime()->format('D, M j, Y'));
        $venue = htmlspecialchars($tourDate->getVenue());
        $city = htmlspecialchars($tourDate->getCity());
        $region = htmlspecialchars($tourDate->getRegion());
        $infoLink = 'tour-date.php?id=' . urlencode($tourDate->getID());
        $soldOutTagHTML = $tourDate->getIsSoldOut() ? '<div class="text-center text-sm-end sold-out-tag">Sold out!</div>' : '';

        $upcomingTourDatesHTML .= <<<END
            <div class="d-flex flex-column flex-sm-row flex-wrap row-gap-3">
                <div class="d-flex flex-column col-sm-4 justify-content-center text-center text-sm-start">
                    <div>$formattedDate</div>
                    <div>$venue</div>
                </div>
                <div class="d-flex flex-column col-sm-4 justify-content-center text-center">
                    <div>$city, $region</div>
                </div>
                <div class="d-flex flex-column col-sm-4 justify-content-center">
                    <div class="d-flex flex-column flex-sm-row-reverse column-gap-2 row-gap-1 justify-content-center justify-content-sm-start align-items-center">
                       <a href="$infoLink"><button type="button" class="btn btn-primary btn-sm">More Info</button></a>
                       $soldOutTagHTML
                    </div>
                </div>
            </div>
            <hr>
        END;
    } while ($row = $statement->fetch());
} else {
    $upcomingTourDatesHTML = <<<END
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
        <title>Rocktane - The Ride Or Die Tour</title>
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
    <main class="d-flex flex-column flex-grow-1 container-fluid p-0">

        <section class="splash container-fluid pb-4 text-center">
            <div class="flex-column next-tour-date-overlay col-lg-10 mx-auto p-4">
                <h1 class="tour-title mb-4">
                    <span class="tour-title-the display-4">The</span>
                    <span class="display-1">Ride or Die Tour</span>
                </h1>
                <?= $nextStopHTML ?>
            </div>
        </section>
        <section class="container-lg py-4 theme-bg-dark upcoming-tour-dates">
            <h2>Upcoming Tour Dates:</h2>
            <hr class="header-hr">
            <div class="d-flex flex-column px-4">
                <?= $upcomingTourDatesHTML ?>
                <a class="mt-2 align-self-center" href="tour-dates.php"><button type="button" class="btn btn-outline-primary">See All Tour Dates</button></a>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <?php include 'inc/footer.php'; ?>

    <!-- JavaScript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>