$(document).on('hidden.bs.modal', '#inzerat_modal, #profile_modal, #inzerat_profile_modal', function(){
	 $(this).data('bs.modal', null);
})

$(document).ready(function() {
		$('.carousel').carousel({
      		interval: 3000
    })
});