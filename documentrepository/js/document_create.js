$(document).ready(function() {
	globalInit('document');
	$('#characters option').each(function() {
		available_characters.push($(this).val());
	});
	$('#institutions option').each(function() {
		available_institutions.push($(this).val());
	});
	addCharacter();
	addInstitution();
});
