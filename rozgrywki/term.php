<?
mysql_connect("mysql.cba.pl","admin_marcin","haslorolnik") or die(mysql_error()."Nie mozna polaczyc sie z baza danych. Prosze chwile odczekac i sprobowac ponownie.");
mysql_select_db("rolnikskapa_cba_pl") or die(mysql_error()."Nie mozna wybrac bazy danych.");
wypisz();
function wypisz(){
echo '<div class="terminarz">'."\n".'<div class="t_tytul">Terminarz sezonu 2010/11 1-ej grupy B Klasy </div>';
kolejka(1,'28/29 08 2010');
kolejka(2,'4/5 09 2010');
kolejka(3,'11/12 09 2010');
kolejka(4,'18/19 09 2010');
kolejka(5,'25/26 09 2010');
kolejka(6,'2/3 10 2010');
kolejka(7,'09/10 10 2010');
kolejka(8,'16/17 10 2010');
kolejka(9,'23/24 10 2010');
kolejka(10,'30/31 10 2010');
kolejka(11,'06/07 11 2010');
kolejka(12,'03 04 2011');
kolejka(13,'09/10 04 2011');
kolejka(14,'17 04 2011');
kolejka(15,'30 04 2011');
kolejka(16,'03 05 2011');
kolejka(17,'08 05 2011');
kolejka(18,'14/15 05 2011');
kolejka(19,'22 05 2011');
kolejka(20,'28/29 05 2011');
kolejka(21,'05 06 2011');
kolejka(22,'12 06 2011');
echo '</div>';
}
function kolejka($nr_k,$dni){
$d=mysql_fetch_array(mysql_query("Select id from mecze where nr_k='".$nr_k."'"));
echo '<div class="t_kolejka">'."\n".
     '<div class="t_kolejka_t">'.$nr_k.' Kolejka '.$dni.'</div>';
for($a=$d[0];$a<=$d[0]+5;$a++){
$data=explode("-",pobierz(data,$a));
$g=explode(":",pobierz(godz,$a));
echo '<div class="t_mecz">'."\n".
'<div class="t_data">'.$data[0].' '.$data[1].' '.$data[2].'</div>'."\n".
'<div class="t_godz">'.$g[0].':'.$g[1].'</div>'."\n".
'<div class="t_gosp">'.nazwa_d(pobierz(id_h,$a)).'</div><div class="t_kreska"> - </div>
<div class="t_gosc"> '.nazwa_d(pobierz(id_a,$a)).'</div>'.
'<div class="t_wynik">'.pobierz(wynik,$a);
if (pobierz(walk,$a)==1) echo'<small>(wo)</small>';
echo'</div>'."\n".'</div>';

}//for
echo'</div>';
}//kolejka
function pobierz($co,$id){
$wynik=mysql_fetch_array(mysql_query("SELECT ".$co." FROM mecze WHERE id='".$id."'"));
return $wynik[0];
}
function nazwa_d($id){
$wynik=mysql_fetch_array(mysql_query("SELECT nazwa FROM druzyny WHERE id='".$id."'"));
return $wynik[0];
}
?>
