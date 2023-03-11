<template>
<admin>
    <Head>
        <title>Payments</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Payments</h6>
        <template #info >
            <p class="text-sm flex gap-2">
                <svg class="fill-teal-700 h-5 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                <span>Customer Payments</span>
            </p>

        </template>
    </title-block>
    <div class="my-10">
        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Order ID</th>
                <th class="text-start py-3 px-4">Customer</th>
                <th class="text-start py-3 px-4">Amount($)</th>
                <th class="py-3 px-4 text-start">Date</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b" v-if="payments.data" v-for="payment in payments.data" :key="payment.id">
                <td class="py-2 px-4">{{payment.id }}</td>
                <td class="py-2 px-4">
                    <Link :href="route('purchases.show',payment.id)" class="text-sm font-bold text-start text-teal-700">
                        {{payment.order_id}}
                    </Link>
                </td>
                <td class="py-2 px-4">{{payment.user.name }} {{payment.user.last_name }}</td>
                <td class="py-2 px-4">{{payment.total}}</td>
                <td class="py-2 px-4">
                   {{new Date(payment.created_at).toDateString()}}
                </td>

            </tr>


            </tbody>

        </table>
        <pagination :data="payments"></pagination>
    </div>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head,Link} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue"
import Pagination from "@/views/components/pagination.vue";
defineProps({
    payments:Object
})
</script>

<style scoped>

</style>
