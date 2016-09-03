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

	var date = $(object).attr('id').substring(5);
	// alert(date.substring(5));
	//remove person
	$('#username_' + date + '_test').remove();

	//add person back in new row
	$person = `<div id='username_` + date + `_test' class='person rounded-corners ` + status + `'> 
					<div class='avatar'><img src='images/default.png'></div>
					<div class='name'>Testy McTest</div>
				</div>`;
	$("#personList_" + date + "_" + status).append($person);
}