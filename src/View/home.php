<?php
// Autoriser les requêtes CORS depuis n'importe quelle origine
header("Access-Control-Allow-Origin: *");

// Autoriser les méthodes HTTP spécifiques
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Document</title>
</head>

<body>
<style>
    [x-cloak]{
        display: none !important;
    }   
</style>
    <div x-data="{
        products: [],
        currentPage: 1,
        itemsPerPage: 5,
        showProductInfo: false,
        paginatedData() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.products.slice(start, end);
        },
        nextPage() {
            if (this.currentPage < this.totalPages()) {
                this.currentPage++;
            }
        },
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        totalPages() {
            return Math.ceil(this.products.length / this.itemsPerPage);
        }
    }" x-init="fetch('https://world.openfoodfacts.net/api/v2/search')
            .then(response => response.json())
            .then(data => products = data.products)">

        <!-- Affichage des produits de la page courante -->
        <ul>
            <template x-for="product in paginatedData()" :key="product.id">
                <li>
                    <div x-text="product.product_name"></div>
                    <img :src="product.image_url" alt="">
                    <div x-text="product.allergens"></div>
                    <button :id="product._id" x-data="showProductInfo= ! showProductInfo">Show infos</button>
                    <button :id="product._id">Add to favorite</button>

                </li>
            </template>
        </ul>

        
        
        <!-- Pagination -->
        <button @click="prevPage()" :disabled="currentPage === 1">Previous</button>
        <span x-text="`Page ${currentPage} of ${totalPages()}`"></span>
        <button @click="nextPage()" :disabled="currentPage === totalPages()">Next</button>
        
        
        
    </div>
    <div x-data="{ showProductInfo: false,
    }">
    <button @click="showProductInfo = true">Show infos</button>

    <div 
        x-show="showProductInfo" 
        x-cloak 
        x-transition.opacity
        x-bind:style="z-index: 100"
    >

        <div  class="popup-background"         x-bind:style="z-index: 101" style="background-color: rgba(0, 0, 0, 0.900); width: 100%; height: 100%">
        <div class="popup-content"         x-bind:style="z-index: 102"  style="background-color: wheat; width: 50%; height: 50%; " >
            <button @click="showProductInfo = false">X</button>
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
</div>

</body>

</html>