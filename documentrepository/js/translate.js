function translate(language)
{
	$.ajax({
		type: 'POST',
		contentType: "application/json; charset=utf-8",
		url: '/index.php/api/language',
		data: JSON.stringify(language),
		dataType: 'json',
		success: function(data) {
			location.reload();
		}
	});
}
