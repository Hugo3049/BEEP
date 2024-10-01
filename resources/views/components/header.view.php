<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) :
    require_once '../controllers/logout-controller.php';
    logout();

endif;

?>

<header class="bg-gray-900 p-3 shadow-lg w-full lg:fixed z-20 sticky top-0">
    <!-- Desktop navbar -->
    <ul class="container mx-auto py-3 flex justify-between items-center tracking-wide text-white">
        <li>
            <a href="index.php">
                <h1 class="text-3xl font-bold"><span class="text-orange-400">A</span>ssets <span class="italic"><span class="text-orange-400">I</span>nsight</span></h1>
            </a>
        </li>
        <li>
            <ul class="hidden md:flex items-end justify-end gap-10 text-nav-text text-base cursor-pointer">
                <li class="hover:text-secondary-color<?= getActivePage($page) == 'home' ? ' font-bold text-orange-400' : '' ?>"><a href="./">Home</a></li>
                <li class="hover:text-secondary-color<?= getActivePage($page) == 'blogs' ? ' font-bold text-orange-400' : '' ?>"><a href="?page=blogs">Blog</a></li>
                <li class="hover:text-secondary-color<?= getActivePage($page) == 'contact' ? ' font-bold text-orange-400' : '' ?>"><a href="?page=contact">Contact</a></li>
                <?php if (isAdmin()) : ?>
                    <li class="hover:text-secondary-color<?= getActivePage($page) == 'admin-dashboard' ? ' font-bold text-orange-400' : '' ?>"><a href="?page=admin&type=admin-dashboard">Admin Dashboard</a></li>
                    <li class="hover:text-secondary-color<?= getActivePage($page) == 'write' ? ' font-bold text-orange-400' : '' ?>"><a href="?page=admin&type=write">Write</a></li>
                    <li class="hover:text-secondary-color<?= getActivePage($page) == 'manage-users' ? ' font-bold text-orange-400' : '' ?>"><a href="?page=admin&type=users-dashboard">Manage Users</a></li>
                    <li class="hover:text-secondary-color<?= getActivePage($page) == 'logout' ? ' font-bold text-orange-400' : '' ?>">
                        <form method="POST">
                            <button type="submit" name="logout" class="text-white">Logout</button>
                        </form>
                    </li>
                <?php elseif (isWriter()) : ?>
                    <li class="hover:text-secondary-color<?= getActivePage($page) == 'writer-dashboard' ? ' font-bold text-orange-400' : '' ?>"><a href="?page=writer&type=writer-dashboard">Writer Dashboard</a></li>
                    <li class="hover:text-secondary-color<?= getActivePage($page) == 'admin-dashboard' ? ' font-bold text-orange-400' : '' ?>"><a href="?page=writer&type=write">Write</a></li>
                    <li class="hover:text-secondary-color<?= getActivePage($page) == 'logout' ? ' font-bold text-orange-400' : '' ?>">
                        <form method="POST">
                            <button type="submit" name="logout" class="text-white">Logout</button>
                        </form>
                    </li>
                <?php elseif (isReader()) : ?>
                    <li class="hover:text-secondary-color<?= getActivePage($page) == 'reader-dashboard' ? ' font-bold text-orange-400' : '' ?>"><a href="?page=reader&type=reader-dashboard">Reader Dashboard</a></li>
                    <li class="hover:text-secondary-color<?= getActivePage($page) == 'logout' ? ' font-bold text-orange-400' : '' ?>">
                        <form method="POST">
                            <button type="submit" name="logout" class="text-white">Logout</button>
                        </form>
                    </li>
                <?php else : ?>
                    <li class="hover:text-secondary-color<?= getActivePage($page) == 'login' ? ' font-bold text-orange-400' : '' ?>"><a href="?page=login">Login</a></li>
                <?php endif; ?>
            </ul>
        </li>
        <!-- Mobile navbar -->
        <div class="flex justify-end lg:hidden">
            <button id="mobile-menu-btn" class="flex justify-end items-center px-3 py-2">
                <img class="fill-current h-6 w-5" src="./images/menu.svg" alt="Menu">
            </button>
            <!-- Dropdown menu -->
            <div id="mobile-menu" class="hidden absolute z-20 top-20 left-0 bg-gray-900 w-full mt-2 border-none rounded-b-lg shadow-md">
                <a href="./" class="block px-4 py-2 hover:text-orange-400 mx-2<?= getActivePage($page) == 'home' ? ' font-bold text-orange-400' : '' ?>">Home</a>
                <a href="?page=blogs" class="block px-4 py-2 hover:text-orange-400 mx-2<?= getActivePage($page) == 'blogs' ? ' font-bold text-orange-400' : '' ?>">Blog</a>
                <a href="?page=contact" class="block px-4 py-2 hover:text-orange-400 mx-2<?= getActivePage($page) == 'contact' ? ' font-bold text-orange-400' : '' ?>">Contact</a>
                <?php if (isAdmin()) : ?>
                    <a href="?page=admin&type=admin-dashboard" class="block px-4 py-2 hover:text-orange-400 mx-2<?= getActivePage($page) == '?page=admin&type=admin-dashboard' ? ' font-bold text-orange-400' : '' ?>">Admin Dashboard</a>
                    <a href="?page=admin&type=write" class="block px-4 py-2 hover:text-orange-400 mx-2<?= getActivePage($page) == '?page=admin&type=write' ? ' font-bold text-orange-400' : '' ?>">Write</a>
                    <a href="?page=admin&type=users-dashboard" class="block px-4 py-2 hover:text-orange-400 mx-2<?= getActivePage($page) == '?page=admin&type=users-dashboard' ? ' font-bold text-orange-400' : '' ?>">Manage Users</a>
                    <form action="" method="POST" class="block px-4 mx-2">
                        <button type="submit" name="logout" class="text-white w-full text-left">Logout</button>
                    </form>
                <?php elseif (isWriter()) : ?>
                    <a href="?page=writer&type=writer-dashboard" class="block px-4 py-2 hover:text-orange-400 mx-2<?= getActivePage($page) == '?page=writer&type=writer-dashboard' ? ' font-bold text-orange-400' : '' ?>">Writer Dashboard</a>
                    <a href="?page=writer&type=write" class="block px-4 py-2 hover:text-orange-400 mx-2<?= getActivePage($page) == '?page=writer&type=write' ? ' font-bold text-orange-400' : '' ?>">Write</a>
                    <form action="" method="POST" class="block px-4 mx-2">
                        <button type="submit" name="logout" class="text-white w-full text-left">Logout</button>
                    </form>
                <?php elseif (isReader()) : ?>
                    <a href="?page=reader&type=reader-dashboard" class="block px-4 py-2 hover:text-orange-400 mx-2<?= getActivePage($page) == 'reader-dashboard' ? ' font-bold text-orange-400' : '' ?>">Reader Dashboard</a>
                    <form action="" method="POST" class="block px-4 mx-2">
                        <button type="submit" name="logout" class="text-white w-full text-left">Logout</button>
                    </form>
                <?php else : ?>
                    <a href="?page=login" class="block px-4 py-2 hover:text-orange-400 mx-2<?= getActivePage($page) == 'login' ? ' font-bold text-orange-400' : '' ?>">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </ul>
</header>
