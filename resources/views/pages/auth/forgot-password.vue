<template>
    <div v-show="forgot" class="mt-2 px-3 ">
        <div>
            <div class="font-bold text-black-100 text-xl text-center">
                <h6>Forgot Password</h6>
            </div>

            <div class="w-full my-8 px-3">
                <form class="w-full " @submit.prevent="submit">
                    <div class="grid mt-3">
                        <div>
                            <label for="forgot-email" class="creative-label"><span class="mr-2 text-teal-700"><i class="far fa-envelope"></i></span>Email:</label>
                            <input type="email" class="creative-input" id="forgot-email" placeholder="Enter your email" required v-model="form.email"/>
                            <div v-if="form.errors.email" class="creative-error">
                                <span>{{ form.errors.email }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 flex justify-center w-full">
                        <button type="submit" :disabled="form.processing" class="flex gap-3 justify-center py-3 w-1/2  px-10 bg-teal-700 rounded-full text-white font-semibold">
                            Send Reset Email
                            <span class="animate-ping self-center" v-show="form.processing">
                            <svg class="fill-white" height="10" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path
                                d="M0 256a56 56 0 1 1 112 0A56 56 0 1 1 0 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"/></svg>
                            </span>
                        </button>
                    </div>
                    <div class="flex justify-center mt-5">
                        <p class="cursor-pointer font-bold">
                            <span class="hover:text-teal-700" @click="$emit('showLogin')">Login to your account</span> |
                            <span class="hover:text-teal-700" @click="$emit('registerAccount')">Register new account</span>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {useForm} from "@inertiajs/inertia-vue3";
let props=defineProps({
    forgot:Boolean
})

let form=useForm({
    email:''
})
const emits=defineEmits(['updateForm','forgotOff'])

const submit=()=>{
    form.post(route('reset.password'),{
        onSuccess:()=>{
            form.reset();
            emits('updateForm')
            emits('forgotOff')

        }
    })
}
</script>

<style scoped>

</style>
