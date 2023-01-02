<template>
    <teleport to="body">
        <Transition
            enter-from-class="opacity-0 scale-125"
            enter-to-class="opacity-100 scale-100"
            enter-active-class="transition duration-300"
            leave-active-class="transition duration-200"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-125"
        >
            <div v-if="show" class="inset-0 fixed bg-black-100 bg-opacity-70 z-50 grid place-items-center p-5" >
                <div class="bg-white lg:w-4/6 w-full rounded-xl">
                    <header class="p-3">
                        <div class="flex justify-between">

                            <slot name="header">
                                <div class="font-bold text-black-100 text-lg">
                                    <h6 class="font-bold text-lg">Product Overview</h6>
                                </div>
                            </slot>
                            <div>
                                <div class="text-end">
                                    <button class="bg-teal-900 rounded-full h-8 w-8" type="button" @click="$emit('close')"><span class="text-white text-lg"><i
                                        class="fal fa-times"></i></span></button>
                                </div>
                            </div>
                        </div>

                    </header>

                    <div class="p-3.5 ">
                        <div class="grid md:grid-cols-3 gap-2">
                            <div class="md:col-span-1 grid justify-center text-center">
                                <Link :href="route('shop.show',product.slug)" :title="product.name" class="relative">
                                    <img :src="product.mainImage.icon" class="rounded-xl">
                                    <button v-if="product.promotion" class="absolute top-2 left-2 bg-red-700 p-1
                                    text-white text-[9px] font-montserrat font-semibold rounded-md">
                                        <span>{{product.promotion.discount}}% off</span>
                                    </button>
                                </Link>
                                <Link :href="route('shop.show',product.slug)" :title="product.name" class="font-bold hover:text-teal-700">
                                    View Design
                                </Link>
                            </div>
                            <div class="md:col-span-2">
                                <div class="border rounded-xl p-2">
                                    <div class="sm:flex justify-between px-2">
                                        <div>
                                            <h6 class="font-bold">{{product.name}}</h6>
                                            <p class="mt-1">
                       <span class="text-teal-700 mr-2">
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                           <span><i class="fas fa-star-half-alt"></i></span>

                       </span>
                                                624 Reviews
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xl font-bold font-montserrat">
                                                USD {{product.price}}
                                                <span v-if="product.promotion" class="ml-1 text-teal-700 line-through text-xs">
                                             USD {{Number(product.promotion.discount/100*product.price+product.price).toFixed(2)}}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <Link  v-if="$page.props.auth" :href="route('wishlist.update',product.id)" as="button" method="patch" class="text-black-100 py-2 px-4 border rounded-full
                                         m-2 border-black-100 text-xs hover:text-teal-700 hover:border-teal-700 font-semibold">
                                            <span class="mr-2"><i class="far fa-heart"></i></span>Add to Wishlist
                                        </Link>
                                        <Link v-else  @click="store.login=true" as="button" class="text-black-100 py-2 px-4 border rounded-full
                                         m-2 border-black-100 text-xs hover:text-teal-700 hover:border-teal-700 font-semibold">
                                            <span class="mr-2"><i class="far fa-heart"></i></span>Add to Wishlist
                                        </Link>

                                        <Link :href="route('cart.update',product.id)" method="patch" preserve-scroll as="button" class="text-white bg-teal-700 py-2 px-4 border rounded-full
                                          m-1 border-teal-700 text-xs  hover:bg-teal-900 font-semibold">
                                            <span class="mr-2"><i class="far fa-plus"></i></span>Add to Basket
                                        </Link>
                                    </div>

                                </div>
                                <div class="px-2 mt-3">
                                    <h5 class="font-bold">Overview</h5>
                                    <div class="mt-2">
                                        <p class="text-sm"><span class="text-teal-700">Size (W/H):</span> {{product.design_size_mm}}mm | {{product.design_size_inches}}"</p>
                                        <p class="text-sm"><span class="text-teal-700">Formats:</span> <span class="mr-2 font-bold" v-for="format in product.embroideries" :key="format.id">{{format.format.abbreviation}}</span> </p>
                                        <p class="text-sm"><span class="text-teal-700">Total Stitches:</span> {{product.total_stitches}}</p>
                                        <p class="text-sm"><span class="text-teal-700">SKU:</span> {{product.sku}}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <footer class="p-3.5">
                        <slot name="footer">

                        </slot>
                    </footer>
                </div>
            </div>
        </Transition>
    </teleport>

</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
import {store} from "@/scripts/store/login";
const emits=defineEmits(['close'])
emits("close")
let props=defineProps({
    product:Object,
    show:Boolean
})

</script>

<style scoped>

</style>
