<template>
<admin>
    <Head>
        <title>Products</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Products</h6>
        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 mr-3 text-teal-900"><i class="fas fa-info-circle"></i></span>Embroidery design files</p>
        </template>
    </title-block>

    <template #sidebar>
        <Sidelink :link="route('products.create')"> <span class="mr-2"><i class="fal fa-plus"></i></span>Add Products</Sidelink>
    </template>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import Sidelink from "@/views/components/sidelink.vue";
</script>

<style scoped>

</style>
