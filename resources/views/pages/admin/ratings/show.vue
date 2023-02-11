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
    <div class="my-10 px-3">
        <div class="grid grid-cols-2 gap-2">
            <div>
                <h6 class="font-bold text-lg">{{review.user.name}} {{review.user.last_name}}</h6>
            <div>
                <p  class="mt-1">
                    <span v-for="rating in review.rating" class="text-teal-700"><i class="fas fa-star"></i></span>
                    <span v-for="rating in 5-review.rating" class="text-teal-700"><i
                        class="far fa-star"></i></span>


                </p>
                <p v-show="review.comment">
                    {{review.comment}}
                </p>
                <p>Posted on: <span class="text-teal-500">{{new Date(review.created_at).toDateString()}}</span></p>
            </div>
            </div>
            <div>
            <h6 class="font-bold text-lg">Product: {{review.product.name}}</h6>
                <div class="my-3">
                    <img :src="review.product.mainImage.thumb" :alt="review.product.name">

                    <Link class="font-bold my-2" :href="route('products.show',review.product.slug)">View Product</Link>
                </div>
            </div>
        </div>

        <div class="flex justify-center gap-2 my-2">
            <Link v-if="previous" class="btn-primary btn-small" :href="route('ratings.show', previous)"><span class="mr-2"><i class="fal fa-long-arrow-left"></i></span>Previous</Link>
            <Link v-if="next" class="btn-primary btn-small" :href="route('ratings.show', next)">Next<span class="ml-2"><i class="fal fa-long-arrow-right"></i></span></Link>
        </div>
    </div>
    <template #sidebar>
        <Sidelink :link="route('ratings.index')">All Reviews</Sidelink>
    </template>
</admin>

</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head, Link} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import Sidelink from "@/views/components/sidelink.vue";
let props=defineProps({
    review:Object,
    next:Number,
    previous:Number
})

const review=props.review.data
</script>

<style scoped>

</style>
