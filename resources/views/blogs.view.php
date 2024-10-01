<?php
$pdo = dBConnect();

// Basisquery om artikelen op te halen
$query = $pdo->prepare("SELECT * FROM articles");

// Zoekfunctie
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $query = $pdo->prepare("SELECT * FROM articles WHERE title LIKE ?");
    $query->execute(["%$search%"]);
    $articles = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Filterfunctie op categorie
    if (isset($_GET['category']) && !empty($_GET['category'])) {
        $category = $_GET['category'];
        $query = $pdo->prepare("SELECT * FROM articles WHERE category = ?");
        $query->execute([$category]);
        $articles = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Standaard alle artikelen ophalen als er geen filter is toegepast
        $query->execute();
        $articles = $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Controleer of er artikelen zijn gevonden
if (empty($articles)) {
    $error_message = "Geen artikelen gevonden voor de opgegeven zoekopdracht of categorie.";
}
?>

<main class="container mx-auto py-24">
    <!-- Zoekformulier -->
    <form action="" method="get" class="mb-4" onsubmit="return redirectToBlogsPageWithSearch()">
        <input type="text" name="search" placeholder="Zoek naar artikelen" class="px-4 py-2 border border-gray-300 rounded-md w-80">
        <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-md">Zoeken / Reset</button>
    </form>

    <!-- Filter opties -->
    <div class="mb-4">
        <label for="category" class="font-bold">Filter op categorie:</label>
        <select name="category" id="category" class="ml-2 px-2 py-1 border border-gray-300 rounded-md">
            <option value="">Alle categorieën</option>
            <option value="Crypto">Crypto</option>
            <option value="Precious metals">Precious metals</option>
            <option value="Property">Property</option>
            <option value="Shares">Shares</option>
        </select>
    </div>

    <!-- Artikelen worden hier ingeladen -->
    <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
        <?php if (isset($error_message)) : ?>
            <h1 class="text-xl font-bold"><?php echo $error_message; ?></h1>
        <?php else : ?>
            <!-- Artikelen worden hier opgehaald en getoond -->
            <?php foreach ($articles as $article) : ?>
                <!-- Functie om de datum volgorde goed te zetten -->
                <?php
                // Huidige datum in YYYY-MM-DD formaat
                $originalDate = $article['published_at'];
                // Converteren naar DateTime object
                $dateTime = new DateTime($originalDate);
                // Formatteren naar DD-MM-YYYY
                $formattedDate = $dateTime->format('D-d-m-Y H:i:00');
                ?>
                <div class="bg-white shadow-lg p-6 rounded-lg">
                    <div class="relative" style="height: 14rem;">
                        <!-- Toont de afbeelding van het artikel -->
                        <img class="w-full h-full object-cover" src="<?php echo $article['featured_image_url'] ?>" alt="">
                    </div>
                    <div class="mt-3">
                        <!-- Toont de titel van het artikel -->
                        <h2 class="text-xl font-bold mb-4"><?php echo $article['title']; ?></h2>
                        <!-- Toont de uitbreng datum van het artikel -->
                        <p class="text-gray-400"><?php echo $formattedDate; ?></p>
                        <!-- Toont de catogorie van het artikel -->
                        <p class="text-gray-300">Category: <?php echo $article['category'] ?></p>
                        <!-- Toont de link naar het artikel -->
                        <a href="./?page=article-r&id=<?php echo $article['id'] ?>" class="block mt-4 text-blue-500 hover:underline">Lees meer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

<script>
    function redirectToBlogsPageWithSearch() {
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput && searchInput.value.trim() !== '') {
            window.location.href = './?page=blogs&search=' + encodeURIComponent(searchInput.value);
            return false;
        } else {
            window.location.href = './?page=blogs'
            return false;
        }
        return true;
    }

    // Function to redirect to the selected category
    document.getElementById('category').addEventListener('change', function() {
        const selectedCategory = this.value;
        if (selectedCategory !== '') {
            window.location.href = './?page=blogs&category=' + selectedCategory;
        } else {
            window.location.href = 'blog.php';
        }
    });
</script>