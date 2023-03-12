<template >
<admin>
    <Head>
        <title>Request for Quotation</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Request for Quotations</h6>

        <template #info >
            <p class="text-sm flex gap-2">
                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                <span>Request for Quotations</span>
            </p>
        </template>
    </title-block>
    <div class="mt-10 px-3">
        <h1 class="font-bold text-lg">Quote Requested by: {{quote.data.name}} {{quote.data.last_name}}</h1>
        <div class="flex gap-4">
            <p class="mt-2 text-sm"><span class="text-teal-700 mr-2">Date:</span> {{new Date(quote.data.created_at).toDateString()}}</p>
            <p class="mt-2 text-sm"><span class="text-teal-700 mr-2">Status:</span>
                <span v-if="quote.data.status===2">Responded</span>
                <span v-else class="text-red-700">Pending Response</span>
            </p>
            <p class="mt-2 text-sm" v-if="quote.data.status===2"><span class="text-teal-700 mr-2">Responded by:</span> {{quote.data.user.name}} {{quote.data.user.last_name}}</p>
        </div>
        <p class="mt-3">{{quote.data.description}}</p>
    </div>

    <template #sidebar>
        <div class="mt-2">
            <Link  :href="route('quote.responded',quote.data.id)" class="text-sm font-bold  text-start text-teal-700"  method="patch" as="button">
                Mark responded
            </Link>

            <div>
                <Link :href="route('quote-request.destroy',quote.data.id)" class="text-sm font-bold  text-start text-red-700"  method="delete" as="button">
                    Delete Request
                </Link>
            </div>
        </div>

    </template>
</admin>

</template>

<script setup lang="ts">
import Admin from "@/views/layouts/admin.vue";
import TitleBlock from "@/views/components/title-block.vue";
import {Link} from "@inertiajs/inertia-vue3";
defineProps({
    quote:Object
})

</script>

<style scoped>

</style>
