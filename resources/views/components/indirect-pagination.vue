<template>
    <div class="bg-gray-50 p-3 flex justify-between">
        <div class="self-center">
            <h6 class="font-medium">Showing <span class="text-sky-800">{{ data.current_page }}</span> of <span
                class="text-sky-800">{{ data.last_page }}</span> Page(s)</h6>
        </div>
        <div class="flex">
            <Link :href="data.prev_page_url" class="flex gap-1 btn-primary text-xs m-1" v-if="data.prev_page_url">
                <svg class="fill-white h-4 self-center mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M203.9 405.3c5.877 6.594 5.361 16.69-1.188 22.62c-6.562 5.906-16.69 5.375-22.59-1.188L36.1 266.7c-5.469-6.125-5.469-15.31 0-21.44l144-159.1c5.906-6.562 16.03-7.094 22.59-1.188c6.918 6.271 6.783 16.39 1.188 22.62L69.53 256L203.9 405.3z"/></svg>
                <span class="self-center">Prev</span>
            </Link>
            <Link :href="data.next_page_url" class="flex gap-1 btn-primary text-xs m-1" v-if="data.next_page_url">
                <span class="self-center">Next</span>
                <svg class="fill-white h-4 self-center ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
            </Link>

        </div>

    </div>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
defineProps({
    data:Object
})
</script>

<style scoped>

</style>
