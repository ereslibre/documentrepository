var current_aliases = new Array();

$(document).ready(function() {
	globalCharacterInit();

	$.each(current_aliases, function(index, value) {
		addAlias_(value);
	});
});