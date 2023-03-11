<template layout="main">
<Head>
    <title>My Wishlist</title>
    <meta name="description" content="Embroidery Design Wishlists">
</Head>
    <account-menu></account-menu>
    <div v-if="user.data.wishlist.length" class="py-10 grid sm:grid-cols-2 ">
       <div v-for="wishlist in user.data.wishlist" class="border rounded-xl overflow-hidden p-2 m-2">
           <Link :href="route('shop.show',wishlist.product.slug)" :title="wishlist.product.name">

           <div class="grid grid-cols-4 gap-2  ">
             <div class="col-span-1">
               <img :src="wishlist.product.mainImage.icon" class=" mx-auto rounded-xl" :alt="wishlist.product.name">
             </div>
               <div class="col-span-3">
                <h6 class="font-bold text-xl">{{wishlist.product.name}}</h6>
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
                                   m-2  text-xs hover:text-teal-700 hover:border-teal-700 font-semibold flex gap-1 group">

                                   <svg class="h-4 group-hover:fill-teal-700 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M144 400C144 408.8 136.8 416 128 416C119.2 416 112 408.8 112 400V176C112 167.2 119.2 160 128 160C136.8 160 144 167.2 144 176V400zM240 400C240 408.8 232.8 416 224 416C215.2 416 208 408.8 208 400V176C208 167.2 215.2 160 224 160C232.8 160 240 167.2 240 176V400zM336 400C336 408.8 328.8 416 320 416C311.2 416 304 408.8 304 400V176C304 167.2 311.2 160 320 160C328.8 160 336 167.2 336 176V400zM310.1 22.56L336.9 64H432C440.8 64 448 71.16 448 80C448 88.84 440.8 96 432 96H416V432C416 476.2 380.2 512 336 512H112C67.82 512 32 476.2 32 432V96H16C7.164 96 0 88.84 0 80C0 71.16 7.164 64 16 64H111.1L137 22.56C145.8 8.526 161.2 0 177.7 0H270.3C286.8 0 302.2 8.526 310.1 22.56V22.56zM148.9 64H299.1L283.8 39.52C280.9 34.84 275.8 32 270.3 32H177.7C172.2 32 167.1 34.84 164.2 39.52L148.9 64zM64 432C64 458.5 85.49 480 112 480H336C362.5 480 384 458.5 384 432V96H64V432z"/></svg>
                                   <span class="self-center">Remove from Wishlist</span>
                               </Link>
                           </div>

                               <div>
                                   <button type="button" class="text-white bg-teal-700 py-2 px-4 border rounded-full
                                   m-1 border-teal-700 text-xs  hover:bg-teal-900 font-semibold flex gap-1 ">

                                       <svg class="h-4 fill-white self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256C432 264.8 424.8 272 416 272h-176V448c0 8.844-7.156 16.01-16 16.01S208 456.8 208 448V272H32c-8.844 0-16-7.15-16-15.99C16 247.2 23.16 240 32 240h176V64c0-8.844 7.156-15.99 16-15.99S240 55.16 240 64v176H416C424.8 240 432 247.2 432 256z"/></svg>
                                       <span class="self-center">Add to Basket</span>
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
           </Link>
       </div>
    </div>
    <div v-else class="py-14 flex place-content-center">
       <div class="text-center">
           <h6 class="font-bold text-lg">You haven't saved products on the Wishlist!</h6>
           <div class="my-3">
               <Link :href="route('shop.index')" title="Shop all Products" class="btn-primary">Continue Shopping</Link>
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
