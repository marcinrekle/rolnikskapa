<?php 
include '../../../polacz.php';
if($_POST[act]='updateUnread')updateUnreadItem($_POST[id],$_POST[value]);
function updateUnreadItem($id,$value){
	mysql_query("UPDATE item SET `read`=$value WHERE id=$id");
}
readRss();
$jsonUnread.="<div id=\"jsonData\" style=\"display:none\">{\"nr_01\":\"nr_01\"";
unread(0);
$jsonUnread.="}</div>";
echo $jsonUnread;
function unread($parent){
global $jsonUnread;
global $ileFolder;
global $unreadCount;
$unreadCount=0;
$query=mysql_query("SELECT * FROM channel where parent='$parent' ORDER BY id ASC");
while ($row = mysql_fetch_array($query)) {
	$ile=mysql_num_rows(mysql_query("SELECT * FROM channel where parent='$row[id]'"));
	if ($ile>0) {
		unread($row[id]);
	}else{
		$count=mysql_num_rows(mysql_query("SELECT * FROM item WHERE channel='$row[id]' AND `read`=0"));
		mysql_query("UPDATE channel SET unread=$count WHERE id=$row[id]");
		$unreadCount+=$count;
		$jsonUnread.=", \"nr_$row[id]\" : $count";	
	}
	
}
mysql_query("UPDATE channel SET unread=$unreadCount WHERE id=$parent");
$jsonUnread.=", \"nr_$parent\" : $unreadCount";	
}

function readRss(){
	$query=mysql_query("Select * from channel");
	while ($row = mysql_fetch_array($query)) {
		$ile=mysql_num_rows(mysql_query("SELECT * FROM channel where parent='$row[id]'"));
		if ($ile==0)readRssItem($row[link]);
}
}
function readRssItem($adres){
  $xml = simplexml_load_file($adres);
	for ($i = 0; $i < sizeof($xml->channel->item); $i++) {
		$pd=date('Y-m-d H:i:s',strtotime ($xml->channel->item[$i]->pubDate) );
		$ct=$xml->channel->title;
		$link=$xml->channel->item[$i]->link;
		$ile=mysql_num_rows(mysql_query("Select * from item where pubDate='$pd' and link='$link'"));
		$id=mysql_fetch_array(mysql_query("SELECT id FROM channel where title='$ct'"));
		if ($ile==0) {
			$it=znaki($xml->channel->item[$i]->title,2);
			$description=znaki($xml->channel->item[$i]->description,2); 
			mysql_query("INSERT INTO item VALUES('',$id[0],'$it','$link','$pd','$description','0')");
		}
	}	
}
function znaki($string,$v) 
{ 
	if ($v==1) {
		$string = str_replace(array("&lt;", "&gt;", '&amp;', '&#039;', '&quot;','&lt;', '&gt;'), array("<", ">",'&','\'','"','<','>'), htmlspecialchars_decode($string, ENT_NOQUOTES));
	}else
   $string = str_replace( array("<", ">",'&','\'','"','<','>'),array("&lt;", "&gt;", '&amp;', '&#039;', '&quot;','&lt;', '&gt;'), htmlspecialchars_decode($string, ENT_NOQUOTES)); 

       return $string; 
   
} 
mysql_close();
?>