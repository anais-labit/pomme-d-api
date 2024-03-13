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
<div x-data="{
    products: [],
    currentPage: 1,
    itemsPerPage: 5,
    showProductInfo: {},
    fetchProducts() {
        fetch('https://world.openfoodfacts.org/api/v2/search')
            .then(response => response.json())
            .then(data => this.products = data.products);
    },
    paginatedData() {
        const start = (this.currentPage - 1) * this.itemsPerPage;
        const end = start + this.itemsPerPage;
        return this.products.slice(start, end);
    },
    toggleProductInfo(productId) {
        if (this.showProductInfo.hasOwnProperty(productId)) {
            this.showProductInfo[productId] = !this.showProductInfo[productId];
        } else {
            this.showProductInfo[productId] = true; // Utilisation de l'opérateur d'assignation
        }
    },
    nextPage() {
        if (this.currentPage < Math.ceil(this.products.length / this.itemsPerPage)) {
            this.currentPage++;
        }
    },
    prevPage() {
        if (this.currentPage > 1) {
            this.currentPage--;
        }
    }
}" x-init="fetchProducts()">

        <!-- Affichage des produits de la page courante -->
        <ul>
            <template x-for="product in paginatedData()" :key="product.id">
                <li>
                    <div x-text="product.product_name"></div>
                    <img :src="product.image_url" alt="">
                    <div x-text="product.allergens"></div>
                    <button @click="toggleProductInfo(product._id)">Show infos</button>
                    <button :id="product._id">Add to favorite</button>
                    <!-- Bloc pour afficher les informations supplémentaires -->
                    <div x-show="showProductInfo[product._id]" x-cloak x-transition.opacity>
                        <div class="popup-background" style="background-color: rgba(0, 0, 0, 0.9); width: 100%; height: 100%;">
                            <div class="popup-content" style="background-color: wheat; width: 50%; height: 50%; z-index: 101;">
                                <button @click="toggleProductInfo(product._id)">X</button>
                                <h2>Product info</h2>
                                <p>Product name: <span x-text="product.product_name"></span></p>
                                <p>Brand: <span x-text="product.brands"></span></p>
                                <p>Quantity: <span x-text="product.quantity"></span></p>
                                <p>Ingredients: <span x-text="product.ingredients_text"></span></p>
                                <p>Allergens: <span x-text="product.allergens"></span></p>
                                <p>Labels: <span x-text="product.labels"></span></p>
                                <p>Stores: <span x-text="product.stores"></span></p>
                                <p>Country: <span x-text="product.countries"></span></p>
                            </div>
                        </div>
                    </div>
                </li>
            </template>
        </ul>
</div>


</body>

</html>