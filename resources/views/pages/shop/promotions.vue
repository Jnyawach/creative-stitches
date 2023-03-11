<template layout="main">
<Head>
    <title>{{promotion.data.name}}</title>
    <meta name="description" :content="'Embroidery design files on offer '+ promotion.data.name+ ' at great discount.' +
     'Shop today and get the best offer'">
    <meta name="keywords" content="machine embroidery designs, digital embroidery files, downloadable
embroidery file, embroidery designs, stitch designer">
    <meta property="og:title" :content="promotion.data.name">
    <meta property="og:description" :content="'Embroidery design files on offer '+ promotion.data.name+ ' at great discount.' +
     'Shop today and get the best offer'">
    <meta property="og:image" :content="promotion.data.mobile">
    <meta property="og:url" :content="route('shop.promotion',promotion.data.slug)">
    <meta name="twitter:title" :content="promotion.data.name">
    <meta name="twitter:description" :content="'Embroidery design files on offer '+ promotion.data.name+ ' at great discount.' +
     'Shop today and get the best offer'">
    <meta name="twitter:url" :content="route('shop.promotion',promotion.data.slug)">
    <meta name="twitter:card" :content="'Embroidery design files on offer '+ promotion.data.name+ ' at great discount.' +
     'Shop today and get the best offer'">
