<template>
<admin>
    <Head><title>{{order.data.order_code}}</title></Head>
    <title-block>
        <h6 class="font-bold text-sm">Orders: {{order.data.order_code}}</h6>
        <template #info >
            <p class="text-sm flex gap-2">
                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                <span>Order Details</span>
            </p>
        </template>
    </title-block>
    <div class="my-10 px-3">
        <h1 class="font-bold text-xl">Order Details</h1>
        <div class="grid grid-cols-2 gap-2">
            <div>
                <p><span class="text-teal-700 mr-2">Order Number:</span>{{order.data.order_code}}</p>
                <p><span class="text-teal-700 mr-2">Status:</span>Paid</p>
                <p><span class="text-teal-700 mr-2">Amount:</span>$ {{order.data.amount}}</p>
                <p><span class="text-teal-700 mr-2">Placed on :</span>{{new Date(order.data.created_at).toDateString()}}</p>
            </div>
            <div>
                <p><span class="text-teal-700 mr-2">Customer:</span>{{order.data.user.name}} {{order.data.user.last_name}}</p>
                <p><span class="text-teal-700 mr-2">Email:</span>{{order.data.user.email}}</p>
            </div>
        </div>
        <div class="mt-3">
            <h6 class="font-bold">Products</h6>

            <table class="table-auto w-full mt-3 border-t">
                <thead>
                <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                    <th class="text-start py-3 px-4">Id</th>
                    <th class="text-start py-3 px-4">Name</th>
                    <th class="text-start py-3 px-4">Price</th>
                    <th class="text-start py-3 px-4 ">Action</th>


                </tr>
                </thead>
                <tbody>
                <tr class="border-b text-[12px] font-bold"  v-for="product in order.data.products" :key="product.id" >
                    <td class="py-3 px-4 text-start">{{ product.id }}</td>
                    <td class="py-3 px-4 text-start">{{product.name}}</td>
                    <td class="py-3 px-4 text-start">{{product.price}}</td>
                    <td class="py-3 px-4">
                        <Link :href="route('products.show',product.slug)" class="flex gap-1 text-sm font-bold btn-link  pt-3  text-start">
                            <svg class="h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M320 0H64C28.72 0 0 28.7 0 64v431.1c0 5.844 3.188 11.23 8.312 14.04c5.125 2.781 11.34 2.562 16.28-.5313L192 402.1l167.4 106.5C362 511.2 365 512 368 512c2.656 0 5.281-.6562 7.688-1.969C380.8 507.2 384 501.8 384 495.1V64C384 28.7 355.3 0 320 0zM352 466.9l-151.4-96.36C197.1 368.8 195 368 192 368s-5.969 .8281-8.594 2.5L32 466.9V64c0-17.64 14.34-32 32-32h256c17.66 0 32 14.36 32 32V466.9z"/></svg>
                            <span>View</span>
                        </Link>
                    </td>

                </tr>


                </tbody>

            </table>

        </div>
    </div>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head,Link} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
defineProps({
    order:Object
})
</script>

<style scoped>

</style>
