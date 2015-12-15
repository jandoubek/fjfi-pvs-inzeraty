$(document).ready(function() {
		$('#inzerat_modal').on('hidden.bs.modal', function(){
    	$(this).data('bs.modal', null);
		});
		$('.carousel').carousel({
      		interval: 3000
    })
});