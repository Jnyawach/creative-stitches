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
        <ol itemscope itemtype="https://schema.org/BreadcrumbList" class="flex font-montserrat">
            <li itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem" class="hover:text-teal-700 m-1 text-sm">
                <Link itemprop="item" href="/">
                    <span itemprop="name">Home</span></Link>
                <meta itemprop="position" content="1" />
            </li>
            <li class="m-1">|</li>

            <li itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem" class="hover:text-teal-700 m-1 text-sm">
                <Link itemprop="item" :href="route('shop.index')">
                    <span itemprop="name">Shop</span></Link>
                <meta itemprop="position" content="3" />
            </li>
        </ol>

        <h1 class="font-bold text-3xl">Finding something you love</h1>

    </div>

    <div class="px-3 mt-5 md:px-10 py-8">

        <!---Filter div-->
        <div class="flex justify-between py-3">
            <div>
                <button @click="filterModal=true" class="border rounded-full px-8 py-1 border-black-100
                font-semibold hover:bg-teal-700 hover:text-white hover:border-teal-700">
                    <span class="mr-2"><i class="far fa-sliders-h"></i></span>
                    Filter
                </button>
            </div>
            <div class="flex justify-center gap-3 self-center">
                <div class="self-center hidden sm:block">
                    <p class="text-sm font-bold">Showing Page {{products.meta.current_page}} of {{products.meta.last_page}}</p>
                </div>
                <div class="flex gap-1">
                    <Link :href="products.links.prev"  class="bg-teal-700 text-white rounded-full py-1 px-5"
                          :class="[products.links.prev?'cursor-pointer':'cursor-not-allowed']" :disabled="!products.links.prev">
                        <span class="mr-2"><i class="far fa-angle-left"></i></span>
                        PREV
                    </Link>
                    <Link :href="products.links.next"  class="bg-teal-700 text-white rounded-full py-1 px-5 "
                          :disabled="!products.links.next" :class="[products.links.next?'cursor-pointer':'cursor-not-allowed']">
                        NEXT <span class="ml-2"><i class="far fa-angle-right"></i></span>
                    </Link>
                </div>
            </div>


        </div>
        <!--current filter-->
        <div class="flex gap-2" v-if="filters">
            <h6 >Filters:</h6>
            <button class="bg-teal-700 text-sm text-white py-1 px-3 rounded-full font-semibold font-montserrat" v-if="filters.range" @click="deleteRange()">
                <span v-if="filters.range=='most-popular'">Most Popular<span class="ml-4"><i class="fal fa-times"></i></span></span>
                <span v-else-if="filters.range=='top-rated'">Top Rated<span class="ml-4"><i class="fal fa-times"></i></span></span>
                <span v-else-if="filters.range=='low-to-high'">Price Low-High<span class="ml-4"><i class="fal fa-times"></i></span></span>
                <span v-else-if="filters.range=='high-to-low'">Price High-Low<span class="ml-4"><i class="fal fa-times"></i></span></span>
            </button>
            <button class="bg-teal-700 text-sm text-white py-1 px-3 rounded-full font-semibold font-montserrat" v-if="filters.category" @click="deleteCategory()">
                <span>{{selectedCategory.name}}<span class="ml-4"><i class="fal fa-times"></i></span></span>
            </button>
            <button class="bg-teal-700 text-sm text-white py-1 px-3 rounded-full font-semibold font-montserrat" v-if="filters.price" @click="deletePrice()">
                <span v-if="filters.price=='0-1'">Price: Below $ 1.00<span class="ml-4"><i class="fal fa-times"></i></span></span>
                <span v-else-if="filters.price=='1-5'">Price: Between $ 1.00-$ 5.00<span class="ml-4"><i class="fal fa-times"></i></span></span>
                <span v-else-if="filters.price=='5-15'">Price: Between $ 5.00-$ 15.00<span class="ml-4"><i class="fal fa-times"></i></span></span>
                <span v-else-if="filters.price=='15-above'">Price: $ 15.00 and Above<span class="ml-4"><i class="fal fa-times"></i></span></span>
            </button>
            <button class="bg-teal-700 text-sm text-white py-1 px-3 rounded-full font-semibold font-montserrat" v-if="filters.hoop" @click="deleteHoop()">
                <span>{{selectedHoop.size_in_mm}}mm | {{selectedHoop.size_in_inches}} inches<span class="ml-4"><i class="fal fa-times"></i></span></span>
            </button>
        </div>
        <div class="self-center sm:hidden">
            <p class="text-sm font-bold">Showing Page {{products.meta.current_page}} of {{products.meta.last_page}}</p>
        </div>

        <div>
            <!-- product listings -->
            <product-list :products="products.data"></product-list>
        </div>

        <!--Secondary Pagination-->
        <div class="py-3 flex justify-center mt-5">
            <div>
                <div class="flex gap-2">
                    <Link :href="products.links.prev"  class="bg-teal-700 text-white rounded-full py-1 px-5"
                          :class="[products.links.prev?'cursor-pointer':'cursor-not-allowed']" :disabled="!products.links.prev">
                        <span class="mr-2"><i class="far fa-angle-left"></i></span>
                        PREV
                    </Link>

                    <Link :href="products.links.next"  class="bg-teal-700 text-white rounded-full py-1 px-5 "
                          :disabled="!products.links.next" :class="[products.links.next?'cursor-pointer':'cursor-not-allowed']">
                        NEXT <span class="ml-2"><i class="far fa-angle-right"></i></span>
                    </Link>
                </div>
                <p class="text-sm font-bold text-center mt-2">Showing Page {{products.meta.current_page}} of {{products.meta.last_page}}</p>
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
                                        <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600" v-model="filterForm.range" name="range" value="most-popular">
                                        Most Popular
                                    </label>
                                </div>
                                <div>
                                    <label class="creative-label">
                                        <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600" v-model="filterForm.range" name="range" value="top-rated">
                                        Top Rated
                                    </label>
                                </div>
                                <div>
                                    <label class="creative-label">
                                        <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600" v-model="filterForm.range" name="range" value="high-to-low">
                                        Price: High to Low
                                    </label>
                                </div>
                                <div>
                                    <label class="creative-label">
                                        <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600" v-model="filterForm.range" name="range" value="low-to-high">
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
                                        <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600" v-model="filterForm.price" name="price" value="0-1">
                                        Below $ 1.00
                                    </label>
                                </div>

                                <div>
                                    <label class="creative-label">
                                        <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600" v-model="filterForm.price" name="price" value="1-5">
                                        Between $ 1.00- $ 5.00
                                    </label>
                                </div>
                                <div>
                                    <label class="creative-label">
                                        <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600" v-model="filterForm.price" name="price" value="5-15">
                                        Between $ 5.00- $ 15.00
                                    </label>
                                </div>
                                <div>
                                    <label class="creative-label">
                                        <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600" v-model="filterForm.price" name="price" value="15-above">
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
                                    <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600" v-model="filterForm.category" name="hoop" :value="category.id">
                                    {{category.name}}
                                </label>
                            </div>

                        </div>
                    </div>
                    <div>
                        <h6 class="font-bold  text-teal-700">Hoop Size:</h6>
                        <div class="mt-3">
                            <div v-for="hoop in hoops" :key="hoop.id">
                                <label class="creative-label">
                                    <input type="radio" class="mr-2 checked:bg-teal-700 focus:outline-teal-600" v-model="filterForm.hoop" name="hoop" :value="hoop.id">
                                    {{hoop.size_in_mm}}mm | {{hoop.size_in_inches}}inches
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
