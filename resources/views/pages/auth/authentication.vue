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
                <div class="bg-white w-full md:w-3/5 lg:w-2/5 rounded-xl">
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
                    <!--login form-->
                    <login :login="login"></login>
                    <!--End of login form-->
                    <!--register form-->
                    <register :register="register"></register>

                    <!--forgot password-->
                    <forgot-password :forgot="forgot"></forgot-password>
                    <!--update password form-->
                    <update-password :update="update"></update-password>



                </div>
            </div>
        </Transition>
    </teleport>
</template>

<script setup lang="ts">

import {Button, Input} from "flowbite-vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {ref} from "vue";
import Login from "@/views/components/auth/login.vue";
import Register from "@/views/pages/auth/register.vue";
import ForgotPassword from "@/views/pages/auth/forgot-password.vue";
import UpdatePassword from "@/views/pages/auth/update-password.vue";

const emits=defineEmits(['close'])
emits("close")
let props=defineProps({
    show:Boolean,
})

let form=useForm({
    email:'',
    password:''
})



const login=ref(false)
const register=ref(false)
const forgot=ref(false)
const update=ref(true)

</script>

<style scoped>

</style>
