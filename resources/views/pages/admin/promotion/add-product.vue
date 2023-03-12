<template>
    <admin>
        <Head>
            <title>{{promotion.name}}</title>
        </Head>
        <title-block>
            <h6 class="font-bold text-sm">{{promotion.name}}</h6>
            <template #info >
                <p class="text-sm flex gap-2">
                    <svg class="fill-teal-700 h-5 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                    <span>Running Promotions</span>
                </p>
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
                        <input v-model="search" type="search" id="default-search" class="block p-2 pl-10 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-sky-600 focus:border-sky-600" placeholder="Search roles..." required>

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

                          <button class="text-red-700 flex gap-1" type="submit">
                              <svg class="w-5 fill-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M432 256C432 264.8 424.8 272 416 272H32c-8.844 0-16-7.15-16-15.99C16 247.2 23.16 240 32 240h384C424.8 240 432 247.2 432 256z"/></svg>
                              <span>Remove from Promotion</span>
                          </button>
                        </form>
                        <form @submit.prevent="submit(product.id)"
                              v-else>

                            <button class="text-teal-700 flex gap-1" type="submit">
                                <svg class="h-5 fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M432 256C432 264.8 424.8 272 416 272h-176V448c0 8.844-7.156 16.01-16 16.01S208 456.8 208 448V272H32c-8.844 0-16-7.15-16-15.99C16 247.2 23.16 240 32 240h176V64c0-8.844 7.156-15.99 16-15.99S240 55.16 240 64v176H416C424.8 240 432 247.2 432 256z"/></svg>
                                <span>Add to promotion</span>
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
