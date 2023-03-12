<template>
<admin>
    <Head><title>User Details</title></Head>
    <title-block>
        <h6 class="font-bold text-sm capitalize">{{user.data.name}} {{user.data.last_name}}</h6>
        <template #info >
            <p class="text-sm flex gap-2">
                <svg class="fill-teal-700 h-5 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                <span>Customer details</span>
            </p>
        </template>
    </title-block>
    <div class="my-10 px-3">
        <h6 class="font-bold">Details</h6>
        <p><span class="text-teal-700">Email:</span> {{user.data.email}}</p>
        <p><span class="text-teal-700">Total Spent:</span>$ {{user.data.totalSpent}}</p>
    </div>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from '@/views/components/title-block.vue'
defineProps({
    user:Object
})
</script>

<style scoped>

</style>
