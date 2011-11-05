function translate(language)
{
	$.ajax({
		type: 'POST',
		contentType: "application/json; charset=utf-8",
		url: '/index.php/api/language',
		data: JSON.stringify(language),
		dataType: 'json',
		success: function(data) {
			$('#page,#flags').fadeOut('slow', function() {
				$.cookie('loadEffect', 'true');
				location.reload();
			});
		}
	});
}

$(document).ready(function() {
	if ($.cookie('loadEffect') == 'true') {
		$('#page,#flags').hide();
		$('#page,#flags').fadeIn('slow');
		$.cookie('loadEffect', null);
	}
	$('#' + $('#language').html() + '_flag').addClass('current');
});
