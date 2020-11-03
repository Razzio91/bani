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





    </script>
    <!-- if the page button is pressed/active show the page title -->
    <title><?php if (isset($page_title)) echo $page_title; ?></title>
</head>

<body>

    <nav class="navbar navbar-expand-md  bg-white fixed-top">

        <a class="navbar-brand" href="index.php"><img src="img/test.png" alt="" style="margin-left: 100px; width: 60%; display:block;"></a>





        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">

            <ul class="nav navbar-nav">


                <!-- if the session you are in has the username or the cookie is in the database show: -->
                <?php if ((isset($_SESSION['klant_id']) || isCookieValid($db))) : ?>

                    <a class="nav-link" href="logout.php">Logout</a>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Damage Reports</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" name="changePass" href="wachtwoordReset.php" >Change Password</a>

                        </div>
                    </li>
                    <!-- if username is not active and there is no account available show -->
                <?php else : ?>
                    <a class="nav-link" href="login.php">Login</a>
                    <a class="nav-link" href="signup.php">Register</a>
                    <a class="nav-link" href="bestelling.php">Bestelling</a>
                    <!-- end if/else php statement -->

                <?php endif ?>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-3" type="text" placeholder="Search" aria-label="Search">

            </form>
        </div>

    </nav>
    