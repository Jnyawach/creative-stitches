<template>
<admin>
 <Head><title>Reviews</title></Head>
    <title-block>
        <h6 class="font-bold text-sm">Reviews</h6>
        <template #info >
            <p class="text-sm flex gap-2">
                <svg class="fill-teal-700 h-5 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                <span>Product Reviews</span>
            </p>
        </template>
    </title-block>

    <div class="my-10">
        <div class="flex gap-1 justify-end px-3">
            <div class="self-center">
                <h6>Sort By:</h6>
            </div>
            <div>
                <select class="h-9 rounded-lg text-sm" v-model="rating">
                    <option selected value="">Random</option>
                    <option value="DESC">Rating High</option>
                    <option value="ASC">Rating Low</option>
                </select>
            </div>
            <div>
                <select class="h-9 rounded-lg text-sm" v-model="age">
                    <option selected value="">Random</option>
                    <option value="ASC">Newest</option>
                    <option value="DESC">Oldest</option>
                </select>
            </div>
        </div>
        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Customer</th>
                <th class="text-start py-3 px-4">Ratings</th>
                <th class="text-start py-3 px-4">Comments</th>
                <th class="text-start py-3 px-4">Product</th>
                <th class="py-3 px-4 text-start">Action</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b" v-if="reviews.data" v-for="review in reviews.data" :key="review.id">
                <td class="py-2 px-4">{{review.id }}</td>
                <td class="py-2 px-4">{{review.user.name }}</td>
                <td class="py-2 px-4">{{review.rating }}</td>
                <td class="py-2 px-4">{{useTruncate(review.comment,20) }}</td>
                <td class="py-2 px-4"><Link class="text-teal-500"
                    :href="route('products.show',review.product.slug)">
                    {{useTruncate(review.product.name,30) }}
                </Link></td>
                <td class="py-3 px-4">
                    <dropdown placement="bottom">
                        <template #trigger="{ toggle }">
                            <Button @click="toggle" >
                                <span class="flex gap-1">
                                   <span>Action</span>
                                     <svg class="h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512"><path d="M56 472a56 56 0 1 1 0-112 56 56 0 1 1 0 112zm0-160a56 56 0 1 1 0-112 56 56 0 1 1 0 112zM0 96a56 56 0 1 1 112 0A56 56 0 1 1 0 96z"/></svg>
                               </span>
                            </Button>
                        </template>
                        <div class="shadow w-36">
                            <ul class="divide-y">
                                <li class="hover:bg-gray-100 py-2">
                                    <Link :href="route('ratings.show',review.id)" class="flex gap-1 text-sm font-bold text-start p-2 w-full h-full" as="button">
                                        <svg class="h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M320 0H64C28.72 0 0 28.7 0 64v431.1c0 5.844 3.188 11.23 8.312 14.04c5.125 2.781 11.34 2.562 16.28-.5313L192 402.1l167.4 106.5C362 511.2 365 512 368 512c2.656 0 5.281-.6562 7.688-1.969C380.8 507.2 384 501.8 384 495.1V64C384 28.7 355.3 0 320 0zM352 466.9l-151.4-96.36C197.1 368.8 195 368 192 368s-5.969 .8281-8.594 2.5L32 466.9V64c0-17.64 14.34-32 32-32h256c17.66 0 32 14.36 32 32V466.9z"/></svg>
                                        <span>View</span>
                                    </Link>
                                </li>


                                <li class="hover:bg-gray-100">
                                    <Link :href="route('ratings.destroy',review.id)" class="flex gap-1 text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
                                        <svg class="h-4 fill-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M144 400C144 408.8 136.8 416 128 416C119.2 416 112 408.8 112 400V176C112 167.2 119.2 160 128 160C136.8 160 144 167.2 144 176V400zM240 400C240 408.8 232.8 416 224 416C215.2 416 208 408.8 208 400V176C208 167.2 215.2 160 224 160C232.8 160 240 167.2 240 176V400zM336 400C336 408.8 328.8 416 320 416C311.2 416 304 408.8 304 400V176C304 167.2 311.2 160 320 160C328.8 160 336 167.2 336 176V400zM310.1 22.56L336.9 64H432C440.8 64 448 71.16 448 80C448 88.84 440.8 96 432 96H416V432C416 476.2 380.2 512 336 512H112C67.82 512 32 476.2 32 432V96H16C7.164 96 0 88.84 0 80C0 71.16 7.164 64 16 64H111.1L137 22.56C145.8 8.526 161.2 0 177.7 0H270.3C286.8 0 302.2 8.526 310.1 22.56V22.56zM148.9 64H299.1L283.8 39.52C280.9 34.84 275.8 32 270.3 32H177.7C172.2 32 167.1 34.84 164.2 39.52L148.9 64zM64 432C64 458.5 85.49 480 112 480H336C362.5 480 384 458.5 384 432V96H64V432z"/></svg>
                                        <span>Delete</span>
                                    </Link>
                                </li>



                            </ul>
                        </div>
                    </dropdown>

                </td>


            </tr>


            </tbody>

        </table>
        <pagination :data="reviews"></pagination>
    </div>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head, Link} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import _ from "lodash"
import Pagination from "@/views/components/pagination.vue";
import {useTruncate} from "@/scripts/use/useTruncate";
import { Dropdown} from 'flowbite-vue'
let props=defineProps({
    reviews:Object,
    filters:Object
})

const age=ref(props.filters.age?props.filters.age:'')
const rating=ref(props.filters.rating?props.filters.rating:'')
watch([age, rating], _.debounce(function (value:any) {
    Inertia.get(route('ratings.index'),{
       age:age.value,
        rating:rating.value
    }, {preserveState:true, replace:true});
}, 300))
</script>

<style scoped>

</style>
