var aliasi = 0;
var positioni = 0;

function globalCharacterInit()
{
	globalInit('Character', 'image');

	datePicker('Character_birth_date');
	datePicker('Character_death_date');
	datePicker('Character_from_position0');
	datePicker('Character_to_position0');
}

function addAlias()
{
	if ($('#Character_alias' + aliasi).val() == '') {
		alert($('#js_noalias').text());
		return;
	}
	addAlias_($('#Character_alias' + aliasi).val());
}

function addAlias_(alias)
{
	$('#Character_alias' + aliasi).attr('name', 'Character[alias' + (aliasi + 1) + ']');
	$('#Character_alias' + aliasi).attr('id', 'Character_alias' + (aliasi + 1));
	var remove = '<div class="action"><a href="javascript:void(0);" onclick="removeAlias(' + aliasi + ');">' + $('#js_remove').text() + '</a></div>';
	$('#addedAlias').append('<div id="aliaswrapper' + aliasi + '"><input type="text" id="Character_alias' + aliasi + '" name="Character[alias' + aliasi + ']" value="' + alias + '"/>' + remove + '<br/></div>');
	++aliasi;
	$('#Character_alias' + aliasi).val('');
}

function removeAlias(i)
{
	$('#aliaswrapper' + i).remove();
}

function addPosition()
{
	if ($('#Character_from_position' + positioni).val() == '' ||
        $('#Character_position' + positioni).val() == '') {
		$('#Character_position' + positioni + ' option[value=""]').attr('selected', 'selected');
		alert($('#js_noposition').text());
		return;
	}
	addPosition_($('#Character_from_position' + positioni).val(),
				 $('#Character_to_position' + positioni).val(),
				 $('#Character_position' + positioni).val(),
				 $('#Character_position' + positioni + ' option:selected').text());
}

function addPosition_(from_position_, to_position_, position_, position_name_)
{
	var from_position = $('From: <input type="text" id="Character_from_position' + positioni + '" name="Character[from_position' + positioni + ']" />');
	var to_position = $('To: <input type="text" id="Character_to_position' + positioni + '" name="Character[to_position' + positioni + ']" />');
	var position = $('<input type="hidden" id="Character_position' + positioni + '" name="Character[position' + positioni + ']" />');
	var position_label = ' Position: ' + position_name_;
	var remove_link = '<div class="action"><a href="javascript:void(0);" onclick="removePosition(' + positioni + ');">' + $('#js_remove').text() + '</a></div>';

	from_position.attr('value', from_position_);
	to_position.attr('value', to_position_);
	position.attr('value', position_);

	$('#Character_from_position' + positioni).val('');
	$('#Character_from_position' + positioni).attr('name', 'Character[from_position' + (positioni + 1) + ']');
	$('#Character_from_position' + positioni).attr('id', 'Character_from_position' + (positioni + 1));
	$('#Character_to_position' + positioni).val('');
	$('#Character_to_position' + positioni).attr('name', 'Character[to_position' + (positioni + 1) + ']');
	$('#Character_to_position' + positioni).attr('id', 'Character_to_position' + (positioni + 1));
	$('#Character_position' + positioni).val('');
	$('#Character_position' + positioni).attr('name', 'Character[position' + (positioni + 1) + ']');
	$('#Character_position' + positioni).attr('id', 'Character_position' + (positioni + 1));

	var wrapper = $('<div id="positionwrapper' + positioni + '"></div>');
    wrapper.append("From: ");
	wrapper.append(from_position);
    wrapper.append(" To: ");
	wrapper.append(to_position);
	wrapper.append(position);
	wrapper.append(position_label);
	wrapper.append(remove_link);
	$('#addedPosition').append(wrapper);

	datePicker('Character_from_position' + positioni);
	datePicker('Character_to_position' + positioni);

	++positioni;

	$('#Character_from_position' + positioni).datepicker('destroy');
	$('#Character_to_position' + positioni).datepicker('destroy');
	datePicker('Character_from_position' + positioni);
	datePicker('Character_to_position' + positioni);
}

function removePosition(i)
{
	$('#positionwrapper' + i).remove();
}
