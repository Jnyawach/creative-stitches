<template>
<admin>
    <Head>
        <title>{{category.data.name}}</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">{{category.data.name}}</h6>
        <template #info>
            <p class="text-sm"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> Frequently Asked Questions</p>
        </template>
    </title-block>
    <div class="mt-8">
        <h6 class="font-bold">FAQS ({{category.data.faqs.length}})</h6>
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
            <tr class="border-b" v-if="category.data.faqs" v-for="faq in category.data.faqs" :key="faq.id">
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
        <div class="bg-gray-50 p-3 flex justify-between">
            <div class="self-center">
                <h6 class="font-medium">Showing <span class="text-sky-800">{{ category.data.faqs.current_page }}</span> of <span
                    class="text-sky-800">{{ category.data.faqs.last_page }}</span> Page(s)</h6>
            </div>
            <div class="flex">
                <Link :href="category.data.faqs.prev_page_url" class="btn-primary text-xs m-1" v-if="category.data.faqs.prev_page_url"><span
                    class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                </Link>
                <Link :href="category.data.faqs.next_page_url" class="btn-primary text-xs m-1" v-if="category.data.faqs.next_page_url">Next
                    <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

            </div>

        </div>
    </div>
    <template #sidebar>
        <sidelink :link="route('faqs.create')" class="btn-primary btn-small m-1 mt-3">
            <span class="mr-2"><i class="fal fa-plus"></i></span>Add FAQs
        </sidelink>
        <div class="mt-5">
            <h5 class="text-teal-700 font-bold">FAQs Categories</h5>
            <div>
                <sidelink :link="route('faqs-category.show',category.slug)" class="m-1 capitalize" v-for="category in branches" :key="category.id">
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
defineProps({
    category:Object,
    branches:Object
})
</script>

<style scoped>

</style>
