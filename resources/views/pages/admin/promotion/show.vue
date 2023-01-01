<template>
    <admin>
        <Head>
            <title>{{promotion.name}}</title>
        </Head>
        <title-block>
            <h6 class="font-bold text-sm">{{promotion.name}}</h6>
            <template #info >
                <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
                <p class="text-sm" v-else><span class="ml-2 mr-3 text-teal-900"><i class="fas fa-info-circle"></i></span>Running promotions</p>
            </template>
        </title-block>

        <div class="mt-10 px-3">
            <h1 class="font-bold text-xl">{{promotion.name}} at {{promotion.discount}}% Discount</h1>

            <hr class="mt-5">
            <div class="flex justify-between mt-5">
                <h5 class="font-bold">Select Products and add to promotion</h5>
                <div class="">

                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input v-model="search" type="search" id="promotion-search" class="block p-2 pl-10 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-sky-600 focus:border-sky-600" placeholder="Search products..." required>

                    </div>
                </div>
            </div>

            <table class="table-auto w-full mt-3 border-t">
                <thead>
                <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                    <th class="text-start py-3 px-4">
                        Id
                    </th>
                    <th class="text-start py-3 px-4">Sku</th>
                    <th class="text-start py-3 px-4">Name</th>
                    <th class="text-start py-3 px-4">Action</th>

                </tr>
                </thead>
                <tbody>
                <tr class="border-b text-[12px] font-medium"  v-for="product in products.data" :key="product.id">
                    <td class="py-3 px-4 text-start">
                        {{product.id}}
                    </td>
                    <td class="py-3 px-4 text-start">{{product.sku}}</td>
                    <td class="py-3 px-4 text-start">{{product.name}}</td>
                    <td>
                        <form @submit.prevent="remove(product.id)"
                              v-if="promotion.products.find(item=>item.id===product.id)">

                            <button class="text-red-700" type="submit">
                                <span class="mr-2"><i class="far fa-plus"></i></span> Remove from promotion
                            </button>
                        </form>
                        <form @submit.prevent="submit(product.id)"
                              v-else>

                            <button class="text-teal-700" type="submit">
                                <span class="mr-2"><i class="far fa-plus"></i></span> Add to promotion
                            </button>
                        </form>


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
            <div>
                <Sidelink :link="route('promotion.index')">Go to all promotions</Sidelink>
            </div>
        </template>
    </admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {Link} from "@inertiajs/inertia-vue3";
import {useForm} from "@inertiajs/inertia-vue3";
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import _ from "lodash"
import Sidelink from "@/views/components/sidelink.vue";
let props=defineProps({
    promotion:Object,
    products:Object,
    filters:Object
})
const productId=ref('')
let form=useForm({
    product_id:'',
    promotion_id:props.promotion.id
})

const submit=(product:any)=>{
    form.product_id=product;
    form.post(route('save-product'));
}

const remove=(product:any)=>{
    form.product_id=product;
    form.post(route('remove-product'));
}

const search=ref(props.filters.search)

watch(search, _.debounce(function (value:any) {
    Inertia.get(route('add-product',props.promotion.id),{
        search:value
    }, {preserveState:true, replace:true});
}, 300))

</script>

<style scoped>

</style>
