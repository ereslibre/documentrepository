$(document).ready(function() {
	globalInit('Event', 'image');
	$("#Event_start_date").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd/mm/yy"
	});

	$("#Event_end_date").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd/mm/yy"
	});
});