<?php $page_title = "Bani - Wachtwoord Reset";
include_once 'partials/headers.php';
// include_once 'partials/parseProfile.php';
include_once 'partials/parseChangePassword.php';

?>
<div>
<img src="img/editprofile.jpg" style="width: 107.3%; height: 200px; position: relative; right: 50px;display: block;"alt=""></div>


<div class="container">
    <section class="col col-lg-7">
        <br>
        <h2>WW-Reset</h2>
        <div>
            <?php if (isset($result)) echo $result; ?>
            <?php if (!empty($form_errors)) echo show_errors($form_errors); ?>

        </div>
        <div class="clearfix"></div>

        <?php if(!isset($_SESSION['voornaam'])): ?>
            <P class="lead"> You are not authorized to view this page <a href="login.php">Login</a>
                Not registered yet? <a href="signup.php">Signup</a></P>
        <?php else: ?>
      
        
                <!-- Change pass -->
        
                <h3>Password Management</h3>
                <hr />

                <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="currentpasswordField">Current Password </label>
                <input type="password" name="current_password" class="form-control"
                id="currentpasswordField" placeholder="Current Password">
            </div>

            <div class="form-group">
                <label for="newpasswordField">New Password </label>
                <input type="password" name="new_password" class="form-control"
                id="newpasswordField" placeholder="New Password">
            </div>

            <div class="form-group">
                <label for="confirmpasswordField">Confirm Password </label>
                <input type="password" name="confirm_password" class="form-control"
                id="confirmpasswordField" placeholder="Confirm Password">
            </div>
        <input type="hidden" name="hidden_id" value="<?php if(isset($id)) echo $id;?>">
        <input type="hidden" name="token" value="<?php if(function_exists('_token')) echo _token();?>">
        <button type="submit" name="changePasswordBtn" class="btn btn-primary" style="float:right">
        Change Password</button> <br/>
        
        
        </form> 
        <?php endif; ?>
        
        <a href="index.php">Back</a>            
    </section>

</div>


<?php include_once 'partials/footers.php'; ?>