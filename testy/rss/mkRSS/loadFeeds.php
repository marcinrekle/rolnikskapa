<?php 
include "../../../polacz.php";
empty($_POST[ch])? showItems("'$_POST[id]'"):showItemsFromFolder($_POST[ch]);
is_numeric($_POST[id])?$txt='tak':$txt='nie';
function showItems($channel){
	$query=mysql_query("SELECT * FROM item where channel=$channel ORDER BY pubDate DESC");
	while ($row = mysql_fetch_array($query)) {
		$licz+=1;
		$bgColor=mysql_fetch_array(mysql_query("SELECT * FROM channel where id=$row[channel]"));
		$hour=date('H:i',strtotime ($row[pubDate]) );
		$day=date('d.m.Y',strtotime ($row[pubDate]) );
		echo"
		<div class=\"item read$row[read]\" style=\"background:rgba($bgColor[color],.6);\" id=\"$row[id]\">
		<div class=\"content\">
		<div class=\"title\">
		<a href=\"$row[link]\">
		$row[title]</a>
		</div>
		<div class=\"desc2\">
		$row[description]
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
	while ($row = mysql_fetch_array($query)) {
		$ile=mysql_num_rows(mysql_query("Select * from channel where parent='$row[id]'"));
		if ($ile>0) {
			showItemsFromFolder($row[id]);
		}else
		$channelQuery.= ($channelQuery=='')? "'$row[id]' ": " OR channel='$row[id]'";
	}
	showItems($channelQuery);
}
mysql_close();
?>