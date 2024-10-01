<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) :
    require_once '../controllers/logout-controller.php';
    logout();

endif;

?>

<footer class="bg-gray-900 text-white">
    <div class="container mx-auto py-10">
        <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-10">
            <div class="w-full">
                <h1 class="text-3xl font-bold"><span class="text-orange-400">A</span>ssets <span class="italic"><span class="text-orange-400">I</span>nsight</span></h1>
            </div>
            <div class="w-full">
                <ul>
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
            </div>
            <div class="w-full">
                <ul>
                    <li><span class="font-bold">Email:</span> info@assetsinsight.com</li>
                    <li><span class="font-bold">Phone:</span> +31 6 12 34 56 78</li>
                    <li><span class="font-bold">Location:</span> Muntinglaan 3, Groningen</li>
                </ul>
            </div>
            <div class="w-full">
                <button class="bg-orange-400 px-3 py-2 rounded-md">Contact forumulier</button>
            </div>
        </div>
    </div>
</footer>