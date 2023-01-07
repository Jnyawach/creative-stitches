<template layout="main">
    <Head>
        <title>Payment</title>
        <meta name="description" content="Provide Contact information to help us deliver your order">
    </Head>
    <div class="my-10 px-3 lg:px-24">
        <div class="grid my-3">
            <p class="text-lg space-x-2 font-bold">
                <Link :href="route('cart.index')" class="hover:text-teal-700" title="Order Basket">Basket</Link> |
                <Link href="#" class="text-gray-300 cursor-not-allowed">Payment</Link> |
                <Link href="#" class="text-gray-300 cursor-not-allowed">Order Complete</Link>
            </p>
        </div>

        <div class="grid md:grid-cols-5 mt-5 gap-5 ">
            <div class="md:col-span-3 space-y-3 gap-2">
                <h1 class="font-bold text-3xl">Payments</h1>
                <p class="text-lg">All transactions are safe and secure</p>
                <form @submit.prevent="form.post(route('details.store'))" class="w-full sm:w-3/4">
                    <div class="grid mt-3">
                        <div class="w-full ">
                            <label for="pay_name" class="creative-label">Name on Card <sup class="text-[8px]"><i class="fas fa-star-of-life"></i></sup></label>
                            <input type="text" class="creative-input" id="pay_name" placeholder="Enter your full name" required v-model="form.name"/>
                            <div v-if="form.errors.name" class="creative-error">
                                <span>{{ form.errors.name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid mt-3">
                        <div class="w-full ">
                            <label for="pay_name" class="creative-label">Card Number <sup class="text-[8px]"><i class="fas fa-star-of-life"></i></sup></label>
                            <input type="text" class="creative-input" id="pay_name" placeholder="Enter card Number" required v-model="form.card_number"/>
                            <div v-if="form.errors.card_number" class="creative-error">
                                <span>{{ form.errors.card_number }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="mt-3">
                            <label for="payment_card" class="creative-label">Expiry Date <sup class="text-[8px]"><i class="fas fa-star-of-life"></i></sup></label>
                            <input type="text" class="creative-input" id="payment_card" placeholder="MM/YY" required v-model="form.expiry"/>
                            <div v-if="form.errors.expiry" class="creative-error">
                                <span>{{ form.errors.expiry }}</span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="payment_cvv" class="creative-label">CVV <sup class="text-[8px]"><i class="fas fa-star-of-life"></i></sup></label>
                            <input type="text" class="creative-input" id="payment_cvv" placeholder="CVV" required v-model="form.cvv"/>
                            <div v-if="form.errors.cvv" class="creative-error">
                                <span>{{form.errors.cvv }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="creative-label">
                            <input type="checkbox" v-model="form.save_card" class="checked:bg-teal-700 rounded focus:outline-teal-600 mr-2">
                            Save my card for easier checkout next time
                        </label>
                    </div>
                    <div class="mt-10">
                        <button type="submit" :disabled="form.processing" class="py-3 sm:w-1/2  px-10 bg-teal-700 hover:bg-teal-800
                    rounded-full text-white font-semibold">Place Order <span class="ml-3"><i class="fal fa-long-arrow-right"></i></span></button>
                    </div>
                </form>

            </div>
            <div class="md:col-span-2 m-1 grid gap-3">
                <div class="border rounded-lg p-2 mt-3  hidden md:block">
                    <h6 class="font-bold mt-2">ORDER SUMMARY</h6>
                    <div class="px-2 mt-3 space-y-4">
                        <p class="text-gray-800 flex justify-between"><span>{{ cart.cartCount }} Items(s)</span> <span>$ {{Number( cart.cartSubTotal ).toFixed(2)}}</span>
                        </p>
                        <p class="text-gray-800 flex justify-between"><span>Sales Tax</span> <span>-</span></p>
                        <p class="text-gray-800 flex justify-between font-bold"><span>Sub Total</span> <span>$ {{Number( cart.cartSubTotal ).toFixed(2)}}</span></p>
                        <p class="text-gray-800 flex justify-between" v-for="condition in cart.conditions"><span>{{condition.name}}</span> <span>{{condition.amount}}</span></p>
                        <p class="text-gray-800 flex justify-between font-bold"><span>Total</span>
                            <span>$ {{Number( cart.cartTotal).toFixed(2)}}</span></p>

                    </div>

                </div>
                <div class="p-2 mt-3 hidden md:block">
                    <h6 class="font-bold mt-2">ORDER DETAILS</h6>
                    <div class=" mt-3 space-y-4">
                        <div class="mt-3 grid grid-cols-4 gap-2" v-for="item in cart.items" :key="item.id">
                            <div class="col-span-1">
                                <img :src="item.attributes.image" class="rounded-md">
                            </div>
                            <div class="col-span-3 self-center">
                                <h6 class="font-bold text-sm">{{item.name}}</h6>
                                <p class="text-sm"><span class="text-teal-700">USD</span> {{Number( item.price).toFixed(2)}}</p>
                                <p class="text-sm">Available formats: <span class="text-teal-700 font-bold">{{item.attributes.format}}</span></p>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="order-3">
                    <div class="mt-4">
                        <h6 class="text-xs font-bold">ACCEPTED PAYMENTS</h6>
                        <img :src="'/images/accepted.png'" alt="Accepted payment types">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Head, usePage,Link} from "@inertiajs/inertia-vue3";
import {useForm} from "@inertiajs/inertia-vue3";
import {computed} from "vue";

const cart= computed(() => usePage().props.value.cart)
let form=useForm({
    name:'',
    card_number:'',
    expiry:'',
    cvv:'',
    save_card:true
})
</script>

<style scoped>

</style>
