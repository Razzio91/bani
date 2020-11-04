<?php $page_title = "Bani - Wachtwoord Reset";
include_once 'resources/database.php';
include_once 'partials/headers.php';
// include_once 'partials/parseProfile.php';
include_once 'partials/parseChangePassword.php';

?>


<div class="container">
    <section class="col col-lg-7">
        <br>
        <h2>Wachtwoord-Reset</h2>
        <div>
            <?php if (isset($result)) echo $result; ?>
            <?php if (!empty($form_errors)) echo show_errors($form_errors); ?>

        </div>
        <div class="clearfix"></div>

        <?php if (!isset($_SESSION['klant_id'])) : ?>
            <P class="lead">Je bent niet bevoegd om deze pagina te zien<a href="login.php">Login</a>
                Nog geen account? <a href="signup.php">Registreren</a></P>
        <?php else : ?>


            <!-- Change pass -->

            <h3>Wachtwoord Reset</h3>
            <hr />

            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="currentpasswordField">Current Password </label>
                    <input type="password" name="current_password" class="form-control" id="currentpasswordField" placeholder="Current Password">
                </div>

                <div class="form-group">
                    <label for="newpasswordField">New Password </label>
                    <input type="password" name="new_password" class="form-control" id="newpasswordField" placeholder="New Password">
                </div>

                <div class="form-group">
                    <label for="confirmpasswordField">Confirm Password </label>
                    <input type="password" name="confirm_password" class="form-control" id="confirmpasswordField" placeholder="Confirm Password">
                </div>
                <input type="hidden" name="hidden_id" value="<?php if (isset($_SESSION['klant_id'])) echo $_SESSION['klant_id']; ?>">
                <input type="hidden" name="token" value="<?php if (function_exists('_token')) echo _token(); ?>">
                <input type="submit" value="Change Password" name="changePasswordBtn" class="btn btn-primary"><br />


            </form>
        <?php endif; ?>

        <a href="index.php">Terug</a>
    </section>

</div>


<?php include_once 'partials/footers.php'; ?>