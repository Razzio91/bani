<?php
// include these files for the functions and database info
include_once "resources/database.php";
include_once "resources/utilities.php";

//  if the login button is pressed this function searches the given data in the database
// and if there are empty fields left it will show errors with the info on what field is empty
// otherwise itll get the information from the database and logs the user in
// we want the password to be stored in hashed format and while the statement is being executed
// we want the info to be fetched and the cookie gets active and sets a time for how long itll be active till the user gets logged off
// if everything is succesfull i want the site to give a popup message saying welcome back and you are being logged in which is set on a timer as well
// and automatically sends you to the index.php but in ['username'] mode:
if (isset($_POST["loginBtn"], $_POST['token'])) {
   //validate the token
   if(validate_token($_POST['token'])){
       //process the form
       //array errors
    $form_errors = array();

    // Validation
    $required_fields = array('email', 'wachtwoord');
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    if (empty($form_errors)) {

        //collect form data
        $email = $_POST['email'];
        $wachtwoord = $_POST['wachtwoord'];
        isset($_POST['remember']) ? $remember = $_POST['remember'] : $remember = "";

        //check if user exist in the database   
        $sqlQuery = "SELECT * FROM klant WHERE email = :email"; //select all from user table where username = :username in database(checks if this is valid)
        $statement = $db->prepare($sqlQuery); 
        $statement->execute(array(':email' => $email));


        if($row = $statement->fetch()) {
            $id = $row['klant_id'];
            $hashed_password = $row['wachtwoord'];
            $voornaam = $row['voornaam'];
            $geactiveerd = $row['geactiveerd']; 
            
            if($geactiveerd === "0"){

                $result = flashMessage("Activate your account please!");


            }else{
                if (password_verify($wachtwoord, $hashed_password)) {
                    $_SESSION['klant_id'] = $id;
                    $_SESSION['email'] = $email;
    
                    $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
                    $_SESSION['last_active'] = time();
                    $_SESSION['fingerprint'] = $fingerprint;
    
                    if($remember === "yes"){
                        rememberMe($id);
                    }
    
                    echo $welcome="<script type=\"text/javascript\">
                    swal({
                        title: \"Welcome back $voornaam!\",
                        text: \"You're being logged in!\",
                        type: 'success',
                        timer: 6000,
                       showConfirmButton: false});
                    setTimeout(function(){
                        window.location.href='index.php';
                    }, 5000);
                    </script>";
    
                   
                } else 
                // this will show a message above the login form saying the message written inside, styled nicely
                {
                    $result = flashMessage("You have entered an invalid password!");
                }
            }

            
        }else{
            $result = flashMessage("You have entered an invalid email");
        }
        // counts the amount of errors and shows this + where the errors occurred
    } else {
        if (count($form_errors) == 1) {
            $result = flashMessage("There was 1 error in the form");
        } else {
            $result = flashMessage("There were " . count($form_errors) . " errors in the form");
        }
    }

   }else{

//throw an error if token is not valid
$result = "<script type= 'text/javascript'>
swal('Error', 'This request originates from an unknown source, possible attack!', 'error');
</script>";

   }
    }
