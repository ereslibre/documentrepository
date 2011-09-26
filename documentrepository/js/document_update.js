var current_characters = new Array();

$(document).ready(function() {
	globalInit('document');
	$('#characters option').each(function() {
		available_characters.push($(this).val());
	});
	addCharacter();
	$.each(current_characters, function(index, value) {
		addCharacter_(value);
	});
});
