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
            <div @click.self="$emit('close')" v-if="show" class="inset-0 fixed bg-black-100 bg-opacity-70 z-[10000] grid place-items-center p-5" >
                <div class="bg-white lg:w-2/6 w-full rounded-xl p-3">
                    <div>
                        <div class="text-end flex justify-end">
                            <button class="bg-teal-900 rounded-full h-8 w-8 flex place-content-center" type="button" @click="$emit('close')">

                                <svg class="h-5 self-center fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M312.1 375c9.369 9.369 9.369 24.57 0 33.94s-24.57 9.369-33.94 0L160 289.9l-119 119c-9.369 9.369-24.57 9.369-33.94 0s-9.369-24.57 0-33.94L126.1 256L7.027 136.1c-9.369-9.369-9.369-24.57 0-33.94s24.57-9.369 33.94 0L160 222.1l119-119c9.369-9.369 24.57-9.369 33.94 0s9.369 24.57 0 33.94L193.9 256L312.1 375z"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-2">
                        <div v-if="cart.cartCount">
                            <h6 class="text-center text-lg font-bold  text-sm">Available in Basket {{cart.cartCount}} Item(s)</h6>
                            <hr class="mt-2">

                            <div class="mt-3 grid grid-cols-4 gap-2" v-for="item in cart.items" :key="item.id">
                                <div class="col-span-1">
                                    <img :src="item.attributes.image" class="rounded-md">
                                </div>
                                <div class="col-span-3 self-center">
                                    <h6 class="font-bold text-sm">{{item.name}}</h6>
                                    <p class="text-sm"><span class="text-teal-700">USD</span> {{Number( item.price).toFixed(2)}}</p>
                                    <p class="text-sm">Available formats: <span class="text-teal-700 font-bold inline-block">{{item.attributes.format}}</span></p>
                                </div>
                            </div>
                            <hr class="mt-3">

                            <div class="mt-5 grid grid-cols-2 justify-center space-x-2">
                                <button @click="$emit('close')" class="border border-teal-700 text-teal-700 py-2 px-4 rounded-full text-sm font-bold">Shop More</button>
                                <Link :href="route('cart.index')" @click="$emit('close')"  class="bg-teal-700 py-2 px-4 text-white rounded-full text-sm font-bold"> <span class="mr-5 self-center">Checkout</span>
                                    <svg class="w-5 fill-white inline-block self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M363.3 100.7l144 144C510.4 247.8 512 251.9 512 255.1s-1.562 8.188-4.688 11.31l-144 144c-6.25 6.25-16.38 6.25-22.62 0s-6.25-16.38 0-22.62l116.7-116.7H16c-8.844 0-16-7.156-16-15.1c0-8.844 7.156-16 16-16h441.4l-116.7-116.7c-6.25-6.25-6.25-16.38 0-22.62S357.1 94.44 363.3 100.7z"/></svg>
                                </Link>
                            </div>
                        </div>
                        <div v-else>
                            <h6 class="font-bold my-2">No Items available in you basket</h6>
                            <button @click="$emit('close')" class="border border-teal-700 text-teal-700 py-2 px-4 rounded-full text-sm font-bold">Continue Shopping</button>
                        </div>
                    </div>

                </div>
            </div>
        </Transition>
    </teleport>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
const emits=defineEmits(['close'])
emits("close")
let props=defineProps({
    show:Boolean,
   cart:Object
})

</script>

<style scoped>

</style>
