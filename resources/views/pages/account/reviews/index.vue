<template layout="main">
<Head>
    <title>Product Reviews</title>
</Head>
    <account-menu></account-menu>
    <div class="my-8 px-3 md:px-10">
        <h1 class="text-2xl font-bold">Your Reviews</h1>
        <div class="mt-3"></div>
    </div>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import AccountMenu from "@/views/components/account-menu.vue";
</script>

<style scoped>

</style>
