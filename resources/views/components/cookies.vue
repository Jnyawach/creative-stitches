<template>
    <TransitionGroup
        enter-from-class="translate-y-full opacity-0"
        enter-active-class="duration-1000"
        leave-active-class="duration-1000"
        leave-to-class="translate-y-full opacity-0"
    >
        <div v-if="show" class="fixed z-[10000] w-full bg-white bottom-0 w-screen drop-shadow bg-white">
            <div class="w-full px-3 md:px-14 py-3 bg-primary-300/20">
                <div class=" mx-3">
                    <div class="md:flex justify-center gap-5 p-2">
                        <div class="self-center text-center md:text-start">
                            <p class="text-4xl"><i class="fa-regular fa-cookie-bite"></i></p>
                        </div>
                        <div class="self-center text-center md:text-start">
                            <p class="text-lg">We use cookies to ensure the best possible experience.
                                By using our site site you agree with our <Link title="Privacy Policy" :href="route('cookie.policy')" class="text-primary-300 underline">Privacy Policy</Link></p>
                        </div>
                        <div class="self-center text-center md:text-start py-3 md:p-0">
                            <button @click="hide" class="btn-secondary">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </TransitionGroup>
</template>

<script setup lang="ts">
import { Link} from "@inertiajs/inertia-vue3";
import {computed, onMounted} from "vue";
const emits=defineEmits(['close','open'])
let props=defineProps({
    show:Boolean,
})
const cookies = localStorage.getItem('cookies')
const timer=[
    {cookies:1,timer:new Date().toString()}
]
onMounted(()=>{
    if (!cookies){
        setTimeout(()=>{
            emits('open')
        },5000)
    }
})
const hide=()=>{
    emits('close')
    localStorage.setItem('cookies',JSON.stringify(timer))
}
</script>

<style scoped>
</style>
