<?php if (isReader() === false) : ?>
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

<main class="container mx-auto py-24">
        <!-- Get username from session -->
        <?php if (!empty($_SESSION['loggedInUser'])) : ?>
            <h1 class="text-3xl font-bold text-orange-400 my-2">Welkom terug, <?php echo $_SESSION['loggedInUser']["username"]; ?>!</h1>
        <?php endif; ?>
        <!-- Cards voor de verschillende admin pagina's -->
        <div class="my-10 grid lg:grid-cols-2 lg:grid-rows-2 md:grid-cols-2 md:grid-rows-2 sm:grid-cols-1 sm:grid-rows-1 gap-10">
                <h1 class="text-3xl font-bold">Deze pagina is momenteel in ontwikkeling, kom later terug voor het eindresultaat!</h1>
            </a>
        </div>
    </main>
</body>
