<!-- Recent post articles -->
<section>
    <div class="bg-orange-400 p-6">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold">Most recent news articles</h1>
        </div>
    </div>
    <div class="container mx-auto py-10 grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-10">
        <!-- Voor eventule foutmelding -->
        <?php if (isset($error_message)) : ?>
            <h1 class="text-xl font-bold"><?php echo $error_message; ?></h1>
        <?php else : ?>
            <!-- Haalt de artikelen op uit de database -->
            <?php
            $articles = getRecentArticles();
            foreach ($articles as $article) : ?>
                <!-- HTML structuur voor artikelen -->
                <div class="bg-white shadow-lg p-6 rounded-lg">
                    <div class="relative" style="height: 9rem;">
                        <img class="w-full h-full object-cover" src="<?= $article['featured_image_url'] ?>" alt="Article: <?php echo $article['title']; ?>">
                    </div>
                    <div class="mt-3">
                        <h2 class="text-xl font-bold mb-1"><?= $article['title']; ?></h2>
                        <p class="text-gray-300">Category: <?= $article['category'] ?></p>
                        <a href="./?page=article-r&id=<?php echo $article['id']?>" class="block mt-4 text-blue-500 hover:underline">Lees meer</a>
                    </div>
                </div>
            <?php endforeach?>

        <?php endif; ?>
    </div>
</section>