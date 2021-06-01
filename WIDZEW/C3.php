<?php
    $URL = "https://www.ks-widzew.pl/stadion/?s=C3&e=193";

    $domain = file_get_contents($URL);
    echo $domain;
?>