<template >
   <admin>
       <Head>
           <title>{{post.data.title}}</title>
       </Head>
       <TitleBlock>
           <h6 class="font-bold text-sm">{{post.data.title}}</h6>
           <template #info>
               <p class="text-sm flex gap-2">
                   <svg class="fill-teal-700 h-5 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                   <span>Categories for classifying products</span>
               </p>
           </template>
       </TitleBlock>
       <div>
           <img :src="post.data.postImage">
           <div>
               <small>Image credit: {{post.data.credit}}</small>
           </div>
           <div class="px-3 mt-3">
               <h1 class="font-bold text-2xl">{{post.data.title}}</h1>
               <p class="text-teal-700 font-bold text-sm my-2">Published on {{new Date(post.data.created_at).toDateString()}} by {{post.data.author.name}} {{post.data.author.last_name}}</p>
               <div class="bg-teal-50 border-l-2 border-l-teal-700 p-2">
                   <p>{{post.data.summary}}</p>
               </div>
               <div v-html="post.data.content" class="px-1"></div>
               <p class="my-2 font-bold"><span class="text-teal-700 mr-2">Tags:</span>{{post.data.tags}}</p>
           </div>

       </div>
   <template #sidebar>
       <div class="mt-3">
           <sidelink :link="route('posts.edit', post.data.id)">
               Edit Post
           </sidelink>

           <Link :href="route('posts.destroy',post.data.id)" class="text-red-700   mt-2 font-bold"  method="delete" as="button">
               Delete Post
           </Link>

           <Link :href="route('post-status',post.data.id)" class="text-red-700 mt-2 font-bold"  method="patch" as="button">
               <span v-if="post.data.status">Disable Post</span>
               <span v-else class="text-green-800">Enable Post</span>
           </Link>
       </div>
   </template>
   </admin>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import Admin from "@/views/layouts/admin.vue";
import Sidelink from "@/views/components/sidelink.vue";
import {Link} from "@inertiajs/inertia-vue3";
defineProps({
   post:Object
})
</script>

<style scoped>

</style>
