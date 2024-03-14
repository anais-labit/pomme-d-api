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

    <div x-data="{
    products: [],
    currentPage: 1,
    itemsPerPage: 5,
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
    nextPage() {
        if (this.currentPage < Math.ceil(this.products.length / this.itemsPerPage)) {
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
    },
    userInput: '', 
    userProducts: [],
    fetchQuery() {
        const url = `https://world.openfoodfacts.org/cgi/search.pl?search_terms=${this.userInput}`;
        const options = {
            mode: 'no-cors'
        };
        fetch(url)
            .then(response => response.json())
            .then(data => this.products = data.products)
            .catch(error => console.error('Error fetching products:', error));
    }
}" x-init="fetchProducts()">

        <form class="flex gap-1 items-center" @submit.prevent="fetchQuery">
            <x-search-modal>
                <input x-model="userInput" name="userInput" type="text" class="rounded-lg text-3xl font-semibold tracking-wide text-cyan-500 focus:border-cyan-400 shadow-xl border-4 px-4 py-2 w-full">
            </x-search-modal>

            <button type="submit">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="text-cyan-300 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </button>
        </form>

        <!-- Affichage des produits de la page courante -->
        <ul>
            <template x-for="product in paginatedData()" :key="product.id">
                <li>
                    <div :id="product.id">
                        <div x-text="product.product_name"></div>
                        <img :src="product.image_url" alt="">
                        <div x-text="product.allergens"></div>
                        <a :href="'product/' + product._id">Show infos</a>
                        <button :id="product._id">Add to favorite</button>
                    </div>
                    <!-- Bloc pour afficher les informations supplémentaires -->
                    <!-- <div x-show="showProductInfo[product._id]" x-cloak x-transition.opacity>
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
                    </div> -->
                </li>
            </template>
        </ul>



        <div>
            <ul>
                <template x-for="product in userProducts" :key="product.code">
                    <li x-text="product.product_name"></li>
                </template>
            </ul>
        </div>

        <!-- Pagination -->
        <button @click="prevPage()" :disabled="currentPage === 1">Previous</button>
        <button @click="nextPage()" :disabled="currentPage === totalPages()">Next</button>
    </div>


</body>

</html>