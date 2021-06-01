<?php
include 'function.php';
$cart = isset($_COOKIE['cart'])?unserialize(base64_decode($_COOKIE['cart'])):Array();
$price = isset($_COOKIE['price'])?$_COOKIE['price']:0;
if (isset($_COOKIE['cart'])){
	foreach ($cart as $key => $value) {
		dbConnect();
		$row=mysql_fetch_row(mysql_query("SELECT * FROM item WHERE id=$key"));
		$item.="<li>$row[1] - sztuk $value </li>";
	}
	$nazwa = validate($_GET['k24_nazwa']);
	$adres = validate($_GET['k24_ulica'])." ".validate($_GET['k24_numer_dom'])." , ".validate($_GET['k24_kod'])." ".validate($_GET['k24_miasto']);
	$kontakt = validate($_GET['k24_email'])." , ".validate($_GET['k24_telefon']);
	mysql_close();
	$text = "
	<html>
	<head>
	
	</head>
	<body>
	<h3>Nowe zamówienie (wysyłka - $_GET[z24_delivery]) o symbolu:<b>$_GET[z24_nazwa]</b></h3>
	<h4><b>Lista produktów do wysłania:</b></h4>
	<ul style=\"font-size:15px;\">
	$item
	</ul>
	<h4><b>Adres na który należy wysłać:</b></h4>
	<p> $nazwa
	<p> $adres
	<p>Kontakt:<br> $kontakt
	</body>
	</html>
	";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$headers .= "From: l-w-g@o2.pl" . "\r\n";
	if(!mail("l-w-g@o2.pl","Nowe zamówienie",$text,$headers))echo "{\"status\":\"BAD\"}";else echo "{\"status\":\"OK\"}";
	$error = error_get_last();
	//preg_match("/\d+/", $error["message"], $error);
	echo $error[message];
}

?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Sklep internetowy koszulek</title>
		<link rel="stylesheet" type="text/css" href="styl.css">
		<script type="text/javascript" src="html5.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="skrypt.js"></script>
		<link rel="Shortcut icon" href="img/logo.png" />
	</head>
	<body>
		<div id="top">
			<header id="NAGLOWEK"><h2>Koszulki motocyklowe świecące w nocy</h2></header>
			<aside id="INFORMACJE"></aside>
			<article id="TRESC" class="brbs">
			<nav id="MENU">
					<a href="index.php">Strona główna</a>
					<a href="kontakt.php">Kontakt</a>
					<a href="faq.php">FAQ</a>
					<a href="cart.php"><?php showPrice();?></a>
			</nav>
			<div id="left">
				<b>Kontakt  :</b><br><br>
				Tel : 500566547<br>
				E-mail : l-w-g@o2.pl<br>
				GG : 123456789<br><br>
				<b>Wysyłka :</b><br><br>
				List priorytetowy polecony : 5zł<br>
				Przesyłka pobraniowa biznesowa : 12.70 zł<br><br>
			</div>
			<div id="main">
				<div class="item">
					<p style="margin: 140px 0;"><b>Zamówienie zostało przyjęte do realizacji. Proszę o informacje jaki rozmiar wysłać na adres l-w-g@o2.pl w tytule należy podać symbol zamowienia : <?php echo $_GET[z24_nazwa]; ?> .Dziękujemy za wybór naszej oferty.</b> 
				</div>
			</div>
				
			</article>
			<footer id="STOPKA">Stopka serwisu</footer>
		</div>
		<script type="text/javascript" src="cookies.js"></script>
	</body>
</html>