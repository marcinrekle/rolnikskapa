	<?php
//setcookie('cart', "", time()-3600);
//setcookie('price', 0, time()-3600);
include 'function.php';
$cart = isset($_COOKIE['cart'])?unserialize(base64_decode($_COOKIE['cart'])):Array();
$price = isset($_COOKIE['price'])?$_COOKIE['price']:0;
if (isset($_POST['submit'])){
	$_POST[p24_item_id]=validate($_POST[p24_item_id]);
	$cart[$_POST[p24_item_id]]=isset($cart[$_POST[p24_item_id]])?$cart[$_POST[p24_item_id]]+$_POST[p24_number]:$_POST[p24_number];
	//$cart[$_POST[p24_item_id]]=$_POST[p24_number];
	//array_push($cart,"$_POST[p24_item_id]_$_POST[p24_number]");
	setcookie('cart', base64_encode(serialize($cart)), time()+3600);
	$price+=$_POST[p24_price]*$_POST[p24_number];
	setcookie('price', $price, time()+3600);
	//$cart = unserialize($_COOKIE['cart']);
	//addItem("$_POST[p24_item_id]_$_POST[p24_number]");
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
				<div id="formCart" class="item">
					<h3>Twój koszyk</h3>
					<div class="cart">
						<form id="form_order" method="post" action="summary.php">
							<?php
							dbConnect();
							$sum=0;
							$count= sizeof($cart);
							if($count==0)echo "<span class=\"emptyCart\">Twój koszyk jest pusty. Przejdz na stronę główną i wybierz coś dla siebie</span>";else {
								echo "<span class=\"emptyCart\" style=\"display:none;\">Twój koszyk jest pusty. Przejdz na stronę główną i wybierz coś dla siebie</span>";
							
								echo "<div class=\"fullCart\"><ul>";
								foreach ($cart as $key => $value) {
									$row=mysql_fetch_row(mysql_query("SELECT * FROM item WHERE id=$key"));
									echo "<li id=\"$key\">"."\n".
											"<div class=\"itemPhoto\"><img alt=\"\" src=\"img/choppersCruiser.jpg\"></div>
											<div class=\"itemInfo\"><b>$row[1]</b></div>
											<div class=\"itemQuantity\">
											<button class=\"btnPlus\"> + </button>
											<input type=\"text\" value=\"$value\" class=\"quantity\" disabled=\"disabled\">
											<button class=\"btnMinus\"> - </button>
											</div>
											<div class=\"itemPrice price\">$row[4] zł</div>
											<div class=\"itemDelete\"></div>
											</li>
											";
								}
								
								echo "</ul>";
										echo"<br><br><hr>
										<div class=\"itemSum price\">Razem : $price zł</div>
										<select class=\"quantity delivery\">
										<option value=\"-1\">Wybierz sposób dostawy</option>
										<option disabled=\"disabled\">Płatne z góry</option>
										<option value=\"5\">List polecony priorytetowy : 5zł</option>
										<option disabled=\"disabled\">Płatne przy odbiorze</option>
										<option value=\"0\">Odbiór osobisty : 0zł</option>
										<option value=\"12.70\">Przesyłka pobraniowa biznesowa : 12.70zł</option>
										</select>
										<div class=\"deliverySum price\"></div>
										<hr>
										<div class=\"allSum price\">Do zapłaty : $price  zł</div>
										<button class=\"btn sell payForShopping\">Zapłać za zakupy</button>
										<button class=\"btn sell returnToShop\">Kontynuj zakupy</button>
										<br>
										<br>
										<div class=\"address\" style=\"display: none;\">
										<h3>Dane do wysyłki</h3>
										<input type=\"hidden\" name=\"z24_kwota\">
										<input type=\"hidden\" name=\"z24_delivery\">
										<input type=\"hidden\" name=\"z24_delivery_cost\">
										<label for=\"nameSurname\">Imie Nazwisko</label><input type=\"text\" name=\"k24_nazwa\" id=\"nameSurname\" value=\"\" class=\"quantity\" placeholder=\"Imię nazwisko\"><br>
										<label for=\"ulica\">Ulica i nr domu</label><input type=\"text\" name=\"k24_ulica\" id=\"ulica\" value=\"\" class=\"quantity\"><input type=\"text\" name=\"k24_numer_dom\" id=\"numer_dom\" value=\"\" class=\"quantity\"><br>
										<label for=\"kod\">Kod i miasto</label><input type=\"text\" name=\"k24_kod\" id=\"kod\" value=\"\" class=\"quantity\" placeholder=\"00-000\"><input type=\"text\" name=\"k24_miasto\" id=\"miasto\" value=\"\" class=\"quantity\"><br>
										<label for=\"email\">Adres Email</label><input type=\"text\" name=\"k24_email\" id=\"email\" value=\"\" class=\"quantity\"><br>
										<label for=\"telefon\">Nr telefonu</label><input type=\"text\" name=\"k24_telefon\" id=\"telefon\" value=\"\" class=\"quantity\">
										
										<br><br>
										<input id=\"p24_submit\" type=\"submit\" class=\"btn sell buyPay\" value=\"Kup\" name=\"submit_zamow\">
										<button class=\"btn sell cancel\">Anuluj</button>
										</div></div>";
							}
							mysql_close();
							?>
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
