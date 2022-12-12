<template>
<admin>
    <Head>
        <title>View FAQs</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">{{faq.question}}</h6>
        <template #info>
            <p class="text-sm"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> Frequently Asked Questions</p>
        </template>
    </title-block>
    <div class="mt-5 px-3">
        <h1 class="text-lg font-bold">{{faq.question}}</h1>
        <p><span class="text-teal-700">Answer:</span>{{faq.answer}}</p>
    </div>
    <template #sidebar>
        <sidelink :link="route('faqs.edit',faq.id)"><span class="mr-2"><i class="fa-light fa-pen"></i></span>Edit FAQ</sidelink>
        <div>
            <Link :href="route('faqs.destroy',faq.id)" class="text-red-700 text-sm font-bold  w-full h-full text-start"  method="delete" as="button">
                <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete FAQ
            </Link>
        </div>
        <div class="mt-5">
            <h5 class="text-teal-700 font-bold">FAQs Categories</h5>
            <div>
                <sidelink :link="route('faqs-category.show',category.slug)" class="m-1 capitalize" v-for="category in categories" :key="category.id">
                    <span class="mr-2 text-teal-700"><i class="far fa-angle-right"></i></span>{{category.name}}
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
