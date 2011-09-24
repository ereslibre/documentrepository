var i = 0;
var lasti = 0;
var available_characters = new Array();

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
	character.attr('id', 'Document_character' + i);
	character.attr('name', 'Document[character' + i + ']');

	var character_wrapper = $('<div id="characterwrapper' + i + '" class="spacing characterbox"></div>');
	character_wrapper.append(character);
	character_wrapper.append('<div class="minwidth" style="display: inline;" id="characterlabel' + i + '"></div>');
	character_wrapper.append('<a class="action" style="display: none;" id="removecharacter' + i + '" onclick="removeCharacter(' + i + ');" href="javascript:void(0);">Remove</a>');
	character_wrapper.append('<a class="action" id="addcharacter' + i + '" onclick="addCharacter();" href="javascript:void(0);">Add</a>');

	$('#selectedcharacters').append(character_wrapper);

	$('#Document_character' + i).show();
	$('#addcharacter' + i).show();

	lasti = i;
	++i;
}

function updateCharacterSelection()
{
	$('#characterwrapper' + lasti).remove();
	addCharacterSelection();
}

function addCharacter_(selected)
{
	if (i > 0) {
		if (selected == '') {
			alert('Please, select the character you want to add');
			return;
		}
		var removeMe;
		$.each(available_characters, function(i, v) {
			if (v == selected) {
				removeMe = i;
			}
		});
		available_characters.splice(removeMe, 1);
		$('#Document_character' + lasti).hide();
		$('#addcharacter' + lasti).hide();
		$('#removecharacter' + lasti).show();
		$('#characterlabel' + lasti).html($('#Document_character' + lasti + ' option:selected').text());
		$('#characterlabel' + lasti).attr('character', $('#Document_character' + lasti + ' option:selected').val());
		$('#characterlabel' + lasti).show();
	}

	addCharacterSelection();
}

function addCharacter()
{
	addCharacter_($('#Document_character' + lasti).val());
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