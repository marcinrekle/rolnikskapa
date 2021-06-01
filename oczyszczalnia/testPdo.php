<?php
try
{
	$pdoLcl = new PDO('mysql:host=localhost;dbname=plc_memory', 'root', '');
	$lclDataR = $pdoLcl	->query('SELECT id,value FROM plc_r WHERE id=1 OR id=4 OR id=93 OR id=96 OR id=117 OR id=185 OR id=188 OR id=51 OR id=54 OR id=160 OR id=87');
	$lclDataM = $pdoLcl ->query('SELECT id,value FROM plc_m WHERE id=20 OR id=138 OR id=3 OR id=6 OR id=144 OR id=207  OR id=206 OR id=208 OR id=70 OR id=268 OR id=53 OR id=56 OR id=274 OR id=210 OR id=209 OR id=211 OR id=93 OR id=77 OR id=78 OR id=79 OR id=76 OR id=94 OR id=95 OR id=214 OR id=213 OR id=212');
	$lclDataI = $pdoLcl ->query('SELECT id,value FROM plc_i WHERE id=1 OR id=2 OR id=7 OR id=8 OR id=17 OR id=18 OR id=23 OR id=24 OR id=33 OR id=34 OR id=25 OR id=26 OR id=30 OR id=31 OR id=32');
	$lclDataQ = $pdoLcl ->query('SELECT id,value FROM plc_q WHERE id=9 OR id=10 OR id=11 OR id=12 OR id=13 OR id=14 OR id=17 OR id=18 OR id=19 OR id=21 OR id=22');
	//$lclData = $pdoLcl ->prepare('SELECT id,value FROM plc_r WHERE id=:id');
	//$id=1;
	//$lclData->bindParam(':table','plc_r');
	//$lclData->bindParam(':id',$id, PDO::PARAM_INT);
	//$lclData->execute();
	unset($values);
	$values['plc_r']=$lclDataR->fetchAll();
	$values['plc_m']=$lclDataM->fetchAll();
	$values['plc_i']=$lclDataI->fetchAll();
	$values['plc_q']=$lclDataQ->fetchAll();
	
	
	$lclDataR->closeCursor();
	$lclDataM->closeCursor();
	$lclDataI->closeCursor();
	$lclDataQ->closeCursor();
}
catch(PDOException $e)
{
	echo 'B³¹d:'.$e->getMessage();
}

try
{
	$pdoNet = new PDO('mysql:host=db4free.net;dbname=oczrzasnia', 'rzasniauser', 'rzasniapassword');
	$pdoNet->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
	$update = $pdoNet -> prepare("INSERT INTO `plc_r` (`id`,`value`) VALUES (:id, :value) ON DUPLICATE KEY UPDATE value=:value");
	$tables=['plc_r','plc_m','plc_i','plc_q'];
	$update -> bindParam(':id',$id);
	$update -> bindParam(':value',$value);
	foreach($tables as $table){
	$update = $pdoNet -> prepare("INSERT INTO `$table` (`id`,`value`) VALUES (:id, :value) ON DUPLICATE KEY UPDATE value=:value");
	$update -> bindParam(':id',$id);
	$update -> bindParam(':value',$value);
	echo $table."<br>";
	
		foreach($values[$table] as $data){
			$id = $data['id'];
			$value = $data['value'];
			echo "$id : $value <br>";
			$update->execute();
			$err = $update -> errorInfo();
			echo $err[2];
		}
		$update->closeCursor();
	}
	$update->closeCursor();
}
catch(PDOException $e)
{
	echo 'B³¹d:'.$e->getMessage();
}

?>