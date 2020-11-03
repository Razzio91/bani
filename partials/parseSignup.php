<?php
include_once "resources/database.php";
include_once "resources/utilities.php";
include_once "resources/send-email.php";
//process the form
if (isset($_POST['signupBtn'], $_POST['token'])) {

    if(validate_token($_POST['token'])){

        // process the form
        $form_errors = array();


    //form validations
    $required_fields = array('voornaam', 'achternaam', 'postcode', 'huisnummer', 'telefoonnummer', 'email', 'wachtwoord');

    // call the function to check empty fields

    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    //fields that require min length of 4 chars
    $fields_to_check_length = array('wachtwoord' => 6);

    //call the function to check minimum req length n merge the return data

    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    //email validation
    $form_errors = array_merge($form_errors, check_email($_POST));

   
   
    $voornaam = $_POST['voornaam'];

    $tussenvoegsel = $_POST['tussenvoegsel'];
    $achternaam = $_POST['achternaam'];
    $postcode = $_POST['postcode'];
    $huisnummer = $_POST['huisnummer'];
    $telefoonnummer = $_POST['telefoonnummer'];
    $wachtwoord = $_POST['wachtwoord'];
    $email = $_POST['email'];

    if (checkDuplicateEntries("klant", "email", $email, $db)) {
        $result = flashMessage("Email is already taken, please try another one...");
    } elseif (empty($form_errors)) {

        $hashed_password = password_hash($wachtwoord, PASSWORD_DEFAULT);
        try {
            $sqlInsert = "INSERT INTO klant(voornaam, tussenvoegsel, achternaam, postcode, huisnummer, telefoonnummer, email, wachtwoord)
                VALUES(:voornaam, :tussenvoegsel, :achternaam, :postcode, :huisnummer, :telefoonnummer, :email, :wachtwoord)";


            $statement = $db->prepare($sqlInsert);
            $statement->execute(array(':voornaam' => $voornaam, ':tussenvoegsel' => $tussenvoegsel, ':achternaam' => $achternaam, ':postcode' => $postcode,':huisnummer' => $huisnummer, ':telefoonnummer' => $telefoonnummer,':email' => $email, ':wachtwoord' => $hashed_password));

            if ($statement->rowCount() == 1) {
                $user_id = $db->lastInsertId(); // this targets the Last inserted ID added to the database
                $encode_id = base64_encode("encodeuserid{$user_id}"); //    

                $mail_body = '<html>
                <body style="background-color:#CCCCCC; color:#000; font-family: Arial, Helvetica, sans-serif;
                    line-height:1.8em;">
                <h2>User Authentication: Code A Secured Login System</h2>
                <p>Dear ' . $voornaam . '<br><br>Thank you for registering, please click on the link below to
	            confirm your email address</p>
                <p><a href="https://localhost/bani/activate.php?id=' . $encode_id . '">Confirm Email</a></p> 
                <p><strong>&copy;2020 Arazzio</strong></p>
</body>
</html>';
                // http://localhost/activate.php?id=  (the localhost part needs to change if you are on a live server)


                //recipient information
                $mail->addAddress($email, $voornaam);
                $mail->Subject = "Bani Supermarkt";
                $mail->Body = $mail_body;

                if (!$mail->Send()) { // checks if the mail was not sent if its false we show the next error
                    $result = "<script type=\"text/javascript\">
                        swal(\"Error\",\" Email sending failed: $mail->ErrorInfo \",\"error\");</script>";
                } else { // if the mail was sent we show a message saying to check their mail
                    $result = "<script type=\"text/javascript\">
                                swal({
                                title: \"Welcome $voornaam!\",
                                text: \"Registration Completed Successfully. Please check your email for confirmation link\",
                                type: 'success',
                                timer: 3000,
                                confirmButtonText: \"Thank You!\" });
                                setTimeout(function(){
                                    window.location.href='login.php';}, 2000);
                            </script>";
                }
            }
        } catch (PDOException $ex) {

            $result = flashMessage("An error occurred: " . $ex->getMessage());
        }
    } else {
        if (count($form_errors) == 1) {
            $result = flashMessage("There was 1 error in the form<br>");
        } else {
            $result = flashMessage("There were " . count($form_errors) . " errors in the form <br>");
        }
    }
    } else {  
 //throw an error if token is not valid
$result = "<script type= 'text/javascript'>
swal('Error', 'This request originates from an unknown source, possible attack!', 'error');
</script>";

    }
    
}

//activation
if(isset($_GET['klant_id'])) {
    $encoded_id = $_GET['klant_id'];
    $decode_id = base64_decode($encoded_id);
    $user_id_array = explode("encodeuserid", $decode_id);
    $id = $user_id_array[1];
    
    $sql = "UPDATE klant SET geactiveerd =:geactiveerd WHERE id=:klant_id AND geactiveerd='0', '1'";
    
    $statement = $db->prepare($sql);
    $statement->execute(array(':geactiveerd' => "1", ':klant_id' => $id));
    
    if ($statement->rowCount() == 1) {
    $result = '<h2>Email Confirmed </h2>
    <p>Your email address has been verified, you can now <a href="login.php">login</a> with your email and password.</p>';
    } else {
    $result = "<p class='lead'>No changes made please contact site admin,
        if you have not confirmed your email before</p>";
    }
    }
