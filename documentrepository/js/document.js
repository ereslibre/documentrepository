var characteri = 0;
var characterlasti = 0;
var institutioni = 0;
var institutionlasti = 0;
var available_characters = new Array();
var available_institutions = new Array();

function cloneCharacters()
{
	var characters = $('#characters').clone();
	characters.each(function(i, select) {
			$('option', this).each(function() {
				if ($.inArray(this.value, available_characters) == -1) {
					$(this).remove();
				}
			})
		}
	);
	return characters;
}

function addCharacterSelection()
{
	if (!(available_characters.length - 1)) {
		return;
	}

	var character = cloneCharacters();
	character.attr('id', 'Document_character' + characteri);
	character.attr('name', 'Document[character' + characteri + ']');

	var character_wrapper = $('<div id="characterwrapper' + characteri + '" class="characterbox"></div>');
	character_wrapper.append(character);
	character_wrapper.append('<div class="minwidth" style="display: inline;" id="characterlabel' + characteri + '"></div>');
	character_wrapper.append('<a class="action" style="display: none;" id="removecharacter' + characteri + '" onclick="removeCharacter(' + characteri + ');" href="javascript:void(0);">Remove</a>');
	character_wrapper.append('<a class="action" id="addcharacter' + characteri + '" onclick="addCharacter();" href="javascript:void(0);">Add</a>');

	$('#selectedcharacters').append(character_wrapper);

	$('#Document_character' + characteri).show();
	$('#addcharacter' + characteri).show();

	characterlasti = characteri;
	++characteri;
}

function updateCharacterSelection()
{
	$('#characterwrapper' + characterlasti).remove();
	addCharacterSelection();
}

function addCharacter_(selected)
{
	if (characteri > 0) {
		if (selected == '') {
			alert('Please, select the character you want to add');
			return;
		}
		$('#Document_character' + characterlasti).val(selected);
		var removeMe;
		$.each(available_characters, function(i, v) {
			if (v == selected) {
				removeMe = i;
			}
		});
		available_characters.splice(removeMe, 1);
		$('#Document_character' + characterlasti).hide();
		$('#addcharacter' + characterlasti).hide();
		$('#removecharacter' + characterlasti).show();
		$('#characterlabel' + characterlasti).html($('#Document_character' + characterlasti + ' option:selected').text());
		$('#characterlabel' + characterlasti).attr('character', $('#Document_character' + characterlasti + ' option:selected').val());
		$('#characterlabel' + characterlasti).show();
	}

	addCharacterSelection();
}

function addCharacter()
{
	addCharacter_($('#Document_character' + characterlasti).val());
}

function removeCharacter(i)
{
	available_characters.push($('#characterlabel' + i).attr('character'));
	$('#characterwrapper' + i).remove();
	if (available_characters.length == 2) {
		addCharacterSelection();
	} else {
		updateCharacterSelection();
	}
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function cloneInstitutions()
{
	var institutions = $('#institutions').clone();
	institutions.each(function(i, select) {
			$('option', this).each(function() {
				if ($.inArray(this.value, available_institutions) == -1) {
					$(this).remove();
				}
			})
		}
	);
	return institutions;
}

function addInstitutionSelection()
{
	if (!(available_institutions.length - 1)) {
		return;
	}

	var institution = cloneInstitutions();
	institution.attr('id', 'Document_institution' + institutioni);
	institution.attr('name', 'Document[institution' + institutioni + ']');

	var institution_wrapper = $('<div id="institutionwrapper' + institutioni + '" class="characterbox"></div>');
	institution_wrapper.append(institution);
	institution_wrapper.append('<div class="minwidth" style="display: inline;" id="institutionlabel' + institutioni + '"></div>');
	institution_wrapper.append('<a class="action" style="display: none;" id="removeinstitution' + institutioni + '" onclick="removeInstitution(' + institutioni + ');" href="javascript:void(0);">Remove</a>');
	institution_wrapper.append('<a class="action" id="addinstitution' + institutioni + '" onclick="addInstitution();" href="javascript:void(0);">Add</a>');

	$('#selectedinstitutions').append(institution_wrapper);

	$('#Document_institution' + institutioni).show();
	$('#addinstitution' + institutioni).show();

	institutionlasti = institutioni;
	++institutioni;
}

function updateInstitutionSelection()
{
	$('#institutionwrapper' + institutionlasti).remove();
	addInstitutionSelection();
}

function addInstitution_(selected)
{
	if (institutioni > 0) {
		if (selected == '') {
			alert('Please, select the institution you want to add');
			return;
		}
		$('#Document_institution' + institutionlasti).val(selected);
		var removeMe;
		$.each(available_institutions, function(i, v) {
			if (v == selected) {
				removeMe = i;
			}
		});
		available_institutions.splice(removeMe, 1);
		$('#Document_institution' + institutionlasti).hide();
		$('#addinstitution' + institutionlasti).hide();
		$('#removeinstitution' + institutionlasti).show();
		$('#institutionlabel' + institutionlasti).html($('#Document_institution' + institutionlasti + ' option:selected').text());
		$('#institutionlabel' + institutionlasti).attr('institution', $('#Document_institution' + institutionlasti + ' option:selected').val());
		$('#institutionlabel' + institutionlasti).show();
	}

	addInstitutionSelection();
}

function addInstitution()
{
	addInstitution_($('#Document_institution' + institutionlasti).val());
}

function removeInstitution(i)
{
	available_institutions.push($('#institutionlabel' + i).attr('institution'));
	$('#institutionwrapper' + i).remove();
	if (available_institutions.length == 2) {
		addInstitutionSelection();
	} else {
		updateInstitutionSelection();
	}
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function fileAPIAvailable()
{
	return window.File && window.FileReader && window.FileList;
}

function previewImage(evt)
{
	if (!fileAPIAvailable()) {
		$('#preview').html('Your browser does not support image previews');
		return;
	}

	var files = evt.target.files;
	for (var i = 0, f; f = files[i]; ++i) {
		if (!f.type.match('image.*')) {
			$('#preview').html('Selected file is not an image');
			return;
		}
		var reader = new FileReader();
		reader.onload = (function(file) {
			return function(e) {
				var preview = $('<img class="thumb" src="' + e.target.result + '" title="' + file.name + '"/>');
				$('#preview').html(preview);
			};
		})(f);
		reader.readAsDataURL(f);
	}
}

function globalInit(id)
{
	$('#Document_' + id).change(function(evt) {
		$('#preview').html('<img src="images/loading.gif"/>');
		previewImage(evt);
	});
}
