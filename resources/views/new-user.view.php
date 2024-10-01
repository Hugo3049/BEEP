<?php

$pdo = dBConnect();

$fault = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Controleer of alle vereiste velden zijn ingevuld
    if (isset($_POST['username']) && isset($_POST['Email']) && isset($_POST['password'])) {
        // Ontvang de ingevoerde gegevens van het formulier
        $username = $_POST['username'];
        $email = $_POST['Email'];
        $password = $_POST['password'];

        // Voeg de standaard rechten toe
        $rights = 'Reader';

        // Controleer of de gebruikersnaam al bestaat
        $query = "SELECT COUNT(*) AS count FROM gebruikers WHERE username = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result['count'] > 0) {
            $fault = 'Deze gebruikersnaam is al in gebruik. Kies een andere gebruikersnaam.';
        } else {
            // Controleer of het e-mailadres al in gebruik is
            $query = "SELECT COUNT(*) AS count FROM gebruikers WHERE email = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result['count'] > 0) {
                $fault = 'Dit e-mailadres is al aan een account gekoppeld. Kies een ander e-mailadres.';
            } else {
                // Voeg de gebruiker toe aan de database
                $query = "INSERT INTO gebruikers (username, email, password, rights) VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($query);
                if ($stmt->execute([$username, $email, $password, $rights])) {
                    // Redirect naar een succespagina of een andere pagina
                    header('Location: ?page=succes');
                    exit();
                } else {
                    // Geef een foutmelding als het toevoegen aan de database mislukt
                    $fault = 'Er is een fout opgetreden. Probeer het later opnieuw.';
                }
            }
        }
    } else {
        // Geef een foutmelding als niet alle vereiste velden zijn ingevuld
        $fault = 'Vul alle vereiste velden in.';
    }
}
?>

<main class="bg-[url('../../public/images/login-page/login-foto.jpg')] bg-cover bg-center">
    <div class="container mx-auto py-20">
        <!-- Voor eventule foutmelding -->
        <?php if (!empty($fault)) : ?>
            <h1 class="text-xl font-semibold text-red-500 text-center"><?php echo $fault; ?></h1>
        <?php endif; ?>
        <div class="flex justify-center items-center flex-wrap h-screen">
            <!-- gegevens invoer gedeelte -->
            <div class="flex justify-center items-center bg-gray-100 rounded-md shadow-md w-72 py-5">
                <form class="grid grid-cols-1 gap-5" method="POST">
                    <!-- Gebruikersnaam input -->
                    <label class="text-lg font-semibold" for="username">Gebruikersnaam</label>
                    <input class="border-2 w-52 rounded-md" type="name" name="username" placeholder="Gebruikersnaam">
                    <!-- Email input -->
                    <label class="text-lg font-semibold" for="Email">Email adres</label>
                    <input class="border-2 w-52 rounded-md" type="email" name="Email" placeholder="Email adres">
                    <!-- Wachtwoord input -->
                    <label class="text-lg font-semibold" for="password">Wachtwoord</label>
                    <input class="border-2 w-52 rounded-md" type="password" name="password" placeholder="Wachtwoord">
                    <!-- Registreren knop -->
                    <button class="bg-orange-400 rounded-md w-20" type="submit">Register</button>
                    <!-- Stuur terug naar loginpagina knop-->
                    <a class="text-blue-500 underline" href="./login.php">Terug naar loginpagina</a>
                </form>
            </div>
        </div>
    </div>
</main>