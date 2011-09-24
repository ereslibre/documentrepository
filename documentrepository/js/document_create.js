$(document).ready(function() {
	$('#characters option').each(function() {
		available_characters.push($(this).val());
	});
	addCharacter();
});
