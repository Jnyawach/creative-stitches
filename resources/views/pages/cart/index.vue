<template layout="main">
<div class="my-10 px-3 md:px-10 ">
 <div class="flex justify-between">
     <div>
         <h1 class="text-2xl font-bold">You Basket</h1>
         <p><span class="font-bold">Total:</span> {{cart.cartCount}} items - <span class="text-teal-700 font-bold">USD {{cart.cartTotal}}</span></p>
     </div>
     <div>
         <button v-if="!$page.props.auth" @click="store.login=true"  class="font-bold text-teal-700 underline text-xs md:text-lg">Login and Check out faster</button>
     </div>
 </div>

    <div class="grid md:grid-cols-5 mt-5 gap-5 lg:mx-10">
        <div class="col-span-3 space-y-3 gap-2">
            <div class="grid grid-cols-6 m-1 border p-2 rounded-lg gap-2" v-for="item in cart.items" >
                <div class="col-span-1">
                  <img :src="item.attributes.image" class="rounded-lg">
                </div>
                <div class="col-span-4">
                    <h6 class="flex justify-between text-sm lg:text-lg font-bold "><span>{{item.name}}</span>
                    <span class="font-bold text-teal-700 text-2xl">$ {{item.price}}</span></h6>
                    <p class="text-sm lg:text-md"><span class="text-teal-700">Formats:</span> {{item.attributes.format}}</p>
                    <p class="text-sm lg:text-md"><span class="text-teal-700">Total Stitches:</span> {{item.attributes.stitches}}</p>
                    <p class="text-sm lg:text-md"><span class="text-teal-700">Size:</span> {{item.attributes.size_mm}} mm | {{item.attributes.size_inches}} inches</p>
                </div>
                <div class="col-span-1 text-end">
                    <Link preserve-scroll v-if="$page.props.auth" :href="route('move.wishlist',item.id)" as="button" title="Save to Wishlist" method="patch"
                          class="text-xl m-2">

                        <span><i class="far fa-heart"></i></span>
                    </Link>
                    <Link v-else @click="store.login=true" as="button" title="Save to Wishlist"
                          class="m-2 text-xl ">

                        <span><i class="far fa-heart"></i></span>
                    </Link>
                     <Link title="Remove from cart" :href="route('cart.destroy',item.id)" as="button" method="delete"
                           preserve-scroll class="text-2xl hover:text-teal-700 m-2" >
                         <span><i class="fal fa-times"></i></span>
                     </Link>


                </div>
            </div>
        </div>

        <div class="col-span-2 m-1">
            <Link class="btn-primary w-full">Checkout <span class="ml-2"><i class="fal fa-long-arrow-right"></i></span></Link>
        </div>
    </div>

</div>
</template>

<script setup lang="ts">
import {computed} from "vue";
import {usePage} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
import {store} from "@/scripts/store/login";

const cart= computed(() => usePage().props.value.cart)
</script>

<style scoped>

</style>
