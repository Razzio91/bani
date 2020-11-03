<?php

function check_empty_fields($required_fields_array)
{
    $form_errors = array();


    foreach ($required_fields_array as $name_of_field) {
        if (!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL) {
            $form_errors[] = $name_of_field . " is a required field!";
        }
    }
    return $form_errors;
}

function check_min_length($fields_to_check_length)
{

    $form_errors = array();


    foreach ($fields_to_check_length as $name_of_field => $minimum_length_required) {
        if (strlen(trim($_POST[$name_of_field])) < $minimum_length_required) {
            $form_errors[] = $name_of_field . " is too short, must be {$minimum_length_required} characters long!";
        }
    }
    return $form_errors;
}

function check_email($data)
{

    $form_errors = array();
    $key = 'email';

    if (array_key_exists($key, $data)) {
        //check if email has a value
        if ($_POST[$key] != NULL) {

            //remove all illegal characters in the email
            $key = filter_var($key, FILTER_SANITIZE_EMAIL);


            //check if valid email
            if (filter_var($_POST[$key], FILTER_VALIDATE_EMAIL) === false) {
                $form_errors[] = $key . " is not a valid email address!";
            }
        }
    }
    return $form_errors;
}

function show_errors($form_errors_array)
{
    $errors = "<p><ul style='color:red';>";

    foreach ($form_errors_array as $the_error) {
        $errors .= "<li> {$the_error} </li>";
    }
    $errors .= "</ul></p>";
    return $errors;
}

function flashMessage($message, $passOrFail = "Fail")
{

    if ($passOrFail === "Pass") {
        $data = "<div class='alert alert-success'>{$message}</p>";
    } else {
        $data = "<div class='alert alert-danger'>{$message}</p>";
    }
    return $data;
}

function redirectTo($page)
{
    header("Location: {$page}.php");
}

function checkDuplicateEntries($table, $column_name, $value, $db)
{
    try {
        $sqlQuery = "SELECT * FROM " . $table . " WHERE " . $column_name . "=:column_name";
        $statement = $db->prepare($sqlQuery);
        $statement->execute(array(':column_name' => $value));

        if ($row = $statement->fetch()) {

            return true;
        }
        return false;
    } catch (PDOException $ex) {

        //undo exception    

    }
}

// remember me func()
function rememberMe($user_id)
{
    //secures the ID of the user string dont matter
    $encryptCookieData = base64_encode("UaQteh5i4y3dntstemYODEC{$user_id}");
    //30 days expiration
    setCookie("rememberUserCookie", $encryptCookieData, time() + 60 * 60 * 24 * 100, "/");
}

//cookie check
function isCookieValid($db)
{
    $isValid = false;

    if (isset($_COOKIE['rememberUserCookie'])) {

        //decoding cookie and extracting info


        $decryptCookieData = base64_decode($_COOKIE['rememberUserCookie']);
        $user_id = explode("UaQteh5i4y3dntstemYODEC", $decryptCookieData);
        $userID = $user_id[1];

        //does the ID exist in the db?
        $sqlQuery = "SELECT * FROM klant WHERE id = :klant_id";
        $statement = $db->prepare($sqlQuery);
        $statement->execute(array(':klant_id' => $userID));

        if ($row = $statement->fetch()) {
            $id = $row['klant_id'];
            $voornaam = $row['voornaam'];
            $isValid = true;
        } else {
            //if cookie dont exist destroy session and logout user
            $isValid = false;
            $this->signout();
        }
    }
    return $isValid;
}
function signout()
{
    unset($_SESSION['voornaam']);
    unset($_SESSION['klant_id']);

    if (isset($_COOKIE['rememberUserCookie'])) {
        unset($_COOKIE['rememberUserCookie']);
        setCookie('rememberUserCookie', null, -1, '/');
    }
    session_destroy();
    session_regenerate_id(true);
    redirectTo('index');
    // komt op terug
}

function guard()
{
    $isValid = true;
    $inactive = 60 * 2; //2 min inactief

    //hashing the users IP address and making sure the server sends the hashed ip
    $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

    if ((isset($_SESSION['fingerprint']) && $_SESSION['fingerprint']) != $fingerprint) {
        $isValid = false;
        signout();
    } else if ((isset($_SESSION['last_active']) && (time() - $_SESSION['last_active']) > $inactive) && $_SESSION['voornaam']) {
        $isValid = false;
        signout();
    } else {
        $_SESSION['last_active'] = time();
    }
    return $isValid;
}

function isValidImage($file){
    $form_errors = array();
    //split file array
    $part = explode(".", $file);

    //target the ext
    $extension = end($part);

    switch(strtolower($extension)){
        case 'jpg':
        case 'gif':
        case 'bmp':
        case 'png':

        return $form_errors;
    }

    $form_errors[] = $extension . " is not a valid image extension";
    return $form_errors;
}


function uploadAvatar($username){

    $isImageMoved = false;

    if($_FILES['avatar']['tmp_name']){
//temp location
        $temp_file = $_FILES['avatar']['tmp_name'];
        $ds = DIRECTORY_SEPARATOR; // uploads/
        $avatar_name = $username.".jpg";


        $path = "uploads".$ds.$avatar_name; //uploads/scream.jpg

        if(move_uploaded_file($temp_file, $path)){
            $isImageMoved= true;
        }
    }
     return $isImageMoved;
}

//csrf attacks creates token

function _token(){
    $randomToken = base64_encode(openssl_random_pseudo_bytes(32)); //generates a random token in a secured way
    // $randomToken = md5(uniqid(rand(), true));

    //store the token in the user session
    return $_SESSION['token'] = $randomToken;
}

// validates token
function validate_token($requestToken){
    if(isset($_SESSION['token']) && $requestToken ===$_SESSION['token']){
        unset($_SESSION['token']);

        return true;
    }

    return false;
}
