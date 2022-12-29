<template layout="main">
    <Head>
        <title>Machine Embroidery designs</title>
        <meta name="description" content="Machine embroidery designs: Instant download: Smooth Stitching">
    </Head>
    <!--Hero image based on running promotion-->
<div class="bg-black-100 md:min-h-[60vh] lg:min-h-[30vh] py-5">
  <div class="grid md:grid-cols-4  p-3 md:px-8  h-full">
     <div class="grid place-content-center col-span-2 order-2 md:order-1">
         <div class="self-center text-white text-center md:text-start">
             <h1 class="font-bold text-3xl sm:text-4xl md:text-5xl font-montserrat md:leading-[56px]">Up to 20% Off. Top designs of the week.</h1>
             <h5 class="text-xl sm:text-2xl font-extralight mt-3 font-montserrat">Shop today and get the best offer!</h5>
            <div class="mt-8">
                <Link class="font-montserrat text-sm btn-primary font-bold" href="#">Get discount here <span class="ml-3"><i class="fal fa-long-arrow-right"></i></span></Link>
            </div>
         </div>
     </div>
      <div class="flex place-content-center col-span-2 order-1 md:order-2 justify-center">
          <div class="self-center">
              <img :src="'images/hero-image.png'" alt="Pink Peonies Design" class="w-80 md:2/3 lg:w-96">
          </div>
      </div>
  </div>
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

})
const recommends=props.products.data.slice(0, 5);
const featured=props.products.data.slice(5)
const {categories}=useCategory()





</script>


