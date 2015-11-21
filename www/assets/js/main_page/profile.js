
$(document).on('click', '#editovat_profil', function(event) {
	// vsem inputum co maji tridu profile_input oebereme readonly => editace
	$('.profile_input').each(function(index, el) {
		$(el).removeAttr('readonly');
	});
});

$(document).on('click', '#ulozit_profil', function(event) {
	// vsem inputum co maji tridu profile_input vratime readonly => ulozeni
	$('.profile_input').each(function(index, el) {
		$(el).attr('readonly', 'readonly');
	});
});

function pridatkontakt(){
	window.alert("nic to nedělá, ale pak to přidá řádek");
}

function zmenitikonu(){
	window.alert("nic to nedělá, ale pak půjde vybrat ikonu z lokálního disku");
}

function zmenitheslo(){
	window.alert("nic to nedělá, ale pak bude možné po zadání starého hesla změnit heslo");
}