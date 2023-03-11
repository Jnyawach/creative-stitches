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
                    p-1 w-10 h-10 text-xl absolute top-2 right-2 hover:bg-teal-600 flex place-content-center">

                        <svg class="self-center h-6 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M255.1 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 0 232.4 0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L255.1 96zM255.1 141.3L221.4 106.6C196.1 81.31 160 69.77 124.7 75.66C71.21 84.58 31.1 130.9 31.1 185.1V190.9C31.1 223.6 45.55 254.7 69.42 277L250.1 445.7C251.7 447.2 253.8 448 255.1 448C258.2 448 260.3 447.2 261.9 445.7L442.6 277C466.4 254.7 480 223.6 480 190.9V185.1C480 130.9 440.8 84.58 387.3 75.66C351.1 69.77 315.9 81.31 290.6 106.6L255.1 141.3z"/></svg>

                </Link>
                <button v-else @click="store.login=true" title="Save to Wishlist"
                      class="rounded-full text-white bg-teal-700
                    p-1 w-10 h-10 text-xl absolute top-2 right-2 hover:bg-teal-600 flex place-content-center">
                    <svg class="self-center h-6 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M255.1 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 0 232.4 0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L255.1 96zM255.1 141.3L221.4 106.6C196.1 81.31 160 69.77 124.7 75.66C71.21 84.58 31.1 130.9 31.1 185.1V190.9C31.1 223.6 45.55 254.7 69.42 277L250.1 445.7C251.7 447.2 253.8 448 255.1 448C258.2 448 260.3 447.2 261.9 445.7L442.6 277C466.4 254.7 480 223.6 480 190.9V185.1C480 130.9 440.8 84.58 387.3 75.66C351.1 69.77 315.9 81.31 290.6 106.6L255.1 141.3z"/></svg>

                </button>

                <button v-if="product.promotion" class="absolute top-2 left-2 bg-red-700 p-1
                text-white text-[9px] font-montserrat font-semibold rounded-md">
                    <span>{{product.promotion.discount}}% off</span>
                </button>
            </div>
            <div class="mt-2 font-semibold text-gray-800 px-2">
                <h5 class="text-sm ">{{useTruncate(product.name, 30)}}</h5>
                <div v-if="product.rating" class="flex gap-1">
                    <div v-for="rating in product.rating" class="self-center">
                        <svg class="h-4 fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                    </div>
                    <div v-for="rating in 5-product.rating" class="self-center">
                        <svg class="h-4 fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M287.9 0C297.1 0 305.5 5.25 309.5 13.52L378.1 154.8L531.4 177.5C540.4 178.8 547.8 185.1 550.7 193.7C553.5 202.4 551.2 211.9 544.8 218.2L433.6 328.4L459.9 483.9C461.4 492.9 457.7 502.1 450.2 507.4C442.8 512.7 432.1 513.4 424.9 509.1L287.9 435.9L150.1 509.1C142.9 513.4 133.1 512.7 125.6 507.4C118.2 502.1 114.5 492.9 115.1 483.9L142.2 328.4L31.11 218.2C24.65 211.9 22.36 202.4 25.2 193.7C28.03 185.1 35.5 178.8 44.49 177.5L197.7 154.8L266.3 13.52C270.4 5.249 278.7 0 287.9 0L287.9 0zM287.9 78.95L235.4 187.2C231.9 194.3 225.1 199.3 217.3 200.5L98.98 217.9L184.9 303C190.4 308.5 192.9 316.4 191.6 324.1L171.4 443.7L276.6 387.5C283.7 383.7 292.2 383.7 299.2 387.5L404.4 443.7L384.2 324.1C382.9 316.4 385.5 308.5 391 303L476.9 217.9L358.6 200.5C350.7 199.3 343.9 194.3 340.5 187.2L287.9 78.95z"/></svg>
                    </div>
                <span class="self-center">({{product.totalRating}})</span>
                </div>

                <p class="text-black-100 text-xs font-bold">
                     <span v-if="product.embroideries.length>0">
                        <span  v-for="embroidery in product.embroideries">
                            {{embroidery.format.abbreviation}},
                        </span>
                    </span>
                </p>
               <p class="font-bold text-black-100 font-montserrat">$ {{Number(product.price).toFixed(2)}}
                    <span v-if="product.promotion" class="ml-1 text-teal-700 line-through text-xs">
                       $ {{Number(product.promotion.discount/100*product.price+product.price).toFixed(2)}}</span></p>
                <div class="py-3">
                    <Link preserve-scroll as="button" method="patch" :href="route('cart.update',product.id)" class="text-black-100 py-2 px-2 sm:px-5 border rounded-full
                     border-black-100 text-xs sm:text-sm hover:text-teal-700 hover:border-teal-700 flex gap-3 group">

                        <svg class="h-5 group-hover:fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256C432 264.8 424.8 272 416 272h-176V448c0 8.844-7.156 16.01-16 16.01S208 456.8 208 448V272H32c-8.844 0-16-7.15-16-15.99C16 247.2 23.16 240 32 240h176V64c0-8.844 7.156-15.99 16-15.99S240 55.16 240 64v176H416C424.8 240 432 247.2 432 256z"/></svg>
                        <span>
                            Add to Basket
                        </span>
                    </Link>
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
import {Button} from "flowbite-vue";



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
