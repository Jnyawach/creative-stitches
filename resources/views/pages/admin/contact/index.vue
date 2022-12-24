<template>
<admin>
<Head>
    <title>Messages</title>
</Head>
    <title-block>
        <h6 class="font-bold text-sm">Messages</h6>

        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> Messages from contact form</p>
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
                <p class="capitalize font-semibold"><span v-if="message.status===2" class="mr-2 text-teal-700" title="Responded"><i class="far fa-check-circle"></i></span>{{message.name}}</p>
                <p class="capitalize">{{message.subject}}</p>
                <p class="text-gray-300">{{useTruncate(message.message,50)}}</p>

            </Link>
            <div class="flex gap-2">
                <Link v-if="!message.status" :href="route('contact.markRead',message.id)" class="text-sm font-bold  text-start"  method="patch" as="button">
                    <span class="mr-2"><i class="far fa-eye"></i></span>Mark read
                </Link>

                <Link :href="route('contact.destroy',message.id)" class="text-sm font-bold  text-start"  method="delete" as="button">
                    <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete
                </Link>
            </div>
        </div>
    </div>

    <div class="bg-teal-50 p-3 flex justify-between">
        <div class="self-center">
            <h6 class="font-medium">Showing <span class="text-sky-800">{{ messages.meta.current_page }}</span> of <span
                class="text-sky-800">{{ messages.meta.last_page }}</span> Page(s)</h6>
        </div>
        <div class="flex">
            <Link :href="messages.links.prev" class="btn-primary text-xs m-1" v-if="messages.links.prev"><span
                class="mr-2"><i class="far fa-angle-left"></i></span>Prev
            </Link>
            <Link :href="messages.links.next" class="btn-primary text-xs m-1" v-if="messages.links.next">Next
                <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

        </div>

    </div>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {reactive, ref, watch} from "vue";
import {Link} from "@inertiajs/inertia-vue3";
import {useTruncate} from "@/scripts/use/useTruncate";
import _ from "lodash";
import {Inertia} from "@inertiajs/inertia";

let props=defineProps({
    messages:Object,
    filters:Object
})
const sort=reactive({
    search:props.filters.search,
    status:props.filters.status
})

watch(sort,_.debounce(()=>{
    Inertia.get(route('contact.index'),{
        search:sort.search, status:sort.status
    }, {preserveState:true, replace:true});
},300))


</script>

<style scoped>

</style>
