var current_aliases = new Array();
var current_positions = new Array();

$(document).ready(function() {
	globalCharacterInit();

	$.each(current_aliases, function(index, value) {
		addAlias_(value);
	});

	$.each(current_positions, function(index, value) {
		addPosition_(value.start_date, value.end_date, value.position_id, value.position_name);
	});
});