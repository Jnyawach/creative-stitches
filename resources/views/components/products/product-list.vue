<template>
    <div class="mt-10 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-8 justify-center">
        <div v-for="product in products" :key="product.id">
            <div class="relative">
                <img :src="product.mainImage.icon" class="rounded-xl cursor-pointer w-full"
                     :alt="product.name" :title="product.name" @click="triggerModal(product)">
                <button type="button" title="Save to Wishlist" class="rounded-full text-white bg-teal-700
                    p-1 w-10 h-10 text-xl absolute top-2 right-2 hover:bg-teal-600">
                    <span><i class="far fa-heart"></i></span>
                </button>
            </div>
            <div class="mt-2 font-semibold text-gray-800 px-2">
                <h5 class="text-sm sm:text-md">{{product.name}}</h5>
                <p class="text-sm sm:text-md">
                       <span class="text-teal-700 mr-2">
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                           <span><i class="fas fa-star-half-alt"></i></span>
                           (624)
                       </span>
                    Available in {{product.embroideries.length}} format<span v-show="product.embroideries.length>1">s</span>
                </p>
                <p class="font-bold text-black-100 font-montserrat">USD {{product.price}}</p>
                <button type="button" class="text-black-100 py-2 px-3 sm:px-5 border rounded-full
                    mt-3 border-black-100 text-xs sm:text-sm hover:text-teal-700 hover:border-teal-700">
                    <span class="mr-3"><i class="far fa-plus"></i></span>Add to Basket</button>
            </div>
        </div>
    </div>
    <overview :product="preview" :show="showModal" @close="showModal=false"></overview>
</template>

<script setup lang="ts">
import Overview from "@/views/components/products/overview.vue";
import {ref} from "vue";
defineProps({
    products:Object
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
