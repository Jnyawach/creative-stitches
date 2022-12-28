<template layout="main">
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
        </div>
    </section>

</template>
<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
import {ref} from "vue";
import ProductList from "@/views/components/products/product-list.vue";

let props=defineProps({
    products:Object
})
const recommends=props.products.data.slice(0, 4);





</script>


