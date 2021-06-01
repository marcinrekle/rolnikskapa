<?php
include 'polacz.php';
include 'funkcje.php';
$czas=date("Y-m-d G:i:s");
$kom_text=$_POST[kom_text];
$kom_text=htmlspecialchars($kom_text);
if(!empty($kom_text)&&!empty($_POST[autor])){
insert("komentarz", "`id`, `id_news`, `autor`, `czas`, `system`, `przegladarka`, `wersja`, `text`, `cytat`",
 "'',$_POST[news_id],'$_POST[autor]','$czas','$_POST[system]','$_POST[przeg]','$_POST[wersja]','$kom_text','$_POST[cytat]'");
echo "Komentarz został dodany";
}else echo "Napisz coś... $_POST[autor] $_POST[system] $_POST[news_id]";
mysql_close();
?>
