<?php
include_once 'resources/database.php';
$query = 'SELECT categorie_id,naam FROM categorie';
$statement = $db->prepare($query);
$statement->execute();
$categories = [];
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    array_push($categories, $row);
}
