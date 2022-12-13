
<template>
<admin>
    <Head>
        <title>Categories</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Categories</h6>
        <template #info>
            <p class="text-sm"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> Categories for classifying products</p>
        </template>
    </title-block>

    <!--page content-->
    <div class="flex justify-between px-3 py-2">
        <h6 class="font-bold">Categories ({{ categories.data.length }})</h6>
    </div>
    <!--categories table-->
    <div class="">
        <!--table search and name-->
        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Name</th>
                <th class="text-start py-3 px-4">Status</th>
                <th class="py-3 px-4 text-start">Action</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b" v-if="categories.data" v-for="category in categories.data" :key="category.id">
                <td class="py-3 px-4">{{ category.id }}</td>
                <td class="py-3 px-4">{{ category.name }}</td>
                <td class="py-3 px-4">
                    <span v-if="category.status">Active </span>
                    <span v-else>Inactive </span>
                </td>
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
                                    <Link :href="route('categories.show',category.slug)" class="text-sm font-bold btn-link  pt-2  text-start">
                                        <span class="mr-2"><i class="fa-light fa-bookmark"></i></span>View
                                    </Link>
                                </li>
                                <li class="hover:bg-gray-100 h-8">

                                    <Link :href="route('categories.edit',category.id)" class="text-sm font-bold btn-link pt-2 text-start">
                                        <span class="mr-2"><i class="fa-light fa-pen"></i></span>Edit
                                    </Link>
                                </li>
                                <li class="hover:bg-gray-100 ">
                                    <Link :href="route('categories.destroy',category.id)" class="text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
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
                <h6 class="font-medium">Showing <span class="text-sky-800">{{ categories.current_page }}</span> of <span
                    class="text-sky-800">{{ categories.last_page }}</span> Page(s)</h6>
            </div>
            <div class="flex">
                <Link :href="categories.prev_page_url" class="btn-primary text-xs m-1" v-if="categories.prev_page_url"><span
                    class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                </Link>
                <Link :href="categories.next_page_url" class="btn-primary text-xs m-1" v-if="categories.next_page_url">Next
                    <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

            </div>

        </div>
    </div>

    <template #sidebar>
        <sidelink :link="route('categories.create')" class="btn-primary btn-small m-1">
            <span class="mr-2"><i class="fal fa-plus"></i></span>Category
        </sidelink>

    </template>
</admin>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import Admin from "@/views/layouts/admin.vue";
import TitleBlock from "@/views/components/title-block.vue";
import Sidelink from "@/views/components/sidelink.vue";
import {Link} from "@inertiajs/inertia-vue3";
import { Dropdown, Button} from 'flowbite-vue'

defineProps({
    categories:Object
})
</script>

<style scoped>

</style>