</Head>

    <div class="p-3 bg-teal-50">
        <div class="max-w-[1280px] mx-auto">
            <ol itemscope itemtype="https://schema.org/BreadcrumbList" class="flex font-montserrat">
                <li itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem" class="hover:text-teal-700 m-1 text-sm">
                    <Link itemprop="item" href="/">
                        <span itemprop="name">Home</span></Link>
                    <meta itemprop="position" content="1"/>
                </li>
                <li class="m-1">|</li>

                <li itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem" class="hover:text-teal-700 m-1 text-sm">
                    <Link itemprop="item" :href="route('shop.index')">
                        <span itemprop="name">Shop</span></Link>
                    <meta itemprop="position" content="3"/>
                </li>
            </ol>

            <h1 class="font-bold text-3xl">Finding something you love</h1>
        </div>
    </div>

    <div class="max-w-[1280px] mx-auto">
        <div class="px-3 mt-5 md:px-10 py-8">

            <!---Filter div-->
            <div class="flex justify-between py-3">
                <div>
                    <button @click="filterModal=true" class="border rounded-full px-3 sm:px-5 py-1 border-black-100
                        font-semibold hover:bg-teal-700 hover:text-white hover:border-teal-700 group flex gap-2">
                        <svg class="h-4 group-hover:fill-white self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 416C0 407.2 7.164 400 16 400H81.6C89.01 363.5 121.3 336 160 336C198.7 336 230.1 363.5 238.4 400H496C504.8 400 512 407.2 512 416C512 424.8 504.8 432 496 432H238.4C230.1 468.5 198.7 496 160 496C121.3 496 89.01 468.5 81.6 432H16C7.164 432 0 424.8 0 416V416zM208 416C208 389.5 186.5 368 160 368C133.5 368 112 389.5 112 416C112 442.5 133.5 464 160 464C186.5 464 208 442.5 208 416zM352 176C390.7 176 422.1 203.5 430.4 240H496C504.8 240 512 247.2 512 256C512 264.8 504.8 272 496 272H430.4C422.1 308.5 390.7 336 352 336C313.3 336 281 308.5 273.6 272H16C7.164 272 0 264.8 0 256C0 247.2 7.164 240 16 240H273.6C281 203.5 313.3 176 352 176zM400 256C400 229.5 378.5 208 352 208C325.5 208 304 229.5 304 256C304 282.5 325.5 304 352 304C378.5 304 400 282.5 400 256zM496 80C504.8 80 512 87.16 512 96C512 104.8 504.8 112 496 112H270.4C262.1 148.5 230.7 176 192 176C153.3 176 121 148.5 113.6 112H16C7.164 112 0 104.8 0 96C0 87.16 7.164 80 16 80H113.6C121 43.48 153.3 16 192 16C230.7 16 262.1 43.48 270.4 80H496zM144 96C144 122.5 165.5 144 192 144C218.5 144 240 122.5 240 96C240 69.49 218.5 48 192 48C165.5 48 144 69.49 144 96z"/></svg>
                        <span class="self-center">Filter</span>
                    </button>
                </div>
                <div class="flex justify-center gap-3 self-center">
                    <div class="self-center hidden sm:block">
                        <p class="text-sm font-bold">Showing Page {{ products.meta.current_page }} of
                            {{ products.meta.last_page }}</p>
                    </div>
                    <div class="flex gap-1">
                        <Link :href="products.links.prev" class="flex gap-1 bg-teal-700 text-white rounded-full py-1 px-3 sm:px-5"
                              :class="[products.links.prev?'cursor-pointer':'cursor-not-allowed']"
                              :disabled="!products.links.prev">
                            <svg class="fill-white h-4 self-center mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M203.9 405.3c5.877 6.594 5.361 16.69-1.188 22.62c-6.562 5.906-16.69 5.375-22.59-1.188L36.1 266.7c-5.469-6.125-5.469-15.31 0-21.44l144-159.1c5.906-6.562 16.03-7.094 22.59-1.188c6.918 6.271 6.783 16.39 1.188 22.62L69.53 256L203.9 405.3z"/></svg>
                            <span class="self-center">Prev</span>
                        </Link>
                        <Link :href="products.links.next" class="flex gap-1 bg-teal-700 text-white rounded-full py-1 px-3 sm:px-5 "
                              :disabled="!products.links.next"
                              :class="[products.links.next?'cursor-pointer':'cursor-not-allowed']">
                            <span class="self-center">Next</span>
                            <svg class="fill-white h-4 self-center ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                        </Link>
                    </div>
                </div>


            </div>
            <!--current filter-->
            <div class="flex gap-2" v-if="filters">
                <h6>Filters:</h6>
                <button class="bg-teal-700 text-sm text-white py-1 px-3 rounded-full font-semibold font-montserrat"
                        v-if="filters.range" @click="deleteSort()">
                    <span class="flex gap-1" v-if="filters.range=='most-popular'">Most Popular
                        <span class="ml-4 self-center">
                            <svg class="h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M315.3 411.3c-6.253 6.253-16.37 6.253-22.63 0L160 278.6l-132.7 132.7c-6.253 6.253-16.37 6.253-22.63 0c-6.253-6.253-6.253-16.37 0-22.63L137.4 256L4.69 123.3c-6.253-6.253-6.253-16.37 0-22.63c6.253-6.253 16.37-6.253 22.63 0L160 233.4l132.7-132.7c6.253-6.253 16.37-6.253 22.63 0c6.253 6.253 6.253 16.37 0 22.63L182.6 256l132.7 132.7C321.6 394.9 321.6 405.1 315.3 411.3z"/></svg>
                        </span>
                    </span>
                    <span class="flex gap-1" v-else-if="filters.range=='top-rated'">Top Rated
                       <span class="ml-4 self-center">
                            <svg class="h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M315.3 411.3c-6.253 6.253-16.37 6.253-22.63 0L160 278.6l-132.7 132.7c-6.253 6.253-16.37 6.253-22.63 0c-6.253-6.253-6.253-16.37 0-22.63L137.4 256L4.69 123.3c-6.253-6.253-6.253-16.37 0-22.63c6.253-6.253 16.37-6.253 22.63 0L160 233.4l132.7-132.7c6.253-6.253 16.37-6.253 22.63 0c6.253 6.253 6.253 16.37 0 22.63L182.6 256l132.7 132.7C321.6 394.9 321.6 405.1 315.3 411.3z"/></svg>
                        </span>
                    </span>
                    <span class="flex gap-1"  v-else-if="filters.range=='low-to-high'">Price Low-High
                       <span class="ml-4 self-center">
                            <svg class="h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M315.3 411.3c-6.253 6.253-16.37 6.253-22.63 0L160 278.6l-132.7 132.7c-6.253 6.253-16.37 6.253-22.63 0c-6.253-6.253-6.253-16.37 0-22.63L137.4 256L4.69 123.3c-6.253-6.253-6.253-16.37 0-22.63c6.253-6.253 16.37-6.253 22.63 0L160 233.4l132.7-132.7c6.253-6.253 16.37-6.253 22.63 0c6.253 6.253 6.253 16.37 0 22.63L182.6 256l132.7 132.7C321.6 394.9 321.6 405.1 315.3 411.3z"/></svg>
                        </span>
                    </span>
                    <span class="flex gap-1" v-else-if="filters.range=='high-to-low'">Price High-Low
                         <span class="ml-4 self-center">
                            <svg class="h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M315.3 411.3c-6.253 6.253-16.37 6.253-22.63 0L160 278.6l-132.7 132.7c-6.253 6.253-16.37 6.253-22.63 0c-6.253-6.253-6.253-16.37 0-22.63L137.4 256L4.69 123.3c-6.253-6.253-6.253-16.37 0-22.63c6.253-6.253 16.37-6.253 22.63 0L160 233.4l132.7-132.7c6.253-6.253 16.37-6.253 22.63 0c6.253 6.253 6.253 16.37 0 22.63L182.6 256l132.7 132.7C321.6 394.9 321.6 405.1 315.3 411.3z"/></svg>
                        </span>
                    </span>
                </button>
                <button class="flex gap-1 bg-teal-700 text-sm text-white py-1 px-3 rounded-full font-semibold"
                        v-if="filters.category" @click="deleteCategory()">
                    <span>{{ selectedCategory.name }}</span>
                    <span class="ml-4 self-center">
                            <svg class="h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M315.3 411.3c-6.253 6.253-16.37 6.253-22.63 0L160 278.6l-132.7 132.7c-6.253 6.253-16.37 6.253-22.63 0c-6.253-6.253-6.253-16.37 0-22.63L137.4 256L4.69 123.3c-6.253-6.253-6.253-16.37 0-22.63c6.253-6.253 16.37-6.253 22.63 0L160 233.4l132.7-132.7c6.253-6.253 16.37-6.253 22.63 0c6.253 6.253 6.253 16.37 0 22.63L182.6 256l132.7 132.7C321.6 394.9 321.6 405.1 315.3 411.3z"/></svg>
                        </span>
                </button>
                <button class="bg-teal-700 text-sm text-white py-1 px-3 rounded-full font-semibold font-montserrat"
                        v-if="filters.price" @click="deletePrice()">
                    <span class="flex gap-1" v-if="filters.price=='0-1'">Price: Below $ 1.00
                        <span class="ml-4 self-center">
                            <svg class="h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M315.3 411.3c-6.253 6.253-16.37 6.253-22.63 0L160 278.6l-132.7 132.7c-6.253 6.253-16.37 6.253-22.63 0c-6.253-6.253-6.253-16.37 0-22.63L137.4 256L4.69 123.3c-6.253-6.253-6.253-16.37 0-22.63c6.253-6.253 16.37-6.253 22.63 0L160 233.4l132.7-132.7c6.253-6.253 16.37-6.253 22.63 0c6.253 6.253 6.253 16.37 0 22.63L182.6 256l132.7 132.7C321.6 394.9 321.6 405.1 315.3 411.3z"/></svg>
                        </span>
                    </span>
                    <span class="flex gap-1" v-else-if="filters.price=='1-5'">Price: Between $ 1.00-$ 5.00
                       <span class="ml-4 self-center">
                            <svg class="h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M315.3 411.3c-6.253 6.253-16.37 6.253-22.63 0L160 278.6l-132.7 132.7c-6.253 6.253-16.37 6.253-22.63 0c-6.253-6.253-6.253-16.37 0-22.63L137.4 256L4.69 123.3c-6.253-6.253-6.253-16.37 0-22.63c6.253-6.253 16.37-6.253 22.63 0L160 233.4l132.7-132.7c6.253-6.253 16.37-6.253 22.63 0c6.253 6.253 6.253 16.37 0 22.63L182.6 256l132.7 132.7C321.6 394.9 321.6 405.1 315.3 411.3z"/></svg>
                        </span>
                    </span>
                    <span class="flex gap-1" v-else-if="filters.price=='5-15'">Price: Between $ 5.00-$ 15.00
                       <span class="ml-4 self-center">
                            <svg class="h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M315.3 411.3c-6.253 6.253-16.37 6.253-22.63 0L160 278.6l-132.7 132.7c-6.253 6.253-16.37 6.253-22.63 0c-6.253-6.253-6.253-16.37 0-22.63L137.4 256L4.69 123.3c-6.253-6.253-6.253-16.37 0-22.63c6.253-6.253 16.37-6.253 22.63 0L160 233.4l132.7-132.7c6.253-6.253 16.37-6.253 22.63 0c6.253 6.253 6.253 16.37 0 22.63L182.6 256l132.7 132.7C321.6 394.9 321.6 405.1 315.3 411.3z"/></svg>
                        </span>
                    </span>
                    <span v-else-if="filters.price=='15-above'">Price: $ 15.00 and Above
                       <span class="ml-4 self-center">
                            <svg class="h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M315.3 411.3c-6.253 6.253-16.37 6.253-22.63 0L160 278.6l-132.7 132.7c-6.253 6.253-16.37 6.253-22.63 0c-6.253-6.253-6.253-16.37 0-22.63L137.4 256L4.69 123.3c-6.253-6.253-6.253-16.37 0-22.63c6.253-6.253 16.37-6.253 22.63 0L160 233.4l132.7-132.7c6.253-6.253 16.37-6.253 22.63 0c6.253 6.253 6.253 16.37 0 22.63L182.6 256l132.7 132.7C321.6 394.9 321.6 405.1 315.3 411.3z"/></svg>
                        </span>
                    </span>
                </button>
                <button class="flex gap-1 bg-teal-700 text-sm text-white py-1 px-3 rounded-full font-semibold font-montserrat"
                        v-if="filters.hoop" @click="deleteHoop()">
                    <span>{{ selectedHoop.size_in_mm }}mm | {{ selectedHoop.size_in_inches }} inches</span>
                    <span class="ml-4 self-center">
                            <svg class="h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M315.3 411.3c-6.253 6.253-16.37 6.253-22.63 0L160 278.6l-132.7 132.7c-6.253 6.253-16.37 6.253-22.63 0c-6.253-6.253-6.253-16.37 0-22.63L137.4 256L4.69 123.3c-6.253-6.253-6.253-16.37 0-22.63c6.253-6.253 16.37-6.253 22.63 0L160 233.4l132.7-132.7c6.253-6.253 16.37-6.253 22.63 0c6.253 6.253 6.253 16.37 0 22.63L182.6 256l132.7 132.7C321.6 394.9 321.6 405.1 315.3 411.3z"/></svg>
                        </span>
                </button>
            </div>
            <div class="self-center sm:hidden">
                <p class="text-sm font-bold">Showing Page {{ products.meta.current_page }} of
                    {{ products.meta.last_page }}</p>
            </div>

            <div>
                <!-- product listings -->
                <product-list :products="products.data"></product-list>
            </div>

            <!--Secondary Pagination-->
            <div class="py-3 flex justify-center mt-5">
                <div>
                    <div class="flex gap-1">
                        <Link :href="products.links.prev" class="flex gap-1 bg-teal-700 text-white rounded-full py-1 px-3 sm:px-5"
                              :class="[products.links.prev?'cursor-pointer':'cursor-not-allowed']"
                              :disabled="!products.links.prev">
                            <svg class="fill-white h-4 self-center mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M203.9 405.3c5.877 6.594 5.361 16.69-1.188 22.62c-6.562 5.906-16.69 5.375-22.59-1.188L36.1 266.7c-5.469-6.125-5.469-15.31 0-21.44l144-159.1c5.906-6.562 16.03-7.094 22.59-1.188c6.918 6.271 6.783 16.39 1.188 22.62L69.53 256L203.9 405.3z"/></svg>
                            <span class="self-center">Prev</span>
                        </Link>
                        <Link :href="products.links.next" class="flex gap-1 bg-teal-700 text-white rounded-full py-1 px-3 sm:px-5 "
                              :disabled="!products.links.next"
                              :class="[products.links.next?'cursor-pointer':'cursor-not-allowed']">
                            <span class="self-center">Next</span>
                            <svg class="fill-white h-4 self-center ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                        </Link>
                    </div>
                    <p class="text-sm font-bold text-center mt-2">Showing Page {{ products.meta.current_page }} of
                        {{ products.meta.last_page }}</p>
                </div>
            </div>
        </div>
        <!-- Filter Modal-->
        <div>
            <Modal :show="filterModal" @close="filterModal=false">
                <template #header>
                    <h6 class="font-bold text-lg">Filter Designs</h6>
                </template>
                <div>
                    <div class="grid sm:grid-cols-2 md:grid-cols-3">
                        <div>
                            <div>
                                <h6 class="font-bold  text-teal-700">range By:</h6>
                                <div class="mt-3">
                                    <div>
                                        <label class="creative-label">
                                            <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600"
                                                   v-model="filterForm.range" name="range" value="most-popular">
                                            Most Popular
                                        </label>
                                    </div>
                                    <div>
                                        <label class="creative-label">
                                            <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600"
                                                   v-model="filterForm.range" name="range" value="top-rated">
                                            Top Rated
                                        </label>
                                    </div>
                                    <div>
                                        <label class="creative-label">
                                            <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600"
                                                   v-model="filterForm.range" name="range" value="high-to-low">
                                            Price: High to Low
                                        </label>
                                    </div>
                                    <div>
                                        <label class="creative-label">
                                            <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600"
                                                   v-model="filterForm.range" name="range" value="low-to-high">
                                            Price: Low to High
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <h6 class="font-bold  text-teal-700">Price:</h6>
                                <div class="mt-3">
                                    <div>
                                        <label class="creative-label">
                                            <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600"
                                                   v-model="filterForm.price" name="price" value="0-1">
                                            Below $ 1.00
                                        </label>
                                    </div>

                                    <div>
                                        <label class="creative-label">
                                            <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600"
                                                   v-model="filterForm.price" name="price" value="1-5">
                                            Between $ 1.00- $ 5.00
                                        </label>
                                    </div>
                                    <div>
                                        <label class="creative-label">
                                            <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600"
                                                   v-model="filterForm.price" name="price" value="5-15">
                                            Between $ 5.00- $ 15.00
                                        </label>
                                    </div>
                                    <div>
                                        <label class="creative-label">
                                            <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600"
                                                   v-model="filterForm.price" name="price" value="15-above">
                                            Above $ 15.00
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h6 class="font-bold  text-teal-700">Categories:</h6>
                            <div class="mt-3">
                                <div v-for="category in categories" :key="category.id">
                                    <label class="creative-label">
                                        <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600"
                                               v-model="filterForm.category" name="hoop" :value="category.id">
                                        {{ category.name }}
                                    </label>
                                </div>

                            </div>
                        </div>
                        <div>
                            <h6 class="font-bold  text-teal-700">Hoop Size:</h6>
                            <div class="mt-3">
                                <div v-for="hoop in hoops" :key="hoop.id">
                                    <label class="creative-label">
                                        <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600"
                                               v-model="filterForm.hoop" name="hoop" :value="hoop.id">
                                        {{ hoop.size_in_mm }}mm | {{ hoop.size_in_inches }}inches
                                    </label>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
                <template #footer>
                    <div class="flex justify-end gap-3 mt-3">
                        <button class="btn-link" @click="filterModal=false">Cancel</button>
                        <button class="btn-primary" @click="filterProduct">Apply Filter</button>
                    </div>
                </template>

            </Modal>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
import ProductList from "@/views/components/products/product-list.vue";
import Modal from "@/views/components/modal.vue";
import {ref,reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";
let props=defineProps({
    promotion:Object,
    products:Object,
    hoops:Object,
    filters:Object,
    selectedHoop:Object,
    categories:Object,
    selectedCategory:Object
})

const filterModal=ref(false)

let filterForm=reactive({
    range:props.filters.range,
    price:props.filters.price,
    hoop:props.filters.hoop,
    category:props.filters.category
})

const filterProduct=()=>{
    Inertia.get(route('shop.index'),{
        range:filterForm.range, price:filterForm.price, hoop:filterForm.hoop,
        category:filterForm.category
    }, {preserveState:true, replace:true});
    filterModal.value=false;
}

function deleteRange(){
    filterForm.range=null;
    filterProduct();
}

function deletePrice(){
    filterForm.price=null;
    filterProduct();
}
function deleteHoop(){
    filterForm.hoop=null;
    filterProduct();
}
function deleteCategory(){
    filterForm.category=null;
    filterProduct();
}
</script>

<style scoped>

</style>
