<?php

$pdo = dBConnect();

// Controleren of er een artikel-id is doorgegeven via de URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirecten naar de blogpagina als er geen id is opgegeven
    header("Location: ./?page=blogs");
    exit;
}

// Artikelgegevens ophalen op basis van de id
$articleId = $_GET['id'];
$query = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$query->execute([$articleId]);
$article = $query->fetch(PDO::FETCH_ASSOC);

// Huidige datum in YYYY-MM-DD formaat
$originalDate = $article['published_at'];
// Converteren naar DateTime object
$dateTime = new DateTime($originalDate);
// Formatteren naar DD-MM-YYYY
$formattedDate = $dateTime->format('D-d-m-Y H:i:00');

// Controleren of het artikel bestaat
if (!$article) {
    // Als het artikel niet gevonden/bestaat, wordt de gebruiker doorsturen naar de blogpagina
    header("Location: ./?page=blogs");
    exit;
}
?>

<main class="container mx-auto py-24">
    <div class="flex flex-col lg:flex-row justify-between">
        <!-- Toont de inhoud van het artikel -->
        <div class="w-full lg:w-4/6 mr-2">
            <div class="flex justify-center items-center mb-4">
                <!-- Toont de afbeelding van het artikel -->
                <img class="flex justify-center items-center lg:w-full h-auto" src="<?php echo $article['featured_image_url'] ?>" alt="">
            </div>
            <!-- Toont de schrijver van het artikel -->
            <p class="text-gray-400">Writen by: <span class="font-semibold"><?php echo $article['writer_id']; ?></span></p>
            <!-- Toont de uitbreng datum van het artikel -->
            <p class="text-gray-400 mb-4"><?php echo $formattedDate; ?></p>
            <!-- Toont de titel van het artikel -->
            <h1 class="text-3xl font-bold mb-4"><?php echo $article['title']; ?></h1>
            <!-- Toont de inhoud van het artikel -->
            <p class="text-gray-600 mb-4"><?php echo $article['hero_text']; ?></p>
        </div>
        <!-- Ads -->
        <div class="lg:w-2/6 bg-gray-100 shadow-lg rounded-md p-3 h-screen lg:block md:block sm:hidden">

            <!-- If statement maken voor de teksten -->

            <!-- Admin -->
            <!-- If statement maken voor de teksten -->
            <?php if (isAdmin()) : ?>
                <!-- Nothing -->
            <?php elseif (isWriter()) : ?>
                <!-- Nothing -->
            <?php elseif (isReader()) : ?>
                <h1 class="text-3xl font-semibold my-1">Wordt een schrijver bij ons!</h1>
                <p class="my-2">
                    Heb jij een nieuwtje? Of wil je kennis delen met de Assets Insight communitie? Wordt dan schrijver bij ons!
                </p>
                <p class="my-2">
                    Meld je aan, en laat je verifiëren als een echte betrouwbare schrijver!
                </p>
                <a class="bg-orange-400 px-3 py-2 rounded-md mt-5" href="./?page=new-user">Wordt schrijver!</a>
            <?php else : ?>
                <h1 class="text-3xl font-semibold my-1">Wordt een lezer bij ons!</h1>
                <p class="my-2">
                    Wil jij altijd op de hoogte blijven van de nieuwe updates in de assets markt? Wordt dan een lezer bij ons!
                </p>
                <p class="my-2">
                    Meld je aan, en laat je verassen met de handige functies binnen Assets Insight!
                </p>
                <a class="bg-orange-400 px-3 py-2 rounded-md mt-5" href="./?page=new-user">Maak een account</a>
            <?php endif; ?>
        </div>
    </div>
</main>