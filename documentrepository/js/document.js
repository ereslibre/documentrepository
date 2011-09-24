var i = 0;
var available_characters = new Array();

function cloneCharacters(i)
{
	var characters = $('#characters').clone();
	return characters;
}

function addCharacter()
{
	if (i > 0) {
		var selected = $('#character' + (i - 1)).val();
		var removeMe;
		$.each(available_characters, function(i, v) {
			if (v == selected) {
				removeMe = i;
			}
		});
		available_characters.splice(removeMe, 1);
		$('#character' + (i - 1)).hide();
		$('#addcharacter' + (i - 1)).hide();
		$('#removecharacter' + (i - 1)).show();
		$('#characterlabel' + (i - 1)).html($('#character' + (i - 1) + ' option:selected').text());
		$('#characterlabel' + (i - 1)).show();
	}

	if (!available_characters.length) {
		return;
	}

	var character = cloneCharacters(i);
	character.attr('id', 'Document_character' + i);
	character.attr('name', 'Document[character' + i + ']');

	var character_wrapper = $('<div></div>');
	character_wrapper.append(character);
	character_wrapper.append('<div id="characterlabel' + i + '"></div>');
	character_wrapper.append('<a style="display: none;" id="removecharacter' + i + '" onclick="removeCharacter();" href="javascript:void(0);">Remove</a>');
	character_wrapper.append('<a id="addcharacter' + i + '" onclick="addCharacter();" href="javascript:void(0);">Add</a>');

	$('#selectedcharacters').append(character_wrapper);
	++i;
}

$(document).ready(function() {
	$('#characters option').each(function() {
		available_characters.push($(this).val());
	});
	addCharacter();
});
