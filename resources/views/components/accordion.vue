<template>
    <div class="w-full">
        <div
            @click="toggleAccordion()"
            class="flex justify-between w-full cursor-pointer"
            :aria-expanded="isOpen"
            :aria-controls="id"
        >

            <slot name="title" />

            <svg
                class="w-3 transition-all duration-200 transform"
                :class="{
          'rotate-180': isOpen,
          'rotate-0': !isOpen,
        }"
                fill="none"
                stroke="currentColor"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 16 10"
                aria-hidden="true"
            >
                <path
                    d="M15 1.2l-7 7-7-7"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </div>


        <div v-show="isOpen" :id="id">
            <slot name="content" />
        </div>
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
</script>

<style scoped>

</style>
