<template>
<admin>
    <Head><title>{{order.data.order_code}}</title></Head>
    <title-block>
        <h6 class="font-bold text-sm">Orders: {{order.data.order_code}}</h6>
        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 mr-3 text-teal-900"><i class="fas fa-info-circle"></i></span>Order Details</p>
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
                        <Link :href="route('products.show',product.slug)" class="text-sm font-bold btn-link  pt-3  text-start">
                            <span class="mr-2"><i class="fa-light fa-bookmark"></i></span>View
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
