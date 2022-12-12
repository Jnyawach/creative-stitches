<template>
<admin>
    <Head>
        <title>Add FAQ</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Create FAQs</h6>
        <template #info>
            <p class="text-sm"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> Create Frequently Asked Questions</p>
        </template>
    </title-block>

    <div class="px-3 mt-10">
        <form @submit.prevent="form.post(route('faqs.store'))">
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
                <button type="submit" class="btn-primary">Save FAQ</button>
            </div>
        </form>
    </div>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head, useForm} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
defineProps({
    categories:Object
})
let form=useForm({
    question:'',
    answer:'',
    category:''
})
</script>

<style scoped>

</style>
