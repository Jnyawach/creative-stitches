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
                        <h6 class="font-bold text-center">Edit Password</h6>
                        <div class="mt-5">
                            <form @submit.prevent="submit">
                                <div class="grid mt-3">
                                    <label for="edit-password" class="creative-label"><span class="mr-2 text-teal-700"><i class="fal fa-lock"></i></span>Current Password:</label>
                                    <input type="password" class="creative-input" id="edit-password" placeholder="Current password" required v-model="form.current_password"/>
                                    <div v-if="form.errors.current_password" class="creative-error">
                                        <span>{{ form.errors.current_password}}</span>
                                    </div>
                                </div>
                                <div class="grid mt-5 grid-cols-2 gap-1">
                                    <div>
                                        <label for="edit-new-password" class="creative-label"><span class="mr-2 text-teal-700"><i class="fal fa-lock"></i></span>New Password:</label>
                                        <input type="password" class="creative-input" id="edit-new-password" placeholder="New password" required v-model="form.password"/>
                                        <div v-if="form.errors.password" class="creative-error">
                                            <span>{{ form.errors.password}}</span>
                                        </div>
                                    </div>
                                    <div >
                                        <label for="update_password_confirmation" class="creative-label"><span class="mr-2 text-sky-800"><i class="fal fa-lock"></i></span>Confirm Password:</label>
                                        <input type="password" class="creative-input" id="update_password_confirmation" placeholder="Confirm New password" required v-model="form.password_confirmation"/>
                                    </div>
                                </div>


                                <div class="mt-5 flex justify-end">
                                    <button type="submit" class="btn-primary">Update Password</button>
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
    current_password:'',
    password:'',
    password_confirmation:'',
    _method:'PATCH'

})

const submit=()=>{
    form.post(route('password.edit',props.user),{
        onSuccess:()=>{
            form.reset()
            emits("close")
        }
    })
}
</script>

<style scoped>

</style>
