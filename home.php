<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <p>Coucou!</p>
    <h1 x-data="{ message: 'I ❤️ Alpine' }" x-text="message"></h1>

    <div x-data="{ count: 0 }">
        <button x-on:click="count++">Increment</button>
        <span x-text="count"></span>
    </div>  

    
    <div
           x-data="{products: []}"
           x-init="fetch('https://world.openfoodfacts.net/api/v2/product/3017624010701')
                      .then(response => response.json())
                      .then(data => products = data)">
    <div>
      <template x-for="product in products">

                <div x-text="product.id"></div>

      </template>
    </div>
</div>

</body>
</html>

