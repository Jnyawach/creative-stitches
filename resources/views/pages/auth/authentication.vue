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
                <div class="bg-white w-full md:w-3/5 lg:w-2/5 rounded-xl">
                    <header class="p-3">
                        <div class="flex justify-end">
                            <div>
                                <div class="text-end">
                                    <button class="bg-teal-900 rounded-full h-8 w-8 flex place-content-center" type="button" @click="$emit('close')">

                                    <svg class="h-5 self-center fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M312.1 375c9.369 9.369 9.369 24.57 0 33.94s-24.57 9.369-33.94 0L160 289.9l-119 119c-9.369 9.369-24.57 9.369-33.94 0s-9.369-24.57 0-33.94L126.1 256L7.027 136.1c-9.369-9.369-9.369-24.57 0-33.94s24.57-9.369 33.94 0L160 222.1l119-119c9.369-9.369 24.57-9.369 33.94 0s9.369 24.57 0 33.94L193.9 256L312.1 375z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </header>
                    <!--login form-->
                    <login :login="login" @registerAccount="showRegister()" @forgotPassword="showForgot()" @closeModal="show=false"></login>
                    <!--End of login form-->
                    <!--register form-->
                    <register :register="register" @showLogin="showLogin()" @closeModal="show=false"></register>

                    <!--forgot password-->
                    <forgot-password :forgot="forgot" @showLogin="showLogin()" @registerAccount="showRegister()" @updateForm="update=true" @forgotOff="forgot=false"></forgot-password>
                    <!--update password form-->
                    <update-password :update="update" @resendEmail="sendEmail()" @returnLogin="login=true" @closeUpdate="update=false"></update-password>



                </div>
            </div>
        </Transition>
    </teleport>
</template>

<script setup lang="ts">
import {ref} from "vue";
import Login from "@/views/pages/auth/login.vue";
import Register from "@/views/pages/auth/register.vue";
import ForgotPassword from "@/views/pages/auth/forgot-password.vue";
import UpdatePassword from "@/views/pages/auth/update-password.vue";

const emits=defineEmits(['close'])
emits("close")
let props=defineProps({
    show:Boolean,
    login:Boolean,
})

const login=ref(props.login)
const register=ref(false)
const forgot=ref(false)
const update=ref(false)
 function showRegister(){
    login.value=false;
    forgot.value=false;
    update.value=false;
    register.value=true;
 }
function showForgot(){
    login.value=false;
    update.value=false;
    register.value=false;
    forgot.value=true;
}

function showLogin(){
    update.value=false;
    register.value=false;
    forgot.value=false;
    login.value=true;
}

function sendEmail(){
    login.value=false;
    update.value=false;
    register.value=false;
    forgot.value=true;
}

</script>

<style scoped>

</style>
