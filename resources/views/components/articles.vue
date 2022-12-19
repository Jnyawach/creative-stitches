<template>

    <div class="px-3 md:px-8 my-5" v-if="articles" ref="blogArticles">
        <div class="mt-5 grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <Link v-for="article in articles" :key="article.id" :title="article.title" :href="route('blog.show',article.slug)">
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
import {Link} from "@inertiajs/inertia-vue3";
import getPosts from "@/scripts/api/getPosts";
import {useTruncate} from "@/scripts/use/useTruncate";
import {ref} from "vue";

const blogArticles=ref(null)
const showPosts=10;
const articles=ref(await getPosts(showPosts,0));

</script>

<style scoped>

</style>
