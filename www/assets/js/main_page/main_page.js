$(document).ready(function() {
		$('.mini_body').dotdotdot();
		$('#inzerat_modal').on('hidden.bs.modal', function(){
    	$(this).data('bs.modal', null);
		});
		$('.carousel').carousel({
      		interval: 3000
    })
});