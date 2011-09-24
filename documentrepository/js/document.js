var i = 0;

function addCharacter()
{
	if (i > 0) {
		$('#addcharacter' + (i - 1)).hide();
	}
	var character = $('#characters').clone();
	character.attr('id', 'character' + i);
	character.attr('name', 'character' + i);

	var character_wrapper = $('<div></div>');
	character_wrapper.append(character);
	character_wrapper.append('Remove');
	character_wrapper.append('<a id="addcharacter' + i + '" onclick="addCharacter();" href="javascript:void(0);">Add</a>');

	$('#selectedcharacters').append(character_wrapper);
	++i;
}

$(document).ready(function() {
	addCharacter();
});
