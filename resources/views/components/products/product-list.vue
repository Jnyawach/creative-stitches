<template>
    <div v-if="products.length">
    <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3  justify-center">
        <div v-for="product in products" :key="product.id">
            <div class="relative">
                <div class="overflow-hidden rounded-md ">
                    <img :src="product.mainImage.icon" class="cursor-pointer hover:scale-110 duration-200"
                         :alt="product.name" :title="product.name" @click="triggerModal(product)">
                </div>

                <Link preserve-scroll v-if="$page.props.auth" :href="route('wishlist.update',product.id)" as="button" title="Save to Wishlist" method="patch"
                      class="rounded-full text-white bg-teal-700
                    p-1 w-10 h-10 text-xl absolute top-2 right-2 hover:bg-teal-600">
                    <span><i class="far fa-heart"></i></span>
                </Link>
                <Link v-else @click="store.login=true" as="button" title="Save to Wishlist"
                      class="rounded-full text-white bg-teal-700
                    p-1 w-10 h-10 text-xl absolute top-2 right-2 hover:bg-teal-600">
                    <span><i class="far fa-heart"></i></span>
                </Link>
                <button v-if="product.promotion" class="absolute top-2 left-2 bg-red-700 p-1
                text-white text-[9px] font-montserrat font-semibold rounded-md">
                    <span>{{product.promotion.discount}}% off</span>
                </button>
            </div>
            <div class="mt-2 font-semibold text-gray-800 px-2">
                <h5 class="text-sm ">{{useTruncate(product.name, 30)}}</h5>
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
                <p class="text-black-100 text-xs font-bold">
                     <span v-if="product.embroideries.length>1">
                        <span  v-for="embroidery in product.embroideries">
                            {{embroidery.format.abbreviation}},
                        </span>
                    </span>
                </p>
                <p class="font-bold text-black-100 font-montserrat">USD {{product.price}}
                    <span v-if="product.promotion" class="ml-1 text-teal-700 line-through text-xs">
                        USD {{Number(product.promotion.discount/100*product.price+product.price).toFixed(2)}}</span></p>
                <div class="py-3">
                    <Link preserve-scroll as="button" method="patch" :href="route('cart.update',product.id)" class="text-black-100 py-2 px-3 sm:px-5 border rounded-full
                     border-black-100 text-xs sm:text-sm hover:text-teal-700 hover:border-teal-700">
                        <span class="mr-3"><i class="far fa-plus"></i></span>Add to Basket</Link>
                </div>
            </div>
        </div>
    </div>
    <overview :product="preview" :show="showModal" @close="showModal=false"></overview>
    </div>
    <div v-else class="py-10">
        <h5 class="text-center text-2xl">No Products found!</h5>
    </div>
</template>

<script setup lang="ts">
import Overview from "@/views/components/products/overview.vue";
import {ref} from "vue";
import {useTruncate} from "@/scripts/use/useTruncate";
import {Link} from "@inertiajs/inertia-vue3";
import {store} from "@/scripts/store/login";



defineProps({
    products:Object,

})

const showModal=ref(false)
const  preview=ref(null)

const triggerModal=(product:any)=>{
    preview.value=product;
    showModal.value=true;

}

</script>

<style scoped>

</style>
