$(document).on('click', 'a[data-target=#inzerat_modal]', function(ev) {
	ev.preventDefault();
  var target = $(this).attr("href");

  // load the url and show modal on success
  $("#myModal .modal-content").load(target, function() {
       $("#myModal").modal("show");
       $("#myModal").children('.modal-dialog').css('width', '800px');
  });
});

$(document).on('hidden.bs.modal', '#profile_modal, #inzerat_profile_modal', function(){
	$(this).data('bs.modal', null);
})

$(document).ready(function() {
		$('.carousel').carousel({
      		interval: 3000
    })
});