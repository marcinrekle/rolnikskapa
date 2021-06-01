<?php
$location = 'galeria/2011/news/' . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $location)) {
   echo "Plik został załadowany poprawnie...";
} else {
   echo basename($_FILES['userfile']['name']);
}
echo $location;
?>