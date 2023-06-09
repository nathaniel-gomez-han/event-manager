<?php
require_once("inc/base.php"); // Defines $isUserValid and $root

$currentYear = date('Y');
?>
<footer class="footer d-flex flex-column mt-auto">
    <!-- Page Links -->
    <ul class="footer-links nav align-self-center d-flex flex-column flex-sm-row py-3 text-center">
        <li class="nav-item">
            <a class="nav-link <?php if($_SERVER['SCRIPT_NAME'] == "$root/index.php") { ?> active" aria-current="page <?php } ?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($_SERVER['SCRIPT_NAME'] == "$root/about.php") { ?> active" aria-current="page <?php } ?>" href="about.php">About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($_SERVER['SCRIPT_NAME'] == "$root/tour-dates.php") { ?> active" aria-current="page <?php } ?>" href="tour-dates.php">Tour Dates</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($_SERVER['SCRIPT_NAME'] == "$root/contact.php") { ?> active" aria-current="page <?php } ?>" href="contact.php">Contact</a>
        </li>
    <?php if($isUserValid) { ?>
        <li class="nav-item">
            <a class="nav-link <?php if($_SERVER['SCRIPT_NAME'] == "$root/admin.php") { ?> active" aria-current="page <?php } ?>" href="admin.php">Admin</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($_SERVER['SCRIPT_NAME'] == "$root/logout.php") { ?> active" aria-current="page <?php } ?>" href="logout.php">Log Out</a>
        </li>
    <?php } else { ?>
        <li class="nav-item">
            <a class="nav-link <?php if($_SERVER['SCRIPT_NAME'] == "$root/admin.php") { ?> active" aria-current="page <?php } ?>" href="admin.php">Admin Login</a>
        </li>
    <?php } ?>
    </ul>

    <!-- Copyright -->
    <div class="footer-copyright w-100 text-center py-2">
        &copy; <?= $currentYear ?> Nathaniel Gomez-Han
    </div>
</footer>
