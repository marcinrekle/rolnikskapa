<?php
function dodaj_zero($dana){
	if ($dana<10)
	return '0'.$dana; else return $dana;
}
function dzien_tyg(){
	$dzis=getDate();
	switch($dzis['wday']){
		case 0 :$dzien="niedziela";break;
		case 1 :$dzien="poniedziałek";break;
		case 2 :$dzien="wtorek";break;
		case 3 :$dzien="środa";break;
		case 4 :$dzien="czwartek";break;
		case 5 :$dzien="piątek";break;
		case 6 :$dzien="sobota";break;
	}
	return $dzien;
}
function mies(){
	$dzis=getDate();
	switch($dzis['mon']){
		case 1 :$mies="styczeń";break;
		case 2 :$mies="luty";break;
		case 3 :$mies="marzec";break;
		case 4 :$mies="kwiecień";break;
		case 5 :$mies="maj";break;
		case 6 :$mies="czerwiec";break;
		case 7 :$mies="lipiec";break;
		case 8 :$mies="sierpień";break;
		case 9 :$mies="wrzesień";break;
		case 10 :$mies="październik";break;
		case 11 :$mies="listopad";break;
		case 12 :$mies="grudzień";break;
	}
	return $mies;
}
function jaki_mies($m){
	switch($m){
		case 1 :$mies="styczeń";break;
		case 2 :$mies="luty";break;
		case 3 :$mies="marzec";break;
		case 4 :$mies="kwiecień";break;
		case 5 :$mies="maj";break;
		case 6 :$mies="czerwiec";break;
		case 7 :$mies="lipiec";break;
		case 8 :$mies="sierpień";break;
		case 9 :$mies="wrzesień";break;
		case 10 :$mies="październik";break;
		case 11 :$mies="listopad";break;
		case 12 :$mies="grudzień";break;
	}
	return $mies;
}
function pobierz($co,$tabela,$warunek1,$warunek2){
	$wynik=mysql_fetch_array(mysql_query("SELECT ".$co." FROM ".$tabela." WHERE ".$warunek1."=".$warunek2 ));
	if ($co=="*") {
		return $wynik;
	}else
	return $wynik[0];

}
function pobierz_bw($co,$tabela){
	$zapytanie=mysql_query("SELECT ".$co." FROM ".$tabela);
	$wynik=mysql_fetch_array($zapytanie);
	if ($co=="*") {
		return $wynik;
	}else
	return $wynik[0];
}
function ile($tabela){
	$wynik=mysql_num_rows(mysql_query("SELECT * FROM ".$tabela));
	return $wynik;
}

function ile_w($tabela,$where){
	$wynik=mysql_num_rows(mysql_query("SELECT * FROM ".$tabela.$where));
	return $wynik;
}
function data($data,$znak,$zwrot){
	$data=explode($znak,$data);
	if ($zwrot=="") {
		return $data;
	}else
	return $data[0].$zwrot.$data[1].$zwrot.$data[2];
}
function godz($godz){
	$godz=explode(":",$godz);
	return $godz[0].":".$godz[1];
}
function update($tabela,$co,$war){
	mysql_query("UPDATE ".$tabela." SET ".$co." WHERE ".$war);
}
function insert($tabela,$co,$war){
	mysql_query("INSERT INTO $tabela ($co) VALUES ($war)");
}
function insert_w($tabela,$co,$war,$where){
	mysql_query("INSERT INTO $tabela ($co) VALUES ($war) $where");
}
function make_time($r,$m,$d,$g,$min,$s){
	Return mktime($g,$min,$s,$m,$d,$r);
}
function browser($uagent){
	$ua=strtolower($uagent);
	$platform="unknown";
	$name="unknown";
	$version="unknown";
	if (preg_match('/windows|win32/i', $ua)) {
		$platform='Windows';
		if(preg_match('/nt 6.1/i', $ua)) $platform.=' 7';
		if(preg_match('/nt 6.0/i', $ua)) $platform.=' Vista';
		if(preg_match('/nt 5.1/i', $ua)) $platform.=' XP';
		if(preg_match('/nt 5.0/i', $ua)) $platform.=' 2000';
		if(preg_match('/nt 6.2/i', $ua)) $platform.=' 8';
	}elseif (preg_match('/linux/i', $ua)) {
		$platform = 'Linux';
	}
	elseif (preg_match('/macintosh|mac os x/i', $ua)) {
		$platform = 'Mac OS X';
	}
	elseif (preg_match('/Android/i', $ua)) {
		$platform = 'Android';
	}
	if(preg_match('/MSIE/i',$ua) && !preg_match('/Opera/i',$ua))
	{
		$name = 'Internet Explorer';
		$ub = "MSIE";
	}
	elseif(preg_match('/Firefox/i',$ua))
	{
		$name = 'Mozilla Firefox';
		$ub = "Firefox";
	}
	elseif(preg_match('/Chrome/i',$ua))
	{
		$name = 'Google Chrome';
		$ub = "Chrome";
	}
	elseif(preg_match('/Safari/i',$ua))
	{
		$name = 'Apple Safari';
		$ub = "Safari";
	}
	elseif(preg_match('/Opera/i',$ua))
	{
		$name = 'Opera';
		$ub = "Opera";
	}
	elseif(preg_match('/Netscape/i',$ua))
	{
		$name = 'Netscape';
		$ub = "Netscape";
	}
	elseif(preg_match('/Opera Mini/i',$ua))
	{
		$name = 'Opera Mini';
		$ub = "Opera Mini";
	}
	$known = array('Version',$ub,'Other');
	$pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if (!preg_match_all($pattern, $uagent, $matches)) {
	}

	if ($i != 1) {
		if (strripos($uagent,"Version") < strripos($uagent,$ub)){
			$version= $matches['version'][0];
		}
		else {
			$version= $matches['version'][1];
		}
	}
	else {
		$version= $matches['version'][0];
	}
	Return Array(
    	'os' => $platform,
    	'name' => $name,
    	'version' => $version 
	);

}
function sklad(){
	$sklad="P 1 1 BR G C Z K,RZ 2 1 LO Z K,P 1 1 BR G C Z K,RZ 2 1 LO Z K,P 1 1 BR G C Z K,RZ 2 1 LO Z K,P 1 1 BR G C Z K,RZ 2 1 LO Z K,P 1 1 BR G C Z K,RZ 2 1 LO Z K,P 1 1 BR G C Z K,RZ 2 1 LO Z K";
	$s=explode(",", $sklad);
	echo '<div class="news_sklad">
	<div class="belka">Skład</div>
	<div class="news_sklad_p">';
	$zaw=explode(" ", $s[0]);
	echo "<div class=\"zawodnik\"><div class=\"nr\">$zaw[2]</div>";
	for ($i = 0; $i < 10; $i++) {
		
	}
	echo"</div>";//zaw
	echo "</div>";//news_sklad_p
	echo"</div>";//news_sklad
}
?>