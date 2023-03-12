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
    <div class="my-10 px-3">
        <div class="grid grid-cols-2 gap-2">
            <div>
                <h6 class="font-bold text-lg">{{review.user.name}} {{review.user.last_name}}</h6>
            <div>
                <div>
                    <div class="flex gap-1 mt-1">
                        <div v-for="rating in review.rating" class="self-center">
                            <svg class="h-3 fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                        </div>
                        <div v-for="rating in 5-review.rating" class="self-center">
                            <svg class="h-3 fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M287.9 0C297.1 0 305.5 5.25 309.5 13.52L378.1 154.8L531.4 177.5C540.4 178.8 547.8 185.1 550.7 193.7C553.5 202.4 551.2 211.9 544.8 218.2L433.6 328.4L459.9 483.9C461.4 492.9 457.7 502.1 450.2 507.4C442.8 512.7 432.1 513.4 424.9 509.1L287.9 435.9L150.1 509.1C142.9 513.4 133.1 512.7 125.6 507.4C118.2 502.1 114.5 492.9 115.1 483.9L142.2 328.4L31.11 218.2C24.65 211.9 22.36 202.4 25.2 193.7C28.03 185.1 35.5 178.8 44.49 177.5L197.7 154.8L266.3 13.52C270.4 5.249 278.7 0 287.9 0L287.9 0zM287.9 78.95L235.4 187.2C231.9 194.3 225.1 199.3 217.3 200.5L98.98 217.9L184.9 303C190.4 308.5 192.9 316.4 191.6 324.1L171.4 443.7L276.6 387.5C283.7 383.7 292.2 383.7 299.2 387.5L404.4 443.7L384.2 324.1C382.9 316.4 385.5 308.5 391 303L476.9 217.9L358.6 200.5C350.7 199.3 343.9 194.3 340.5 187.2L287.9 78.95z"/></svg>
                        </div>

                    </div>
                </div>
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
            <Link v-if="previous" class="btn-primary btn-small flex gap-1" :href="route('ratings.show', previous)">
               <svg class="fill-white h-4 self-center mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M203.9 405.3c5.877 6.594 5.361 16.69-1.188 22.62c-6.562 5.906-16.69 5.375-22.59-1.188L36.1 266.7c-5.469-6.125-5.469-15.31 0-21.44l144-159.1c5.906-6.562 16.03-7.094 22.59-1.188c6.918 6.271 6.783 16.39 1.188 22.62L69.53 256L203.9 405.3z"/></svg>
                <span class="self-center">Prev</span>
            </Link>
            <Link v-if="next" class="btn-primary btn-small flex gap-1" :href="route('ratings.show', next)">
                <span class="self-center">Next</span>
                <svg class="fill-white h-4 self-center ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
            </Link>
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
