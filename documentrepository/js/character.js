$(document).ready(function() {
	var currentTime = new Date();

	$("#Character_birth_date").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd/mm/yy"
	});

	$("#Character_death_date").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd/mm/yy"
	});
});