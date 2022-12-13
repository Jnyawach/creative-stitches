<template layout="main">
    <Head>
        <title>Frequently asked Question</title>
        <meta name="description" content="Do you have a question about embroidery? We are here to help">
    </Head>
  <div class="py-14 text-center">
    <h6 class="font-bold">FAQS</h6>
      <h1 class="font-black text-2xl md:text-4xl mt-4">Frequently asked Questions</h1>
      <h6 class="text-xl font-light mt-5">Have any Questions? We are here to help.</h6>
  </div>
    <div class="mt-3 px-3 w-full pb-5 flex justify-center">
        <form class="w-full md:w-1/2 px-5">

            <div class="relative w-full">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="search" id="default-search" class="block p-3 pl-10 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-gray-700 focus:border-gray-700" placeholder="Search FAQs..." required>

            </div>
        </form>
    </div>

    <div class="py-2">
        <ul class="flex gap-3 justify-center text-gray-600 font-bold text-sm">
            <li v-for="category in categories" :key="category.id" class="hover:text-teal-700">
                <Link :href="route('help-center.show', category.slug)" class="capitalize">{{ category.name }}</Link>
            </li>
        </ul>
    </div>

    <div class="flex px-3 md:px-28 py-16 justify-center w-full">
        <accordion :id="1">
            <template #title>
                <span class="font-semibold">Hello there, I a can see you trying</span>

            </template>
            <template #content>
                <p>
                    <b>Lorem</b>, ipsum dolor sit amet consectetur adipisicing elit. Quia,
                    porro. Non a excepturi, voluptatibus ipsam magnam, eligendi,
                    accusantium ipsa quae quis praesentium voluptate saepe ullam sint ea
                    itaque consectetur impedit?
                </p>
            </template>
        </accordion>
    </div>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
import Accordion from "@/views/components/accordion.vue";
import {Head} from "@inertiajs/inertia-vue3";
defineProps({
    categories:Object
})
</script>

<style scoped>

</style>
