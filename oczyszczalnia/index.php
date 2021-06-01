<?php
echo"
<!DOCTYPE html>
<html>
<head>
<title>Monitoring Gminnej Oczyszczalni Ścieków w Rząśni</title>
<meta name=\"description\" content=\"Gminna Oczyszczalnia Ścieków w Rząśni\">
<meta name=\"keywords\" content=\"\">
<meta name=\"author\" content=\"Marcin Kazuba\">
<meta charset=\"UTF-8\">
<meta http-equiv=\"refresh\" content=\"300\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
<script type=\"text/javascript\" src=\"html5.js\"></script>
<script type=\"text/javascript\" src=\"jquery.js\"></script>
<script type=\"text/javascript\" src=\"script.js\"></script>

</head>

<body>
<div id=\"contener\">
<aside id=\"INFORMACJE\"></aside>
	<div id=\"TRESC\" class=\"\">
		<div id=\"contentTresc\">
			<div id=\"zbiorniki\">";
			include 'zbiorniki.php';	
			echo"</div>
			<div id=\"info\" class=\"logi\"><div id=\"dateAndTime\" class=\"black3d\"><div id=\"time\"></div><div id=\"date\"><div id=\"dateDay\"></div><div id=\"dateDate\"></div></div><div id=\"plcState\" ><img src=\"img/monitor6.png\"/></div><div id=\"todoIcon\">12</div><div id=\"alarmIcon\">0</div></div><div class=\"infoMenu\"><input type=\"radio\" id=\"cbIMspusty\" name=\"infoMenuItem\"><label for=\"cbIMspusty\">Spusty</label><input type=\"radio\" id=\"cbIMall\"  name=\"infoMenuItem\" checked=\"checked\"><label for=\"cbIMall\">Wszystko</label></div>
				<div class=\"infoContent\">";
					
				echo"</div></div>
			</div>
		<footer id=\"STOPKA\">&copy; Marcin Kazuba</footer>
		</div>
	</div>
		<div id=\"popup\">
			<div id=\"popupContent\">
				<span>Podaj nową nastawę</span><br><hr><br>
				<input type=\"text\" name=\"PopupNewValue\" id=\"PopupNewValue\"><br>
				<input type=\"password\" name=\"PopupPass\" id=\"PopupPass\" value=\"hasło\"><br><hr>
				<button class=\"submit\">OK</button><button class=\"cancel\">Anuluj</button>
				<div id=\"popupLog\"></div>
			</div>
		</div>
		<div id=\"popupAlarm\">
			<div id=\"popupAlarmContent\">
				<span>Podaj nową nastawę</span><br>
				<input type=\"text\" name=\"PopupNewValue\" id=\"PopupNewValue\"><br>
				<button class=\"submit\">OK</button><button class=\"cancel\">Anuluj</button>
			</div>
		</div>
		<div id=\"popupTask\">
			<div id=\"popupTaskContent\">
				<span>Podaj nową nastawę</span><br>
				<input type=\"text\" name=\"PopupNewValue\" id=\"PopupNewValue\"><br>
				<button class=\"submit\">OK</button><button class=\"cancel\">Anuluj</button>
			</div>
		</div>
</body>

</html>";
//include 'plcInfoCheck.php';		
?>