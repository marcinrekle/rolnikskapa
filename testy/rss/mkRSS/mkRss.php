<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>mkRSS</title>
<link rel="stylesheet" type="text/css" href="styl.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="skrypt.js"></script>
<script type="text/javascript">

</script>


</head>
<body>
<div id="kontener">
<?php 
echo "<div id=\"lewa\">";
include 'lewa.php';
echo "</div>";
?>
<div id="tresc">
<div id="contentRss">
<?php 
include "../../../polacz.php";
empty($_GET[ch])? showItems("'$_GET[id]'"):showItemsFromFolder($_GET[ch]);
is_numeric($_GET[id])?$txt='tak':$txt='nie';
function showItems($channel){
	$query=mysql_query("SELECT * FROM item where channel=$channel ORDER BY pubDate DESC");
	while ($row = mysql_fetch_row($query)) {
		$licz+=1;
		$bgColor=mysql_fetch_array(mysql_query("SELECT * FROM channel where id=$row[1]"));
		$hour=date('H:i',strtotime ($row[4]) );
		$day=date('d.m.Y',strtotime ($row[4]) );
		echo"
		<div class=\"item\" style=\"background:rgba($bgColor[7],.6);\">
		<div class=\"content\">
		<div class=\"title\">
		<a href=\"$row[3]\">
		$row[2]</a>
		</div>
		<div class=\"desc2\">
		$row[5]
		</div>
		</div>
		<div class=\"info\">$hour<br>$day</div>
		</div>
		";
	}
}
function showItemsFromFolder($channel){
	$channelQuery='';
	$query=mysql_query("Select * from channel where parent='$channel'");
	while ($row = mysql_fetch_row($query)) {
		$channelQuery.= ($channelQuery=='')? "'$row[0]' ": " OR channel='$row[0]'";
	}
	showItems($channelQuery);
}
mysql_close();
?>

</div>
</div>
</div>
</body>
</html>