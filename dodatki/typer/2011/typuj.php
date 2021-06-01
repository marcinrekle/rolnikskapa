<?php
session_start();
include '../../../funkcje.php';
include '../../../polacz.php';
$idu=pobierz("*", "uzytkownik", "login", "'".$_SESSION['nick']."'");
$ile=ile_w("`typer1112`", ' WHERE id_uz='.$idu[0].' and id_m='.$_GET['id']);
if(empty($_GET['wynik'])) echo "<a href=\"javascript:pokaz_typuj($_GET[id])\">typuj</a>"; 
elseif ($ile<>0) {
	update("`typer1112`"," `wynik`='".$_GET['wynik']."'","`id_uz`=".$idu[0]." and `id_m`=".$_GET['id']);
	echo "<a href=\"javascript:pokaz_typuj($_GET[id])\">$_GET[wynik]</a>";
}else{ 
insert("typer1112", "`id`, `id_m`, `id_uz`, `wynik`","NULL,'".$_GET['id']."' , '".$idu[0]."' , '".$_GET['wynik']."'");
echo "<a href=\"javascript:pokaz_typuj($_GET[id])\">$_GET[wynik]</a>";
}
?>
