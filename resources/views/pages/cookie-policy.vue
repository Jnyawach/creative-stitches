<template layout="main">
    <Head>
        <title>Cookie Policy</title>
        <meta name="description" content="Creative Stitches Cookie Policy">
    </Head>
    <div class="mt-5 px-3 md:px-16 py-3">
        <h1 class="text-lg font-bold text-center uppercase">Cookie Policy</h1>
        <div class="px-3">
            <p class="mt-3">Last Updated <span class="text-teal-700">{{new Date(term.updated_at).toDateString()}}</span></p>
            <div class="mt-2 leading-7" v-html="term.content"/>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
defineProps({
    term:Object
})
</script>

<style scoped>

</style>
