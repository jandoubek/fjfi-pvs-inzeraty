$(function(){

	// inicializace nette ajaxu
  	$.nette.init();

  	// rozsireni pro opetovnou validaci
  	$.nette.ext('formsValidationBind', {
        success:function (payload) {
            if (!payload.snippets) {
                return;
            }

            for (var i in payload.snippets) {
                $('#' + i + ' form').each(function () {
                    Nette.initForm(this);
                });
            }
        }
    });

});
