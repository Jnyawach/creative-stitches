<template layout="main">
<Head>
    <title>My Wishlist</title>
    <meta name="description" content="Embroidery Design Wishlists">
</Head>
    <account-menu></account-menu>
    <div class="py-10 grid sm:grid-cols-2 ">
       <div v-for="wishlist in user.data.wishlist" class="border rounded-xl overflow-hidden p-2 m-2">
           <div class="grid grid-cols-4 gap-2  ">
             <div class="col-span-1">
               <img :src="wishlist.product.mainImage.icon" class=" mx-auto rounded-xl">
             </div>
               <div class="col-span-3">
                <h6 class="font-bold text-xl">{{wishlist.product.name}}</h6>
                   <p class="text-sm sm:text-md">
                       <span class="text-teal-700 mr-2">
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                           <span><i class="fas fa-star-half-alt"></i></span>
                           (624)
                       </span>
                   </p>
                   <div class="hidden md:flex justify-between gap-3">
                       <div>
                           <div>
                               <p class="text-xl font-bold font-montserrat">
                                   USD {{wishlist.product.price}}
                                   <span v-if="wishlist.product.promotion" class="ml-1 text-teal-700 line-through text-xs">
                                             USD {{Number(wishlist.product.promotion.discount/100*wishlist.product.price+wishlist.product.price).toFixed(2)}}</span>
                               </p>
                           </div>
                           <p class="text-sm"><span class="text-teal-700">Total Stitches:</span> {{wishlist.product.total_stitches}}</p>
                           <p class="text-sm"><span class="text-teal-700">SKU:</span> {{wishlist.product.sku}}</p>
                       </div>
                       <div class="text-center">
                           <div >
                               <Link :href="route('wishlist.destroy',wishlist.id)" method="delete" as="button" class="text-black-100
                                   m-2  text-xs hover:text-teal-700 hover:border-teal-700 font-semibold">
                                   <span class="mr-2"><i class="far fa-trash-alt"></i></span>Remove from Wishlist
                               </Link>
                           </div>

                               <div>
                                   <button type="button" class="text-white bg-teal-700 py-2 px-4 border rounded-full
                                   m-1 border-teal-700 text-xs  hover:bg-teal-900 font-semibold">
                                       <span class="mr-2"><i class="far fa-plus"></i></span>Add to Basket
                                   </button>
                               </div>

                       </div>
                   </div>

               </div>
           </div>
           <div class="flex justify-between gap-3 md:hidden">
               <div>
                   <div>
                       <p class="text-xl font-bold font-montserrat">
                           USD {{wishlist.product.price}}
                           <span v-if="wishlist.product.promotion" class="ml-1 text-teal-700 line-through text-xs">
                                             USD {{Number(wishlist.product.promotion.discount/100*wishlist.product.price+wishlist.product.price).toFixed(2)}}</span>
                       </p>
                   </div>
                   <p class="text-sm"><span class="text-teal-700">Total Stitches:</span> {{wishlist.product.total_stitches}}</p>
                   <p class="text-sm"><span class="text-teal-700">SKU:</span> {{wishlist.product.sku}}</p>
               </div>
               <div class="text-center">
                   <div >
                       <Link :href="route('wishlist.destroy',wishlist.id)" method="delete" as="button" class="text-black-100
                                   m-2  text-xs hover:text-teal-700 hover:border-teal-700 font-semibold">
                           <span class="mr-2"><i class="far fa-trash-alt"></i></span>Remove from Wishlist
                       </Link>
                   </div>

                   <div>
                       <button type="button" class="text-white bg-teal-700 py-2 px-4 border rounded-full
                                   m-1 border-teal-700 text-xs  hover:bg-teal-900 font-semibold">
                           <span class="mr-2"><i class="far fa-plus"></i></span>Add to Basket
                       </button>
                   </div>

               </div>
           </div>
       </div>
    </div>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import AccountMenu from "@/views/components/account-menu.vue";
import {Link} from "@inertiajs/inertia-vue3";
let props=defineProps({
    user:Object
})


</script>

<style scoped>

</style>
