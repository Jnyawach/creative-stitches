<template>
<admin>
 <Head><title>Reviews</title></Head>
    <title-block>
        <h6 class="font-bold text-sm">Reviews</h6>
        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 mr-3 text-teal-900"><i class="fas fa-info-circle"></i></span>Reviews posted by customers </p>
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
                                Action <span class="self-center"><i class="far fa-ellipsis-v-alt"></i></span>
                            </Button>
                        </template>
                        <div class="shadow w-36">
                            <ul class="divide-y">
                                <li class="hover:bg-gray-100 py-2">
                                    <Link :href="route('ratings.show',review.id)" class="text-sm font-bold text-start p-2 w-full h-full" as="button">
                                        <span class="mr-2"><i class="fal fa-bookmark"></i></span>View details
                                    </Link>
                                </li>


                                <li class="hover:bg-gray-100">
                                    <Link :href="route('ratings.destroy',review.id)" class="text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
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
