<?php
include_once 'resources/database.php';
include_once 'resources/utilities.php';
include_once 'resources/session.php';


if (isset($_POST['changePasswordBtn'], $_POST['token'])) {
    if (validate_token($_POST['token'])) {
        //process the form
        //initialize an array to store any message from the form
        $form_errors = array();

        //form validation
        $required_fields = array('current_password', 'new_password', 'confirm_password');

        //call the function to check empty field and merge the return data into form_error[];
        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

        //fields that require minimum length
        $fields_to_check_length = array('new_password' => 6, 'confirm_password' => 6);

        //calls the function to check the min length and merge the return data into form_errors

        $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

        //if the errors array is empty(no errors) process the form data

        if (empty($form_errors)) {
            // the variables are equal to the input given by the user
            $id = $_POST['hidden_id'];
            $current_password = $_POST['current_password'];
            $password1 = $_POST['new_password'];
            $password2 = $_POST['confirm_password'];

            //checks if both inputs are not the same
            if ($password1 != $password2) {
                $result = flashMessage("New password and confirm does not match");
            } else {
                    try {
                    //process request//checks if old password == inTheDatabase
                    $sqlQuery = "SELECT wachtwoord FROM klant WHERE id =:klant_id";
                    $statement = $db->prepare($sqlQuery);

                    $statement->execute(array(':klant_id' => $id));

                    //checks if record is found

                    if ($row = $statement->fetch()) {
                        $password_from_db = $row['wachtwoord'];

                        if (password_verify($current_password, $password_from_db)) {

                            //hash the new password
                            $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

                            //SQL Stmt to update password
                            $sqlUpdate = "UPDATE klant SET wachtwoord = :wachtwoord WHERE id=:klant_id";
                            $statement = $db->prepare($sqlUpdate);
                            $statement->execute(array(':wachtwoord' => $hashed_password, ':klant_id' => $id));
                            // if everything worked out and there is a new entry to the row count show a success message
                            if ($statement->rowCount() === 1) {

                                $result = "<script type=\"text/javascript\">
                                swal({
                                    title:\"Operation Successful!\",
                                    text:\"Password updated successfully!\",
                                    type: 'success',
                                    confirmButtonText: \"Thank You!\"});
                                    </script>";
                            }else{
                                $result = flashMessage("No changes Saved!");
                            
                            
                        }
                     } else {
                            $result = "<script type=\"text/javascript\">
                            swal({
                                title:\"OOPS!!\",
                                text:\"old password is not correct, please try again\",
                                type: 'error',
                                confirmButtonText: \"Ok!\"});
                                </script>";
                            }
                    } else {
                        signout();
                    }
                } catch (PDOException $ex) {
                    $result = flashMessage("An error occurred: " . $ex->getMessage());
                }
            }
        }else {
            //counts the amount (empty forms array, wrong password etc)of errors in the form and shows this 
            if (count($form_errors) == 1) {
                $result = flashMessage("There was 1 error in the form<br>");
            } else {
                //if there are more errors show them
                $result = flashMessage("There were : " . count($form_errors) . " errors in the form<br>");
            }
          }
    } else //
    {

        $result = "<script type = 'text/javascript'>
        swal('Error', 'This request originates from an unknown source, possible attack!', 
        'error');
        </script>";
    }
}
