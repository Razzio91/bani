<?php
// show the given page title in the tab
// include the headers for the session info database info and functionalities of the website
$page_title = "Bani - Homepage";
include_once 'partials/headers.php'; ?>

<div>
    <img src="img/nieuws.png" style="width: 107.3%; height: 200px; position: relative; right: 50px; display: block;" alt=""></div>
<main role="main" class="container">

    <div class="flag">

        <?php 
        //shows when logged in
        if (isset($_SESSION['voornaam'])) : ?>
 <!-- Producten/categoriën whateverthefucknot -->
           


            <!-- shows when not logged in-->
        <?php else : ?>

            <P class="lead">You are currently not signed in<a href="login.php"> <br>Login</a>
                <br> Not yet a member?<a href="signup.php"><br>Registreer</a></P>
               
            <!-- <p>You are logged in as {username}<i>(Admin)</i> <br>
    <a href="logout.php">Logout</a></p> -->

    <!-- end if statment -->
        <?php endif ?>
    </div>

</main>
<?php _token();?>
        </div>
<!-- include footers.php file this way this code remains clean-->
<?php include_once 'partials/footers.php'; ?>


