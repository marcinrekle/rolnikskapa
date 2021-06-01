<?php 
global $txt;
include '../../../polacz.php';
unread(0);
$txt.="
<div id=\"refresh\" class=\"btn\">Odśwież</div><div id=\"addChannel\" class=\"btn\">Dodaj</div><div class=\"rssMenu\">";
$row=mysql_fetch_array(mysql_query("SELECT * FROM channel where parent='0'"));
if($row[unread]>0){$ur=" ($row[unread])";$class=" unread";}
$txt.="<div class=\"folder\" id=\"folder$row[id]\"><div class=\"arrow arrowDown\"></div>
		<a href=\"ch=$row[id]\" class=\"$class\">$row[title]
		<div class=\"nonread\" id=\"nr_$row[id]\">$ur</div>
		</a>
		<div class=\"$hide\" id=\"folder$row[id]-content\">
		";
		child($row[id]);
		$txt.="</div></div>";
$txt.="</div>";
echo $txt;
echo "<div id=\"licznik\">0</div>";
function child($parent){
global $txt;
global $ileFolder;
$lvl++;	
$lvlName=array('zero','first','second','third');
$query=mysql_query("SELECT * FROM channel where parent='$parent' ORDER BY id ASC");
while ($row = mysql_fetch_array($query)) {
	$row[title]=(strlen($row[title])>15)?substr($row[title],0,15)."...":substr($row[title],0,15);
	$ile=mysql_num_rows(mysql_query("SELECT * FROM channel where parent='$row[id]'"));
	if($row[unread]>0){$ur=" ($row[unread])";$class="unread";}
	if ($ile>0) {
		$hide=($row[id]==1)?"":"hide";
		$txt.="<div class=\"folder\" id=\"folder$row[id]\"><div class=\"arrow arrowLeft\"></div>
		<a href=\"ch=$row[id]\" class=\"$class\">$row[title]
		<div class=\"nonread\" id=\"nr_$row[id]\">$ur</div>
		</a>
		<div class=\"$hide\" id=\"folder$row[id]-content\">
		";
		child($row[id]);
		$txt.="</div></div>";
	}else{
		$txt.="<div class=\"feed\">
		<a href=\"id=$row[id]\" class=\"$class\">
		$row[title] <div class=\"nonread\" id=\"nr_$row[id]\">$ur</div>
		</a>
		</div>
		";
	}
}
}
function unread($parent){
global $jsonUnread;
global $ileFolder;
global $unreadCount;
$unreadCount=0;
$lvl++;	
$lvlName=array('zero','first','second','third');
$query=mysql_query("SELECT * FROM channel where parent='$parent' ORDER BY id ASC");
while ($row = mysql_fetch_array($query)) {
	$ile=mysql_num_rows(mysql_query("SELECT * FROM channel where parent='$row[id]'"));
	if ($ile>0) {
		unread($row[id]);
	}else{
		$count=mysql_num_rows(mysql_query("SELECT * FROM item WHERE channel='$row[id]' AND `read`=0"));
		mysql_query("UPDATE channel SET unread=$count WHERE id=$row[id]");
		$unreadCount+=$count;
	}
	
}
mysql_query("UPDATE channel SET unread=$unreadCount WHERE id=$parent");
}
mysql_close();
?>