<!-- Set the page title to the following and show this on the page tab
also include the following files for database reference and partial signup page information -->
<?php
$page_title = "Bani - Register Page";
include_once 'partials/headers.php';
include_once 'partials/parseSignup.php'; ?>


<div>
    <img src="img/register.jpg" style="width: 107.3%; height: 200px; position: relative; right: 51px; display:block;" alt=""></div>

<div class="container">
    <section class="col col-lg-7">

        <br>
        <h2>Registration Form</h2>
        <hr>


        <div>
            <!-- If the user submits the sign up form it will show the result as a pop up saying welcome and the user
            gets redirected to another page(utilities function) if the form is not fully filled out the browser will give an error form on submit
        showing the amount of errors and the type of errors -->
            <?php
            if (isset($result)) echo $result; ?>
            <?php
            if (!empty($form_errors)) echo show_errors($form_errors); ?>
        </div>
        <div class="clearfix"></div>
        <form action=" " method="post">
            <div class="form-group">
                <label for="voornaamField">voornaam</label>
                <input type="text" class="form-control" id="voornaamField" name="voornaam" placeholder="Voornaam">

            </div>
           <!-- tussenvoegsel verwerpen -->
                <div class="form-group">
                    <label for="tussenvoegsel">tussenvoegsel</label>
                    <input type="text" class="form-control" id="tussenvoegsel" name="tussenvoegsel" placeholder="Tussenvoegsel">

                </div>

                <div class="form-group">
                <label for="achterField">Achternaam</label>
                <input type="text" class="form-control" id="achterField" name="achternaam" placeholder="Achternaam">

            </div>
            <div class="form-group">
                <label for="postField">Postcode</label>
                <input type="text" class="form-control" id="postField" name="postcode" placeholder="Postcode">

            </div>
            <div class="form-group">
                <label for="huisField">Huisnummer</label>
                <input type="text" class="form-control" id="huisField" name="huisnummer" placeholder="Huisnummer">

            </div>
            <div class="form-group">
                <label for="telField">Telefoonnummer</label>
                <input type="text" class="form-control" id="telField" name="telefoonnummer" placeholder="Telefoonnummer">

            </div>
                <div class="form-group">
                    <label for="wachtwoordField">Password</label>
                    <input type="wachtwoord" name="wachtwoord" class="form-control" id="wachtwoordField" placeholder="wachtwoord">
                </div>
                <div class="form-group">
                <label for="emailField">E-mail address</label>
                <input type="text" class="form-control" id="emailField" name="email" placeholder="E-mail">

            </div>
                <input type="hidden" name="token" value="<?php if(function_exists('_token')) echo _token(); ?>">
                <button style="float: right" type="submit" name="signupBtn" class="btn btn-primary">Signup</button>
            </form>
            <a href="index.php">Back</a>

    </section>
</div>
<!-- include the footer part of the page here -->
<?php include_once 'partials/footers.php'; ?>