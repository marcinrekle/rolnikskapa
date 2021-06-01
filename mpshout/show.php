<link href="shout.css" rel="stylesheet" type="text/css">
<?php
/*
MPShout 0.1
By Morgan Andersson
www.morgande.com
*/
require_once "mpcfg.php";

	$db = mysql_connect($dbaddress,$username,$password); if (!$db) die("Could'nt connect to the database");
	mysql_select_db($mysqldb,$db) or die ("Could'nt open $db: ".mysql_error() );
mysql_query("SET CHARSET utf8");
mysql_query("SET NAMES 'utf8' COLLATE 'utf8_bin'");	
$showquery = mysql_query("SELECT * FROM mpshout ORDER BY shoutID DESC");

echo "<span class=\"shoutwindow\">";

while($row = mysql_fetch_array($showquery))
{
	$message = $row['shoutMessage'];

	$message = str_replace(":)","<img src='shoutimages/smile.gif' border='0'>",$message);
	$message = str_replace(":D","<img src='shoutimages/bigsmile.gif' border='0'>",$message);
	$message = str_replace("8D","<img src='shoutimages/cool.gif' border='0'>",$message);
	$message = str_replace(":(!","<img src='shoutimages/angry.gif' border='0'>",$message);
	$message = str_replace(":(","<img src='shoutimages/frown.gif' border='0'>",$message);
	$message = str_replace(":P","<img src='shoutimages/tongue.gif' border='0'>",$message);
	$message = str_replace(";)","<img src='shoutimages/wink.gif' border='0'>",$message);
	echo "<b>".$row['shoutName']."</b> ";
	
	echo "<em>".$row['shoutDate']." ";
	echo $row['shoutTime']."</em><br>";
	echo $message."<br>";
	echo "<hr width=100% size=1 color=black>";
}
echo "</span>";
mysql_close($db);
?>