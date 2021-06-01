<?php
try {
	$db = new PDO("mysql:host=mysql.cba.pl;dbname=rolnikskapa_cba_pl", "admin_marcin", "haslorolnik",array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
} catch (PDOException $e) {
	echo "{\"Status\":\"Błąd\",\"Error\":\"".$e->getMessage()."\"}";
	die();
}
try {
	$db->exec($_POST[query]);
	echo "{\"Status\":\"Zapytanie wykonane\",\"lid\":".$db->lastInsertId()."}";
} catch (PDOException $e) {
	echo "{\"Status\":\"Błąd\",\"Error\":\"".$e->getMessage()."\"}";
}
?>