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
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
</script>

<style scoped>

</style>
