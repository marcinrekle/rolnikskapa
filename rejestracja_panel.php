<h5>Tworzenie nowego konta w serwisie</h5>
<a id="start" href="javascript:rejestracja()" class="btn">START</a>
<form action="" method="post" onsubmit="return false" id="rej" style="display:none">
<label for="login">Login(5-32)</label><input type="text" maxlength="32" name="login" id="login"><br>
<label for="haslo">Hasło(5-32)</label><input type="password" maxlength="32" name="haslo" id="haslo"><br>
<label for="phaslo">Powtórz hasło</label><input type="password" maxlength="32" name="phaslo" id="phaslo"><br>
<label for="email">E-mail(32)</label><input type="text" name="email" maxlength="32" id="email"><br>
<label for="miej">Miejscowość(32)</label><input type="text" name="miej" maxlength="32" id="miej"><br>
<label for="imie">Imię(20)</label><input type="text" name="imie" maxlength="20" id="imie"><br>
<input type="submit" name="rejestruj" value="Rejestruj" id="rejestruj" class="btn">
<a href="javascript:usun('#panelRej')" class="btn">Zamknij</a>
<br>
</form>
