<template>
<admin>
    <Head><title>Orders</title></Head>
    <title-block>
        <h6 class="font-bold text-sm">Orders</h6>
        <template #info >
            <p class="text-sm flex gap-2">
                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                <span>Running Orders. Clients can also access their orders on client dashboard</span>
            </p>

        </template>
    </title-block>
    <div class="my-10">
        <div class="flex justify-end">
            <div>

                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input v-model="search" type="search" id="product-search" class="block p-2 pl-10 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-sky-600 focus:border-sky-600" placeholder="Search Order by Code..." required>

                </div>
            </div>
        </div>
        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Order Number</th>
                <th class="text-start py-3 px-4">Customer</th>
                <th class="text-start py-3 px-4">Amount</th>
                <th class="py-3 px-4 text-start">Action</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b" v-if="orders.data" v-for="order in orders.data" :key="order.id">
                <td class="py-2 px-4">{{order.id }}</td>
                <td class="py-2 px-4">{{ order.order_code }}</td>
                <td class="py-2 px-4">{{ order.user.name }} {{ order.user.last_name }}</td>
                <td class="py-2 px-4">{{ order.amount }}</td>
                <td class="py-2 px-4">
                    <Link :href="route('purchases.show',order.id)" class="flex gap-1 text-sm font-bold text-start">
                        <svg class="h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M320 0H64C28.72 0 0 28.7 0 64v431.1c0 5.844 3.188 11.23 8.312 14.04c5.125 2.781 11.34 2.562 16.28-.5313L192 402.1l167.4 106.5C362 511.2 365 512 368 512c2.656 0 5.281-.6562 7.688-1.969C380.8 507.2 384 501.8 384 495.1V64C384 28.7 355.3 0 320 0zM352 466.9l-151.4-96.36C197.1 368.8 195 368 192 368s-5.969 .8281-8.594 2.5L32 466.9V64c0-17.64 14.34-32 32-32h256c17.66 0 32 14.36 32 32V466.9z"/></svg>
                        <span>View Details</span>
                    </Link>
                </td>

            </tr>


            </tbody>

        </table>
        <div class="bg-gray-50 p-3 flex justify-between">
            <div class="self-center">
                <h6 class="font-medium">Showing <span class="text-sky-800">{{ orders.meta.current_page }}</span> of <span
                    class="text-sky-800">{{ orders.meta.last_page }}</span> Page(s)</h6>
            </div>
            <div class="flex">
                <Link :href="orders.links.prev" class="btn-primary text-xs m-1" v-if="orders.links.prev"><span
                    class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                </Link>
                <Link :href="orders.links.next" class="btn-primary text-xs m-1" v-if="orders.links.next">Next
                    <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

            </div>

        </div>
    </div>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head,Link} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import _ from "lodash"
let props=defineProps({
    orders:Object,
    filters:Object
})
const search=ref(props.filters.search)
watch(search, _.debounce(function (value:any) {
    Inertia.get(route('purchases.index'),{
        search:value
    }, {preserveState:true, replace:true});
}, 300))
</script>

<style scoped>

</style>
