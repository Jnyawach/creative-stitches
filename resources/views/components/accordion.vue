<template>
    <div class="w-full">
        <div
            @click="toggleAccordion()"
            class="flex justify-between w-full cursor-pointer px-3"
            :aria-expanded="isOpen"
            :aria-controls="id"
        >

            <slot name="title" />
            <span><i :class="{'far fa-plus':!isOpen, 'far fa-minus':isOpen}"></i></span>

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
