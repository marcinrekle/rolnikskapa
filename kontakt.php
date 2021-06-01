<?
session_start();
?>

<!--HEADER-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">

<HTML>
<HEAD>
<?
require_once("head.php");
?>
</HEAD>
<BODY>
<!--/HEADER-->

<DIV id="naglowek">
<?
include("naglowek.php");
?>
</DIV>

<div id="lewy_bok">
     <?
     include("lewy.php");
     ?>
</div>

<div id="tresc">
     <div class="panel"><div class="tyt">Kontakt</div>
	  <table rules="rows">
	  <tr><th>Imię i Nazwisko</th></tr>
	  <tr><td style="left-padding:5px">&nbsp;Marcin Kazuba</td></tr>
	  <tr><th>adres e-mail</th></tr>	
	  <tr><td style="left-padding:5px">&nbsp;marcinrekle@o2.pl</td></tr>
	  <tr><th>Numer GG</th></tr>	
	  <tr><td style="left-padding:5px">&nbsp;7406183</td></tr>	
	  <tr><th>Formularz kontaktu</th></tr>		
	  <tr><td style="left-padding:5px">
	  <form style="margin:5px" method="POST" action="">
	  <input type="text" maxlenght="40" value="nadawca" onclick="this.value=''" name="nadawca" style="background:rgba(0,0,0,0.15)">
	  <input type="text" maxlenght="50" value="e-mail" onclick="this.value=''" name="mail" style="background:rgba(0,0,0,0.15)"><br>
	  <textarea name="tresc" rows="5" cols="15" class="komentarz_dodaj_text"></textarea><br>
	  <button type="submit" value="Wyślij" name="kontakt" class="przycisk">Wyślij</button>				
	  </form>		
		</td></tr>	
		</table>	
		</div>
		<?
		if(isset($_POST['kontakt'])){
		
		mail("marcinrekle@o2.pl", "Formularz", $_POST['nadawca']."\n".$_POST['tresc']."\n".$_POST['mail'], "Reply-To: $mail"); 
		}
		?>
</div>

<div id="prawy_bok">
     <?
     include("prawy.php");
     ?>
</div>

<!--FOOTER-->
</BODY>
</HTML>
<!--/FOOTER-->
