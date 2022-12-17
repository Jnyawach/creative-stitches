<template>
<admin>
    <Head>
        <title>Posts</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Blog Posts</h6>
        <template #info>
            <p class="text-sm"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> Articles optimized for SEO</p>
        </template>
    </title-block>

    <template #sidebar>
       <div class="mt-3">
           <sidelink :link="route('posts.create')" class="btn-primary btn-small m-1 mt-3">
               <span class="mr-2"><i class="fal fa-plus"></i></span>Add Posts
           </sidelink>
       </div>
    </template>
</admin>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import Admin from "@/views/layouts/admin.vue";
import TitleBlock from "@/views/components/title-block.vue";
import Sidelink from "@/views/components/sidelink.vue";
import {Link} from "@inertiajs/inertia-vue3";
import { Dropdown, Button} from 'flowbite-vue'
</script>

<style scoped>

</style>
