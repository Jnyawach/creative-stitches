<template layout="main">
<Head>
    <title>Thank you for your Order</title>
</Head>
    <div class="my-10 flex justify-center">
        <div class="text-center">
            <h1 class="text-2xl">Payment Successful <span class="ml-2 text-teal-700"><i class="fal fa-check-circle"></i></span></h1>
            <div class="py-5">
                <p class="text-lg">Thank you for your order. <br>Please proceed to your dashboard to download artworks</p>


            </div>
            <div>
                <Link :href="route('orders.index')" title="Download Designs"
                      class="py-3 px-5 rounded-full bg-teal-700 font-semibold
                       text-white">Download designs here</Link>
            </div>
        </div>
    </div>
    <div v-if="order">
        <img :src="'https://www.shareasale.com/sale.cfm?tracking='+order.order_code+'&amount='+order.amount+'&merchantID=137988&transtype=sale'" width="1" height="1">
        <component :is="'script'"  src="https://www.dwin1.com/45943.js" type="text/javascript" defer="defer">
        </component>

    </div>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
defineProps({
    order:Object
})
</script>

<style scoped>

</style>
