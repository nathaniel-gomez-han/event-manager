<?php
require_once('exceptionHandlers.php'); 

// This file contains the PHP coding to connect to the database.    
// Include this file in any page that needs to access the database.  
// Use the PHP include command before doing any database accesses.

$hostname = "127.0.0.1"; // The name of the server where the database is located. Usually localhost.
$username = "root";      // The username on the database. Usually listed on the cPanel listing of databases.
$password = "";          // The password of the account or database. Set a seperate password for the database. On the cPanel listing of databases.
$database = "wdv341";    // The name of the database. Usually the same as the username. Located on the cPanel listing of databases.

// Builds the connection object called $connection and selects the desired database.
// You will need to use the $connect variable in the mysqli_query() commands whenever you run a query against the database.
try {
  $connection = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
  // Set the PDO error mode to exception.
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  handleConnectionException($connection, $e);
	die();
}
?>