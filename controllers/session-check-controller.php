<?php

$pdo = dBConnect();

// Kijkt of de gebruiker is ingelogd
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: ../public/?page=login');
    exit();
}

// Zet een timer voor de inactiviteit
$inactiveLimit = 15 * 60;
if (isset($_SESSION['lastActivity']) && time() - $_SESSION['lastActivity'] > $inactiveLimit) {
    session_unset();
    session_destroy();
    header('Location: ../public/?page=login');
    exit();
}

$_SESSION['lastActivity'] = time();

// Controleer of de gebruiker de juiste rechten heeft
// if ($_SESSION['loggedInUser']['rights'] !== 'Admin') {
//     header('Location: /'); // Stuur gebruikers zonder adminrechten terug naar de inlogpagina
//     exit();
// }