<?php
require_once("base.php"); // Defines $isUserValid and $root
?>
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand mb-0" href="index.php">
                <img src="<?= $root ?>/img/rocktane-logo.svg" alt="Rocktane Logo" class="d-inline-block align-text-bottom">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
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
                <?php } ?>
                </ul>
            </div>
        </div>
    </nav>