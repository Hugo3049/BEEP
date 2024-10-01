<?php

// Verbind met de database
require_once '../libs/dbconnection.php';

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
    $writer_id = $_SESSION['loggedInUser'];
    $time = date('Y-m-d H:i:00'); // Hier worden de seconden expliciet op 00 gezet
    $category = $_POST['Category'];
    $title = $_POST['title'];
    $heroText = nl2br($_POST['hero_text']);

// Het artikelgegevens omzetten naar JSON-formaat
$articleData = json_encode(array(
    'image' => $imageURL,
    'username' => $username,
    'time' => $time,
    'category' => $category,
    'title' => $title,
    'hero_text' => $heroText
));

// Ingevulde gegevens opslaan in de database
$query = $pdo->prepare("INSERT INTO articles (writer_id, title, hero_text, published_at, featured_image_url, category) VALUES ((SELECT username FROM gebruikers WHERE username = ?), ?, ?, ?, ?, ?)");
$query->execute([$username, $title, $heroText, $time, $imageURL, $category]);


    // Optioneel: een succesmelding weergeven   
    echo "Article submitted successfully.";
}
?>