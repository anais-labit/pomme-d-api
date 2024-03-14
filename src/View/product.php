<?php

var_dump($_SERVER['REQUEST_URI']);

// Récupérer l'URL actuelle
$currentURL = $_SERVER['REQUEST_URI'];

// Diviser l'URL en segments en utilisant '/'
$urlSegments = explode('/', $currentURL);

// Récupérer le dernier segment qui contient l'ID du produit
$productID = end($urlSegments);

// Afficher l'ID du produit
echo "ID du produit : " . $productID;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="public/style/style.css">
    <title>Document</title>
</head>

<body>
    <header>
        <?php require_once 'header.php' ?>
    </header>
    <p> PAGE PRODUCT</p>


    <div x-data="{ elements: [], productId: '<?= $productID ?>' }" x-init="fetch(`https://world.openfoodfacts.org/api/v2/product/${productId}.json`)
            .then(response => response.json())
            .then(data => elements = [data.product])">

        <ul>
            <template x-for="element in elements">
                <li>
                    <a :href="'/plateforme/pomme-d-api/#' + element._id">retour</a>

                    <div x-text=" element.product_name">
                    </div>
                    <img :src="element.image_url" alt="">
                    <div x-text="element.allergens"></div>

                    <button :id="element._id">Add to favorite</button>
                    <div x-text="element.brands_tags"></div>
                    <div x-text="element.categories_tags"></div>
                    <div x-text="element.stores_tags"></div>
                    <div x-text="element.generic_name"></div>
                    <div x-text="element.nutriment_levels.fat"></div>




                </li>
            </template>
        </ul>


    </div>

</body>

</html>