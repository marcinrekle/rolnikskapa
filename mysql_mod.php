<?
session_start();
?>

<!--HEADER-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="Creation-date" CONTENT="2010-10-09T15:20:58Z">
<META HTTP-EQUIV="Reply-to" CONTENT="adres zwrotny">
<META NAME="Description" CONTENT="opis dokumentu">
<META NAME="Author" CONTENT="Marcin Kazuba">
<meta name="Authoring-tool" content="Pajaczek NxG PRO v5.9.4">
<TITLE>Rolnik Skąpa</TITLE>
<link rel="stylesheet" type="text/css" href="styl.css">
<link rel="shortcut icon" href="PLIKI/s.jpg">
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
     <?
	  include("polacz.php");	
     mysql_query("SET CHARSET utf8");
mysql_query("SET NAMES 'utf8' COLLATE 'utf8_bin'");
mysql_query("UPDATE  `rolnikskapa_cba_pl`.`druzyny` SET  `nazwa` =  'Rolnik Skąpa' WHERE  `druzyny`.`id` =1;");
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
