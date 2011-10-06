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
});
