<?php
include 'function.php';
include 'update.php';
echo
"<div id=\"contentTresc\">
<div id=\"zbiorniki\">
";
include 'zbiorniki.php';
echo"
</div>

<div id=\"info\" class=\"logi\"><div id=\"dateAndTime\"></div><div class=\"infoMenu\"><input type=\"radio\" id=\"cbIMspusty\" name=\"infoMenuItem\"><label for=\"cbIMspusty\">Spusty</label><input type=\"radio\" id=\"cbIMall\"  name=\"infoMenuItem\" checked=\"checked\"><label for=\"cbIMall\">Wszystko</label></div>
		<div class=\"infoContent\">";
include "event.php";
echo"</div></div>
</div>
<footer id=\"STOPKA\">&copy; Marcin Kazuba</footer>
"
;
?>