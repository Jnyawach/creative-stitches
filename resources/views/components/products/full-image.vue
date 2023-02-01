<template>
    <teleport to="body">
        <Transition
            enter-from-class="opacity-0 scale-125"
            enter-to-class="opacity-100 scale-100"
            enter-active-class="transition duration-300"
            leave-active-class="transition duration-200"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-125"
        >
            <div @click.self="$emit('close')" v-if="show" class="inset-0 fixed bg-black-100 bg-opacity-70 z-[10000] grid place-items-center p-5" >
                <div class="lg:w-4/6 w-full rounded-xl">
                    <header class="p-3">
                        <div class="flex justify-end">

                            <div>
                                <div class="text-end">
                                    <button class="bg-teal-900 rounded-full h-8 w-8" type="button" @click="$emit('close')"><span class="text-white text-lg"><i
                                        class="fal fa-times"></i></span></button>
                                </div>
                            </div>
                        </div>

                    </header>

                    <div class="p-3.5 ">
                        <slot>
                            Default body
                        </slot>
                    </div>


                </div>
            </div>
        </Transition>
    </teleport>
</template>

<script setup lang="ts">

const emits=defineEmits(['close'])
emits("close")
let props=defineProps({
    show:Boolean,
})

</script>

<style scoped>

</style>
