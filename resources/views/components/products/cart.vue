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
                        <div class="text-end">
                            <button class="bg-teal-900 rounded-full h-8 w-8" type="button" @click="$emit('close')"><span class="text-white text-lg"><i
                                class="fal fa-times"></i></span></button>
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
                                <Link :href="route('cart.index')" @click="$emit('close')"  class="bg-teal-700 py-2 px-4 text-white rounded-full text-sm font-bold">Checkout <span class="ml-2"><i class="fa-regular fa-right-long"></i></span></Link>
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
