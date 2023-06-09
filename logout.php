<?php
    session_start();

    // Close the session
    session_unset();
    session_destroy();

    // Redirect to the admin login page
    header("Location: admin.php");
?>