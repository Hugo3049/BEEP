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

// Verwijder de gebruiker als de ID is ingesteld en er op "Delete" is geklikt
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = $_GET['id'];
    $query = "DELETE FROM gebruikers WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    header('Location: ./users.php');
    exit();
}

// Zoekfunctie
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchTerm = $_POST['search'];
    if (!empty($searchTerm)) {
        $query = "SELECT * FROM gebruikers WHERE username LIKE ? OR email LIKE ? OR rights LIKE ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(["%$searchTerm%", "%$searchTerm%", "%$searchTerm%"]);
    } else {
        $query = "SELECT * FROM gebruikers";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }
} else {
    // Query om alle gebruikers op te halen
    $query = "SELECT * FROM gebruikers";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
}

// Controleer of er gebruikers zijn
$userCount = $stmt->rowCount();
?>

<main class="container mx-auto py-24">
    <!-- Zoekbalk -->
    <form method="POST" class="mb-4">
        <input class="border-2 rounded-md py-1 px-2" type="text" name="search" placeholder="Search...">
        <button class="bg-orange-400 text-white rounded-md px-3 py-1" type="submit">Search/reset-search</button>
    </form>
    <!-- Kijkt of er gebruikers zijn -->
    <?php if ($userCount === 0) : ?>
        <p class="text-red-500">No users found.</p>
    <?php else : ?>
        <!-- Tabel om gebruikers te tonen -->
        <table class="w-full">
            <tr class="text-left">
                <th class="border-2">Username</th>
                <th class="border-2">Email</th>
                <th class="border-2">Rights</th>
                <th class="border-2">Actions</th>
            </tr>
            <?php
            // Laad gebruikers data uit database
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td class='border-2'>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td class='border-2'>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td class='border-2'>" . htmlspecialchars($row['rights']) . "</td>";
                echo "<td class='border-2'>
                        <a class='bg-orange-400 px-3 rounded-md' href='./?page=admin&type=edit-user&id=" . htmlspecialchars($row['id']) . "'>Edit</a>
                        <a class='bg-red-500 px-3 rounded-md' href='?id=" . htmlspecialchars($row['id']) . "&action=delete'>Delete</a>
                        </td>";
                echo "</tr>";
            }
            ?>
        </table>
    <?php endif; ?>
</main>