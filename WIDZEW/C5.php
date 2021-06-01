<?php
    $URL = "https://www.ks-widzew.pl/stadion/?s=C5&e=193";

    $domain = file_get_contents($URL);
    echo $domain;
?>