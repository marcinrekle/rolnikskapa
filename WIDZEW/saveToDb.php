<?php 
include '../polacz.php';
mysql_query("UPDATE WidzewMecze SET ilosc = '$_REQUEST[ilosc]',fans='$_REQUEST[schema]' WHERE id=$_REQUEST[id]") or die("Błąd : ".mysql_error());
mysql_query("UPDATE WidzewLicznik SET count=count+1 WHERE id=3");
mysql_close();
//$data = date("d-m-Y h:m:s");
//mysql_query("UPDATE WidzewMecze SET ilosc = '$data' WHERE id=$_REQUEST[id]");
?>