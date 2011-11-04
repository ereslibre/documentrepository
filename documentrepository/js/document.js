var characteri = 0;
var characterlasti = 0;
var institutioni = 0;
var institutionlasti = 0;
var eventi = 0;
var eventlasti = 0;
var initial_characters = new Array();
var available_characters = new Array();
var initial_institutions = new Array();
var available_institutions = new Array();
var initial_events = new Array();
var available_events = new Array();

function documentInit()
{
	initial_characters = available_characters.slice();
	initial_institutions = available_institutions.slice();
	initial_events = available_events.slice();
}

function cloneCharacters()
{
	var characters = $('#characters').clone();
	characters.each(function(i, select) {
		$('option', this).each(function() {
			if ($.inArray(this.value, available_characters) == -1) {
				$(this).remove();
			}
		})
	});
	return characters;
}

function reloadCharacters()
{
	$.ajax({
		url: '/index.php/api/characters',
		success: function(data) {
			var server_characters = JSON.parse(data);
			var initial_characters_ = new Array();
			$.each(server_characters, function(i, server_character) {
				if ($.inArray(server_character.id, initial_characters) == -1) {
					$('#characters').append('<option value="' + server_character.id + '">' + server_character.name + '</option>');
					available_characters.push(server_character.id);
				}
				initial_characters_.push(server_character.id);
			});
			initial_characters = initial_characters_;
			$('#characterwrapper' + (characteri - 1)).remove();
			addCharacterSelection();
		}
	});
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
	character_wrapper.append('<div class="action" style="display: none;" id="removecharacter' + characteri + '"><a onclick="removeCharacter(' + characteri + ');" href="javascript:void(0);">Remove</a></div>');

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

function reloadInstitutions()
{
	$.ajax({
		url: '/index.php/api/institutions',
		success: function(data) {
			var server_institutions = JSON.parse(data);
			var initial_institutions_ = new Array();
			$.each(server_institutions, function(i, server_institution) {
				if ($.inArray(server_institution.id, initial_institutions) == -1) {
					$('#institutions').append('<option value="' + server_institution.id + '">' + server_institution.name + '</option>');
					available_institutions.push(server_institution.id);
				}
				initial_institutions_.push(server_institution.id);
			});
			initial_institutions = initial_institutions_;
			$('#institutionwrapper' + (institutioni - 1)).remove();
			addInstitutionSelection();
		}
	});
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
	institution_wrapper.append('<div class="action" style="display: none;" id="removeinstitution' + institutioni + '"><a onclick="removeInstitution(' + institutioni + ');" href="javascript:void(0);">Remove</a></div>');

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

function cloneEvents()
{
    var events = $('#events').clone();
    events.each(function(i, select) {
            $('option', this).each(function() {
                if ($.inArray(this.value, available_events) == -1) {
                    $(this).remove();
                }
            })
        }
    );
    return events;
}

function reloadEvents()
{
	$.ajax({
		url: '/index.php/api/events',
		success: function(data) {
			var server_events = JSON.parse(data);
			var initial_events_ = new Array();
			$.each(server_events, function(i, server_event) {
				if ($.inArray(server_event.id, initial_events) == -1) {
					$('#events').append('<option value="' + server_event.id + '">' + server_event.name + '</option>');
					available_events.push(server_event.id);
				}
				initial_events_.push(server_event.id);
			});
			initial_events = initial_events_;
			$('#eventwrapper' + (eventi - 1)).remove();
			addEventSelection();
		}
	});
}

function addEventSelection()
{
    if (!(available_events.length - 1)) {
        return;
    }

    var event = cloneEvents();
    event.attr('id', 'Document_event' + eventi);
    event.attr('name', 'Document[event' + eventi + ']');

    var event_wrapper = $('<div id="eventwrapper' + eventi + '" class="characterbox"></div>');
    event_wrapper.append(event);
    event_wrapper.append('<div class="minwidth" style="display: inline;" id="eventlabel' + eventi + '"></div>');
    event_wrapper.append('<div class="action" style="display: none;" id="removeevent' + eventi + '"><a onclick="removeEvent(' + eventi + ');" href="javascript:void(0);">Remove</a>');

    $('#selectedevents').append(event_wrapper);

    $('#Document_event' + eventi).show();
    $('#addevent' + eventi).show();

    eventlasti = eventi;
    ++eventi;
}

function updateEventSelection()
{
    $('#eventwrapper' + eventlasti).remove();
    addEventSelection();
}

function addEvent_(selected)
{
    if (eventi > 0) {
        if (selected == '') {
            alert('Please, select the event you want to add');
            return;
        }
        $('#Document_event' + eventlasti).val(selected);
        var removeMe;
        $.each(available_events, function(i, v) {
            if (v == selected) {
                removeMe = i;
            }
        });
        available_events.splice(removeMe, 1);
        $('#Document_event' + eventlasti).hide();
        $('#addevent' + eventlasti).hide();
        $('#removeevent' + eventlasti).show();
        $('#eventlabel' + eventlasti).html($('#Document_event' + eventlasti + ' option:selected').text());
        $('#eventlabel' + eventlasti).attr('event', $('#Document_event' + eventlasti + ' option:selected').val());
        $('#eventlabel' + eventlasti).show();
    }

    addEventSelection();
}

function addEvent()
{
    addEvent_($('#Document_event' + eventlasti).val());
}

function removeEvent(i)
{
    available_events.push($('#eventlabel' + i).attr('event'));
    $('#eventwrapper' + i).remove();
    if (available_events.length == 2) {
        addEventSelection();
    } else {
        updateEventSelection();
    }
}
