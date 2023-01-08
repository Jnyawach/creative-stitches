<template layout="main">
    <Head>
        <title>Payment Unsuccessful</title>
    </Head>
    <div class="my-10 flex justify-center">
        <div class="text-center">
            <h1 class="text-2xl">Payment Unsuccessful <span class="ml-2 text-red-700"><i class="far fa-times-circle"></i></span></h1>
            <div class="py-5">
               <p>The payment was unsuccessful. To access your order please try paying again</p>
            </div>
            <div>
                <Link :href="route('payment.index')" title="Download Designs"
                      class="py-3 px-5 rounded-full bg-teal-700 font-semibold
                       text-white">Pay here</Link>
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
