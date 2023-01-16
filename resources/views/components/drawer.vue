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
                    <button class="text-xl border rounded-full w-9 h-9 border-teal-700" @click="$emit('closeDrawer')">
                        <span><i class="fal fa-times"></i></span>
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
