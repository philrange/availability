<?php


function displayAvailablePeopleForDate($event, $date) {
	return displayPeopleForDate($event, $date, "available");
}

function displayUnavailablePeopleForDate($event, $date) {
	return displayPeopleForDate($event, $date, "unavailable");
}

function displayUndecidedPeopleForDate($event, $date) {
	return displayPeopleForDate($event, $date, "undecided");
}

function displayPeopleForDate($event, $date, $status) {

	$people = getPeopleForDate($event, $date, $status);
	foreach ($people as $person) {
		echo displayPerson($person);
	}

}

function displayPerson($person) {

	$html = "<div id='username_" . $person->username . "' 
	class='person rounded-corners " . $person->available . "'>
				<div class='avatar'><img src='" . $person->picture . "'></div>
				<div class='name'>" . $person->displayName . "</div>
			</div>";

  return $html;
}

?> 