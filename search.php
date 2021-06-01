<?php
header("Content-Type: text/html; charset=UTF-8");
include 'polacz.php';
//include 'db.php';
$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

// query
//$sql = "SELECT description as value,id FROM kadra WHERE description LIKE '%:term%'";
//$q = $conn->prepare($sql);
//$q->execute(array($title));


//$q->setFetchMode(PDO::FETCH_BOTH);

// fetch
//while($r = $q->fetch()){
	//print_r($r);
//}

$qstring = "SELECT CONCAT_WS(  ' ', nazwisko, imie ) AS label, id as value , imie , nazwisko FROM kadra WHERE nazwisko or imie LIKE '%$term%' or imie LIKE '%$term%'";
$result = mysql_query($qstring);//query the database for entries containing the term
$json="[";
while ($row = mysql_fetch_array($result))//loop through the retrieved values
{
	$val=(int)$row['value'];
	$lab=htmlentities(stripslashes($row['label']));
	$row['value']=$lab;
	$row['label']=$lab;
	//$row['label2']=htmlentities(stripslashes($row['label']))." -> ".$row['value'];
	$row_set[] = $row;//build an array
	$row['value']=$val;
	$row['label']=$lab." -> $val";
	$row_set[] = $row;
	$json.=$json=="["?"{\"$row[label]\":\"$row[value]\"},{\"$row[label]\":\"$row[label]\"}":",{\"$row[label]\":\"$row[value]\"},{\"$row[label]\":\"$row[label]\"}";
}
$qstring = "SELECT nazwa AS label, id as value FROM druzyny WHERE nazwa LIKE  '%$term%'";
$result = mysql_query($qstring);//query the database for entries containing the term

while ($row = mysql_fetch_array($result,MYSQL_ASSOC))//loop through the retrieved values
{
	$val=(int)$row['value'];
	$lab=htmlentities(stripslashes($row['label']));
	$row['value']=$lab;
	$row['label']=$lab;
	//$row['label2']=htmlentities(stripslashes($row['label']))." -> ".$row['value'];
	$row_set[] = $row;//build an array
	$row['value']=$val;
	$row['label']=$lab." -> $val";
	$row_set[] = $row;
	$json.=",{\"$row[label]\":\"$row[value]\"},{\"$row[label]\":\"$row[label]\"}";
}
$json.="]";
//echo "$json<br>";
echo json_encode($row_set);//format the array into json data
?>