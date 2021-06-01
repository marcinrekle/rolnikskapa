<?php 
include "../../../polacz.php";
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
readRss();
function addChannelForm(){
	echo "<form action=\"\" method=\"POST\" name=\"addChannel\">
	<input type=\"text\" name=\"addChannelUrl\">
	<input type=\"submit\" value=\"Dodaj\" name=\"addChannelBtn\">
	</form>";
}
function addChannel($url){
	$xml = simplexml_load_file($url);
	$title= $xml->channel->title;	
	$link= $xml->channel->link;
	$desc= $xml->channel->description;
	$image=$xml->channel->image->url;
	$ile=mysql_num_rows(mysql_query("SELECT * FROM channel where link='$url'"));
	if ($ile==0) {
		mysql_query("INSERT INTO channel VALUES('','$url','glowna','$title','$link','$description','$image')");
	}
}
mysql_close();
 ?>