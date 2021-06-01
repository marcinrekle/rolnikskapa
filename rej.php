<?php
include("polacz.php");
session_start();
sprawdz();
function formularz($komunikat){
if(is_numeric($_POST['rur'])) $r=$_POST['rur'];
echo'<div class="panel_rej"><div class="tyt">Rejestracja</div>
    <div class="rejestracja_opis">';
    if($komunikat=="")echo
    'Aby się zarejestrować w serwisie wypełnij poniższe
    pola i naciśnij <b>zarejestruj</b>. Pola oznaczone gwiazdką są obowiązkowe.';
    elseif($komunikat=="1") echo "Gratulacje ".$_POST['login']." właśnie zarejestrowałeś się w serwisie<br><a href=\"index.php\">Kliknij aby przejść na stronę główną</a></div></div>";
    elseif(($komunikat!="") AND ($komunikat!="1")) echo $komunikat;
if($komunikat!="1")echo
'</div><div class="rejestracja_txt">
    Login:*<br>
    Hasło:*<br>
    Powtórz hasło:*<br>
    email:*<br>
    Imię:* <br>
    Nazwisko: <br>
    Rok ur:* <br>
    Miejscowość:* <br><br>
    </div>
    <div class="rejestracja_form">
    <form action="rejestracja.php" name="rejestracja" method="post" >
    <input type="text" name="login" maxlenght="32" value="'.$_POST['login'].'" class="login"> <br>
    <input type="password" maxlenght="32" name="haslo" class="login"> <br>
    <input type="password" name="rhaslo" class="login"> <br>
    <input type="text" name="email" value="'.$_POST['email'].'" class="login"> <br>
    <input type="text" name="imie" value="'.$_POST['imie'].'" class="login"> <br>
    <input type="text" name="nazwisko" value="'.$_POST['nazwisko'].'" class="login"><br>
    <input type="text" name="rur" maxlenght="4" value="'.$r.'" class="login"> <br>
    <input type="text" name="miejscowosc" value="'.$_POST['miejscowosc'].'" class="login"> <br>
    <input type="submit" value="Zarejestruj" class="btn"><input type="reset" value="Reset" class="btn">
    </form>
    </div>
	 </div>';
}//formularz
function sprawdz(){
$login=$_POST['login'];
$mail=$_POST['emai'];
if(isset($_POST['login'])){
                           $nazwa=mysql_fetch_array(mysql_query("Select COUNT(*) from uzytkownik where login='".$login."' LIMIT 1"));
                           $maile=mysql_fetch_array(mysql_query("Select COUNT(*) from uzytkownik where email='".$mail."' LIMIT 1"));
                           $komunikat='Popraw następujące błędy:<br>';
                           if($nazwa[0]>=1) $komunikat.='Ten login jest już zajęty<br>';
                           if(empty($_POST['login'])) $komunikat.='Puste pole login<br>';
                           elseif ((strlen($login)<=5))$komunikat.='Login musi mieć conajmniej 5 znaków<br>';
                           if(empty($_POST['haslo'])) $komunikat.='Puste pole haslo<br>';
                           elseif (strlen($_POST['haslo'])<=5)$komunikat.='Hasło musi mieć conajmniej 5 znaków<br>';
                           if(empty($_POST['rhaslo'])) $komunikat.='Puste pole hasło<br>';
                           if($_POST['haslo']!=$_POST['rhaslo']) $komunikat.='Różne hasła<br>';
                           if($_POST['haslo']==$_POST['login']) $komunikat.='Login i hasło nie mogą być takie same <br>';
                           if(empty($_POST['email'])) $komunikat.='Puste pole email<br>';
                           if(spr_mail($maile)!='dobrze') $komunikat.='Już ktoś się rejestrował z tego adresu email<br>';
                           if(empty($_POST['imie'])) $komunikat.='Puste pole imie<br>';
                           if(empty($_POST['rur'])) {$komunikat.='Puste pole rok ur<br>';}
                           if(!is_numeric($_POST['rur'])) $komunikat.='Niewłasciwy format roku(np tekst)<br>';
                           elseif ((strlen($_POST['rur'])!=4))$komunikat.='Rok ur musi mieć 4 znaki<br>';
                           if(empty($_POST['miejscowosc'])) $komunikat.='Puste pole miejscowość<br>';
                           if ($komunikat!='Popraw następujące błędy:<br>') formularz($komunikat); else dodaj();
} else formularz(""); //if
}//sprawdz
function spr_mail($mail){
$mail1=explode("@",$mail);
if($mail1[1]=='o2.pl'){
$maile=mysql_fetch_array(mysql_query("Select COUNT(*) from uzytkownik where email='".$mail1[0]."@o2.pl' OR email='".$mail1[0]."@go2.pl' OR email='".$mail1[0]."@tlen.pl' LIMIT 1"));
}
$maile2=mysql_fetch_array(mysql_query("Select COUNT(*) from uzytkownik where email='".$mail."' LIMIT 1"));
if(($maile1[0]==0) AND ($maile2[0]==0)) return 'dobrze';
}//spr_mail
function dodaj(){
$login=substr(addslashes(htmlspecialchars($_POST['login'])),0,32);
$login=str_replace(' ','',$login);
$haslo = substr(addslashes($_POST['haslo']),0,32);
$haslo=md5($haslo);
mysql_query("insert into uzytkownik  ( id, login, haslo, imie, nazwisko, d_ur, miejscowosc, email) VALUES('','".$login."','".$haslo."','".$_POST['imie']."','".$_POST['nazwisko']."','".$_POST['rur']."','".$_POST['miejscowosc']."','".$_POST['email']."')");

formularz("1");
}//dodaj
?>
