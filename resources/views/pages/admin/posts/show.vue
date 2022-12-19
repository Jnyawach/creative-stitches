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
       <div>
           <img :src="post.data.postImage">
           <div>
               <small>Image credit: {{post.data.credit}}</small>
           </div>
           <div class="px-3 mt-3">
               <h1 class="font-bold text-2xl">{{post.data.title}}</h1>
               <p class="text-teal-700 font-bold text-sm my-2">Published on {{new Date(post.data.created_at).toDateString()}} by {{post.data.author}}</p>
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
               <span class="mr-2"><i class="fal fa-pen"></i></span>Edit Post
           </sidelink>

           <Link :href="route('posts.destroy',post.data.id)" class="text-red-700   mt-2 font-bold"  method="delete" as="button">
               <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete Post
           </Link>

           <Link :href="route('post-status',post.data.id)" class="text-red-700 mt-2 font-bold"  method="patch" as="button">
               <span v-if="post.data.status"> <span class="mr-2"><i class="far fa-stopwatch"></i></span>Disable Post</span>
               <span v-else class="text-green-800"><span class="mr-2"><i class="far fa-stopwatch"></i></span>Enable Post</span>
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
