//základy o JQuery třeba zde: http://citron.blueboard.cz/clanek/jquery-pro-zacatecniky-zaklady
//dokumentace zde: http://api.jquery.com/
//výběr prvků: http://api.jquery.com/category/selectors/

//-----defaultní nastavení
var jednou=1;

//odebrání buňek s tlačítky včetně tlačítek z tabulky
$("#kontaktyEmail td:eq(3)").remove(); 
$("#kontaktyTelefon td:eq(3)").remove(); 
$("#kontaktyAdresa td:eq(3)").remove(); 

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
$("#kontaktyEmail td:eq(2)").after("<td><input type='button' id='smazatEmail' value='smazat kontakt'></td>");
$("#kontaktyTelefon td:eq(2)").after("<td><input type='button' id='smazatTelefon' value='smazat kontakt'></td>");
$("#kontaktyAdresa td:eq(2)").after("<td><input type='button' id='smazatAdresa' value='smazat kontakt'></td>");

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

//odebrání buňek s tlačítky včetně tlačítek z tabulky
$("#kontaktyEmail td:eq(3)").remove();
$("#kontaktyTelefon td:eq(3)").remove();
$("#kontaktyAdresa td:eq(3)").remove();

//schování ostatních tlačítek
$("#zmenitikonu").hide(0);
$("#zmenitheslo").hide(0);
});

$(document).on('click', '#zmenitikonu', function(event) {
window.alert("nic to nedělá, ale pak půjde vybrat ikonu z lokálního disku");
});

$(document).on('click', '#zmenitheslo', function(event) {
window.alert("nic to nedělá, ale pak bude možné po zadání starého hesla změnit heslo");
});

$(document).on('click', '#smazatAdresa', function(event) {
window.alert("nic to nedělá, ale pak to smaže text v inputech");
});

$(document).on('click', '#smazatTelefon', function(event) {
window.alert("nic to nedělá, ale pak to smaže text v inputech");
});

$(document).on('click', '#smazatEmail', function(event) {
window.alert("nic to nedělá, ale pak to smaže text v inputech");
});