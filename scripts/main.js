	function toggle (object) {

		var status;
	//change colour of date
	if ($(object).hasClass("available")) {
		$(object).removeClass("available");
		$(object).addClass("unavailable");
		status = "unavailable";
	} else if ($(object).hasClass("unavailable")) {
		$(object).removeClass("unavailable");
		$(object).addClass("undecided");
		status = "undecided";
	} else if ($(object).hasClass("undecided")) {
		$(object).removeClass("undecided");
		$(object).addClass("available");
		status = "available";
	}

	//remove person
	$('#username_test').remove();

	//add person back in new row
	$person = `<div id='username_test' class='person rounded-corners ` + status + `'> 
					<div class='avatar'><img src='images/default.png'></div>
					<div class='name'>Testy McTest</div>
				</div>`;
	$("#personList_20160623_" + status).append($person);
}