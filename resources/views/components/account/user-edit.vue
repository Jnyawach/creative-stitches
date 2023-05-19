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
            <div v-if="show" class="inset-0 fixed bg-black-100 bg-opacity-70 z-50 grid place-items-center p-5" >
                <div class="bg-white lg:w-1/2 w-full rounded-xl p-3">
                    <div>
                        <div class="flex justify-end">
                            <button class="bg-teal-600 hover:bg-teal-700 rounded-full h-8 w-8 flex place-content-center" type="button" @click="$emit('close')">

                                <svg class="h-5 self-center fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M312.1 375c9.369 9.369 9.369 24.57 0 33.94s-24.57 9.369-33.94 0L160 289.9l-119 119c-9.369 9.369-24.57 9.369-33.94 0s-9.369-24.57 0-33.94L126.1 256L7.027 136.1c-9.369-9.369-9.369-24.57 0-33.94s24.57-9.369 33.94 0L160 222.1l119-119c9.369-9.369 24.57-9.369 33.94 0s9.369 24.57 0 33.94L193.9 256L312.1 375z"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="p-3">
                        <h6 class="font-bold text-center">Edit Address</h6>
                        <div class="mt-5">
                            <form @submit.prevent="submit">
                                <div class="mt-3 grid md:grid-cols-2 gap-2">
                                    <div>
                                        <label for="name_edit" class="creative-label">Name</label>
                                        <input type="text" class="creative-input" id="name_edit" required v-model="form.name"/>
                                        <div v-if="form.errors.name" class="creative-error">
                                            <span>{{ form.errors.name }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="last_name_edit" class="creative-label">Last Name</label>
                                        <input type="text" class="creative-input" id="last_name_edit" required v-model="form.last_name"/>
                                        <div v-if="form.errors.last_name" class="creative-error">
                                            <span>{{ form.errors.last_name }}</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="mt-5 flex justify-end">
                                    <button type="submit" class="btn-primary">Update Info</button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </Transition>
    </teleport>
</template>

<script setup lang="ts">
import {useForm} from "@inertiajs/inertia-vue3";
const emits=defineEmits(['close'])
emits("close")
let props=defineProps({
    show:Boolean,
   user:Object
})

let form=useForm({
    name:props.user.name,
    last_name:props.user.last_name,
    _method:'PATCH'

})

const submit=()=>{
    form.post(route('account.update',props.user.id),{
        onSuccess:()=>{
            form.reset()
            emits("close")
        }
    })
}
</script>

<style scoped>

</style>
