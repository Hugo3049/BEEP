<?php

session_start();

require_once '../libs/helper.php';
require_once '../config.php';
require_once '../libs/dbconnection.php';
require_once '../controllers/article-controller.php';

?>

<!DOCTYPE html>
<html lang="<?= $_ENV['LANG']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="./js/navbar.js" defer></script>
</head>
<body>
    <?php $page = getPage(); ?>

    <?php if ($page == 404) : ?>
        <h1 class="text-xl font-bold">Pagina niet gevonden</h1>
    <?php else : ?>
        <?php require_once '../resources/views/components/header.view.php'; ?>
        <?php require_once $page; ?>
        <?php require_once '../resources/views/components/footer.view.php'; ?>
    <?php endif; ?>
</body>
</html>