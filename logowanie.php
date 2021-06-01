<?php
include("polacz.php");
ob_start();
session_start();
if(isset($_POST['wyloguj']) AND $_COOKIE['zalogowany']=="no") wyloguj();
//echo $_POST['login'].$_COOKIE['zalogowany'];
if(isset($_POST['login'])AND ($_COOKIE['zalogowany']!="no")AND isset($_POST['loguj'])) {
$login=$_POST['login'];
$login = addslashes($login);
$login = htmlspecialchars($login);
$_SESSION['nick']=$_POST['login'];

zaloguj();
}


function zaloguj(){
$komunikat="";
if($login=="") $komunikat.="pusty login<br>";
if($haslo=="") $komunikat.="puste haslo<br>";
$is_uz=mysql_fetch_array(mysql_query("Select id from uzytkownik where login='".$_POST['login']."'"));
if($is_uz[0]=="") $komunikat.="niepoprawny login<br>";
$haslo = substr(addslashes($_POST['haslo']),0,32);
$haslo=md5($haslo);

$haslo1=mysql_fetch_array(mysql_query("Select haslo from uzytkownik where login='".$_POST['login']."'"));

if($haslo==$haslo1[0]) zalogowany() ;
}//zaloguj
 function zalogowany(){
//echo "Witaj <b>".$_POST['login']."</b>";
$u=mysql_fetch_array(mysql_query("Select ranga from uzytkownik where login='".$_POST['login']."'"));
mysql_query("insert into sesja  ( id, sid, d_g, nazwa_uz, ranga, ip) VALUES('','".session_id()."','".date("Y-m-d H:i:s")."','".$_POST['login']."','".$u[0]."','".$_SERVER['REMOTE_ADDR']."')");
setcookie("zalogowany","no",time()+3600);
$_SESSION['zalogowany2']="no";
$_SESSION['nick']=$_POST['login'];

}//zalogowany
function wyloguj(){
setcookie("zalogowany","no",time()-3600);
$_SESSION['zalogowany2']="";
$_SESSION['nick']="";
mysql_query("DELETE FROM `sesja` where `nazwa_uz`='".$_SESSION['nick']."'");
}
$adresikg= explode("?",$_SERVER['HTTP_REFERER']);
$adresik=explode("&",$adresikg[1]) ;
$adres='';
$adres.=$adresikg[0];
header("Location:".$adres);

ob_end_flush();
mysql_close();
?>
