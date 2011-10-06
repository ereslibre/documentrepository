var aliasi = 0;
var positioni = 0;

function addAlias()
{
	if ($('#Character_alias' + aliasi).val() == '') {
		alert('Please, write an alias, and afterwards click on "Add"');
		return;
	}
	$('#Character_alias' + aliasi).attr('name', 'Character[alias' + (aliasi + 1) + ']');
	$('#Character_alias' + aliasi).attr('id', 'Character_alias' + (aliasi + 1));
	var remove = '&nbsp;<a href="javascript:void(0);" onclick="removeAlias(' + aliasi + ');">Remove</a>';
	$('#addedAlias').append('<div id="aliaswrapper' + aliasi + '"><input type="text" id="Character_alias' + aliasi + '" name="Character[alias' + aliasi + ']" value="' + $('#Character_alias' + (aliasi + 1)).val() + '"/>' + remove + '<br/></div>');
	++aliasi;
	$('#Character_alias' + aliasi).val('');
}

function removeAlias(i)
{
	$('#aliaswrapper' + i).remove();
}

function addPosition()
{
	if ($('#Character_position' + positioni).val() == '') {
		alert('Please, select start date, end date and position, and afterwards click on "Add"');
		return;
	}
	var remove = '&nbsp;<a href="javascript:void(0);" onclick="removePosition(' + positioni + ');">Remove</a>';
	var wrapper = $('<div id="positionwrapper' + positioni + '"></div>');
	wrapper.append('<input type="text" value="' + $('#Character_position' + positioni).val() + '"/>' + remove + '<br/>');
	$('#addedPosition').append(wrapper);
	$('#Character_position' + positioni).val('');
	$('#Character_position' + positioni).attr('name', 'Character[position' + (positioni + 1) + ']');
	$('#Character_position' + positioni).attr('id', 'Character_position' + (positioni + 1));
	++positioni;
}

function removePosition(i)
{
	$('#positionwrapper' + i).remove();
}

$(document).ready(function() {
	globalInit('Character', 'image');
	$('#Character_birth_date').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy'
	});

	$('#Character_death_date').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy'
	});

	$('#Character_from_position0').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy'
	});

	$('#Character_to_position0').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy'
	});
});
