<template layout="main">
<Head>
    <title>Product Reviews</title>
</Head>
    <account-menu></account-menu>
    <div class="my-8 px-3 md:px-24">
        <h1 class="text-2xl font-bold">Your Reviews</h1>
        <div class="mt-3" v-if="reviews.data">
            <div v-for="review in reviews.data"  :key="review.id" class="grid sm:grid-cols-5 gap-3 m-2 my-8">
             <div class="sm:col-span-2 md:col-span-1">
                 <img :src="review.product.mainImage.icon" :alt="review.product.name" class="rounded-lg">
             </div>
                <div class="sm:col-span-3 md:col-span-4">
                    <h6 class="font-bold text-lg">{{ review.product.name }}</h6>
                    <p><span class="mr-2 text-teal-700">Sku:</span>{{ review.product.sku}}</p>
                    <p class="mt-2 text-lg">
                        <span v-for="rating in review.rating" class="m-1 text-teal-700"><i class="fas fa-star"></i></span>
                        <span v-for="rating in 5-review.rating" class="m-1 text-teal-700"><i class="far fa-star"></i></span>
                    </p>
                    <p>
                        {{review.comment}}
                    </p>

                    <p><span class="mr-2 text-teal-700">Submitted on:</span> {{new Date(review.created_at).toDateString()}}</p>
                   <Link class="font-bold text-teal-700" :href="route('reviews.edit',review.id)">Edit Review<span class="ml-2"><i class="far fa-pen"></i></span></Link>
                </div>
            </div>
            <div class="flex justify-between mt-10">
                <div class="self-center">
                    <h6 class="font-medium">Showing <span class="text-sky-800">{{ reviews.meta.current_page }}</span> of <span
                        class="text-sky-800">{{ reviews.meta.last_page }}</span> Page(s)</h6>
                </div>
                <div class="flex">
                    <Link :href="reviews.links.prev" class="btn-primary text-xs m-1" v-if="reviews.links.prev"><span
                        class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                    </Link>
                    <Link :href="reviews.links.next" class="btn-primary text-xs m-1" v-if="reviews.links.next">Next
                        <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

                </div>
            </div>
        </div>
        <div v-else class="py-8">
            <h1 class="font-bold text-lg text-center">No reviews available currently</h1>

        </div>
    </div>
</template>

<script setup lang="ts">
import {Head,Link} from "@inertiajs/inertia-vue3";
import AccountMenu from "@/views/components/account-menu.vue";
defineProps({
    reviews:Object
})
</script>

<style scoped>

</style>
