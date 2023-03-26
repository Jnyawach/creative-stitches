<template>
<admin>
<Head>
    <title>Messages</title>
</Head>
    <title-block>
        <h6 class="font-bold text-sm">Messages</h6>

        <template #info >
            <p class="text-sm flex gap-2">
                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                <span>Messages from contact form</span>
            </p>
        </template>
    </title-block>

    <div class="mt-10">
        <div class="px-3 py-3">
            <input type="search" class="creative-input" placeholder="Search Messages..." v-model="sort.search">
        </div>
     <div class="flex px-3 gap-5">
         <div>
             <label>
                 <input type="radio" class="hidden peer" v-model="sort.status" value="">
                 <span class="cursor-pointer font-bold peer-checked:text-teal-700" >All</span>
             </label>
         </div>
         <div>
             <label>
                 <input type="radio" class="hidden peer" v-model="sort.status" value="0">
                 <span class="cursor-pointer font-bold peer-checked:text-teal-700">Unread</span>
             </label>
         </div>
         <div>
             <label>
                 <input type="radio" class="hidden peer" v-model="sort.status" value="1">
                 <span class="cursor-pointer font-bold peer-checked:text-teal-700">Read</span>
             </label>
         </div>
         <div>
             <label>
                 <input type="radio" class="hidden peer" v-model="sort.status" value="2">
                 <span class="cursor-pointer font-bold peer-checked:text-teal-700">Responded</span>
             </label>
         </div>
     </div>
    </div>

    <div class="mt-5 divide-y">
        <div class="hover:drop-shadow-md p-2 py-3 flex justify-between" v-for="message in messages.data" :key="message.id" :class="[!message.status?'bg-gray-50':'']">
            <Link :href="route('contact.show',message.id)" class="text-sm flex gap-2" :class="[!message.status?'text-gray-900':'text-gray-400']">
                <p class="capitalize font-semibold flex gap-1">
                    <svg v-if="message.status===2" class="h-4 fill-teal-700 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M243.8 339.8C232.9 350.7 215.1 350.7 204.2 339.8L140.2 275.8C129.3 264.9 129.3 247.1 140.2 236.2C151.1 225.3 168.9 225.3 179.8 236.2L224 280.4L332.2 172.2C343.1 161.3 360.9 161.3 371.8 172.2C382.7 183.1 382.7 200.9 371.8 211.8L243.8 339.8zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/></svg>
                    <span>{{message.name}}</span></p>
                <p class="capitalize">{{message.subject}}</p>
                <p class="text-gray-300">{{useTruncate(message.message,50)}}</p>

            </Link>
            <div class="flex gap-2">
                <Link v-if="!message.status" :href="route('contact.markRead',message.id)" class="text-sm font-bold  text-start"  method="patch" as="button">
                    <span class="text-teal-700">Mark read</span>
                </Link>

                <Link :href="route('contact.destroy',message.id)" class="text-sm font-bold  text-start text-red-700"  method="delete" as="button">
                    Delete
                </Link>
            </div>
        </div>
    </div>
    <pagination :data="messages"></pagination>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {reactive, watch} from "vue";
import {Link} from "@inertiajs/inertia-vue3";
import {useTruncate} from "@/scripts/use/useTruncate";
import {debounce} from 'lodash';
import {Inertia} from "@inertiajs/inertia";
import Pagination from "@/views/components/pagination.vue";

let props=defineProps({
    messages:Object,
    filters:Object
})
const sort=reactive({
    search:props.filters.search,
    status:props.filters.status
})

watch(sort, debounce(()=>{
    Inertia.get(route('contact.index'),{
        search:sort.search, status:sort.status
    }, {preserveState:true, replace:true});
},300))


</script>

<style scoped>

</style>
