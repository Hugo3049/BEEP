<?php

require_once '../controllers/login-controller.php';

if (isLoggedIn()) {
    header('Location: ./');
}

?>

<?php if (isset($_POST['submit'])) : ?>
    <?php require_once '../controllers/login-controller.php'; ?>
    <?php $validate = login(); ?>
<?php endif ?>

<main class="bg-[url('../../public/images/login-page/login-foto.jpg')] bg-cover bg-center">
    <div class="container mx-auto py-20">
        <!-- Voor eventule foutmelding -->
        <?php if (!empty($fault)) : ?>
            <h1 class="text-xl font-semibold text-red-500 text-center"><?php echo $fault; ?></h1>
        <?php endif; ?>
        <div class="flex justify-center items-center flex-wrap h-screen">
            <!-- Login forumlier -->
            <div class="flex justify-center items-center bg-gray-100 rounded-md shadow-md w-72 py-5">
                <form class="grid grid-cols-1 gap-5" method="POST">
                    <!-- Gebruikersnaam input -->
                    <label class="text-lg font-semibold" for="username">Gebruikersnaam</label>
                    <input class="border-2 w-52 rounded-md" type="text" name="username" placeholder="Gebruikersnaam" required>
                    <!-- Wachtwoord input -->
                    <label class="text-lg font-semibold" for="password">Wachtwoord</label>
                    <input class="border-2 w-52 rounded-md" type="password" name="password" placeholder="Wachtwoord" required>
                    <!-- Login knop -->
                    <button class="bg-orange-400 rounded-md w-20" name="submit" type="submit">Inloggen</button>
                    <!-- Link om account aan te maken -->
                    <a class="text-blue-500 underline" href="./?page=new-user">Account aanmaken</a>
                </form>
            </div>
        </div>
    </div>
</main>