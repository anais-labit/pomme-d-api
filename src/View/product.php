<?php
$currentURL = $_SERVER['REQUEST_URI'];
$urlSegments = explode('/', $currentURL);
$productID = end($urlSegments);
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
        <?php include 'header.php' ?>
    </header>

    <div class="m-5 mt-16" x-data="{ elements: [], productId: '<?= $productID ?>' }" x-init="fetch(`https://world.openfoodfacts.org/api/v2/product/${productId}.json`)
            .then(response => response.json())
            .then(data => elements = [data.product])">

        <ul>
            <template x-for="element in elements">
                <li>
                    <div class="flex justify-between mb-12">
                        <a :href="/#' + element._id">retour</a>
                        <button :id="element._id">Add to favorite</button>
                    </div>
                    
                    <div>
                    <div class="text-[32px] font-bold bg-green-200" x-text=" element.product_name"></div>
                    <div  class="text-[24px] mb-5" x-text="element.brands_tags"></div>
                    </div>
                    <div class="flex max-[640px]:flex-col lg:flex-row">
                        <div class="max-[640px] lg:w-2/6 flex justify-center">
                            <img :src="element.image_url" :alt="element.product_name">
                        </div>
                        <div class="flex flex-col">
                            <div class="text-wrap" x-text="element.generic_name"></div>
                            <div x-text="'Ingredients: ' + element.ingredients_text"></div>                            <div x-text="element.allergens"></div>
                            <div x-text="'Categorie: ' + element.categories"></div>
                            <div x-text="'energie : ' + element.nutriments.energy_value"></div>
                            <div x-text="element.nutriment_levels.fat"></div>
                            <div x-text="'Vendue :' + element.countries"></div>
                           
                            <img :src="'public/img/' + product.nutriscore_grade + '.svg'" alt="">
                        </div>
                        <div>
                            <p> Nutriments pour 100g</p>
                            <div x-text="'glucide: ' + element.nutriments.sugars"></div>
                            <div x-text="'sel: ' + element.nutriments.salt"></div>
                            <div x-text="'gras: ' + element.nutriments.fat"></div>
                            <div x-text="'dontgrassaturé: ' + element.nutriscore_data.saturated_fat"></div>
                            <div x-text="'calorie:' + element.nutriments.energy"></div>
                            <div x-text="'proteines: ' + element.nutriments.proteins"></div>
                            <div x-text="'fibre : ' + element.nutriments.fiber"></div>
                        </div>
                    </div>



                </li>
            </template>
        </ul>


    </div>
    
</body>
</html>

