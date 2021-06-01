<?php
include 'function.php';
$text = "
<html>
<head>
  
</head>
<body>
  <h3>Wiadomość od:<b>".validate($_POST[email])."</b></h3>
  <p>".validate($_POST[text])."
</body>
</html>
";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$headers .= "From: ".validate($_POST[email]). " \r\n";
	if(!mail("l-w-g@o2.pl",validate($_POST[subject]),$text,$headers))echo "{\"status\":\"BAD\"}";else echo "{\"status\":\"OK\"}";
	$error = error_get_last();
	//preg_match("/\d+/", $error["message"], $error);
	echo $error[message];

?>