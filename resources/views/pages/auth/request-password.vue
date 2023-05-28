<template>
    <Head>
        <title>Reset your password</title>
    </Head>
    <section class="flex items-center place-content-center min-h-screen bg-gray-50">
        <div  class="mt-2 px-3 shadow-lg rounded-xl self-center md:w-1/2 p-5 bg-white">
            <div>
                <div class="font-bold text-black-100 text-xl text-center">
                    <div class="my-4 flex justify-center">
                        <img :src="'/images/creative-stitches-logo.png'" alt="Creative Stitches Logo" class="h-10">
                    </div>
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
                            <button type="submit" :disabled="form.processing" class="flex gap-3 justify-center py-3 w-1/2  px-5 bg-teal-700 rounded-full text-white font-semibold">
                                Send Reset Email
                                <span class="animate-ping self-center" v-show="form.processing">
                            <svg class="fill-white" height="10" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 448 512"><path
                                d="M0 256a56 56 0 1 1 112 0A56 56 0 1 1 0 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"/></svg>
                            </span>
                            </button>
                        </div>
                        <div class="flex justify-center mt-5">
                            <p class="cursor-pointer font-bold">
                                <Link class="hover:text-teal-700" :href="route('login')" title="Login">Login to your account</Link> |
                                <Link class="hover:text-teal-700" :href="route('register')" title="Register a new account">Register new account</Link>
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import {useForm, Link, Head} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
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
            Inertia.visit(route('new.password'))

        }
    })
}
</script>

<style scoped>

</style>
