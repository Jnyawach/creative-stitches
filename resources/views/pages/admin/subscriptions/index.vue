<template>
<admin>
    <Head><title>Subscriptions</title></Head>
    <title-block>
        <h6 class="font-bold text-sm">Subscriptions</h6>
        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 mr-3 text-teal-900"><i class="fas fa-info-circle"></i></span>Running Email Subscriptions</p>
        </template>
    </title-block>
    <div class="my-10">

        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Name</th>
                <th class="text-start py-3 px-4">Email</th>
                <th class="py-3 px-4 text-start">Action</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b"  v-for="subscription in subscriptions.data" :key="subscription.id">
                <td class="py-2 px-4">{{subscription.id }}</td>
                <td class="py-2 px-4">{{ subscription.name }}</td>
                <td class="py-2 px-4">{{ subscription.email}}</td>
                <td class="py-2 px-4">
                    <Link :href="route('subscriptions.destroy',subscription.id)" class="text-red-700 text-sm font-bold p-1 w-full h-full text-start"  method="delete" as="button">
                        <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete
                    </Link>
                </td>

            </tr>


            </tbody>

        </table>
        <div class="bg-gray-50 p-3 flex justify-between">
            <div class="self-center">
                <h6 class="font-medium">Showing <span class="text-sky-800">{{ subscriptions.current_page }}</span> of <span
                    class="text-sky-800">{{ subscriptions.last_page }}</span> Page(s)</h6>
            </div>
            <div class="flex">
                <Link :href="subscriptions.prev_page_url" class="btn-primary text-xs m-1" v-if="subscriptions.prev_page_url"><span
                    class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                </Link>
                <Link :href="subscriptions.next_page_url" class="btn-primary text-xs m-1" v-if="subscriptions.next_page_url">Next
                    <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

            </div>

        </div>
    </div>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head,Link} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";

defineProps({
    subscriptions:Object
})
</script>

<style scoped>

</style>
