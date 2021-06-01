<?php
session_start();
include '../../../funkcje.php';
include '../../../polacz.php';
if(!empty($_SESSION[nick])&&$_GET[c_m]>time()){
	$idu=pobierz("*", "uzytkownik", "login", "'".$_SESSION['nick']."'");
	$ile=ile_w("`typer1213`", ' WHERE id_uz='.$idu[0].' and id_m='.$_GET['id']);
	if(empty($_GET['wynik'])) echo "<a href=\"javascript:pokaz_typuj($_GET[id])\">typuj</a>";
	elseif ($ile<>0) {
		update("`typer1213`"," `wynik`='".$_GET['wynik']."'","`id_uz`=".$idu[0]." and `id_m`=".$_GET['id']);
		echo "$_GET[wynik]";
	}else{
		insert("typer1213", "`id`, `id_m`, `id_uz`, `wynik`","NULL,'".$_GET['id']."' , '".$idu[0]."' , '".$_GET['wynik']."'");
		echo "$_GET[wynik]";
	}	
}else {echo "Jesteś niezalogowany badź mecz się już rozpoczął";}

?>
