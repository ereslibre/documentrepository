function translate(language)
{
	$.ajax({
		type: 'POST',
		contentType: "application/json; charset=utf-8",
		url: '/index.php/api/language',
		data: JSON.stringify(language),
		dataType: 'json',
		success: function(data) {
			$('#page').fadeOut('slow', function() {
				$.cookie('loadEffect', 'true');
				location.reload();
			});
		}
	});
}

$(document).ready(function() {
	if ($.cookie('loadEffect') == 'true') {
		$('#page').hide();
		$('#page').fadeIn('slow');
		$.cookie('loadEffect', null);
	}
});
