<?php
mysql_connect("db4free.net","rzasniauser","rzasniapassword") or die(mysql_error()."Nie mozna polaczyc sie z baza danych. Prosze chwile odczekac i sprobowac ponownie.");
mysql_select_db("oczrzasnia") or die(mysql_error()."Nie mozna wybrac bazy danych.");
mysql_query("SET CHARSET utf8");
mysql_query("SET NAMES 'utf8' COLLATE 'utf8_bin'");
function getValue($table,$id){
	$query="SELECT value FROM $table WHERE id=$id";
	$tmp=mysql_fetch_array(mysql_query($query));
	return $tmp[0];	
}
function setValue($table,$id,$newValue){
	mysql_query("UPDATE $table SET value=$newValue WHERE id=$id");
	//return "UPDATE $table SET value=$newValue WHERE id=$id";
}
function insertValue($table,$value){
	mysql_query("INSERT INTO $table VALUES('',$value)");
	
}
function isActiveGG($cond1,$cond2){
	//funkcja sprawdza warunek i zwraca klase green badz klase gray oraz sprawdza czy dodac takze klase active
	$cond1==1?$txt="green":$txt="gray";
	return $cond2==1&&$txt=="green"?$txt." active":$txt;
} 
function isActiveGR($cond1){
	//funkcja sprawdza warunek i zwraca klase green badz klase red
	return $cond1==1?"green":"red";
}
function isActiveGRP($cond1){
	//funkcja sprawdza warunek i zwraca klase green badz klase red
	return $cond1==1?"Green":"";
}
function isActiveGRG($cond1,$cond2){
	//funkcja sprawdza warunek i zwraca klase green badz klase red
	if($cond1!=1)return "";else {
		return $cond2==0?"Green":"Red";	
	}
}
function timeSpust($nap,$sed,$napTime,$sedTime){
	if($nap==1||$sed==1){
		return $nap==1?date("H:i",mktime(date("H"),date("i")+$napTime+$sedTime)):date("H:i",mktime(date("H"),date("i")+$sedTime));
	}
}
function timeSed($nap,$napTime){
	if($nap==1){
		return date("H:i",mktime(date("H"),date("i")+$napTime));
	}
}
?>