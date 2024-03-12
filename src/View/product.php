<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p> PAGE PRODUCT</p>


    <div x-data="{elements: []}" 
    x-init="fetch('https://world.openfoodfacts.net/api/v2/search?code=737628064502')
            .then(response => response.json())
            .then(data => elements = data.elements)">

        <ul>
            <template x-for="element in elements">
                <li>
                    <div x-text="element.product_name"></div>
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