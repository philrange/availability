<?php


function getRowForDate($event, $person, $date, $date_string) {

$status = getStatus($event, $person, $date);

$dayOfWeek = date('l jS F', strtotime($date_string));

$html = '<div class="dateRow">
			<div class="padding"></div>
			<div id="date_' . $date . '_' . $status .'" class="date rounded-corners ' . $status . '">' . $dayOfWeek . '</div>

			<div class=\'people\'>
				<div id="personList_' . $date . '_available" class=\'personList\'>
					' .	displayAvailablePeopleForDate(1, $date) .'
				</div>
				<div id="personList_' . $date . '_unavailable" class=\'personList\'>
					' .	displayUnavailablePeopleForDate(1, $date) .'
				</div>
				<div id="personList_' . $date . '_undecided" class=\'personList\'>
					' . displayUndecidedPeopleForDate(1, $date) . '
				</div>
			</div>
		</div>';

		return $html;
}

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

	$html = "";
	foreach ($people as $person) {
		$html .= displayPerson($person, $date);
	}

	return $html;
}

function displayPerson($person, $date) {

	$html = "<div id='username_" . $date . "_" . $person->username . "' 
	class='person rounded-corners " . $person->available . "'>
				<div class='avatar'><img src='" . $person->picture . "'></div>
				<div class='name'>" . $person->displayName . "</div>
			</div>";

  return $html;
}

function getEvents() {
	return "Karting";
}

?> 