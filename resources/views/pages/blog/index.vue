<template layout="main">
<Head>
    <title>Blog</title>
    <meta name="description" content="Creative Stitches embroidery blog">
    <meta name="keywords" content="Embroidery, Machine Embroidery, embroidery studio, embroidery designs">
</Head>
    <div class="flex bg-teal-50 py-5 px-5 justify-between">
        <div>
            <h1 class="text-4xl font-bold">Creative Stitches Blog</h1>

            <p class="text-lg font-medium mt-2 text-gray-700">Explore and discover ways for creative living</p>
        </div>
        <div class="self-center hidden md:block">
            <form>
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="search" id="default-search" class="block p-3 pl-10 w-full text-sm text-gray-900 bg-white rounded-full border border-gray-300 focus:ring-primary-200 focus:border-primary-200 " placeholder="Search the blog..." required>

                </div>
            </form>
        </div>
    </div>

    <div class="grid px-3 md:px-12 md:grid-cols-2 my-10 gap-4">
       <div>
           <img :src="latest.postImage" class="rounded-3xl shadow-sm" :alt="latest.title">
       </div>
        <div class="self-center">
            <div>
                <small class="font-bold text-teal-700"> Published on {{new Date(latest.created_at).toDateString()}} by {{latest.author.first_name}} {{latest.author.last_name}}</small>
            </div>
        <h1 class="text-3xl font-bold">{{latest.title}}</h1>
            <p class="font-medium">{{useTruncate(latest.summary, 200)}}</p>

           <div class="py-5">
               <Link class="btn-primary py-3" :title="latest.title" :href="route('blog.show',latest.slug)">Read full article <span class="ml-3"><i class="fal fa-long-arrow-right"></i></span></Link>
           </div>
        </div>
    </div>

   <div class="px-3 md:px-8 my-5" v-if="trends">
       <h2 class="font-bold text-2xl">Trending Stories</h2>
       <div class="mt-5 grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
           <Link v-for="trend in trends" :key="trend.id" :title="trend.title" :href="route('blog.show',trend.slug)">
               <div class="border rounded-2xl hover:shadow border-gray-200 overflow-hidden min-h-[350px]">
                   <img :src="trend.postIcon" class="w-full" :alt="trend.title">
                   <div class="p-2 py-3">
                       <h6 class="font-bold text-sm">{{trend.title}}</h6>
                       <p>{{useTruncate(trend.summary, 100) }}</p>
                   </div>
               </div>
           </Link>
       </div>
   </div>

    <div class="px-3 md:px-8 my-5">
        <h2 class="font-bold text-2xl">Featured Designs</h2>
        <p>Remember to plugin products here</p>
    </div>

    <Suspense>
    <Articles></Articles>
    </Suspense>


</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
import {useTruncate} from "@/scripts/use/useTruncate";
import Articles from "@/views/components/articles.vue";



let props=defineProps({
    posts:Object
})



const latest=props.posts.data[0]
const trends = props.posts.data.slice(1, 5);
//const articles=props.posts.data.slice(5);



</script>

<style scoped>

</style>
