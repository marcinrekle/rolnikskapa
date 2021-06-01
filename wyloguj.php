<?php
mysql_connect("127.0.0.1","root","") or die(mysql_error()."Nie mozna polaczyc sie z baza danych. Prosze chwile odczekac i sprobowac ponownie.");
mysql_select_db("rolnik") or die(mysql_error()."Nie mozna wybrac bazy danych.");
if($_GET['w']=='t' AND $_COOKIE['zalogowany']=="no") {
mysql_query("Delete from `sesja` where `nazwa_uz`='".$_SESSION['nick']."'");
$_SESSION['nick']='';
setcookie("zalogowany","no",time()-3600);
$_SESSION['zalogowany2']="";

};
echo $_COOKIE['zalogowany'];
?>
