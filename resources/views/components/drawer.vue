<template>
    <!--mobile menu-->
    <Teleport to="body">
        <div class="right-drawer z-[10000] relative"
             :style="{
             width: show? '70vw' : '0',
             paddingLeft: show? '10px' : '0',
             }"
        >
            <div class="mt-3">
                <div class="flex justify-end mr-6">
                    <button class="border rounded-full w-9 h-9 border-teal-700 flex place-content-center p-0 m-0" @click="$emit('closeDrawer')">

                        <svg class="h-6 fill-teal-700 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M315.3 411.3c-6.253 6.253-16.37 6.253-22.63 0L160 278.6l-132.7 132.7c-6.253 6.253-16.37 6.253-22.63 0c-6.253-6.253-6.253-16.37 0-22.63L137.4 256L4.69 123.3c-6.253-6.253-6.253-16.37 0-22.63c6.253-6.253 16.37-6.253 22.63 0L160 233.4l132.7-132.7c6.253-6.253 16.37-6.253 22.63 0c6.253 6.253 6.253 16.37 0 22.63L182.6 256l132.7 132.7C321.6 394.9 321.6 405.1 315.3 411.3z"/></svg>
                    </button>
                </div>
                <div class="px-2">
                    <h1 class="font-bold text-lg">Menu</h1>
                    <div>
                        <ul class="font-medium font-montserrat text-lg">
                            <li class="hover:text-teal-700 py-2">
                                <Link :href="route('shop.index')"  title="Shop all Embroidery Designs" @click="$emit('closeDrawer')">Shop all</Link>
                            </li>
                            <li class="hover:text-teal-700 py-2" v-for="category in categories" :key="category.id">
                                <Link :href="route('shop.category',category.slug)" :title="category.name" @click="$emit('closeDrawer')">
                                    {{category.name}}</Link>
                            </li>

                        </ul>
                    </div>
                </div>

            </div>

        </div>
        <div class="drawer-mask "
             @click="show = false"
             :style="{
             width: show ? '100vw' : '0',
             opacity: show ? '0.6' : '0',
             }"
        ></div>
    </Teleport>
</template>

<script setup lang="ts">

import {Link} from "@inertiajs/inertia-vue3";
import {onMounted} from "vue";
const emits=defineEmits(['closeDrawer'])
emits("closeDrawer")
defineProps({
    show:Boolean,
    categories:Object
})

</script>

<style scoped>
.right-drawer {
    position: absolute;
    top: 0;
    right: 0;
    width: 0; /* initially */
    overflow: hidden;
    min-height: 100vh;
    padding-left: 0; /* initially */
    border-left: 1px solid whitesmoke;
    background: white;
    z-index: 10004;
    transition: all 0.2s; /* for the animation */
}

.drawer-mask {
    position: absolute;
    left: 0;
    top: 0;
    width: 0; /* initially */
    height: 100vh;
    background: #000;
    opacity: 0.3;
    z-index: 1000;
}
</style>
