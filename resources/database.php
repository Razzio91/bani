<?php
// define the database name/host and set a password for it
$username = 'root';//root/username
$dsn = 'mysql:host=localhost; dbname=bani';//database name + host
$password = "";//password for database

// $db = new PDO($dsn, $username, $password);

try {
    //create an instance of the PDO class with the required parameters
    $db = new PDO($dsn, $username, $password);

    //set PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch (PDOException $ex) {
    //display error message
    echo "Connection failed" . $ex->getMessage();
}

// contact form

?>
