<?php
require_once("inc/base.php");

session_start();

// Authentication
$isUserValid = false;
if (isset($_SESSION['isUserValid'])) {
    $isUserValid = $_SESSION['isUserValid'];
}

// HTML to insert if invalid login credentials were submitted.
$invalidLoginErrorHTML = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database Connection
    require_once(__DIR__ . '/inc/exceptionHandlers.php');
    require_once(__DIR__ . '/inc/dbConnect.php');

    $inUsername = $_POST['inUsername'];
    $inPassword = $_POST['inPassword'];

    $connection = null;
    $statement = null;
    $sql = "
        SELECT `username`, `password`
        FROM admin_login
        WHERE `username`=:username AND `password`=:password
    ";

    // Execute the query statement
    try {
        $connection = dbConnect();
        $statement = $connection->prepare($sql);
    } catch (PDOException $e) {
        handleConnectionException($e, $connection);
    }
    try {
        $statement->bindParam(":username", $inUsername);
        $statement->bindParam(":password", $inPassword);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        handleStatementException($e, $statement);
    }

    if ($row = $statement->fetch()) {
        $isUserValid = true;
        $_SESSION['isUserValid'] = true;
        $_SESSION['username'] = $inUsername;
    } else {
        $invalidLoginErrorHTML = <<<END
            <span class="error">Invalid username or password.</span>
        END;
    }

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
        <?php if($isUserValid) { ?>
            <title>Rocktane - Admin Control Panel</title>
        <?php } else { ?>
            <title>Rocktane - Admin Login</title>
        <?php } ?>
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

        <?php
        if ($isUserValid) {
            ?>
            <h1>Admin Control Panel</h1>
            <div class="d-flex flex-column col-12 col-sm-6 mx-auto row-gap-4">
                <p>Welcome, <?= $_SESSION['username'] ?>.</p>
                <p>Admin options are available to you:</p>
                <div class="admin-commands-list d-flex flex-column row-gap-2">
                    <a href="add-event.php"><button class="btn btn-outline-primary">Add New Event</button></a>
                    <a href="manage-events.php"><button class="btn btn-outline-primary">Manage All Events</button></a>
                    <a href="logout.php"><button class="btn btn-outline-primary mt-4">Log Out</button></a>
                </ul>
            </div>
            <?php
        } else {
            ?>
            <h1>Admin Login</h1>
            <form id="login-form" method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                <div class="d-flex flex-column col-12 col-sm-6 mx-auto row-gap-4">
                    <div>
                        <label for="inUsername">Username: </label><br/>
                        <input type="text" name="inUsername" id="inUsername" placeholder="Username">
                    </div>
                    <div>
                        <label for="inPassword">Password:</label><br/>
                        <input type="password" name="inPassword" id="inPassword" placeholder="Password">
                    </div>
                    <?= $invalidLoginErrorHTML ?>
                    <div class="d-flex flex-row justify-content-center column-gap-4">
                        <button class="btn btn-outline-primary" type="submit" form="login-form" name="submit" value="Log In">Log In</button>
                        <button class="btn btn-outline-primary" type="reset" form="login-form" name="reset" value="Reset">Reset</button>
                    </div>
                </div>
            </form>
            <?php
        }
        ?>
        </section>
    </main>

    <!-- Footer -->
    <?php include 'inc/footer.php'; ?>

    <!-- JavaScript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>