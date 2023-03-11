<template>
<admin>
    <Head>
        <title>View FAQs</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">{{faq.question}}</h6>
        <template #info>
            <p class="text-sm flex gap-2">
                <svg class="fill-teal-700 h-5 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                <span>Frequently Asked Questions</span>
            </p>
        </template>
    </title-block>
    <div class="mt-5 px-3">
        <h1 class="text-lg font-bold">{{faq.question}}</h1>
        <p><span class="text-teal-700">Answer:</span>{{faq.answer}}</p>
    </div>
    <template #sidebar>
        <sidelink :link="route('faqs.edit',faq.id)">Edit FAQ</sidelink>
        <div>
            <Link :href="route('faqs.destroy',faq.id)" class="text-red-700 text-sm font-bold  w-full h-full text-start"  method="delete" as="button">
                Delete FAQ
            </Link>
        </div>
        <div class="mt-5">
            <h5 class="text-teal-700 font-bold">FAQs Categories</h5>
            <div>
                <sidelink :link="route('faqs-category.show',category.slug)" class="m-1 capitalize" v-for="category in categories" :key="category.id">
                    <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                        <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                        <span>{{category.name}}</span>
                    </p>
                </sidelink>
            </div>

        </div>

    </template>
</admin>
</template>

<script setup lang="ts">
import Admin from "@/views/layouts/admin.vue";
import TitleBlock from "@/views/components/title-block.vue";
import Sidelink from "@/views/components/sidelink.vue";
import {Link} from "@inertiajs/inertia-vue3";

defineProps({
    faq:Object,
    categories:Object
})
</script>

<style scoped>

</style>
