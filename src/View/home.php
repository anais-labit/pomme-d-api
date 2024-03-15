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
    itemsPerPage: 12,
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
        const url = `https://world.openfoodfacts.org/api/v2/search?categories_tags=${this.userInput}`;
        fetch(url)
            .then(response => response.json())
            .then(data => this.products = data.products)
            .catch(error => console.error('Error fetching products:', error));
    }
}" x-init="fetchProducts()">
        <div class="w-screen p-5 flex justify-end">
        <form class="flex gap-1  items-center" @submit.prevent="fetchQuery">
            <x-search-modal>
                <input x-model="userInput" name="userInput" type="text" class="rounded-lg text-3xl font-semibold tracking-wide text-[#5A945B] max-[640px]:ml-32 focus:border-[#5A945B] shadow-xl border-4 px-4 py-2  max-[640px]:w-3/4 lg:w-full">
            </x-search-modal>

            <button type="submit">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="text-[#5A945B] w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </button>
        </form>
        </div>

        <!-- Affichage des produits de la page courante -->
        <div class="grid max-[640px]:grid-cols-2 lg:grid-cols-4 m-5 max-[640px]:gap-2 lg:gap-8 justify-center">
            <template x-for="product in paginatedData()" :key="product.id">
                <div :id="product.id" class="flex flex-col justify-around items-center border-2 rounded-2xl">
                    <div class="flex justify-center w-full h-1/2 items-center p-5">
                        <img :src="product.image_url" alt="" class="object-contain h-48 w-64">
                    </div>
                    <div class="h-1/2 my-5">
                        <div class="mx-5">
                            <div x-text="product.brands_tags" class="uppercase text-xl"></div>
                            <div x-text="product.product_name" class="text-lg"></div>
                        </div>
                        <div class="flex max-[640px]:flex-col justify-center items-center gap-8"> 
                            <img :src="'public/img/' + product.nutriscore_grade + '.svg'" alt="" class="max-[640px]:w-3/4 lg:w-1/3 max-[640px]:py-2 lg:py-5">
                             <a class="text-xl underline" :href="'product/' + product._id">Show infos</a>
                        </div>
                        <div class="flex justify-center w-full p-5">
                            
                            <button class="underline" :id="product._id">Add to favorite</button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <div>
            <ul>
                <template x-for="product in userProducts" :key="product.code">
                    <li x-text="product.product_name"></li>
                </template>
            </ul>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between text-2xl m-12">
        <button @click="prevPage()" :disabled="currentPage === 1">Previous</button>
        <button @click="nextPage()" :disabled="currentPage === totalPages()">Next</button>
        </div>
    </div>


</body>

</html>