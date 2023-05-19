<template layout="main">
    <Head>
        <title>Order Basket</title>
    </Head>
    <div class="max-w-[1280px] mx-auto">
        <div v-if="cart.cartCount" class="my-10 px-3 lg:px-20 ">
            <div class="flex justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Your Basket</h1>
                    <p><span class="font-bold">Total:</span> {{ cart.cartCount }} items - <span
                        class="text-teal-700 font-bold">USD {{ Number(cart.cartTotal).toFixed(2) }}</span></p>
                </div>
                <div>
                    <button v-if="!$page.props.auth" @click="store.login=true"
                            class="font-bold text-teal-700 underline text-xs md:text-lg">Login and Check out faster
                    </button>
                </div>
            </div>

            <div class="grid md:grid-cols-5 mt-5 gap-5 ">
                <div class="md:col-span-3 space-y-3 gap-2">
                    <div class="grid grid-cols-6 m-1 border p-2 rounded-lg gap-2" v-for="item in cart.items">
                        <div class="col-span-6 sm:hidden grid grid-cols-6">
                            <h6 class="col-span-5 justify-between text-lg font-bold ">
                                <span>{{item.name }}</span>
                            </h6>
                            <h6 class="col-span-1"><span class="font-bold text-teal-700 ">$ {{  Number( item.price).toFixed(2)}}</span></h6>
                        </div>
                        <div class="col-span-1">
                            <img :src="item.attributes.image" class="rounded-lg">
                        </div>
                        <div class="col-span-4">
                            <h6 class="hidden sm:flex justify-between text-sm lg:text-lg font-bold ">
                                <span>{{item.name }}</span>
                                </h6>
                            <h5><span class="font-bold text-teal-700 text-2xl">$ {{ Number( item.price).toFixed(2) }}</span></h5>
                            <p class="text-sm lg:text-md break-words"><span class="text-teal-700">Formats:</span>
                                <span class="break-words">{{ item.attributes.format }}</span></p>
                            <p class="text-sm lg:text-md "><span class="text-teal-700">Total Stitches:</span>
                                {{ item.attributes.stitches }}</p>
                            <p class="text-sm lg:text-md"><span class="text-teal-700">Size:</span>
                                {{ item.attributes.size_mm }} mm | {{ item.attributes.size_inches }} inches</p>
                        </div>
                        <div class="col-span-1 text-end">
                            <Link preserve-scroll v-if="$page.props.auth" :href="route('move.wishlist',item.id)"
                                  as="button"
                                  title="Save to Wishlist" method="patch"
                                  class="text-xl m-2">
                                <svg class="h-5  hover:fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M255.1 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 0 232.4 0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L255.1 96zM255.1 141.3L221.4 106.6C196.1 81.31 160 69.77 124.7 75.66C71.21 84.58 31.1 130.9 31.1 185.1V190.9C31.1 223.6 45.55 254.7 69.42 277L250.1 445.7C251.7 447.2 253.8 448 255.1 448C258.2 448 260.3 447.2 261.9 445.7L442.6 277C466.4 254.7 480 223.6 480 190.9V185.1C480 130.9 440.8 84.58 387.3 75.66C351.1 69.77 315.9 81.31 290.6 106.6L255.1 141.3z"/></svg>
                            </Link>
                            <Link v-else @click="store.login=true" as="button" title="Save to Wishlist"
                                  class="m-2 text-xl ">
                                <svg class="h-5  hover:fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M255.1 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 0 232.4 0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L255.1 96zM255.1 141.3L221.4 106.6C196.1 81.31 160 69.77 124.7 75.66C71.21 84.58 31.1 130.9 31.1 185.1V190.9C31.1 223.6 45.55 254.7 69.42 277L250.1 445.7C251.7 447.2 253.8 448 255.1 448C258.2 448 260.3 447.2 261.9 445.7L442.6 277C466.4 254.7 480 223.6 480 190.9V185.1C480 130.9 440.8 84.58 387.3 75.66C351.1 69.77 315.9 81.31 290.6 106.6L255.1 141.3z"/></svg>
                            </Link>
                            <Link title="Remove from cart" :href="route('cart.destroy',item.id)" as="button"
                                  method="delete"
                                  preserve-scroll class="text-2xl hover:text-teal-700 m-2">

                                <svg class="h-5  hover:fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M315.3 411.3c-6.253 6.253-16.37 6.253-22.63 0L160 278.6l-132.7 132.7c-6.253 6.253-16.37 6.253-22.63 0c-6.253-6.253-6.253-16.37 0-22.63L137.4 256L4.69 123.3c-6.253-6.253-6.253-16.37 0-22.63c6.253-6.253 16.37-6.253 22.63 0L160 233.4l132.7-132.7c6.253-6.253 16.37-6.253 22.63 0c6.253 6.253 6.253 16.37 0 22.63L182.6 256l132.7 132.7C321.6 394.9 321.6 405.1 315.3 411.3z"/></svg>
                            </Link>


                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 m-1 grid gap-3">
                    <div class="w-full flex order-2 md:order-1">
                        <Link :href="route('payment.index')" v-if="$page.props.auth" class="bg-teal-700 w-full py-3 px-10 h-12 font-bold hover:bg-teal-800
                      text-white rounded-full text-center flex justify-center gap-3">
                            <span>Checkout</span>
                            <svg class="w-5 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M363.3 100.7l144 144C510.4 247.8 512 251.9 512 255.1s-1.562 8.188-4.688 11.31l-144 144c-6.25 6.25-16.38 6.25-22.62 0s-6.25-16.38 0-22.62l116.7-116.7H16c-8.844 0-16-7.156-16-15.1c0-8.844 7.156-16 16-16h441.4l-116.7-116.7c-6.25-6.25-6.25-16.38 0-22.62S357.1 94.44 363.3 100.7z"/></svg>
                        </Link>
                        <Link v-else :href="route('details.index')" title="Proceed to checkout" class="bg-teal-700 w-full py-3 px-10 h-12 font-bold hover:bg-teal-800
                      text-white rounded-full text-center">Checkout <span class="ml-2"><i
                            class="fal fa-long-arrow-right"></i></span>
                        </Link>
                    </div>
                    <div class="border rounded-lg p-2 mt-3 order-1 md:order-2">
                        <h6 class="font-bold mt-2">ORDER SUMMARY</h6>
                        <div class="px-2 mt-3 space-y-4">
                            <p class="text-gray-800 flex justify-between"><span>{{ cart.cartCount }} Items(s)</span>
                                <span>$ {{ Number(cart.cartSubTotal).toFixed(2) }}</span>
                            </p>
                            <p class="text-gray-800 flex justify-between"><span>Sales Tax</span> <span>-</span></p>
                            <p class="text-gray-800 flex justify-between font-bold"><span>Sub Total</span>
                                <span>$ {{ Number(cart.cartSubTotal).toFixed(2) }}</span></p>
                            <p class="text-gray-800 flex justify-between" v-for="condition in cart.conditions">
                                <span>{{ condition.name }}</span> <span>{{ condition.amount }}</span></p>
                            <p class="text-gray-800 flex justify-between font-bold"><span>Total</span>
                                <span>$ {{ Number(cart.cartTotal).toFixed(2) }}</span></p>

                        </div>

                    </div>
                    <div class="order-3">
                        <div>

                            <form v-if="promoForm" @submit.prevent="submit">
                                <div class="grid grid-cols-3 gap-2">
                                    <div class="col-span-2">
                                        <input type="text" class="creative-input" v-model="form.code">
                                    </div>
                                    <div class="col-span-1 ">
                                        <button type="submit" class="w-full bg-teal-700 py-2 px-3 font-semibold hover:bg-teal-800
                               rounded-full mt-3 text-white">Enter code
                                        </button>
                                    </div>
                                </div>
                                <div v-if="form.errors.code" class="mt-3 text-red-800 text-sm">
                                    <span>{{ form.errors.code }}</span>
                                </div>
                            </form>
                            <button v-else @click="promoForm=true"
                                    class="mt-3 underline font-semibold hover:text-teal-700"
                                    :disabled="form.processing">Use Promo code
                            </button>
                        </div>
                        <div class="mt-4">
                            <h6 class="text-xs font-bold">ACCEPTED PAYMENTS</h6>
                            <img :src="'/images/accepted.png'" alt="Accepted payment types">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div v-else class="flex place-content-center">
            <div class="py-14 text-center">
                <h1 class="font-bold text-2xl">0 Items available in you baskets</h1>
                <div class="py-3">
                    <Link class="font-bold btn-primary" :href="route('shop.index')" title="Shop Embroidery Designs">Add
                        Designs to your Basket
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {computed, ref} from "vue";
import {usePage} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
import {store} from "@/scripts/store/login";
import {Head} from "@inertiajs/inertia-vue3";
import {useForm} from "@inertiajs/inertia-vue3";

const cart= computed(() => usePage().props.value.cart)
let form=useForm({
    code:''
})

const promoForm=ref(false)
const submit= ()=>{
    form.post(route('enter.promo'),{
        onSuccess:()=>{
            form.reset();
            promoForm.value=false
        }
    })
}
</script>

<style scoped>

</style>
