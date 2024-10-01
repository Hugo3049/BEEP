<?php
function userNameDisplay() {
    if (!empty($_SESSION['loggedInUser'])) {
        echo '<h1 class="text-3xl font-bold text-orange-400 my-2">Welkom terug, ' . htmlspecialchars($_SESSION['loggedInUser']["username"]) . '!</h1>';
    }
}
?>
