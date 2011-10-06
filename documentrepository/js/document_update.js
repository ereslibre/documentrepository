var current_characters = new Array();

$(document).ready(function() {
	globalInit('Document', 'document');
	$('#characters option').each(function() {
		available_characters.push($(this).val());
	});
	$('#institutions option').each(function() {
		available_institutions.push($(this).val());
	});
	$('#events option').each(function() {
		available_events.push($(this).val());
	});
	addCharacter();
	addInstitution();
	addEvent();
	$.each(current_characters, function(index, value) {
		addCharacter_(value);
	});
	$.each(current_institutions, function(index, value) {
		addInstitution_(value);
	});
	$.each(current_events, function(index, value) {
		addEvent_(value);
	});
});
