<?php
include_once 'resources/database.php';
$query = 'SELECT * FROM artikel WHERE categorie_id=:cat';
$statement = $db->prepare($query);
$statement->execute([':cat' => $cat]);
$products = [];
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    array_push($products, $row);
}
