<template>
    <section class="flex items-center place-content-center min-h-screen bg-gray-50">
        <div  class="mt-2 px-3 shadow-lg rounded-xl self-center md:w-1/2 p-5 bg-white">
            <div>
                <div class="font-bold text-black-100 text-xl text-center">
                    <div class="my-4 flex justify-center">
                        <img :src="'/images/creative-stitches-logo.png'" alt="Creative Stitches Logo" class="h-10">
                    </div>
                    <h6>Update your password</h6>
                </div>

                <div class="w-full my-8 px-3">
                    <form class="w-full" @submit.prevent="submit">
                        <div class="grid mt-3">
                            <div>
                                <label for="update-email" class="creative-label"><span class="mr-2 text-teal-700"><i class="far fa-envelope"></i></span>Email:</label>
                                <input type="email" class="creative-input" id="update-email" placeholder="Enter your email" required v-model="form.email"/>
                                <div v-if="form.errors.email" class="creative-error">
                                    <span>{{ form.errors.email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="grid mt-5">
                            <div>
                                <label for="update-code" class="creative-label"><span class="mr-2 text-teal-700"><i class="fal fa-lock"></i></span>OTP Code:</label>
                                <input type="text" class="creative-input" id="update-code" placeholder="Enter the otp code" required v-model="form.code"/>
                                <div v-if="form.errors.code" class="creative-error">
                                    <span>{{ form.errors.code}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="grid mt-5 grid-cols-2 gap-1">
                            <div>
                                <label for="update-password" class="creative-label"><span class="mr-2 text-teal-700"><i class="fal fa-lock"></i></span>New Password:</label>
                                <input type="password" class="creative-input" id="update-password" placeholder="Enter your password" required v-model="form.password"/>
                                <div v-if="form.errors.password" class="creative-error">
                                    <span>{{ form.errors.password}}</span>
                                </div>
                            </div>
                            <div >
                                <label for="update_password_confirmation" class="creative-label"><span class="mr-2 text-sky-800"><i class="fal fa-lock"></i></span>Confirm Password:</label>
                                <input type="password" class="creative-input" id="update_password_confirmation" placeholder="Confirm your password" required v-model="form.password_confirmation"/>
                            </div>
                        </div>

                        <div class="mt-10 flex justify-center w-full">
                            <button type="submit" :disabled="form.processing" class="py-3 w-1/2  px-10 bg-teal-700 rounded-full text-white font-semibold">Update Password</button>
                        </div>
                        <div class="flex justify-center mt-5">
                            <button  class="hover:text-teal-700 font-semibold" @click="$emit('resendEmail')">Resend new Code</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import {useForm} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
import {Button} from "flowbite-vue";
import {Inertia} from "@inertiajs/inertia";
import route from "ziggy-js";
defineProps({
    update:Boolean
})
let form=useForm({
    email:'',
    code:'',
    password:'',
    password_confirmation:''
})

const emits=defineEmits(['returnLogin','closeUpdate'])

const  submit=()=>{
    form.post(route('update.password'),{
        onSuccess:()=>{
            form.reset();
            Inertia.visit(route('/'))
        }
    })
}
</script>

<style scoped>

</style>
