
var jednou=1;
document.getElementById("smazatEmail").style.display="none"; //block none	
var row = document.getElementById("kontaktyEmail");
row.deleteCell(3);
document.getElementById("smazatTelefon").style.display="none"; //block none	
var row = document.getElementById("kontaktyTelefon");
row.deleteCell(3);
document.getElementById("smazatAdresa").style.display="none"; //block none	
var row = document.getElementById("kontaktyAdresa");
row.deleteCell(3);
document.getElementById("zmenitikonu").style.display="none"; //block none
document.getElementById("zmenitheslo").style.display="none"; //block none

$(document).on('click', '#editovat_profil', function(event) {
	// vsem inputum co maji tridu profile_input oebereme readonly => editace
	$('.profile_input').each(function(index, el) {
		$(el).removeAttr('readonly');
	});

if (jednou==1)
{
jednou=0;
var row = document.getElementById("kontaktyEmail");
var cel = row.insertCell(3);
cel.innerHTML = "<input type='button' id='smazatEmail' value='smazat kontakt'>";

var row = document.getElementById("kontaktyTelefon");
var cel = row.insertCell(3);
cel.innerHTML = "<input type='button'' id='smazatTelefon' value='smazat kontakt'>";

var row = document.getElementById("kontaktyAdresa");
var cel = row.insertCell(3);
cel.innerHTML = "<input type='button' id='smazatAdresa' value='smazat kontakt'>";

document.getElementById("zmenitikonu").style.display="block"; //block none
document.getElementById("zmenitheslo").style.display="block"; //block none
}
});

$(document).on('click', '#ulozit_profil', function(event) {
	// vsem inputum co maji tridu profile_input vratime readonly => ulozeni
	$('.profile_input').each(function(index, el) {
		$(el).attr('readonly', 'readonly');
	});
jednou=1;
document.getElementById("smazatEmail").style.display="none"; //block none	
var row = document.getElementById("kontaktyEmail");
row.deleteCell(3);
document.getElementById("smazatTelefon").style.display="none"; //block none	 
var row = document.getElementById("kontaktyTelefon");
row.deleteCell(3);
document.getElementById("smazatAdresa").style.display="none"; //block none	
var row = document.getElementById("kontaktyAdresa");
row.deleteCell(3);
document.getElementById("zmenitikonu").style.display="none"; //block none
document.getElementById("zmenitheslo").style.display="none"; //block none
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