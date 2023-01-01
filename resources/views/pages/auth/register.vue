<template>
    <!---Register form-->
    <div v-show="register" class="mt-2 px-3 ">
        <div>
            <div class="font-bold text-black-100 text-xl text-center">
                <h6>Please register a new account</h6>
            </div>

            <div class="w-full my-8 px-3">
                <form class="w-full ">
                    <div class="grid grid-cols-2 gap-1">
                        <div class="mt-3">
                            <label for="first_name" class="creative-label"><span class="mr-2 text-teal-700"><i class="far fa-user-circle"></i></span>First Name:</label>
                            <input type="text" class="creative-input" id="first_name" placeholder="Enter your first name" required v-model="create.name"/>
                            <div v-if="create.errors.name" class="creative-error">
                                <span><span><i class="fal fa-exclamation-circle"></i></span>{{ create.errors.name }}</span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="last_name" class="creative-label"><span class="mr-2 text-teal-700"><i class="far fa-user-circle"></i></span>Last name:</label>
                            <input type="text" class="creative-input" id="last_name" placeholder="Enter your last name" required v-model="create.last_name"/>
                            <div v-if="create.errors.last_name" class="creative-error">
                                <span><span><i class="fal fa-exclamation-circle"></i></span>{{ create.errors.last_name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid mt-3">
                        <div>
                            <label for="create-email" class="creative-label"><span class="mr-2 text-teal-700"><i class="far fa-envelope"></i></span>Email:</label>
                            <input type="email" class="creative-input" id="create-email" placeholder="Enter your email" required v-model="create.email"/>
                            <div v-if="create.errors.email" class="creative-error">
                                <span><span class="mr-2"><i class="fal fa-exclamation-circle"></i></span>{{ create.errors.email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid mt-5 grid-cols-2 gap-1">
                        <div>
                            <label for="create-password" class="creative-label"><span class="mr-2 text-teal-700"><i class="fal fa-lock"></i></span>Password:</label>
                            <input type="password" class="creative-input" id="create-password" placeholder="Enter your password" required v-model="create.password"/>
                            <div v-if="create.errors.password" class="creative-error">
                                <span><span class="mr-2"><i class="fal fa-exclamation-circle"></i></span>{{ create.errors.password}}</span>
                            </div>
                        </div>
                        <div >
                            <label for="create_password_confirmation" class="creative-label"><span class="mr-2 text-sky-800"><i class="fal fa-lock"></i></span>Confirm Password:</label>
                            <input type="password" class="creative-input" id="create_password_confirmation" placeholder="Confirm your password" required v-model="create.password_confirmation"/>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="creative-label">
                            <input type="checkbox" v-model="create.subscribe" class="checked:bg-teal-700 rounded focus:outline-teal-600 mr-2">
                            Subscribe to our email and newsletter
                        </label>
                    </div>

                    <div class="mt-10 flex justify-center w-full">
                        <button type="submit" :disabled="create.processing" class="py-3 w-1/2  px-10 bg-teal-700 rounded-full text-white font-semibold">Register</button>
                    </div>
                    <div class="flex justify-center mt-5">
                        <p class="cursor-pointer ">
                            Have already an account?
                            <span class="hover:text-teal-700 font-bold">Login here</span>
                        </p>
                    </div>

                    <div class="mt-4 flex justify-center gap-3 text-sm">
                        <Link class="hover:text-teal-700" :href="route('terms.conditions')" title="Terms and Conditions">Terms and conditions</Link>
                        <Link class="hover:text-teal-700" :href="route('privacy.policy')" title="Privacy Policy">Privacy Policy</Link>

                    </div>

                </form>
            </div>
        </div>
    </div>
    <!--end of register form-->
</template>

<script setup  lang="ts">
import {useForm} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
import {Input} from "flowbite-vue";
defineProps({
    register:Boolean
})
let create=useForm({
    name:'',
    last_name:'',
    email:'',
    password:'',
    confirm_password:'',
    subscribe:true
})
</script>

<style scoped>

</style>
