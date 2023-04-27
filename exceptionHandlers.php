<?php
function writeToLog($message, $destination) {
	error_log(print_r($message, true) . "\n\r", 3, $destination);
} 

function handleConnectionException($con, $e) {
	// Write developer defined error messages on the PHP log file.
	writeToLog($e->getMessage(), 'debug.log');
	writeToLog($con, 'debug.log');
	//writeToLog($con->connect_error, 'debug.log');
	//error_log(var_dump(debug_backtrace()));
	
	// Send control to a user-friendly error display page.
	header('Location: /500-error.php');	
}


function handleStatementException($stmt, $e) {
	// Write developer defined error messages on the PHP log file.
	writeToLog($e->getMessage(), 'debug.log');
	writeToLog($stmt->errno, 'debug.log');
	writeToLog($stmt->error, 'debug.log');
	//error_log(var_dump(debug_backtrace()));		
	
	// Send control to a user-friendly error display page.
	header('Location: /500-error.php');
}
?>