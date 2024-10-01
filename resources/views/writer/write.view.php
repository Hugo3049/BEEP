<?php if (isWriter() === false) : ?>
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

// Controleer of het formulier is verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controleer of er een afbeeldings-URL is ingevoerd
    if (isset($_POST['image']) && !empty($_POST['image'])) {
        $imageURL = $_POST['image'];
    } else {
        // Geen afbeeldings-URL ingevoerd, geef een foutmelding weer of voer andere gewenste actie uit
        echo "Please provide an image URL.";
        exit();
    }

    // Andere formuliergegevens ophalen
    $writer_id = $_SESSION['loggedInUser']['username'];
    $time = date('Y-m-d H:i:00'); // Hier worden de seconden expliciet op 00 gezet
    $category = $_POST['Category'];
    $title = $_POST['title'];
    $heroText = nl2br($_POST['hero_text']);

// Het artikelgegevens omzetten naar JSON-formaat
$articleData = json_encode(array(
    'image' => $imageURL,
    'time' => $time,
    'category' => $category,
    'title' => $title,
    'hero_text' => $heroText
));

// Ingevulde gegevens opslaan in de database
$query = $pdo->prepare("INSERT INTO articles (writer_id, title, hero_text, published_at, featured_image_url, category) VALUES ((SELECT username FROM gebruikers WHERE username = ?), ?, ?, ?, ?, ?)");
$query->execute([$writer_id, $title, $heroText, $time, $imageURL, $category]);

}

?>

<main class="container mx-auto py-24">
    <!-- Form -->
    <form id="articleForm" class="grid grid-cols-1 gap-5" method="post">
        <input type="url" name="image" placeholder="Add image URL" class="my-2 py-2 w-full rounded" required>
        <!-- Username input field -->
        <input type="text" name="username" value="<?php echo isset($_SESSION['loggedInUser']['username']); ?>" readonly>
        <!-- Time input field -->
        <input type="text" name="time" value="<?php echo date('D d-m-y H:i'); ?>" readonly>
        <!-- Category input field -->
        <div class="flex justify-start">
            <label class="font-semibold" for="Category">Category: </label>
            <select name="Category" id="">
                <option value="Crypto">Crypto</option>
                <option value="Precious Metals">Precious Metals</option>
                <option value="Property">Property</option>
                <option value="Shares">Shares</option>
            </select>
        </div>
        <input class="text-3xl font-bold text-gray-400" type="text" name="title" placeholder="Add Title" required>
        <textarea name="hero_text" id="heroText" cols="30" rows="10" placeholder="Type text (Please note that subheader titles are not recognized by bold formatting.)"></textarea>
        <!-- Submit button -->
        <hr />
        <button class="bg-orange-400 rounded-md py-2 px-3 w-32 font-semibold" type="submit">Post Article</button>
    </form>
</main>