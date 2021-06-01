<?php
function dbConnect(){
	//mysql_connect("127.0.0.1","root","") or die(mysql_error()."Nie mozna polaczyc sie z baza danych. Prosze chwile odczekac i sprobowac ponownie.");
	mysql_connect("mysql.cba.pl","admin_marcin","haslorolnik") or die(mysql_error()."Nie mozna polaczyc sie z baza danych. Prosze chwile odczekac i sprobowac ponownie.");
	
	
	mysql_select_db("rolnikskapa_cba_pl") or die(mysql_error()."Nie mozna wybrac bazy danych.");
	mysql_query("SET CHARSET utf8");
	mysql_query("SET NAMES 'utf8' COLLATE 'utf8_bin'");
	//mysql_query("CREATE DATABASE sklep");
	//mysql_query("INSERT INTO `item` (`id`, `name`, `desc`, `img`, `price`, `quantity`) VALUES
//(2, 'Cruiser Raider', 'Licznik świecący w ciemności. Wykonane z Polskiej Bawełny 100 % Produkt Polski I Gatunek', 'img/choppersCruiser.jpg', 45, NULL),
//(3, 'Trzecia', 'Licznik świecący w ciemności. Wykonane z Polskiej Bawełny 100 % Produkt Polski I Gatunek', 'img/choppersCruiser.jpg', 52, NULL)")or die(mysql_error()."nie utworzono tabeli") ;
	//mysql_close();
}
function showCart(){
	dbConnect();
	$sum=0;
	$count= sizeof($cart);
	if($count==0)echo"<span class=\"emptyCart\">Twój koszyk jest pusty. Przejdz na stronę główną i wybierz coś dla siebie</span>";else{
		
		echo "<ul>";
		for($counter=0;$counter<$count;$counter++){
			$item=explode("_",$cart[$counter]);
			$row=mysql_fetch_row(mysql_query("SELECT * FROM item WHERE id=$item[0]"));
			$sum+=$row[4]*$item[1];
			echo "<li>"."\n".
					"<div class=\"itemPhoto\"><img alt=\"\" src=\"img/choppersCruiser.jpg\"></div>
					<div class=\"itemInfo\"><b>$row[1]</b></div>
					<div class=\"itemQuantity\">
					<button class=\"btnPlus\"> + </button>
					<input type=\"text\" value=\"$item[1]\" class=\"quantity\">
					<button class=\"btnMinus\"> - </button>
					</div>
					<div class=\"itemPrice price\">$row[4] zł</div>
					<div class=\"itemDelete\">x</div>
					</li>
					";
		}
		echo "</ul>";
		echo"<br><br><hr>
					<div class=\"itemSum price\">Razem : $sum zł</div>
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
					<div class=\"allSum price\">Do zapłaty : $sum  zł</div>
					<button class=\"btn sell payForShopping\">Zapłać za zakupy</button>
					<button class=\"btn sell returnToShop\">Kontynuj zakupy</button>
					<br>
					<br>
					<div class=\"address\" style=\"display: none;\">
						<h3>Dane do wysyłki</h3>
						<form action=\"\">
						<label for=\"nameSurname\">Imie Nazwisko</label><input type=\"text\" name=\"k24_nazwa\" id=\"nameSurname\" value=\"\" class=\"quantity\" placeholder=\"Imię nazwisko\"><br>
						<label for=\"ulica\">Ulica i nr domu</label><input type=\"text\" name=\"k24_ulica\" id=\"ulica\" value=\"\" class=\"quantity\"><br>
						<label for=\"kod\">Kod i miasto</label><input type=\"text\" name=\"k24_kod\" id=\"kod\" value=\"\" class=\"quantity\" placeholder=\"00-000\"><input type=\"text\" name=\"k24_miasto\" id=\"miasto\" value=\"\" class=\"quantity\"><br>
						<label for=\"email\">Adres Email</label><input type=\"text\" name=\"k24_email\" id=\"email\" value=\"\" class=\"quantity\"><br>
						<label for=\"telefon\">Nr telefonu</label><input type=\"text\" name=\"telefon\" id=\"telefon\" value=\"\" class=\"quantity\">
						</form>
						<br><br>
						<input id=\"p24_submit\" type=\"submit\" class=\"btn sell buyPay\" value=\"Kup\" name=\"submit_zamow\">
						<button class=\"btn sell cancel\">Anuluj</button>
					</div>";
	}
	mysql_close();
}
function showItem(){
	dbConnect();
	$query=mysql_query("SELECT * FROM item");
		while ($row = mysql_fetch_row($query)) {
			echo"<div class=\"item\">
				<form name=\"p24\" action=\"cart.php\" method=\"post\" accept-charset=\"utf-8\">
					<div class=\"photo\">
						<img src=\"$row[3]\" alt=\"\" />
					</div>
					<div class=\"desc\">
					<h3>$row[1]</h3>
					<div class=\"txt\">$row[2]</div>
					<div class=\"price\">Cena : $row[4] zł</div>
					<input type=\"hidden\" name=\"p24_price\" value=\"$row[4]\" />
					<input type=\"hidden\" name=\"p24_item_id\" value=\"$row[0]\" />
					<div class=\"addToCart\">
					Ilość: 
					<input type=\"text\" name=\"p24_number\" value=\"1\" maxlength=\"4\" class=\"quantity\"/>
					<input type=\"submit\" name=\"submit\" value=\"Dodaj do koszyka\" class=\"btn\"/>
					<input type=\"hidden\" name=\"p24_add\" value=\"1\" />
					</div>
					</div>
				</form>
				</div>";
		}
	mysql_close();
}
switch ($_POST[foo]) {
	case "plusItem":plusItem($_POST[id]);break;
	case "plusItemN":plusItemN();break;
	case "minusItem":minusItem($_POST[id]);break;
	case "deleteItem":deleteItem($_POST[id]);break;
	default:
		;
	break;
}
function addItem($val){
	$cart = unserialize(base64_decode($_COOKIE['cart']));
	array_push($cart,$val);
	setcookie('cart', base64_encode(serialize($cart)), time()+3600);
	$cart = unserialize(base64_decode($_COOKIE['cart']));
}

