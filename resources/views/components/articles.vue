<template>

    <div class="px-3 md:px-8 my-5" v-if="articles">
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
        <div class="flex justify-center mt-5" v-show="fetchingData">
            <button type="button" class="text-2xl" disabled>
                <span class="animate-ping ">
                 <i class="fas fa-ellipsis-h"></i>
                </span>
            </button>
        </div>
    </div>
    <span ref="el"></span>
</template>

<script setup lang="ts">
import {useIntersectionObserver } from "@vueuse/core";
import {Link} from "@inertiajs/inertia-vue3";
import getPosts from "@/scripts/api/getPosts";
import {useTruncate} from "@/scripts/use/useTruncate";
import {ref} from "vue";


const el=ref<HTMLElement | null>(null)
const showPosts=2;
const articles=ref(await getPosts(showPosts,0));
const fetchingData=ref(false)

const getPostsOnScroll= async()=>{
   fetchingData.value=true
    try {
        const newPosts= await getPosts(
            showPosts,
            articles.value.length
        );
        articles.value.push(...newPosts);
    }catch (err){
       console.log(err)
    }

    fetchingData.value=false
}

useIntersectionObserver (
    el,
    async ()=>{

      await getPostsOnScroll()
    },
    {
        threshold: 0.5,
    }


);


</script>

<style scoped>

</style>
