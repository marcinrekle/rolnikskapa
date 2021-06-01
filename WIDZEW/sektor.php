<?php
    $URL = "https://www.ks-widzew.pl/stadion/?s=$_GET[s]&e=$_GET[e]";
    $domain = file_get_contents($URL);
    echo $domain;
?>