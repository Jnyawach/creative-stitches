<template>
<admin>
    <Head>
        <title>Quote Requests</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Request for Quotations</h6>

        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 mr-3 text-teal-900"><i class="fas fa-info-circle"></i></span>Request for Quotations</p>
        </template>
    </title-block>

    <div class="mt-10">
        <div class="px-3 py-3">
            <input type="search" class="creative-input" placeholder="Search quotes..." v-model="sort.search">
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
        <div class="hover:drop-shadow-md p-2 py-3 flex justify-between" v-for="quote in quotes.data" :key="quote.id" :class="[!quote.status?'bg-gray-50':'']">
            <Link :href="route('quote-request.show',quote.id)" class="text-sm flex gap-2" :class="[!quote.status?'text-gray-900':'text-gray-400']">
                <p class="capitalize font-semibold"><span v-if="quote.status===2" class="mr-2 text-teal-700" title="Responded"><i class="far fa-check-circle"></i></span>{{quote.name}} {{quote.last_name}}</p>
                <p class="text-gray-300">{{quote.email}}</p>
                <p class="text-gray-300">{{quote.cellphone}}</p>

            </Link>
            <div class="flex gap-2">
                <Link v-if="!quote.status" :href="route('quote.responded',quote.id)" class="text-sm font-bold  text-start"  method="patch" as="button">
                    <span class="mr-2"><i class="far fa-eye"></i></span>Mark responded
                </Link>

                <Link :href="route('quote-request.destroy',quote.id)" class="text-sm font-bold  text-start"  method="delete" as="button">
                    <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete
                </Link>
            </div>
        </div>
    </div>

    <div class="bg-teal-50 p-3 flex justify-between">
        <div class="self-center">
            <h6 class="font-medium">Showing <span class="text-sky-800">{{ quotes.meta.current_page }}</span> of <span
                class="text-sky-800">{{ quotes.meta.last_page }}</span> Page(s)</h6>
        </div>
        <div class="flex">
            <Link :href="quotes.links.prev" class="btn-primary text-xs m-1" v-if="quotes.links.prev"><span
                class="mr-2"><i class="far fa-angle-left"></i></span>Prev
            </Link>
            <Link :href="quotes.links.next" class="btn-primary text-xs m-1" v-if="quotes.links.next">Next
                <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

        </div>

    </div>
</admin>

</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import TitleBlock from "@/views/components/title-block.vue";
import {Head} from "@inertiajs/inertia-vue3";
import {reactive, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {Link} from "@inertiajs/inertia-vue3";
import {useTruncate} from "@/scripts/use/useTruncate";
import _ from "lodash";

let props=defineProps({
    quotes:Object,
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
