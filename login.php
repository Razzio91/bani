<?php
// show the page title on the page tab and also include the following .php files so 
// this page can access the database
$page_title = "Bani - Login Page";
include_once 'partials/headers.php';
include_once 'partials/parseLogin.php';  ?>



<div class="container">
    <section class="col col-lg-7">

        <br>
        <h2>Login Formulier</h2>
        <hr>

        <div>
            <!-- If there is a result after the login: show a pop up(which is set in the utilities) -->
            <!-- however if there are empty parts in the login form show the following errors -->
            <?php
            if (isset($result)) echo $result; ?>
            <?php
            if (!empty($form_errors)) echo show_errors($form_errors); ?>
        </div>
        <div class="clearfix"></div>
        <form action=" " method="post">
            <div class="form-group">
                <label for="emailField">E-mail</label>
                <input type="text" class="form-control" id="emailField" name="email" placeholder="E-mail">

            </div>
            <div class="form-group">
                <label for="wachtwoordField">Wachtwoord</label>
                <input type="password" name="wachtwoord" class="form-control" id="wachtwoordField" placeholder="Wachtwoord">
            </div>

            <div class="checkbox">
                <label>
                    <input name="remember" value="yes" type="checkbox">Onthoud mij?
                </label>
            </div>
            <!-- <a href="password_recovery_link.php">Wachtwoord vergeten?</a> -->
            <input type="hidden" name="token" value="<?php if (function_exists('_token')) echo _token(); ?>">

            <button type="submit" name="loginBtn" class="btn btn-primary">Login</button>
        </form>
        <a href="index.php">Terug</a>

    </section>
</div>
<!-- include the following file where the footer is so it takes this place -->
<?php include_once 'partials/footers.php'; ?>