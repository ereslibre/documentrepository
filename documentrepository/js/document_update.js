var current_characters = new Array();

$(document).ready(function() {
	globalInit('document');
	$('#characters option').each(function() {
		available_characters.push($(this).val());
	});
	$('#collectives option').each(function() {
		available_collectives.push($(this).val());
	});
	addCharacter();
	addCollective();
	$.each(current_characters, function(index, value) {
		addCharacter_(value);
	});
	$.each(current_collectives, function(index, value) {
		addCollective_(value);
	});
});
