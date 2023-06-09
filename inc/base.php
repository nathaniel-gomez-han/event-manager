<?php
$root = "/event-manager";

session_start();

// Authentication
$isUserValid = false;
if (isset($_SESSION['isUserValid'])) {
    $isUserValid = $_SESSION['isUserValid'];
}