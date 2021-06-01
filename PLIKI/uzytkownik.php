<?php
ob_start();
if($_SESSION['nick']=='') setcookie("zalogowany","no",time()-3600);
if(!isset($_COOKIE['zalogowany'])) $_SESSION['nick']='';
if(($_COOKIE['zalogowany']=="no")AND ($_SESSION['nick']!=''))uz_zalogowany();
 else niezalogowany("");

function niezalogowany($komunikat){
$adresikg= explode("?",$_SERVER['REQUEST_URI']);
$adresik=explode("&",$adresikg['1']) ;
$adres='';
$adres.=$adresikg[0];

echo"<div class=\"tyt\">Panel użytkownika</div><div class=\"uz_panel\"><FORM ACTION=\"$_SESSION[bez]logowanie.php\" METHOD=\"POST\" TARGET=\"_self\" >
<INPUT type=\"TEXT\" NAME=\"login\" VALUE=\"login\" ALIGN=\"left\" class=\"login\" onclick=\"value=''\">
<INPUT type=\"PASSWORD\" NAME=\"haslo\" VALUE=\"haslo\" ALIGN=\"LEFT\" class=\"login\" onclick=\"value=''\">

<INPUT type=\"SUBMIT\"  NAME=\"loguj\" VALUE=\"Zaloguj\" class=\"btn\" ><br>
</form><a  href=\"#\" class=\"btn\" id=\"rej_start\">Zarejestruj się</a></div>";
echo "<div id=\"panelRej\">
<h5>Tworzenie nowego konta w serwisie</h5>
<form action=\"\" method=\"post\" id=\"rej\" style=\"\">
<label for=\"login\">Login(5-32)</label><input type=\"text\" maxlength=\"32\" name=\"login\" id=\"login\"><br>
<label for=\"haslo\">Hasło(5-32)</label><input type=\"password\" maxlength=\"32\" name=\"haslo\" id=\"haslo\"><br>
<label for=\"phaslo\">Powtórz hasło</label><input type=\"password\" maxlength=\"32\" name=\"phaslo\" id=\"phaslo\"><br>
<label for=\"email\">E-mail(32)</label><input type=\"text\" name=\"email\" maxlength=\"32\" id=\"email\"><br>
<label for=\"miej\">Miejscowość(32)</label><input type=\"text\" name=\"miej\" maxlength=\"32\" id=\"miej\"><br>
<label for=\"imie\">Imię(20)</label><input type=\"text\" name=\"imie\" maxlength=\"20\" id=\"imie\"><br>
<input type=\"submit\" name=\"rejestruj\" value=\"Rejestruj\" id=\"rejestruj\" class=\"btn\">
<a href=\"#\" class=\"btn close\">Zamknij</a>
<br>
</form>
</div>";
//echo $komunikat;
}//niezalogowany

function uz_zalogowany(){

echo '<div class="tyt">Panel użytkownika</div><div class="uz_panel">Witaj <b>'.$_SESSION['nick'].'</b> ';
echo '<form action="'.$_SESSION['bez'].'logowanie.php" METHOD="POST"><input type="submit" value="Wyloguj się" name="wyloguj" class="btn">
<input type="hidden" name="wyl" value="tak"><br>
<a  href="'.$_SESSION['bez'].'soon.php" class="btn" >Edytuj profil</a>';

$u=mysql_fetch_array(mysql_query("Select ranga from uzytkownik where login='".$_SESSION['nick']."'"));
$u2=mysql_fetch_array(mysql_query("Select ranga from sesja where nazwa_uz='".$_SESSION['nick']."'"));


if($u[0]=='admin' AND $u[0]==$u2[0]) echo '<a  href="'.$_SESSION['bez'].'zarzadzaj.php" class="btn">Zarządzaj</a>';
echo'</div></form>';
}//uz_zalogowany




ob_end_flush();
echo "
<div id=\"panelRej\">
<h5>Tworzenie nowego konta w serwisie</h5>
<form action=\"\" method=\"post\" id=\"rej\" style=\"display:none;\">
<label for=\"login\">Login(5-32)</label><input type=\"text\" maxlength=\"32\" name=\"login\" id=\"login\"><br>
<label for=\"haslo\">Hasło(5-32)</label><input type=\"password\" maxlength=\"32\" name=\"haslo\" id=\"haslo\"><br>
<label for=\"phaslo\">Powtórz hasło</label><input type=\"password\" maxlength=\"32\" name=\"phaslo\" id=\"phaslo\"><br>
<label for=\"email\">E-mail(32)</label><input type=\"text\" name=\"email\" maxlength=\"32\" id=\"email\"><br>
<label for=\"miej\">Miejscowość(32)</label><input type=\"text\" name=\"miej\" maxlength=\"32\" id=\"miej\"><br>
<label for=\"imie\">Imię(20)</label><input type=\"text\" name=\"imie\" maxlength=\"20\" id=\"imie\"><br>
<input type=\"submit\" name=\"rejestruj\" value=\"Rejestruj\" id=\"rejestruj\" class=\"btn\">
<a href=\"#\" class=\"btn close\">Zamknij</a>
<br>
</form>
</div>
";
?>
