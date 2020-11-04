<?php
$page_title = "Bani - Producten Page";

if (!isset($_GET['cat'])) {
    exit;
}
$cat = $_GET['cat'];
include_once 'partials/headers.php';
include_once 'partials/getProducts.php';
?>
<ul>
    <?php
    foreach ($products as $product) {
        echo '<li><a href="product.php?product=' . $product['artikel_id'] . '">' . $product['naam'] . '</a></li>';
    }
    ?>
</ul>
<?php
include_once 'partials/footers.php';
?>