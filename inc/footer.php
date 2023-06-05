<?php
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
        <li class="nav-item">
            <a class="nav-link" href="index.php">Admin Login</a>
        </li>
    </ul>

    <!-- Copyright -->
    <div class="footer-copyright w-100 text-center py-2">
        &copy; <?= $currentYear ?> Nathaniel Gomez-Han
    </div>
</footer>
