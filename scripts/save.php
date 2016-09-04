<?php

	 require_once '../../db_config.php';
	 require_once 'db.php';

    $conn = connectToDb();

	$user_id = $_REQUEST['user_id'];
	$event_id = $_REQUEST['event_id'];
	$dates = $_REQUEST['dates'];

foreach ($dates as $date => $status) {
	echo $date . " " . $status;
}

    mysqli_close($conn);
    echo $user_id . " " . $event_id . " size: " . count($dates);
    

function saveDate($event, $user, $date, $status) {

}

?>