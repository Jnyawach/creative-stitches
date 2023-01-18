<script setup>
import { computed } from 'vue'
import {Link} from "@inertiajs/inertia-vue3";
import {Spinner} from "flowbite-vue";
const props = defineProps({ status: Number })

const title = computed(() => {
    return {
        503: '503: Service Unavailable',
        500: '500: Server Error',
        404: '404: Page Not Found',
        403: '403: Forbidden',
    }[props.status]
})

const description = computed(() => {
    return {
        503: 'Sorry, we are doing some maintenance. Please check back soon.',
        500: 'Whoops, something went wrong on our servers.',
        404: 'Sorry, the page you are looking for could not be found.',
        403: 'Sorry, you are forbidden from accessing this page.',
    }[props.status]
})
</script>

<template>
    <div class="flex h-screen place-content-center bg-gray-50">
        <div class="self-center text-center">
            <h1 class="text-3xl text-teal-700 my-3 font-bold">{{ title }}</h1>
            <div><p class="text-lg">{{ description }}</p></div>
            <div v-if="status===404||status===403" class="my-5 flex gap-2 justify-center">
                <Link href="/" title="Home page" class="btn-primary"><span class="mr-2"><i class="far fa-home-alt"></i></span>Return Home</Link>
                <Link :href="route('shop.index')" title="Shop all" class="btn-primary"><span class="mr-2"><i class="fal fa-shopping-bag"></i></span>Continue shopping</Link>

            </div>
        </div>
    </div>
</template>
