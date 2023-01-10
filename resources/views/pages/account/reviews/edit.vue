<template layout="main">
    <Head>
        <title>Edit Review {{product.name}}</title>
    </Head>
    <account-menu></account-menu>
    <div class="my-8 px-3 md:px-10">
        <h1 class="text-2xl font-bold">Create a review</h1>
        <div class="mt-5">
            <div class="grid sm:grid-cols-6 gap-4">
                <div class=" sm:col-span-2">
                    <img :src="product.mainImage.thumb" :alt="product.name" class="rounded-lg">
                </div>
                <div class="sm:col-span-4">
                    <h6 class="font-bold text-2xl">{{ product.name }}</h6>
                    <p><span class="mr-2 text-teal-700">Sku:</span>{{product.sku}}</p>
                    <div class="mt-3">
                        <form @submit.prevent="form.patch(route('reviews.update',review.data.id))">
                            <h6 class="text-lg">How did we do?</h6>
                            <div class="mt-3 flex gap-2">
                                <div>
                                    <input id="rate-1" type="radio" v-model="form.rating" value="1" name="rating" class="hidden peer">
                                    <label for="rate-1" class="border h-10 w-10 flex place-content-center cursor-pointer
                                   rounded-full hover:bg-teal-700 hover:border-teal-700 peer-checked:border-teal-700 peer-checked:text-white
                                  peer-checked:bg-teal-700 hover:text-white">
                                        <span class="self-center font-bold text-2xl">1</span>
                                    </label>
                                </div>
                                <div>
                                    <input id="rate-2" type="radio" v-model="form.rating" value="2" name="rating" class="hidden peer">
                                    <label for="rate-2" class="border h-10 w-10 flex place-content-center cursor-pointer
                                   rounded-full hover:bg-teal-700 hover:border-teal-700 peer-checked:border-teal-700 peer-checked:text-white
                                  peer-checked:bg-teal-700 hover:text-white">
                                        <span class="self-center font-bold text-2xl">2</span>
                                    </label>
                                </div>
                                <div>
                                    <input id="rate-3" type="radio" v-model="form.rating" value="3" name="rating" class="hidden peer">
                                    <label for="rate-3" class="border h-10 w-10 flex place-content-center cursor-pointer
                                   rounded-full hover:bg-teal-700 hover:border-teal-700 peer-checked:border-teal-700 peer-checked:text-white
                                  peer-checked:bg-teal-700 hover:text-white">
                                        <span class="self-center font-bold text-2xl">3</span>
                                    </label>
                                </div>
                                <div>
                                    <input id="rate-4" type="radio" v-model="form.rating" value="4" name="rating" class="hidden peer">
                                    <label for="rate-4" class="border h-10 w-10 flex place-content-center cursor-pointer
                                   rounded-full hover:bg-teal-700 hover:border-teal-700 peer-checked:border-teal-700 peer-checked:text-white
                                  peer-checked:bg-teal-700 hover:text-white">
                                        <span class="self-center font-bold text-2xl">4</span>
                                    </label>
                                </div>
                                <div>
                                    <input id="rate-5" type="radio" v-model="form.rating" value="5" name="rating" class="hidden peer">
                                    <label for="rate-5" class="border h-10 w-10 flex place-content-center cursor-pointer
                                   rounded-full hover:bg-teal-700 hover:border-teal-700 peer-checked:border-teal-700 peer-checked:text-white
                                  peer-checked:bg-teal-700 hover:text-white">
                                        <span class="self-center font-bold text-2xl">5</span>
                                    </label>
                                </div>
                            </div>
                            <div v-if="form.errors.rating" class="mt-3 text-red-800 text-sm">
                                <span>{{ form.errors.rating }}</span>
                            </div>
                            <div class="mt-5">
                                <textarea v-model="form.comment" placeholder="Add a comment (optional)" rows="5" class="creative-text-input"></textarea>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn-primary">Save Review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Head, useForm} from "@inertiajs/inertia-vue3";
let props=defineProps({
    review:Object
})
const product=props.review.data.product
let form=useForm({
    product_id:props.review.data.product.id,
    rating:props.review.data.rating,
    comment:props.review.data.comment,

})
</script>

<style scoped>

</style>
