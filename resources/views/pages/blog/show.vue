<template layout="main">
<Head>
  <title>{{post.data.title}}</title>
    <meta name="description" :content="post.data.summary">
    <meta name="keywords" :content="post.data.tags">
</Head>
    <div class="my-10 px-3 md:px-36">
       <h1 class="text-4xl font-bold text-center">{{post.data.title}}</h1>
        <p class="text-teal-700 text-sm text-center mt-2 font-bold">Published on {{ new Date(post.data.created_at).toDateString() }} by {{post.data.author}}</p>
        <img :src="post.data.postImage" class="mt-5 rounded-xl">
        <div class="flex justify-end mr-2">
            <small>Image credit: {{post.data.credit}}</small>
        </div>
        <div class="mt-2 leading-7" v-html="post.data.content"/>
        <p><span class="text-teal-700 mr-2">Tags:</span>{{post.data.tags}}</p>
        <div class="flex mt-2 gap-3">
            <div>
                <img :src="'/images/user-icon.png'" class="w-12">
            </div>
            <div class="self-center">
                <p class="capitalize">{{post.data.author}}</p>
                <p class="text-xs text-teal-700 font-bold">{{ new Date(post.data.created_at).toDateString() }}</p>
            </div>
        </div>
    </div>

    <div class="px-3 md:px-8 my-5" v-if="posts.data">
        <h2 class="font-bold text-2xl">Trending Stories</h2>
        <div class="mt-5 grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <Link v-for="article in posts.data" :key="article.id" :title="article.title" :href="route('blog.show',article.slug)">
                <div class="border rounded-2xl hover:shadow border-gray-200 overflow-hidden min-h-[350px]">
                    <img :src="article.postIcon" class="w-full" :alt="article.title">
                    <div class="p-2 py-3">
                        <h6 class="font-bold text-sm">{{article.title}}</h6>
                        <p>{{useTruncate(article.summary, 100) }}</p>
                    </div>
                </div>
            </Link>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import {useTruncate} from "@/scripts/use/useTruncate";
import {Link} from "@inertiajs/inertia-vue3";
defineProps({
    post:Object,
    posts:Object
})
</script>

<style scoped>

</style>
