<?php
// include all of the following files so they are linked to other php files for database reference, utilities functions and the current session
include_once "resources/session.php";
include_once "resources/database.php";
include_once "resources/utilities.php";
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/headers.css">


    </script>
    <!-- if the page button is pressed/active show the page title -->
    <title><?php if (isset($page_title)) echo $page_title; ?></title>
</head>

<body>




    <div class="navbar" id="navbar">
        <a class="navbar-brand" href="index.php">
            <img src="img/Boni_logo.jpg">
        </a>

        <div class="nav-links">


            <!-- if the session you are in has the username or the cookie is in the database show: -->
            <?php if ((isset($_SESSION['klant_id']) || isCookieValid($db))) : ?>


                <a class="nav-link" href="logout.php">Logout</a>
                <a class="nav-link" href="wachtwoordReset.php">Verander wachtwoord</a>
                <a class="nav-link" href="bestelling.php">Bestelling</a>
                <!-- if username is not active and there is no account available show -->
            <?php else : ?>
                <a class="nav-link" href="login.php">Login</a>
                <a class="nav-link" href="signup.php">Registreren</a>
                <!-- end if/else php statement -->

            <?php endif ?>
            <a class="nav-link" href="categories.php">Categorieën</a>

        </div>
        <form class="search-form">
            <input class="searchbar" type="text" placeholder="Search" aria-label="Search">
        </form>

    </div>

    </nav>