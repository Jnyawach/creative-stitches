<template>

        <TransitionGroup
        enter-from-class="translate-x-full opacity-0"
        enter-active-class="duration-500"
        leave-active-class="duration-500"
        leave-to-class="translate-x-full opacity-0"
        >
            <div v-if="message"  class="z-[10000] fixed top-4 right-4 flex items-center p-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow " role="alert">
                <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-teal-500 bg-teal-100 rounded-lg">
                    <svg class="h-5 self-center fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                </div>
                <div class="ml-3 text-sm font-normal">{{message}}</div>
                <button @click="$emit('remove')" type="button" class="ml-auto  bg-white text-gray-400 hover:text-gray-900 rounded-full focus:ring-2 focus:ring-gray-300 hover:bg-gray-100 inline-flex place-content-center h-8 w-8 p-1">
                    <svg class="h-5 self-center fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M312.1 375c9.369 9.369 9.369 24.57 0 33.94s-24.57 9.369-33.94 0L160 289.9l-119 119c-9.369 9.369-24.57 9.369-33.94 0s-9.369-24.57 0-33.94L126.1 256L7.027 136.1c-9.369-9.369-9.369-24.57 0-33.94s24.57-9.369 33.94 0L160 222.1l119-119c9.369-9.369 24.57-9.369 33.94 0s9.369 24.57 0 33.94L193.9 256L312.1 375z"/></svg>
                </button>
            </div>
        </TransitionGroup>


</template>

<script setup lang="ts">
import { watch} from "vue";

let props=defineProps({
    message:String,
})

const emits=defineEmits(['remove'])

watch(props,()=>{
    setTimeout(()=>emits('remove'),2000)
})
</script>

<style scoped>

</style>
