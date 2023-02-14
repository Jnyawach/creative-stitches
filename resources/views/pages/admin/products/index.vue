<template>
<admin>
    <Head>
        <title>Products</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Products</h6>
        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 mr-3 text-teal-900"><i class="fas fa-info-circle"></i></span>Embroidery design files</p>
        </template>
    </title-block>
    <div class="flex justify-between mt-5 px-3">
        <div>
          <h6 class="font-bold text-lg">Total Products: {{products.total}}</h6>
        </div>

        <div >

            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input v-model="search" type="search" id="product-search" class="block p-2 pl-10 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-sky-600 focus:border-sky-600" placeholder="Search products..." required>

            </div>
        </div>
    </div>
    <div class="mt-3">
        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Name</th>
                <th class="text-start py-3 px-4">Price</th>
                <th class="text-start py-3 px-4">Category</th>
                <th class="text-start py-3 px-4">Designs</th>
                <th class="text-start py-3 px-4">Status</th>
                <th class="text-start py-3 px-4 ">Action</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b text-[12px] font-medium"  v-for="product in products.data" :key="product.id" :class="[!product.embroideries_count?'text-red-700':'']">
                <td class="py-3 px-4 text-start">{{ product.id }}</td>
                <td class="py-3 px-4 text-start">{{product.name}}</td>
                <td class="py-3 px-4 text-start">{{Number(product.price).toFixed(2)}}</td>
                <td class="py-3 px-4 text-start">{{product.category.name}}</td>
                <td class="py-3 px-4 text-start">
                    <span v-if="product.embroideries_count">{{product.embroideries_count}}</span>
                    <span v-else>Missing designs</span>
                </td>
                <td>
                    <span v-if="product.status===1">Active</span>
                    <span v-else class="text-red-700">Inactive</span>
                </td>
                <td class="py-3 px-4">
                    <dropdown placement="bottom">
                        <template #trigger="{ toggle }">
                            <button @click="toggle">
                                Action <span class="self-center"><i class="far fa-ellipsis-v-alt"></i></span>
                            </button>
                        </template>
                        <div class="shadow w-36">
                            <ul class="divide-y pt-2">
                                <li class="hover:bg-gray-100 h-8">
                                    <Link :href="route('attach.files',product.id)" class="text-sm font-bold btn-link  pt-3  text-start">
                                        <span class="mr-2"><i class="far fa-file-plus"></i></span>Attach designs
                                    </Link>
                                </li>
                                <li class="hover:bg-gray-100 h-8">
                                    <Link :href="route('products.show',product.slug)" class="text-sm font-bold btn-link  pt-3  text-start">
                                        <span class="mr-2"><i class="fa-light fa-bookmark"></i></span>View
                                    </Link>
                                </li>
                                <li class="hover:bg-gray-100 h-8">

                                    <Link :href="route('products.edit',product.id)" class="text-sm font-bold btn-link pt-2 text-start">
                                        <span class="mr-2"><i class="fa-light fa-pen"></i></span>Edit
                                    </Link>
                                </li>
                                <li class="hover:bg-gray-100 ">
                                    <Link :href="route('products.destroy',product.id)" class="text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
                                        <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete
                                    </Link>
                                </li>

                            </ul>
                        </div>
                    </dropdown>

                </td>

            </tr>


            </tbody>

        </table>

        <div class="bg-gray-50 p-3 flex justify-between">
            <div class="self-center">
                <h6 class="font-medium">Showing <span class="text-sky-800">{{ products.current_page }}</span> of <span
                    class="text-sky-800">{{ products.last_page }}</span> Page(s)</h6>
            </div>
            <div class="flex">
                <Link :href="products.prev_page_url" class="btn-primary text-xs m-1" v-if="products.prev_page_url"><span
                    class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                </Link>
                <Link :href="products.next_page_url" class="btn-primary text-xs m-1" v-if="products.next_page_url">Next
                    <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

            </div>

        </div>

    </div>

    <template #sidebar>
        <Sidelink :link="route('products.create')"> <span class="mr-2"><i class="fal fa-plus"></i></span>Add Products</Sidelink>
    </template>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import Sidelink from "@/views/components/sidelink.vue";
import {Link} from "@inertiajs/inertia-vue3";
import { Dropdown} from 'flowbite-vue'
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import _ from "lodash"
let props=defineProps({
    products:Object,
    filters:Object
})
const search=ref(props.filters.search)

watch(search, _.debounce(function (value:any) {
    Inertia.get(route('products.index'),{
        search:value
    }, {preserveState:true, replace:true});
}, 300))

</script>

<style scoped>

</style>
