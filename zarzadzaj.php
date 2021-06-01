<?php
include("head.php");
?>
<DIV id="naglowek">
<?php
include("naglowek.php");
?>
</DIV>

<div id="lewy_bok">
     <?php
     include("lewy.php");
     ?>
</div>

<div id="tresc">
<div class="terminarz" style="width:450px">
      <div class="tyt">Zarządzaj stroną<br> </div>
<?php
include("polacz.php");
include 'funkcje.php';
function pokaz(){
	echo "<div class=\"tyt\"><a href=\"javascript:pokazKal()\">Edytuj kalendarz</a></div>";
	echo "<div id=\"editKal\" style=\"display:none;\"></div>";	
	echo "<div class=\"tyt\"><a href=\"javascript:pokazDiv('rozgrywki/1213/zarzadzanie.php','editRoz')\">Edytuj rozgrywki</a></div>";
	echo "<div id=\"editRoz\" style=\"display:none;\"></div>";	
	echo "<div class=\"tyt\"><a href=\"javascript:pokazDiv('rozgrywki/1213/edit_strzelcy.php','editStrz')\">Edytuj strzelców</a></div>";
	echo "<div id=\"editStrz\" style=\"display:none;\"></div>";	
	echo "<div class=\"tyt\"><a href=\"javascript:pokazDiv('rozgrywki/1213/obl_tabela.php','oblTab')\">Oblicz tabelę</a></div>";
	echo "<div id=\"oblTab\" style=\"display:none;\"></div>";	
	echo "<div class=\"tyt\"><a href=\"javascript:pokazDiv('dodatki/typer/1213/tabela_typerow.php','oblTyper')\">Oblicz tabelę typerów</a></div>";
	echo "<div id=\"oblTyper\" style=\"display:none;\"></div>";
}
function wyswietl(){
	echo '<a href="kalendarz.php">Edytuj kalendarz</a><br>
	<a href="zarzadzanie.php">Edytuj rozgrywki</a><br>
	<a href="rozgrywki/obliczanie_tab.php">Oblicz tabelę</a><br>
	<a href="dodatki/typer/tabela_typerow.php">Oblicz tabelę typerów</a><br>';	
}

      $u=mysql_fetch_array(mysql_query("Select ranga from uzytkownik where login='".$_SESSION['nick']."'"));
      $u2=mysql_fetch_array(mysql_query("Select ranga from sesja where nazwa_uz='".$_SESSION['nick']."'"));
      if($_COOKIE['zalogowany']=="no" AND $u[0]==$u2[0] AND $u[0]='admin') pokaz();

?>
 </div>
</div>
</div>

<div id="prawy_bok">
     <?php
     include("prawy.php");
     ?>
</div>

<!--FOOTER-->
</BODY>
</HTML>
<!--/FOOTER-->
	
