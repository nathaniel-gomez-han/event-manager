<?php
require_once("inc/base.php"); // Defines $isUserValid

$currentYear = date('Y');
?>
<footer class="footer d-flex flex-column mt-auto">
    <!-- Page Links -->
    <ul class="footer-links nav align-self-center d-flex flex-column flex-sm-row py-3 text-center">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tour-dates.php">Tour Dates</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
        </li>
    <?php if($isUserValid) { ?>
        <li class="nav-item">
            <a class="nav-link" href="admin.php">Admin</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Log Out</a>
        </li>
    <?php } else { ?>
        <li class="nav-item">
            <a class="nav-link" href="admin.php">Admin Login</a>
        </li>
    <?php } ?>
    </ul>

    <!-- Copyright -->
    <div class="footer-copyright w-100 text-center py-2">
        &copy; <?= $currentYear ?> Nathaniel Gomez-Han
    </div>
</footer>
