//základy o JQuery třeba zde: http://citron.blueboard.cz/clanek/jquery-pro-zacatecniky-zaklady
//dokumentace zde: http://api.jquery.com/
//výběr prvků: http://api.jquery.com/category/selectors/

//-----defaultní nastavení
var jednou=1;

//schování buňek s tlačítky včetně tlačítek z tabulky
$("#kontaktyEmail td:eq(3)").hide(0); 
$("#kontaktyTelefon td:eq(3)").hide(0); 
$("#kontaktyAdresa td:eq(3)").hide(0); 

//defaultně bez tlačítek
$("#zmenitikonu").hide(0);
$("#zmenitheslo").hide(0);
//-----

$(document).on('click', '#editovat_profil', function(event) {
	// vsem inputum co maji tridu profile_input odebereme readonly => editace
	$('.profile_input').each(function(index, el) {
		$(el).removeAttr('readonly');
	});

if (jednou==1)
{
jednou=0;
//zobrazení tlačítek v tabulce pro smazání určitého kontaktu
$("#kontaktyEmail td:eq(3)").show(0); 
$("#kontaktyTelefon td:eq(3)").show(0); 
$("#kontaktyAdresa td:eq(3)").show(0); 

//zobrazení ostatních tlačítek
$("#zmenitikonu").show(0);
$("#zmenitheslo").show(0);
}
});

$(document).on('click', '#ulozit_profil', function(event) {
	// vsem inputum co maji tridu profile_input vratime readonly => ulozeni
	$('.profile_input').each(function(index, el) {
		$(el).attr('readonly', 'readonly');
	});
jednou=1;

//schování buňek s tlačítky včetně tlačítek z tabulky
$("#kontaktyEmail td:eq(3)").hide(0); 
$("#kontaktyTelefon td:eq(3)").hide(0); 
$("#kontaktyAdresa td:eq(3)").hide(0); 

//schování ostatních tlačítek
$("#zmenitikonu").hide(0);
$("#zmenitheslo").hide(0);
});


$("#zmenitikonu").on("click",function() {
window.alert("nic to nedělá, ale pak půjde vybrat ikonu z lokálního disku");
});

$("#zmenitheslo").on("click",function() {
window.alert("nic to nedělá, ale pak bude možné po zadání starého hesla změnit heslo");
});

$("#smazatAdresa").on("click",function() {
window.alert("nic to nedělá, ale pak to smaže text v inputech");
});

$("#smazatTelefon").on("click",function() {
window.alert("nic to nedělá, ale pak to smaže text v inputech");
});

$("#smazatEmail").on("click",function() {
window.alert("nic to nedělá, ale pak to smaže text v inputech");
});
