<template>
    <!--login form-->
    <div v-if="login" class="mt-2 px-3 ">
        <div>
            <div class="font-bold text-black-100 text-xl text-center">
                <h6>Please Login to proceed</h6>
            </div>

            <div class="w-full my-8 px-3">
                <form class="w-full" @submit.prevent="submit">
                    <div class="grid mt-3">
                        <div>
                            <label for="login-email" class="creative-label"><span class="mr-2 text-teal-700"><i class="far fa-envelope"></i></span>Email:</label>
                            <input type="email" class="creative-input" id="login-email" placeholder="Enter your email" required v-model="form.email"/>
                            <div v-if="form.errors.email" class="creative-error">
                                <span>{{ form.errors.email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid mt-5">
                        <div>
                            <label for="login-password" class="creative-label"><span class="mr-2 text-teal-700"><i class="fal fa-lock"></i></span>Password:</label>
                            <input type="password" class="creative-input" id="login-password" placeholder="Enter your password" required v-model="form.password"/>
                            <div v-if="form.errors.password" class="creative-error">
                                <span><span class="mr-2"><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.password}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 flex justify-center w-full">
                        <button type="submit" :disabled="form.processing" class="py-3 w-1/2  px-10 bg-teal-700 rounded-full text-white font-semibold">Login</button>
                    </div>
                    <div class="flex justify-center mt-5">
                        <p class="cursor-pointer font-bold">
                            <span class="hover:text-teal-700" @click="$emit('registerAccount')"> Register new account</span> |
                            <span class="hover:text-teal-700" @click="$emit('forgotPassword')">Forgot Password</span>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!--End of login form-->
</template>

<script setup lang="ts">
import {useForm} from "@inertiajs/inertia-vue3";

let props=defineProps({
    login:Boolean
})
const emits=defineEmits(['closeModal'])


let form=useForm({
    email:'',
    password:''
})

const submit=()=>{
   form.post(route('user.authenticate'),{
       onSuccess:()=>{
           props.login=false;
           form.reset()
           emits('closeModal');
       }
   })
}



</script>

<style scoped>

</style>
