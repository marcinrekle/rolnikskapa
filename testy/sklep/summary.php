<?php include 'function.php';
$cart = isset($_COOKIE['cart'])?unserialize(base64_decode($_COOKIE['cart'])):Array();
$price = isset($_COOKIE['price'])?$_COOKIE['price']:0;
//echo "un:".var_dump(unserialize(base64_decode("a%3A1%3A%7Bi%3A0%3Bs%3A3%3A%221_1%22%3B%7D")));
//var_dump($cart);
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
				<div id="formCartId"class="item cart">
					<h3>Podsumowanie</h3>
					<h4>Twoje zakupy:</h4>
					<ul>
						<?php 
						dbConnect();
						$sum=0;
						$del=explode(":",$_POST[z24_delivery]);
						$count= sizeof($cart);
						echo"<li><div class=\"itemInfo\">Opis</div>
								<div class=\"itemQuantity\"> Ilość</div>
								<div class=\"itemPrice\">Cena</div></li><hr>
								";
						foreach ($cart as $key => $value) {
							$row=mysql_fetch_row(mysql_query("SELECT * FROM item WHERE id=$key"));
							$sum+=$row[4]*$value;
							echo "<li>"."\n".
									"
									<div class=\"itemInfo\">$row[1]</div>
									<div class=\"itemQuantity\">$value</div>
									<div class=\"itemPrice\">$row[4] zł</div>
									</li>
								";
						}
						mysql_close();
						echo"<hr><li>
								<div class=\"itemInfo\"><b> &nbsp</b></div>
								<div class=\"itemQuantity\"> &nbsp</div>
								<div class=\"itemPrice\"><b>$sum zł</b></div>
							</li>
								<h4>Koszt przesyłki:</h4>
							<li><div class=\"itemInfo\">Opis</div>
								<div class=\"itemQuantity\"></div>
								<div class=\"itemPrice\">Cena</div>
							</li><hr>
							<li>
								<div class=\"itemInfo\">$del[0]</div>
								<div class=\"itemQuantity\"> &nbsp</div>
								<div class=\"itemPrice\">$_POST[z24_delivery_cost] zł</div>
							</li>
							<hr>
							<li>
								<div class=\"itemInfo\"><b>Kwota do zapłaty :</b></div>
								<div class=\"itemQuantity\"></div>
								<div class=\"itemPrice\"><b>".($_POST[z24_delivery_cost]+$sum)." zł</b></div>
							</li>
								<h4>Adres dostawy:</h4>
								<span>$_POST[k24_nazwa]</span><br>
								<span>$_POST[k24_ulica]</span><span> $_POST[k24_numer_dom]</span><br>
								<span>$_POST[k24_kod] $_POST[k24_miasto]</span><br><br>
								<span>$_POST[k24_email]</span><br>
								<span>$_POST[k24_telefon]</span>
							</ul><br><br><br>";
					?>
					<div class="cart">
					<?php 
					//echo "del[0]=$del[0] : ".strstr($del[0],"List polecony priorytetowy");
						$action=(strstr($del[0],"List polecony priorytetowy")!==False)?"https://sklep.przelewy24.pl/zakup.php":"done.php";
						$submitVal=(strstr($del[0],"List polecony priorytetowy")!==False)?"zapłać z przelewy24.pl":"Wyślij zamówienie";
						$class=(strstr($del[0],"List polecony priorytetowy")!==False)?"buyZ24":"buy";
					?>
						<form method="get" action="<?php echo $action?>" accept-charset="ISO-8859-1" id="z24">
							<input type="hidden" name="z24_id_sprzedawcy" id="z24_id_sprzedawcy1" value="20988" title="">
							<input type="hidden" name="z24_kwota" id="z24_kwota1" value="5500" title="">
							<input type="hidden" name="z24_crc" id="z24_crc1" value="ef88ef20" title="">
							<input type="hidden" name="z24_nazwa" value="<?php echo date("Y/m/d/Hi")?>" />
							<input type="hidden" name="z24_language" value="pl">
							<input type="hidden" name="z24_return_url" value="http://www.rolnikskapa.cba.pl/testy/sklep/done.php">
							<input type="hidden" name="k24_nazwa" value="<?php echo validate($_POST[k24_nazwa])?>">
							<input type="hidden" name="k24_email" value="<?php echo validate($_POST[k24_email])?>">
							<input type="hidden" name="k24_telefon" value="<?php echo validate($_POST[k24_telefon])?>">
							<input type="hidden" name="k24_kod" value="<?php echo validate($_POST[k24_kod])?>">
							<input type="hidden" name="k24_kraj" value="PL">
							<input type="hidden" name="k24_miasto" value="<?php echo validate($_POST[k24_miasto])?>">
							<input type="hidden" name="k24_ulica" value="<?php echo validate($_POST[k24_ulica])?>">
							<input type="hidden" name="k24_numer_dom" value="<?php echo validate($_POST[k24_numer_dom])?>">
							<input type="hidden" name="z24_delivery" id="z24_delivery" value="<?php echo $del[0]?>" title="">
							<input type="submit" class="btn sell <?php echo $class ?>" value="<?php echo $submitVal?>" name="submit_pay">
							
						</form>
					</div>
				</div>
			</div>
			</article>
			<footer id="STOPKA">Stopka serwisu</footer>
		</div>
		<script type="text/javascript" src="cookies.js"></script>
	</body>
</html>
