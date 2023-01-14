<template>
<admin>
    <Head><title>users</title></Head>
    <title-block>
        <h6 class="font-bold text-sm">users</h6>
        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 mr-3 text-teal-900"><i class="fas fa-info-circle"></i></span>Running Email users</p>
        </template>
    </title-block>
    <div class="my-10">
        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Name</th>
                <th class="text-start py-3 px-4">Email</th>
                <th class="text-start py-3 px-4">Orders</th>
                <th class="text-start py-3 px-4">Total Spent ($)</th>
                <th class="py-3 px-4 text-start">Action</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b"  v-for="user in users.data" :key="user.id">
                <td class="py-2 px-4">{{user.id }}</td>
                <td class="py-2 px-4">{{ user.name }} {{ user.last_name }}</td>
                <td class="py-2 px-4">{{ user.email}}</td>
                <td class="py-2 px-4">{{ user.orders_count}}</td>
                <td class="py-2 px-4">{{ user.payments_sum_total}}</td>
                <td class="py-2 px-4">
                    <dropdown placement="bottom">
                        <template #trigger="{ toggle }">
                            <button @click="toggle">
                                Action <span class="self-center"><i class="far fa-ellipsis-v-alt"></i></span>
                            </button>
                        </template>
                        <div class="shadow w-36">
                            <ul class="divide-y pt-2">

                                <li class="hover:bg-gray-100 h-8">
                                    <Link :href="route('users.show',user.id)" class="text-sm font-bold btn-link  pt-3  text-start">
                                        <span class="mr-2"><i class="fa-light fa-bookmark"></i></span>View details
                                    </Link>
                                </li>

                                <li class="hover:bg-gray-100 ">
                                    <Link :href="route('users.destroy',user.id)" class="text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
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
                <h6 class="font-medium">Showing <span class="text-sky-800">{{ users.current_page }}</span> of <span
                    class="text-sky-800">{{ users.last_page }}</span> Page(s)</h6>
            </div>
            <div class="flex">
                <Link :href="users.prev_page_url" class="btn-primary text-xs m-1" v-if="users.prev_page_url"><span
                    class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                </Link>
                <Link :href="users.next_page_url" class="btn-primary text-xs m-1" v-if="users.next_page_url">Next
                    <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

            </div>

        </div>
    </div>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head,Link} from "@inertiajs/inertia-vue3";
import TitleBlock from '@/views/components/title-block.vue'
import {Dropdown} from "flowbite-vue";
defineProps({
    users:Object
})
</script>

<style scoped>

</style>
