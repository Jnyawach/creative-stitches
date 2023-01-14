<template>
<admin>
    <Head>
        <title>Payments</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Payments</h6>
        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 mr-3 text-teal-900"><i class="fas fa-info-circle"></i></span>Customer Payments</p>
        </template>
    </title-block>
    <div class="my-10">
        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Payment</th>
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
                        {{payment.order.order_code}}
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
        <div class="bg-gray-50 p-3 flex justify-between">
            <div class="self-center">
                <h6 class="font-medium">Showing <span class="text-sky-800">{{ payments.meta.current_page }}</span> of <span
                    class="text-sky-800">{{ payments.meta.last_page }}</span> Page(s)</h6>
            </div>
            <div class="flex">
                <Link :href="payments.links.prev" class="btn-primary text-xs m-1" v-if="payments.links.prev"><span
                    class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                </Link>
                <Link :href="payments.links.next" class="btn-primary text-xs m-1" v-if="payments.links.next">Next
                    <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

            </div>

        </div>
    </div>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head,Link} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue"
defineProps({
    payments:Object
})
</script>

<style scoped>

</style>
