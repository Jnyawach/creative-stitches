<template layout="main">
    <Head>
        <title>Contact Details</title>
        <meta name="description" content="Provide Contact information to help us deliver your order">
    </Head>
<div class="my-10 px-3 lg:px-24">
    <div class="grid my-3">
       <p class="text-lg space-x-2 font-bold">
           <Link :href="route('cart.index')" class="hover:text-teal-700" title="Order Basket">Basket</Link> |
           <Link v-if="!$page.props.auth" :href="route('details.index')" class="hover:text-teal-700">Details |</Link>
           <Link href="#" class="text-gray-300 cursor-not-allowed">Payment</Link> |
           <Link href="#" class="text-gray-300 cursor-not-allowed">Order Complete</Link>
       </p>
    </div>
    <div>
        <button v-if="!$page.props.auth" @click="store.login=true"
                class="font-bold text-teal-700 underline text-xs md:text-lg">Login and Check out faster
        </button>
    </div>
    <div class="grid md:grid-cols-5 mt-5 gap-5 ">
        <div class="md:col-span-3 space-y-3 gap-2">
            <h1 class="font-bold text-3xl">Contact Details</h1>
            <p class="text-lg">We'll use these information to attach your order</p>
            <form @submit.prevent="form.post(route('details.store'))">

                <div class="grid sm:grid-cols-2 gap-2">
                    <div class="mt-3">
                        <label for="details_name" class="creative-label">First Name <sup class="text-[8px]"><i class="fas fa-star-of-life"></i></sup></label>
                        <input type="text" class="creative-input" id="details_name" placeholder="Enter your first name" required v-model="form.name"/>
                        <div v-if="form.errors.name" class="creative-error">
                            <span>{{ form.errors.name }}</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="details_last_name" class="creative-label">Last name <sup class="text-[8px]"><i class="fas fa-star-of-life"></i></sup></label>
                        <input type="text" class="creative-input" id="details_last_name" placeholder="Enter your last name" required v-model="form.last_name"/>
                        <div v-if="form.errors.last_name" class="creative-error">
                            <span>{{form.errors.last_name }}</span>
                        </div>
                    </div>
                </div>
                <div class="grid mt-3 sm:grid-cols-2 gap-2">
                    <div class="w-full">
                        <label for="details-email" class="creative-label">Email <sup class="text-[8px]"><i class="fas fa-star-of-life"></i></sup></label>
                        <input type="email" class="creative-input" id="details-email" placeholder="Enter your email" required v-model="form.email"/>
                        <div v-if="form.errors.email" class="creative-error">
                            <span>{{ form.errors.email }}</span>
                        </div>
                    </div>
                    <div class="w-full ">
                        <label for="create-password" class="creative-label">Add a password for secure checkout <sup class="text-[8px]"><i class="fas fa-star-of-life"></i></sup></label>

                        <input type="password" class="creative-input" id="create-password" placeholder="Enter your password" required v-model="form.password"/>
                        <div v-if="form.errors.password" class="creative-error">
                            <span>{{ form.errors.password}}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="creative-label">
                        <input type="checkbox" v-model="form.subscribe" class="checked:bg-teal-700 rounded focus:outline-teal-600 mr-2">
                        Yes, I’d like to receive emails about exclusive sales and more.
                    </label>
                </div>
                <div class="mt-10">
                    <button type="submit" :disabled="form.processing" class="py-3 sm:w-1/2  px-10 bg-teal-700 hover:bg-teal-800
                    rounded-full text-white font-semibold">Review and Pay <span class="ml-3"><i class="fal fa-long-arrow-right"></i></span></button>
                </div>
            </form>
            <div>
                <small>The design will be available for you to download in multiple formats from any device anywhere </small>
            </div>
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
import {store} from "@/scripts/store/login";
import {Head, usePage,Link} from "@inertiajs/inertia-vue3";
import {useForm} from "@inertiajs/inertia-vue3";
import {computed} from "vue";

const cart= computed(() => usePage().props.value.cart)
let form=useForm({
    email:'',
    name:'',
    last_name:'',
    password:'',
    subscribe:true
})
</script>

<style scoped>

</style>
