<template>
<admin>
    <Head>
        <title>{{category.name}}</title>
        <meta name="description" :content="category.description">
        <meta name="keywords" :content="category.tags">
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">{{category.name}}</h6>
        <template #info>
            <p class="text-sm"><span class="ml-2 mr-2 text-teal-900"><i class="fas fa-info-circle"></i></span>{{category.name}} Category details</p>
        </template>
    </title-block>

    <div class="mt-10 px-3">
        <h1 class="text-xl font-bold">{{category.name}}</h1>
        <img :src="category.image" class="rounded-lg">
        <div>
            <small class="font-bold"><span class="text-teal-900 mr-2">Status:</span>
                <span v-if="category.status">Active </span>
                <span v-else>Inactive </span>
            </small>
        </div>
        <div>
            <p><span class="text-teal-900 font-bold">Description:</span> {{category.description}}</p>
            <p><span class="text-teal-900 font-bold mt-3">Tags:</span> {{category.tags}}</p>
        </div>
    </div>

    <template #sidebar>
        <sidelink :link="route('categories.edit',category.id)"><span class="mr-2"><i class="fa-light fa-pen"></i></span>Edit Category</sidelink>
        <div>
            <Link :href="route('categories.destroy',category.id)" class="text-red-700 text-sm font-bold  w-full h-full text-start"  method="delete" as="button">
                <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete Category
            </Link>
        </div>
    </template>
</admin>

</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import Sidelink from "@/views/components/sidelink.vue";
import {Link} from "@inertiajs/inertia-vue3";
import {reactive} from "vue";
let props=defineProps({
    category:Object
})
const category=reactive(props.category.data)
</script>

<style scoped>

</style>
