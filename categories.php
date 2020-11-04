<?php
$page_title = "Bani - Categorieën";

include_once 'partials/headers.php';
include_once 'partials/getCategories.php';
?>

<ul>
    <?php
    foreach ($categories as $category) {
        echo '<li><a href="products.php?cat=' . $category['categorie_id'] . '">' . $category['naam'] . '</a></li>';
    }
    ?>
</ul>

<?php
include_once 'partials/footers.php';
?>