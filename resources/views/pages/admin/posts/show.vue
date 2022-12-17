<template >
   <admin>
       <Head>
           <title>{{post.data.title}}</title>
       </Head>
       <TitleBlock>
           <h6 class="font-bold text-sm">{{post.data.title}}</h6>
           <template #info>
               <p class="text-sm"><span class="ml-2 mr-2 text-teal-900"><i class="fas fa-info-circle"></i></span>Blog Posts</p>
           </template>
       </TitleBlock>
   </admin>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import Admin from "@/views/layouts/admin.vue";
defineProps({
   post:Object
})
</script>

<style scoped>

</style>
