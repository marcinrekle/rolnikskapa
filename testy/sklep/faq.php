<?php
include 'function.php';
$cart = isset($_COOKIE['cart'])?unserialize(base64_decode($_COOKIE['cart'])):Array();
$price = isset($_COOKIE['price'])?$_COOKIE['price']:0;
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Sklep internetowy koszulek - Najczęściej zadawane pytania</title>
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
				<div id="formContact" class="item">
						<h3>Najczęściej zadawane pytania</h3>
						<h4>Jaki jest koszt przesyłki kolejnych sztuk ?</h4>
						<p>Koszt wysyłki kolejnej sztuki wynosi 1 zł, a maksymalna ilość koszulek w jednej przesyłce wynosi 10.
						<h4>Zwrot towaru</h4>
						<p>W ciągu 10 dni klient może zwrócić towar
				</div>
			</div>
			
			</article>
			<footer id="STOPKA">Stopka serwisu</footer>
		</div>
	<script type="text/javascript" src="cookies.js"></script>
	</body>
</html>