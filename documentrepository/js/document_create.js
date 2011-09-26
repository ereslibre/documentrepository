$(document).ready(function() {
	globalInit('document');
	$('#characters option').each(function() {
		available_characters.push($(this).val());
	});
	addCharacter();
});
