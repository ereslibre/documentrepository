var aliasi = 0;

function addAlias()
{
	if ($('#Character_alias' + aliasi).val() == '') {
		alert('Please, write an alias, and afterwards click on "Add"');
		return;
	}
	var remove = '&nbsp;<a href="javascript:void(0);" onclick="removeAlias(' + aliasi + ');">Remove</a>';
	$('#addedAlias').append('<div id="aliaswrapper' + aliasi + '"><input type="text" value="' + $('#Character_alias' + aliasi).val() + '"/>' + remove + '<br/></div>');
	$('#Character_alias' + aliasi).val('');
	$('#Character_alias' + aliasi).attr('name', 'Character[alias' + (aliasi + 1) + ']');
	$('#Character_alias' + aliasi).attr('id', 'Character_alias' + (aliasi + 1));
	++aliasi;
}

function removeAlias(i)
{
	$('#aliaswrapper' + i).remove();
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
});
