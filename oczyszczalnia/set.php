<?php
include 'function.php';
if($_POST['pass']=='7927642'){
	$tid=$_POST['tid'];
	$newVal=$_POST['newValue'];
	$tid=explode("_",$tid);
	mysql_query("UPDATE new_$tid[0] SET value=$newVal, flag=1 WHERE id=$tid[1]");
	echo "$newVal";
}else{
	echo "Błąd";
}
?>