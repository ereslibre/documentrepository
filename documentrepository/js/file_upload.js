function fileAPIAvailable()
{
	return window.File && window.FileReader && window.FileList;
}

function previewImage(evt)
{
	if (!fileAPIAvailable()) {
		$('#preview').html('Your browser does not support image previews');
		return;
	}

	var files = evt.target.files;
	for (var i = 0, f; f = files[i]; ++i) {
		if (!f.type.match('image.*')) {
			$('#preview').html('Selected file is not an image');
			return;
		}
		var reader = new FileReader();
		reader.onload = (function(file) {
			return function(e) {
				var preview = $('<img class="thumb" src="' + e.target.result + '" title="' + file.name + '"/>');
				$('#preview').html(preview);
			};
		})(f);
		reader.readAsDataURL(f);
	}
}

function globalInit(id_prefix, id)
{
	$('#' + id_prefix + '_' + id).change(function(evt) {
		$('#preview').html('<img src="images/loading.gif"/>');
		previewImage(evt);
	});
}

function datePicker(id)
{
	$('#' + id).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy'
	});
}
