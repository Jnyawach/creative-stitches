<template layout="main">
    <Head>
        <title>Order Basket</title>
    </Head>
    <div v-if="cart.cartCount" class="my-10 px-3 lg:px-24 ">
        <div class="flex justify-between">
            <div>
                <h1 class="text-2xl font-bold">You Basket</h1>
                <p><span class="font-bold">Total:</span> {{ cart.cartCount }} items - <span
                    class="text-teal-700 font-bold">USD {{ cart.cartTotal }}</span></p>
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
                    <div class="col-span-1">
                        <img :src="item.attributes.image" class="rounded-lg">
                    </div>
                    <div class="col-span-4">
                        <h6 class="flex justify-between text-sm lg:text-lg font-bold "><span>{{ item.name }}</span>
                            <span class="font-bold text-teal-700 text-2xl">$ {{ item.price }}</span></h6>
                        <p class="text-sm lg:text-md"><span class="text-teal-700">Formats:</span>
                            {{ item.attributes.format }}</p>
                        <p class="text-sm lg:text-md"><span class="text-teal-700">Total Stitches:</span>
                            {{ item.attributes.stitches }}</p>
                        <p class="text-sm lg:text-md"><span class="text-teal-700">Size:</span>
                            {{ item.attributes.size_mm }} mm | {{ item.attributes.size_inches }} inches</p>
                    </div>
                    <div class="col-span-1 text-end">
                        <Link preserve-scroll v-if="$page.props.auth" :href="route('move.wishlist',item.id)" as="button"
                              title="Save to Wishlist" method="patch"
                              class="text-xl m-2">

                            <span><i class="far fa-heart"></i></span>
                        </Link>
                        <Link v-else @click="store.login=true" as="button" title="Save to Wishlist"
                              class="m-2 text-xl ">

                            <span><i class="far fa-heart"></i></span>
                        </Link>
                        <Link title="Remove from cart" :href="route('cart.destroy',item.id)" as="button" method="delete"
                              preserve-scroll class="text-2xl hover:text-teal-700 m-2">
                            <span><i class="fal fa-times"></i></span>
                        </Link>


                    </div>
                </div>
            </div>

            <div class="md:col-span-2 m-1 grid gap-3">
                <div class="w-full flex order-2 md:order-1">
                    <Link v-if="$page.props.auth" class="bg-teal-700 w-full py-3 px-10 h-12 font-bold hover:bg-teal-800
                      text-white rounded-full text-center">Checkout <span class="ml-2"><i class="fal fa-long-arrow-right"></i></span>
                    </Link>
                    <Link v-else :href="route('details.index')" title="Proceed to checkout" class="bg-teal-700 w-full py-3 px-10 h-12 font-bold hover:bg-teal-800
                      text-white rounded-full text-center">Checkout <span class="ml-2"><i class="fal fa-long-arrow-right"></i></span>
                    </Link>
                </div>
                <div class="border rounded-lg p-2 mt-3 order-1 md:order-2">
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
                        <button v-else @click="promoForm=true" class="mt-3 underline font-semibold hover:text-teal-700"
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
              <Link class="font-bold btn-primary" :href="route('shop.index')" title="Shop Embroidery Designs">Add Designs to your Basket</Link>
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
