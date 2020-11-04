<?php
$page_title = "Bani - Product Page";

if (!isset($_GET['product'])) {
    exit;
}
$product_id = $_GET['product'];
include_once 'partials/headers.php';
include_once 'partials/getProduct.php';
?>
<h1><?php echo $product['naam'] ?></h1>
<p>
    <?php echo $product['omschrijving'] ?>
</p>
<div>Prijs: €<?php echo $product['prijs'] ?></div>
<div>Voorraad: <?php echo $product['voorraad'] ?></div>
<?php
include_once 'partials/footers.php';
?>