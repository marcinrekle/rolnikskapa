<?php
include 'polacz.php';
if($_GET[pok]==1){
	if($_COOKIE['zalogowany']=="no"){
		$id=$_GET[id];
		$kom=$_GET[kom];
		include "dodaj_odp_form.php";
		echo "<br><a href=\"javascript:dodaj_odp($id,$kom)\" class=\"btn\">Odpowiedz</a>";
	} else
	echo "<p style=\"margin:5px\">Komentarze moga dodawać tylko zalogowani użytkownicy. Jeżeli nie posiadasz jeszcze konta w serwisie to <a href=\"javascript:pokaz('$_SESSION[bez]')\">zarejestruj się</a>.<br><br>";
	echo '</div>';
	echo '</div></div>';
} else{
	echo '<div class="komentarze"><div class="tyt">Komentarze</div>';
	$id=$news[0];
	if(empty($id))$id=$_GET[news_id];
	$pyt=mysql_query("SELECT * FROM komentarz WHERE id_news=$id");
	while ($kom=mysql_fetch_row($pyt)) {
		echo "<div class=\"komentarz\" id=\"kom$kom[0]\" name=\"kom$kom[0]\">";
		echo "<div class=\"podpis\">";
		echo "$kom[3] |<img src=\"../../PLIKI/$kom[4].png\"> $kom[4] |<img src=\"../../PLIKI/$kom[5].png\"> $kom[5] $kom[6]";
		echo "</div>";
		echo "<div class=\"txt\">";
		if($kom[8]<>0){
			$cytat=mysql_fetch_array(mysql_query("SELECT * FROM komentarz WHERE id=$kom[8]"));
			echo "<div class=\"cytat\">";
			echo "<strong>$cytat[2] napisał(a)</strong>";
			echo "<div class=\"txt\">";
			echo $cytat[7];
			echo "</div>\n</div>";
		}
		echo $kom[7];
		echo "</div>";
		echo "<div class=\"podpis\">";
		echo "$kom[2]";
		echo "<a href=\"javascript:odp($id,$kom[0])\" style=\"float:right\">Odpowiedz</a>";
		echo "</div>\n</div>";
	}
	 
	if($_COOKIE['zalogowany']=="no"){
		echo "<div class=\"dodaj\">";
		include 'dodaj_kom_form.php';

		echo "<br><a href=\"javascript:dodaj_kom($id)\" class=\"btn\">Dodaj komentarz</a>";
		echo "</div>";
	} else
	echo "<p style=\"margin:5px\">Komentarze moga dodawać tylko zalogowani użytkownicy. Jeżeli nie posiadasz jeszcze konta w serwisie to <a href=\"javascript:pokaz('$_SESSION[adres]')\">zarejestruj się</a>.<br><br>";
	echo '</div>';
	echo '</div></div>';}
	mysql_close();
	?>