<template>
<admin>
    <Head><title>User Details</title></Head>
    <title-block>
        <h6 class="font-bold text-sm capitalize">{{user.data.name}} {{user.data.last_name}}</h6>
        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 mr-3 text-teal-900"><i class="fas fa-info-circle"></i></span>User Details</p>
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
