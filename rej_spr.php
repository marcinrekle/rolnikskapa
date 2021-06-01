<?php
include("polacz.php");
session_start();
if ($_POST[dzialanie]=='spr_login') {
	$login=substr(addslashes(htmlspecialchars($_POST[val])),0,32);
	$login=str_replace(' ','',$login);
	$nazwa=mysql_fetch_array(mysql_query("Select COUNT(*) from uzytkownik where login='$login' LIMIT 1"));
	echo $nazwa[0]>0 || strlen($login)<=4 || strlen($login>=33)? "{\"odp\":\"blad\"}":"{\"odp\":\"$login\"}";
}
if ($_POST[dzialanie]=='spr_haslo') {
	$haslo=substr(addslashes(htmlspecialchars($_POST[val])),0,32);
	$haslo=str_replace(' ','',$haslo);
	echo strlen($haslo)<=4 || strlen($haslo>=33)? "{\"odp\":\"blad\"}":"{\"odp\":\"$haslo\"}";
}
if ($_POST[dzialanie]=='spr_email') {
	$mail=substr(addslashes(htmlspecialchars($_POST[val])),0,32);
	$mail=str_replace(' ','',$mail);
	$spr=explode("@",$mail);
	$nazwa=mysql_fetch_array(mysql_query("Select COUNT(*) from uzytkownik where email='$mail' LIMIT 1"));
	echo strlen($mail)<=10 || $nazwa[0]>0 || empty($spr[1]) || !empty($spr[2])? "{\"odp\":\"blad\"}":"{\"odp\":\"$mail\"}";
}
if ($_POST[dzialanie]=='spr_miej') {
	$miej=substr(addslashes(htmlspecialchars($_POST[val])),0,32);
	$miej=str_replace(' ','',$miej);
	echo strlen($miej)<3 || strlen($miej)>32? "{\"odp\":\"blad\"}":"{\"odp\":\"$haslo\"}";
}

if ($_POST[dzialanie]=='spr_imie') {
	$imie=substr(addslashes(htmlspecialchars($_POST[val])),0,32);
	$imie=str_replace(' ','',$imie);
	echo strlen($imie)<3 || strlen($imie)>32? "{\"odp\":\"blad\"}":"{\"odp\":\"$haslo\"}";
}
if ($_POST[dzialanie]=='zarejestruj') {
	
	$haslo=md5($_POST[haslo]);
mysql_query("insert into uzytkownik  ( id, login, haslo, imie, nazwisko, d_ur, miejscowosc, email) VALUES('','$_POST[login]','$haslo','$_POST[imie]','','','$_POST[miej]','$_POST[mail]')");
echo "{\"odp\":\"ok\"}";
}  
mysql_close();                      
?>
