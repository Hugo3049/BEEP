<?php

function Login() {
    $pdo = dBConnect();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $pdo->prepare('SELECT * FROM gebruikers WHERE BINARY username = ? AND BINARY password = ?');
    $query->execute([$username, $password]);
    $user = $query->fetch();

    if ($user) {
        $_SESSION['loggedInUser'] = $user;
        
        // Controleer de rol van de gebruiker en stuur ze door naar de juiste pagina
        switch ($user['rights']) {
            case 'Admin':
                header('Location: ?page=admin&type=admin-dashboard');
                break;
            case 'Writer':
                header('Location: ./?page=writer&type=writer-dashboard');
                break;
            case 'Reader':
                header('Location: ./?page=reader&type=reader-dashboard');
                break;
            default:
                // Als de rol niet overeenkomt met Admin, Writer of Reader, doorsturen naar de standaardpagina
                header('Location: ./beep/public/');
                break;
        }
        exit();
    } else {
        // Als er geen gebruiker gevonden is met de opgegeven gegevens
        $fault = "Ongeldige gebruikersnaam of wachtwoord.";
    }
}

function isLoggedIn() {
    return isset($_SESSION['loggedInUser']);
}

?>