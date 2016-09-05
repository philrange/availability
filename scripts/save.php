<?php
	 require_once '../../db_config.php';
	 require_once 'db.php';

	$user_id = $_REQUEST['user_id'];
	$event_id = $_REQUEST['event_id'];
	$dates = $_REQUEST['dates'];

	$error = "";
	foreach ($dates as $date_id => $status) {
		// echo $date . " " . $status;
		$error .= saveDate($event_id, $user_id, $date_id, $status);
	}

    echo $error;
    
?>