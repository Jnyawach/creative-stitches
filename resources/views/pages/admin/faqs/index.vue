<template>
<admin>
    <Head>
        <title>FAQs</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">FAQs</h6>
        <template #info>
            <p class="text-sm"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> Frequently Asked Questions</p>
        </template>
    </title-block>

    <div class="mt-8">
        <h6 class="font-bold">FAQS ({{faqs.data.length}})</h6>
        <!--table search and name-->
        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Question</th>
                <th class="text-start py-3 px-4">Category</th>
                <th class="py-3 px-4 text-start">Action</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b" v-if="faqs.data" v-for="faq in faqs.data" :key="faq.id">
                <td class="py-3 px-4">{{ faq.id }}</td>
                <td class="py-3 px-4">{{ faq.question }}</td>
                <td class="py-3 px-4">{{ faq.category.name }}</td>

                <td class="py-3 px-4">
                    <dropdown placement="bottom">
                        <template #trigger="{ toggle }">
                            <button @click="toggle" >
                                Action <span class="self-center"><i class="far fa-ellipsis-v-alt"></i></span>
                            </button>
                        </template>
                        <div class="shadow w-36">
                            <ul class="divide-y">
                                <li class="hover:bg-gray-100 h-8">
                                    <Link :href="route('faqs.show',faq.slug)" class="text-sm font-bold btn-link  pt-2  text-start">
                                        <span class="mr-2"><i class="fa-light fa-bookmark"></i></span>View
                                    </Link>
                                </li>
                                <li class="hover:bg-gray-100 h-8">

                                    <Link :href="route('faqs.edit',faq.id)" class="text-sm font-bold btn-link pt-2 text-start">
                                        <span class="mr-2"><i class="fa-light fa-pen"></i></span>Edit
                                    </Link>
                                </li>
                                <li class="hover:bg-gray-100 ">
                                    <Link :href="route('faqs.destroy',faq.id)" class="text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
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
        <pagination :data="faqs"></pagination>
    </div>

    <template #sidebar>
        <sidelink :link="route('faqs.create')" class="btn-primary btn-small m-1 mt-3">
            <span class="mr-2"><i class="fal fa-plus"></i></span>Add FAQs
        </sidelink>
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
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import Sidelink from "@/views/components/sidelink.vue";
import {Link} from "@inertiajs/inertia-vue3";
import {Dropdown, Button} from "flowbite-vue";
import Pagination from "@/views/components/pagination.vue"

defineProps({
    faqs:Object,
    categories:Object
})

</script>

<style scoped>

</style>
