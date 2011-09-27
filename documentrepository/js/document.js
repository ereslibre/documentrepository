var characteri = 0;
var characterlasti = 0;
var collectivei = 0;
var collectivelasti = 0;
var available_characters = new Array();
var available_collectives = new Array();

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

function cloneCollectives()
{
	var collectives = $('#collectives').clone();
	collectives.each(function(i, select) {
			$('option', this).each(function() {
				if ($.inArray(this.value, available_collectives) == -1) {
					$(this).remove();
				}
			})
		}
	);
	return collectives;
}

function addCollectiveSelection()
{
	if (!(available_collectives.length - 1)) {
		return;
	}

	var collective = cloneCollectives();
	collective.attr('id', 'Document_collective' + collectivei);
	collective.attr('name', 'Document[collective' + collectivei + ']');

	var collective_wrapper = $('<div id="collectivewrapper' + collectivei + '" class="characterbox"></div>');
	collective_wrapper.append(collective);
	collective_wrapper.append('<div class="minwidth" style="display: inline;" id="collectivelabel' + collectivei + '"></div>');
	collective_wrapper.append('<a class="action" style="display: none;" id="removecollective' + collectivei + '" onclick="removeCollective(' + collectivei + ');" href="javascript:void(0);">Remove</a>');
	collective_wrapper.append('<a class="action" id="addcollective' + collectivei + '" onclick="addCollective();" href="javascript:void(0);">Add</a>');

	$('#selectedcollectives').append(collective_wrapper);

	$('#Document_collective' + collectivei).show();
	$('#addcollective' + collectivei).show();

	collectivelasti = collectivei;
	++collectivei;
}

function updateCollectiveSelection()
{
	$('#collectivewrapper' + collectivelasti).remove();
	addCollectiveSelection();
}

function addCollective_(selected)
{
	if (collectivei > 0) {
		if (selected == '') {
			alert('Please, select the collective you want to add');
			return;
		}
		$('#Document_collective' + collectivelasti).val(selected);
		var removeMe;
		$.each(available_collectives, function(i, v) {
			if (v == selected) {
				removeMe = i;
			}
		});
		available_collectives.splice(removeMe, 1);
		$('#Document_collective' + collectivelasti).hide();
		$('#addcollective' + collectivelasti).hide();
		$('#removecollective' + collectivelasti).show();
		$('#collectivelabel' + collectivelasti).html($('#Document_collective' + collectivelasti + ' option:selected').text());
		$('#collectivelabel' + collectivelasti).attr('collective', $('#Document_collective' + collectivelasti + ' option:selected').val());
		$('#collectivelabel' + collectivelasti).show();
	}

	addCollectiveSelection();
}

function addCollective()
{
	addCollective_($('#Document_collective' + collectivelasti).val());
}

function removeCollective(i)
{
	available_collectives.push($('#collectivelabel' + i).attr('collective'));
	$('#collectivewrapper' + i).remove();
	if (available_collectives.length == 2) {
		addCollectiveSelection();
	} else {
		updateCollectiveSelection();
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