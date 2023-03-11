<template layout="main">
    <Head>
        <title>Payment</title>
        <meta name="description" content="Provide Contact information to help us deliver your order">
    </Head>
    <div class="max-w-[1280px] mx-auto">
        <div class="my-10 px-3 lg:px-20">
            <div class="grid my-3">
                <p class="text-lg space-x-2 font-bold">
                    <Link :href="route('cart.index')" class="hover:text-teal-700" title="Order Basket">Basket</Link>
                    |
                    <button title="Payment" class="text-gray-300 cursor-not-allowed">Payment</button>
                    |
                    <button title="Order Complete" class="text-gray-300 cursor-not-allowed">Order Complete</button>
                </p>
            </div>

            <div class="grid md:grid-cols-5 mt-5 gap-5 ">
                <div class="md:col-span-3 space-y-3 gap-2">
                    <h1 class="font-bold text-3xl">Payments</h1>
                    <p class="text-lg">All transactions are safe and secure</p>
                    <div class="p-2 mt-3">
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
                        <stripe-checkout
                            ref="checkoutRef"
                            :pk="pub_key"
                            :sessionId="checkout.id"
                        />

                        <div class="py-8">
                            <button type="button" @click="submit" class="py-3 px-5 rounded-full bg-teal-700 font-semibold
                           text-white flex justify-center gap-3">
                                <span class="self-center">Place Order</span>
                                <svg v-if="loader" class="fill-white animate-ping self-center" height="10" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 448 512"><path
                                        d="M0 256a56 56 0 1 1 112 0A56 56 0 1 1 0 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"/></svg>

                                <svg v-else class="w-5 fill-white self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M363.3 100.7l144 144C510.4 247.8 512 251.9 512 255.1s-1.562 8.188-4.688 11.31l-144 144c-6.25 6.25-16.38 6.25-22.62 0s-6.25-16.38 0-22.62l116.7-116.7H16c-8.844 0-16-7.156-16-15.1c0-8.844 7.156-16 16-16h441.4l-116.7-116.7c-6.25-6.25-6.25-16.38 0-22.62S357.1 94.44 363.3 100.7z"/></svg>


                            </button>
                        </div>

                    </div>
                    <div class="order-3">
                        <div class="mt-4">
                            <h6 class="text-xs font-bold">ACCEPTED PAYMENTS</h6>
                            <img :src="'/images/accepted.png'" alt="Accepted payment types">
                        </div>
                    </div>

                </div>
                <div class="md:col-span-2 m-1 grid gap-3">

                    <div class="p-2 mt-3">
                        <h6 class="font-bold mt-2">ORDER DETAILS</h6>
                        <div class=" mt-3 space-y-4">
                            <div class="mt-3 grid grid-cols-4 gap-2" v-for="item in cart.items" :key="item.id">
                                <div class="col-span-1">
                                    <img :src="item.attributes.image" class="rounded-md">
                                </div>
                                <div class="col-span-3 self-center">
                                    <h6 class="font-bold text-sm">{{ item.name }}</h6>
                                    <p class="text-sm"><span class="text-teal-700">USD</span>
                                        {{ Number(item.price).toFixed(2) }}</p>
                                    <p class="text-sm">Available formats: <span
                                        class="text-teal-700 font-bold">{{ item.attributes.format }}</span></p>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Head, usePage,Link} from "@inertiajs/inertia-vue3";
import {useForm} from "@inertiajs/inertia-vue3";
import {computed, ref} from "vue";
import { StripeCheckout } from '@vue-stripe/vue-stripe';
import {Button} from "flowbite-vue";

let props=defineProps({
    checkout:Object
})
const cart= computed(() => usePage().props.value.cart)
let form=useForm({
    name:'',
    card_number:'',
    expiry:'',
    cvv:'',
    save_card:true
})
const checkoutRef=ref(null)
const loader=ref(false)

const submit = () => {
    loader.value=true
    checkoutRef.value.redirectToCheckout();
}

const pub_key=import.meta.env.VITE_STRIPE_API_KEY as string
</script>

<style scoped>

</style>
