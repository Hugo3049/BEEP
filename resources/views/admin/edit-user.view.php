<!-- Checks if user has acces rights -->
<?php if (isAdmin() === false) : ?>
    <div class="fixed inset-0 flex items-center justify-center mt-20">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h1 class="text-3xl font-bold text-orange-400 mb-4">403: Geen rechten voor deze pagina</h1>
            <p class="mb-6">U heeft niet de juiste rechten tot deze pagina. Keer terug naar de homepagina.</p>
            <a href="./" class="inline-block px-4 py-2 bg-orange-400 text-white rounded-md hover:bg-orange-600">Ga naar Homepagina</a>
        </div>
    </div>
    <?php die(); ?>
<?php endif; ?>

<?php require_once '../controllers/session-check-controller.php'; ?>

<?php

// Verbind met de database
$pdo = dBConnect();

// Haal gebruikersgegevens op die bewerkt moet worden
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $query = "SELECT * FROM gebruikers WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch();
}

// Als het formulier is verzonden, update de gebruiker
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rights = $_POST['rights'];

    $query = "UPDATE gebruikers SET username = :username, email = :email, password = :password, rights = :rights WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password, 'rights' => $rights, 'id' => $userId]);

    // Redirect naar de gebruikerspagina of een andere pagina na het updaten
    header('Location: ./?page=admin&type=users-dashboard');
    exit();
}

?>

<main class="container mx-auto py-24">
    <!-- Form met huidige gegevens van gebruiker -->
    <section>
        <!-- Gebruikersnaam wordt hier dynamisch opgehaald uit de database -->
        <h1 class="text-3xl font-bold">Edit User: <?php echo $user['username']; ?></h1>
        <!-- Gegevens van de huidige gebruiker worden hier opgehaald en ingevuld -->
        <form class="flex flex-col border-2 p-3" method="post">
            <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">
            <!-- Gebruikersnaam -->
            <label class="font-semibold mb-2" for="username">Username:</label>
            <input class="border-2 rounded-md mb-2" type="text" id="username" name="username" value="<?php echo $user['username']; ?>">
            <!-- Email adres -->
            <label class="font-semibold mb-2" for="email">Email address:</label>
            <input class="border-2 rounded-md mb-2" type="email" id="email" name="email" value="<?php echo $user['email']; ?>">
            <!-- Wachtwoord -->
            <label class="font-semibold mb-2" for="password">Password:</label>
            <input class="border-2 rounded-md mb-2" type="password" id="password" name="password" value="<?php echo $user['password']; ?>">
            <!-- Rechten -->
            <label class="font-semibold mb-2" for="rights">Rights:</label>
            <select class="border-2 rounded-md my-2" id="rights" name="rights">
                <option value="Reader" <?php echo ($user['rights'] == 'Reader') ? 'selected' : ''; ?>>Reader</option>
                <option value="Writer" <?php echo ($user['rights'] == 'Writer') ? 'selected' : ''; ?>>Writer</option>
                <option value="Admin" <?php echo ($user['rights'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
            <!-- Knop om gebruiker te updaten -->
            <button class="bg-orange-400 rounded-md px-3 py-2 w-52" type="submit" value="Update User">Update user</button>
        </form>
    </section>
</main>