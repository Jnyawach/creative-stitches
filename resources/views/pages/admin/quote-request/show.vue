<template >
<admin>
    <Head>
        <title>Request for Quotation</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Request for Quotations</h6>

        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 mr-3 text-teal-900"><i class="fas fa-info-circle"></i></span>Request for Quotations</p>
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
            <Link  :href="route('quote.responded',quote.data.id)" class="text-sm font-bold  text-start"  method="patch" as="button">
                <span class="mr-2"><i class="far fa-eye"></i></span>Mark responded
            </Link>

            <Link :href="route('quote-request.destroy',quote.data.id)" class="text-sm font-bold  text-start"  method="delete" as="button">
                <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete
            </Link>
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
