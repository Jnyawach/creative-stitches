<template>
    <div class="w-full">
        <div
            @click="toggleAccordion()"
            class="flex justify-between w-full cursor-pointer px-3"
            :aria-expanded="isOpen"
            :aria-controls="id"
        >

            <slot name="title" />
            <svg v-if="!isOpen" class="h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256C432 264.8 424.8 272 416 272h-176V448c0 8.844-7.156 16.01-16 16.01S208 456.8 208 448V272H32c-8.844 0-16-7.15-16-15.99C16 247.2 23.16 240 32 240h176V64c0-8.844 7.156-15.99 16-15.99S240 55.16 240 64v176H416C424.8 240 432 247.2 432 256z"/></svg>

            <svg v-if="isOpen" class="h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256C432 264.8 424.8 272 416 272H32c-8.844 0-16-7.15-16-15.99C16 247.2 23.16 240 32 240h384C424.8 240 432 247.2 432 256z"/></svg>
        </div>

        <Transition
            name="accordion"
            v-on:before-enter="beforeEnter" v-on:enter="enter"
            v-on:before-leave="beforeLeave" v-on:leave="leave"
            >
            <div v-show="isOpen" :id="id" class="mt-4 accord px-3">
                <slot name="content" />

            </div>
        </Transition>
        <hr class="w-full mt-5">



    </div>
</template>

<script setup lang="ts">
defineProps({
    id:Number
})
import {ref} from "vue";

const isOpen=ref(false)
const toggleAccordion=()=>{
    isOpen.value = !isOpen.value;
}

const beforeEnter=(el)=>{
    el.style.height = '0';
}
const enter=(el)=>{
    el.style.height = el.scrollHeight + 'px';
}
const leave=(el)=>{
    el.style.height = '0';
}
const beforeLeave=(el)=>{
    el.style.height = el.scrollHeight + 'px';
}
</script>

<style scoped>
.accord{
    transition: 200ms ease-in-out;
}
</style>
