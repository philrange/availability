	function toggle (object, username) {

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

	var date = $(object).attr('id').substring(5, 15);
	 // alert(date.substring(1, 10));
	//remove person
	$('#username_' + date + '_' + username).remove();

	//add person back in new row
	$person = `<div id='username_` + date + `_` + username + `' class='person rounded-corners ` + status + `'> 
					<div class='avatar'><img src='` + picture + `'></div>
					<div class='name'>` + displayName + `</div>
				</div>`;
	$("#personList_" + date + "_" + status).append($person);
}