function plusItemN(){
	//global $cart,$price;
	$cart = isset($_COOKIE['cart'])?unserialize(base64_decode($_COOKIE['cart'])):Array();
	$price = isset($_COOKIE['price'])?$_COOKIE['price']:0;
	$price+=$_POST[itemPrice]*($_POST[itemCount]-$cart[$_POST[id]]);
	$cart[$_POST[id]]=$_POST[itemCount];
	setcookie('cart', base64_encode(serialize($cart)), time()+3600);
	setcookie('price', $price, time()+3600);
	$allItemsCount = array_sum($cart);
	//echo "$_POST[id] $_POST[itemPrice] $price";
	//echo showPrice2($cart,$price);
	echo "{\"text\":\"".showPrice2($cart,$price)."\",\"allItemCount\":\"$allItemsCount\",\"price\":\"$price\",\"itemCount\":\"".$cart[$_POST[id]]."\"}";
}
function minusItem(){
	$cart = isset($_COOKIE['cart'])?unserialize(base64_decode($_COOKIE['cart'])):Array();
	$price = isset($_COOKIE['price'])?$_COOKIE['price']:0;
	$price-=$_POST[itemPrice]*($cart[$_POST[id]]-$_POST[itemCount]);
	$cart[$_POST[id]]=$_POST[itemCount];
	setcookie('cart', base64_encode(serialize($cart)), time()+3600);
	setcookie('price', $price, time()+3600);
	$allItemsCount = array_sum($cart);
	echo "{\"text\":\"".showPrice2($cart,$price)."\",\"allItemCount\":\"".$allItemsCount."\",\"price\":\"$price\",\"itemCount\":\"".$cart[$_POST[id]]."\"}";
}

function deleteItem($id){
	$cart = isset($_COOKIE['cart'])?unserialize(base64_decode($_COOKIE['cart'])):Array();
	$price = isset($_COOKIE['price'])?$_COOKIE['price']:0;
	$price=$price-($_POST[itemPrice]*$_POST[itemCount]);
	unset($cart[$id]);
	$size = sizeof($cart);
	if($size==0)$price=0;
	$size==0?(setcookie('cart', "", time()+3600)):(setcookie('cart', base64_encode(serialize($cart)), time()+3600));
	setcookie('price', $price, time()+3600);
	$allItemsCount = array_sum($cart);
	echo "{\"text\":\"".showPrice2($cart,$price)."\",\"size\":\"".$size."\",\"allItemCount\":\"".$allItemsCount."\",\"price\":\"$price\"}";
}
function showPrice2($cart,$price){
	$count = array_sum($cart);
	if ($count==0) return "Koszyk jest pusty"; elseif ($count==1) return "produkt";elseif ($count==2||$count==3||$count==4) return "produkty";else return "produktów";
}
function showPrice(){
	//$cart = isset($_COOKIE['cart'])?unserialize(base64_decode($_COOKIE['cart'])):Array();
	//$price = isset($_COOKIE['price'])?$_COOKIE['price']:0;
	global $cart,$price;
	$count = array_sum($cart);
	if ($count==0) echo "<span id=\"itemsCount\"></span>Koszyk jest pusty<span id=\"itemsPrice\"></span>"; elseif ($count==1) echo "<span id=\"itemsCount\">1</span> produkt za <span id=\"itemsPrice\">$price</span> zł";elseif ($count==2||$count==3||$count==4) echo "<span id=\"itemsCount\">$count</span> produkty za <span id=\"itemsPrice\">$price</span> zł";else echo "<span id=\"itemsCount\">$count</span> produktów za <span id=\"itemsPrice\">$price</span> zł";
}
function testGlobal(){
	global $price;
	echo "price = $price";
}
function validate($txt){
	return trim(strip_tags($txt));
}
?>