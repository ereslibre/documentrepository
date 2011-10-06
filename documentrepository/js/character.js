$(document).ready(function() {
	globalInit('Character', 'image');
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