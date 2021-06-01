<?php
include 'polacz.php';
include 'funkcje.php';
$czas=date("Y-m-d G:i:s");
$message=$_POST[SbMessage];
$nick=$_POST[nick];
if($message!='' && $nick!='')
insert("shoutbox", "`id`, `nick`, `text`, `czas`", "'','$nick','$message','$czas'");
?>