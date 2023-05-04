<?php
function writeToLog($message) {
	error_log(print_r($message, true) . "\n\r", 3, 'error.log');
}

function handleException (\Exception $e) {
    writeToLog($e->getMessage());
    header('Location: \event-manager\500-error.php');
}

function handleConnectionException(\Exception $e, $connection) {
	writeToLog($e->getMessage());
	writeToLog($connection);
	header('Location: \event-manager\500-error.php');
}

function handleStatementException(\Exception $e, $stmt) {
	writeToLog($e->getMessage());
	writeToLog($stmt->errno);
	writeToLog($stmt->error);
	header('Location: \event-manager\500-error.php');
}
?>