<template>
    <div  class="z-[10000] relative">
        <div>
            <input type="search" class="search-input" v-model="search" placeholder="Search for designs by keyword">
        </div>
        <div v-if="search" class="bg-white z-[1000] shadow absolute w-full border mt-1 rounded-lg overflow-hidden">
         <div class="flex justify-between pt-3 px-3 pb-1 border-b">
             <h5 class="text-lg text-teal-700 font-bold items-center">Products</h5>
             <h5>5 Results found</h5>
         </div>
            <div class="p-3  divide-y" v-if="products.length">
               <div v-for="product in products" :key="product.id" class="p-1">
                   <Link :href="route('shop.show',product.slug)" title="Product name">
                       <div class="flex  gap-2">
                           <div class="w-[80px]">
                               <img class="w-[80px] " :src="product.mainImage.icon" :alt="product.name">
                           </div>
                           <div class="">
                               <h6 class="text-lg font-bold">{{product.name}}</h6>
                               <p>{{useTruncate(product.meta_description, 50)}}</p>
                           </div>

                       </div>
                   </Link>
               </div>
            </div>
            <div v-else class="p-3">

                <h6  v-if="loading && products.length" class="flex items-center gap-2">
                    <span> Loading</span>
                    <svg class="w-5 fill-black animate-ping" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                       <path d="M400 256c0 26.5 21.5 48 48 48s48-21.5 48-48S474.5 208 448 208S400 229.5 400 256zM112 256c0-26.5-21.5-48-48-48S16 229.5 16 256S37.5 304 64 304S112 282.5 112 256zM304 256c0-26.5-21.5-48-48-48S208 229.5 208 256S229.5 304 256 304S304 282.5 304 256z"/>
                    </svg>
                </h6>
                <h6 v-else class="text-lg font-bold">No products found!</h6>
            </div>
        </div>

    </div>

</template>

<script setup lang="ts">

import {Link} from "@inertiajs/inertia-vue3";
import {watch,ref} from "vue";
import {debounce} from 'lodash';
import axios from "axios";
import {useTruncate} from "@/scripts/use/useTruncate";

const search = ref('');
const products=ref([]);
const loading=ref(false);

const searchProducts= async()=>{
    if (!search) return
    loading.value=true;
 await axios.get('/api/product/search',{
     params:{
         search:search.value
     }
 }).then((response)=>{

     products.value=response.data.data;
        loading.value=false;
 })
}
watch(search, debounce(()=>searchProducts(), 300))
</script>


<style scoped>

</style>
