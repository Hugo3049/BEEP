<?php

// Code om foutmeldingen te tonen
function dd(): void
{
    $args = func_get_args();

    if (count($args)) {
        echo "<pre>";

        foreach ($args as $arg) {
            var_dump($arg);
        }

        echo "</pre>";

        die();
    }
}

// function to get the active page
function getPage () {
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        
        if ($page == 'admin') {
            if (isset($_GET['type'])) {
                if (file_exists('../resources/views/admin/' . $_GET['type'] . '.view.php')) {
                    return '../resources/views/admin/'. $_GET['type']. '.view.php';
                }
                return 404;
            }
        } else if ($page == 'writer') {
            if (isset($_GET['type'])) {
                if (file_exists('../resources/views/writer/' . $_GET['type'] . '.view.php')) {
                    return '../resources/views/writer/'. $_GET['type']. '.view.php';
                }
                return 404;
            }
        } else if ($page == 'reader') {
            if (isset($_GET['type'])) {
                if (file_exists('../resources/views/reader/' . $_GET['type'] . '.view.php')) {
                    return '../resources/views/reader/'. $_GET['type']. '.view.php';
                }
                return 404;
            }
        }
        
        if (file_exists('../resources/views/'. $page. '.view.php')) {
            return '../resources/views/'. $page. '.view.php';
        }

        return 404;
    }

    return '../resources/views/home.view.php';
}

// function to get the active page dashboard
function getActivePage($page) {
    $expl = explode('/', $page);
    $active = explode('.', $expl[3]);

    return $active[0];
}

// function to check if user is admin
function isAdmin() {
    if (isset($_SESSION['loggedInUser'])) {
        if ($_SESSION['loggedInUser']['rights'] == 'Admin') {
            return true;
        }
    }
    return false;
}

// function to check if user is writer
function isWriter() {
    if (isset($_SESSION['loggedInUser'])) {
        if ($_SESSION['loggedInUser']['rights'] == 'Writer') {
            return true;
        }
    }
    return false;
}

// function to check if user is reader
function isReader() {
    if (isset($_SESSION['loggedInUser'])) {
        if ($_SESSION['loggedInUser']['rights'] == 'Reader') {
            return true;
        }
    }
    return false;
}