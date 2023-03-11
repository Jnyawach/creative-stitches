<template>
    <admin>
        <Head>
            <title>Edit FAQ</title>
        </Head>
        <title-block>
            <h6 class="font-bold text-sm">Edit FAQs</h6>
            <template #info>
                <p class="text-sm flex gap-2">
                    <svg class="fill-teal-700 h-5 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                    <span>Frequently Asked Questions</span>
                </p>
            </template>
        </title-block>

        <div class="px-3 mt-10">
            <form @submit.prevent="form.patch(route('faqs.update',faq.id))">
                <div class="grid">
                    <div class="w-1/2">
                        <label class="creative-label">FAQ Category:</label>
                        <select v-model="form.category" class="creative-input" required>
                            <option selected value="">Select Category</option>
                            <option v-for="category in categories" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>

                    </div>
                </div>
                <div class="grid mt-4">
                    <div>
                        <label class="creative-label">Enter Question:</label>
                        <input type="text" v-model="form.question" class="creative-input" required>
                    </div>
                </div>

                <div class="grid mt-4">
                    <div>
                        <label class="creative-label">Answer:</label>
                        <div>
                            <small class="text-xs">Provide a short and descriptive answer about 150 words
                                for the question</small>
                        </div>
                        <textarea required placeholder="Enter description" class="creative-text-input" rows="4" v-model="form.answer"></textarea>
                        <div v-if="form.errors.answer" class="creative-error">
                            <span>{{ form.errors.answer }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="btn-primary">Update FAQ</button>
                </div>
            </form>
        </div>
    </admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head, useForm} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
let props=defineProps({
    categories:Object,
    faq:Object
})
let form=useForm({
    question:props.faq.question,
    answer:props.faq.answer,
    category:props.faq.faq_category_id
})
</script>

<style scoped>

</style>
