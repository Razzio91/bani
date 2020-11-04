<?php
include_once 'resources/database.php';
$query = 'SELECT * FROM artikel WHERE artikel_id=:id';
$statement = $db->prepare($query);
$statement->execute([':id' => $product_id]);
$product = $statement->fetch(PDO::FETCH_ASSOC);

// product prijs
$query = 'SELECT prijs FROM prijs WHERE artikel_id=:id';
$statement = $db->prepare($query);
$statement->execute([':id' => $product_id]);
$product['prijs'] = $statement->fetch()[0];
