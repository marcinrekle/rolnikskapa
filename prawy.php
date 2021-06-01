<?php
include("polacz.php");
echo'<div class="panel" id="user">';
include("uzytkownik.php");

echo"</div>";
?>
<div class="shoutbox"><div class="tyt">Shoutbox</div>
<?php

include("mpshout/mpshout.php");
?>
</div>
<?php 
include "polacz.php";
echo "<div class=\"panel\">
<div class=\"tyt\">Najnowsze komentarze</div>";
$pyt=mysql_query("SELECT * FROM komentarz ORDER by id desc limit 5");
while ($row = mysql_fetch_row($pyt)) {
	$news=mysql_fetch_array(mysql_query("SELECT * FROM news2011 where id=$row[1]"));
	$link_news="$_SESSION[bez]news/$news[7]/$news[15]/$news[1].html";
	$text=substr($row[7], 0,30)."...";
	echo "<div class=\"naj_kom\">
	<a href=\"$link_news\">$news[14]</a><br>
	
	<a href=\"$link_news#kom$row[0]\">$text</a>
	</div>";
};

echo "</div>";
mysql_close();
?>
</div>