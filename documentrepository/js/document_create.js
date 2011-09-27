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
});
