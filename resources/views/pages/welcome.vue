<template layout="main">
    <Head>
        <title>Machine Embroidery designs</title>
        <meta name="description" content="Machine embroidery designs: Instant download: Smooth Stitching">
    </Head>
    <!--Hero image based on running promotion-->
    <div class="grid">
        <Link :href="route('shop.promotion',promotion.data.slug)" :title="promotion.data.name">
            <div class="hidden sm:block">
                <img :src="promotion.data.banner" :alt="promotion.data.name">
            </div>
            <div class="sm:hidden">
                <img :src="promotion.data.mobile" :alt="promotion.data.name">
            </div>
        </Link>

    </div>
    <!---Recommended for you-->
   <section>
       <div class="my-14 px-3 md:px-10">
           <h2 class="font-bold text-2xl">Recommended for you</h2>
           <product-list :products="recommends"></product-list>
       </div>
   </section>
    <section>
        <!----Shop by category-->
        <div class="my-14 px-3 md:px-10">
            <h2 class="font-bold text-2xl">Shop by Category</h2>
            <div class="mt-10 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 justify-center gap-2">
             <div v-for="category in categories" :key="category.id">
                <Link :title="category.name" href="#">
                    <div class="text-center relative overflow-hidden text-center rounded-md group">
                        <img :src="category.image" class="hover:scale-110 duration-200 relative" :alt="category.name">
                        <div class="absolute bottom-6 left-0 right-0 mx-auto">
                            <button class="bg-white px-5 py-2 rounded-full font-montserrat text-sm
                            font-semibold shadow group-hover:text-teal-700">
                                {{category.name}}
                            </button>
                        </div>

                    </div>
                </Link>
             </div>
            </div>
        </div>
    </section>
    <section>
        <!--rest of the products-->
        <div class="my-14 px-3 md:px-10">
            <h2 class="font-bold text-2xl">Featured Designs</h2>
            <product-list :products="featured"></product-list>
        </div>

    </section>

    <section class="bg-stone-100 py-14 px-5 md:px-18">
         <div class="grid grid-cols-2 sm:grid-cols-3 justify-center gap-2">
             <div class="text-center md:px-16">
                 <p class="text-4xl"><i class="fa-light fa-shield-cross"></i></p>
                 <h6 class="font-bold text-lg text-teal-700 mt-2">Secure Payment</h6>
                 <p>100% Secure payment with 256-bit SSL Encryption</p>
             </div>

             <div class="text-center md:px-16">
                 <p class="text-4xl"><i class="fa-regular fa-alarm-clock"></i></p>
                 <h6 class="font-bold text-lg text-teal-700 mt-2">24/7 Support</h6>
                 <p>We have a dedicated Support team. Ready to help you 24/7</p>
             </div>

             <div class="text-center md:px-16">
                 <p class="text-4xl"><i class="fa-regular fa-comments-question"></i></p>
                 <h6 class="font-bold text-lg text-teal-700 mt-2">See our FAQS</h6>
                 <p>We answer almost all embroidery questions that you may have</p>
             </div>

         </div>
    </section>

</template>
<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
import ProductList from "@/views/components/products/product-list.vue";
import {Head} from "@inertiajs/inertia-vue3";
import {useCategory} from "@/scripts/use/useCategory";

let props=defineProps({
    products:Object,
    promotion:Object,

})
const recommends=props.products.data.slice(0, 5);
const featured=props.products.data.slice(5)
const {categories}=useCategory()





</script>


