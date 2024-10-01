<!-- Deze code is verantwoordelijk voor het verwijderen van de sessie en het terugsturen naar de login pagina -->
<?php

session_start();

session_destroy();

header('Location: ../public/?page=login.php');
exit();

?>