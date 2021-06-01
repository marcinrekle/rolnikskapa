<?php
session_start();
$adres=explode("/",$_SERVER['PHP_SELF']);
$href="";
if(!isset($adres[2])) $href='./';//2
elseif(!isset($adres[3])) $href='../';//3
elseif(!isset($adres[4])) $href='../../';//4
elseif(!isset($adres[5])) $href='../../../';//5
//echo var_dump($adres);
$_SESSION['adres']=$href;
$_SESSION[bez]="http://www.rolnikskapa.cba.pl/";//zmienic http://localhost/rolnik/ -  http://www.rolnikskapa.cba.pl/
if ($href=="") $ad="online.php";else $ad=$href."online.php";
if (!empty($_GET[tyt])){
	include 'polacz.php';
	$news=mysql_fetch_array(mysql_query("SELECT * FROM news2011 WHERE url='$_GET[tyt]' AND sezon='$_GET[rok]'"));
	$metaFB = "<meta property=\"og:title\" content=\"$news[5]\"/>
	<meta property=\"og:image\" content=\"$_SESSION[bez]$news[6]\"/>
	<meta property=\"og:site_name\" content=\"Rolnik Skąpa\"/>
	<meta property=\"og:description\" content=\"".str_replace("&lt;p class=&quot;wprowadzenie&quot;&gt;", "", $news[9])."\"/>";
}
echo "
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"
	\"http://www.w3.org/TR/html4/loose.dtd\">
<HTML>
<HEAD>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
<META HTTP-EQUIV=\"Reply-to\" CONTENT=\"http://www.rolnikskapa.cba.pl\">
<META NAME=\"Description\" CONTENT=\"Rolnik Skąpa mecze wyniki\">
<META NAME=\"Author\" CONTENT=\"Marcin Kazuba\">
<script type=\"text/javascript\" src=\"$_SESSION[bez]js/jquery.js\"></script>
<script type=\"text/javascript\" src=\"$_SESSION[bez]js/jquery-ui-min.js\"></script>
<script type=\"text/javascript\" src=\"$_SESSION[bez]js/jquery-ui-timepicker-addon.js\"></script>
<script type=\"text/javascript\" src=\"$_SESSION[bez]js/jquery.ui.datepicker-pl.js\"></script>
<script type=\"text/javascript\" src=\"$_SESSION[bez]skrypt.js\"></script>
<script type=\"text/javascript\" src=\"$_SESSION[bez]skrypty.js\"></script>
<meta name=\"keywords\" content=\"LZS Rolnik Skąpa, LZS Rolnik Skapa, Rolnik Skąpa, Skąpa,Rolnik,piłka nożna,B-klasa,Sieradz,ozpn sieradz,mecze,wyniki,bramki,typer,galeria,relacje\" />
<TITLE>Rolnik Skąpa</TITLE>
<link rel=\"stylesheet\" type=\"text/css\" href=\"$_SESSION[bez]css/jquery.ui.base.css\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"$_SESSION[bez]css/jquery-ui-timepicker-addon.css\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"$_SESSION[bez]styl.css\">
<script type=\"text/javascript\"></script>
<link rel=\"shortcut icon\" href=\"$_SESSION[bez]PLIKI/s.jpg\">
<META NAME=\"robots\" CONTENT=\"all\">
$metaFB
</HEAD>
<BODY>
";
//https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js 
?>