$(document).on('click', '#profile_close', function(){
	$('#profile_modal,#inzerat_profile_modal').each(function(){
		$(this).modal('hide');
	});
})