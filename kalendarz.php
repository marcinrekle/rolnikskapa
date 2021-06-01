<?php
include("polacz.php");
include 'funkcje.php';
function pokaz(){
	if ($_GET['op']=='u' || $_GET[op]==''){mysql_query("DELETE FROM kalendarz WHERE id=".$_GET['id']);
	echo "<form id=\"dodaj\"><input type=\"text\" / id=\"data\" value=\"rrrr-mm-dd\">
	<input type=\"text\" / name=\"godz\" value=\"gg:mm\">
	<input type=\"text\" / name=\"rodzaj\" value=\"trening\">
	<input type=\"text\" / name=\"opis\" value=\"Skąpa\">";
	
	echo "<a href=\"javascript:dodajKal()\" class=\"btn_dodaj\" id=\"dodaj_btn\">
		&nbsp&nbsp&nbsp&nbsp&nbsp </a>";
	echo "</form>";
	}
	if ($_GET['op']=='zmien') {
		update("kalendarz", "data='$_GET[data]', godz='$_GET[godz]',rodzaj='$_GET[wyd]',opis='$_GET[miejsce]'", "id=$_GET[id]");
	}
	if ($_GET['op']=='ins') {
		insert("kalendarz", "id,data,godz,rodzaj,opis", "NULL,$_GET[d],'$_GET[g]','$_GET[m]','$_GET[w]'");
	}
	$data=mysql_query("SELECT * FROM kalendarz");
	while($r=mysql_fetch_row($data)){
		echo "<div id=\"$r[0]\">$r[0] | $r[1] | $r[2] | $r[3] | $r[4] 
		<a href=\"javascript:editKal($r[0],'z')\"  class=\"btn_ok\">
		&nbsp&nbsp&nbsp&nbsp&nbsp </a>
		<a href=\"javascript:editKal($r[0],'u')\" class=\"btn_usun\">
		&nbsp&nbsp&nbsp&nbsp&nbsp </a>
		</div>";
	
if ($_GET['op']=='z'&&$_GET[id]==$r[0]){
	echo "<form id=\"dodaj\"><input type=\"text\" / id=\"data\" value=\"$r[1]\">
	<input type=\"text\" / name=\"godz\" value=\"$r[2]\">
	<input type=\"text\" / name=\"rodzaj\" value=\"$r[3]\">
	<input type=\"text\" / name=\"opis\" value=\"$r[4]\">";	
	echo "<a id=\"a$r[0]\" href=\"javascript:zmienKal($r[0],'zmien','$r[1]','$r[2]','$r[3]','$r[4]')\" class=\"btn_ok\">
		&nbsp&nbsp&nbsp&nbsp&nbsp </a>";
	echo "</form>";
	}
	}//while
}//pokaz

	
      $u=mysql_fetch_array(mysql_query("Select ranga from uzytkownik where login='".$_SESSION['nick']."'"));
      $u2=mysql_fetch_array(mysql_query("Select ranga from sesja where nazwa_uz='".$_SESSION['nick']."'"));
      if($_COOKIE['zalogowany']=="no" AND $u[0]==$u2[0] AND $u[0]='admin') pokaz();
mysql_close();
      ?>