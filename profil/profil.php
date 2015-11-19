<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>profil</title>
</head>
<body>
<?php
//defaultní hodnoty proměnných
$prezdivka="pribyto4";
$noveheslo="nevim";
$email="tomas.pribyl.89@gmail.com";

$telefon=604555666;
$telefon2=487222145;
$adresa="koleje Strahov, blok 3, pokoj 105";
$email2="blabla@seznam.cz";
$telefonpozn="";
$telefon2pozn="volat jen o víkendu";
$adresapozn="tady bývám až večer";
$email2pozn="";
//--------

if (!empty($_POST["email"])) //byly poslány proměnné metodou post
{
$email=$_POST["email"];
$telefon=$_POST["telefon"];
$telefon2=$_POST["telefon2"];
$adresa=$_POST["adresa"];
$email2=$_POST["email2"];
$telefonpozn=$_POST["telefonpozn"];
$telefon2pozn=$_POST["telefon2pozn"];
$adresapozn=$_POST["adresapozn"];
$email2pozn=$_POST["email2pozn"];
}

?>

<script>
function pridatkontakt()
{
window.alert("nic to nedělá, ale pak to přidá řádek");  
}

function zmenitikonu() 
{
window.alert("nic to nedělá, ale pak půjde vybrat ikonu z lokálního disku");  
}

function zmenitheslo() 
{
window.alert("nic to nedělá, ale pak bude možné po zadání starého hesla změnit heslo");  
}        
</script>  

ikona: <img width="50" height="50" src="./profil.jpg"/>

<?php
$editace=
'
<INPUT type="button" onClick="zmenitikonu()" value="změnit ikonu"><br>
přezdívka: '.$prezdivka.'<br>
<INPUT type="button" onClick="zmenitheslo()" value="změnit heslo"><br>
<form action="profil.php" method="post">	
email: <input type="text" name="email" value="'.$email.'"><br><br>

Uložené volby pro kontaktování na vložené inzeráty (k inzerátu bude možné přiřadit libovolný kontakt nebo taky tam vytvořit nový kontakt):<br>

<table rules="all" cellpadding="5px">
<tr><td>typ kontaktu</td><td>kontakt</td><td>poznámka ke kontaktu</td></tr>

<tr><td>telefon</td><td><input type="text" name="telefon" value="'.$telefon.'"></td><td><input type="text" name="telefonpozn" value="'.$telefonpozn.'"></td><td><button>smazat kontakt</button></td></tr>
<tr><td>telefon2</td><td><input type="text" name="telefon2" value="'.$telefon2.'"></td><td><input type="text" name="telefon2pozn" value="'.$telefon2pozn.'"></td><td><button>smazat kontakt</button></td></tr>
<tr><td>adresa</td><td><input type="text" name="adresa" value="'.$adresa.'"></td><td><input type="text" name="adresapozn" value="'.$adresapozn.'"></td><td><button>smazat kontakt</button></td></tr>
<tr><td>email2</td><td><input type="text" name="email2" value="'.$email2.'"></td><td><input type="text" name="email2pozn" value="'.$email2pozn.'"></td><td><button>smazat kontakt</button></td></tr>
</table>
<INPUT type="button" onClick="pridatkontakt()" value="přidat kontakt">(přidá řádek do tabulky, ve kterém bude jako typ kontaktu tento listbox:
<select name="typkontaktu" size="1"> 
<option value="telefon">telefon
<option value="email">email
<option value="adresa">adresa
<option value="icq">icq
<option value="skype">skype
</select>)
<br><br> 
<input type="hidden" name="editace" value="vypnuta">
<input type="submit" value="uložit změny">
</form>';

$ulozeno=

'<br>přezdívka: '.$prezdivka.'<br>
email: '.$email.'<br><br>

Uložené volby pro kontaktování na vložené inzeráty:<br>

<table rules="all" cellpadding="5px">
<tr><td>typ kontaktu</td><td>kontakt</td><td>poznámka ke kontaktu</td></tr>

<tr><td>telefon</td><td>'.$telefon.'</td><td>'.$telefonpozn.'</td></tr>
<tr><td>telefon2</td><td>'.$telefon2.'</td><td>'.$telefon2pozn.'</td></tr>
<tr><td>adresa</td><td>'.$adresa.'</td><td>'.$adresapozn.'</td></tr>
<tr><td>email2</td><td>'.$email2.'</td><td>'.$email2pozn.'</td></tr>
</table>
<br>
<form action="profil.php" method="post">	
<input type="hidden" name="email" value="'.$email.'">
<input type="hidden" name="telefon" value="'.$telefon.'">
<input type="hidden" name="telefonpozn" value="'.$telefonpozn.'">
<input type="hidden" name="telefon2" value="'.$telefon2.'">
<input type="hidden" name="telefon2pozn" value="'.$telefon2pozn.'">
<input type="hidden" name="adresa" value="'.$adresa.'">
<input type="hidden" name="adresapozn" value="'.$adresapozn.'">
<input type="hidden" name="email2" value="'.$email2.'">
<input type="hidden" name="email2pozn" value="'.$email2pozn.'">
<input type="hidden" name="editace" value="zapnuta">
<input type="submit" value="editovat">
</form>';



if (!empty($_POST["editace"])) 
{
if ($_POST["editace"]=="zapnuta") //bylo nastaveno editování
{ 
	echo $editace;
} else
{
	echo $ulozeno;
}
} else //při prvnim spuštění načte defaultní hodnoty
{
echo $ulozeno;
}

?>


</body>
</html>