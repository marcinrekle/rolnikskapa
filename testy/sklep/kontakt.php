<?php 
	include 'function.php';
	$cart = isset($_COOKIE['cart'])?unserialize(base64_decode($_COOKIE['cart'])):Array();
	$price = isset($_COOKIE['price'])?$_COOKIE['price']:0;
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
				<div id="formContact" class="item">
					<h3>Formularz kontaktowy</h3>
					<form action="">
					<input type="text" name="email" value="E-mail" class="quantity textContact"><br>
					<input type="text" name="subject" value="Temat" class="quantity textContact"><br>
					<textarea name="text" rows="10" cols="50" id="taText" class="quantity textareaContact"></textarea><br>
					<input type="submit" value="Wyślij" class="btn"><input type="reset"  class="btn">
					</form>	
				</div>
			</div>
			
			</article>
			<footer id="STOPKA">Stopka serwisu</footer>
		</div>
		<script type="text/javascript" src="cookies.js"></script>
	</body>
</html>