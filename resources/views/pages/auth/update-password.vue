<template>
    <div v-show="update" class="mt-2 px-3 ">
        <div>
            <div class="font-bold text-black-100 text-xl text-center">
                <h6>Please update your password</h6>
            </div>

            <div class="w-full my-8 px-3">
                <form class="w-full ">
                    <div class="grid mt-3">
                        <div>
                            <label for="login-email" class="creative-label"><span class="mr-2 text-teal-700"><i class="far fa-envelope"></i></span>Email:</label>
                            <input type="email" class="creative-input" id="login-email" placeholder="Enter your email" required v-model="form.email"/>
                            <div v-if="form.errors.email" class="creative-error">
                                <span><span class="mr-2"><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid mt-5">
                        <div>
                            <label for="update-code" class="creative-label"><span class="mr-2 text-teal-700"><i class="fal fa-lock"></i></span>OTP Code:</label>
                            <input type="text" class="creative-input" id="update-code" placeholder="Enter the otp code" required v-model="form.code"/>
                            <div v-if="form.errors.code" class="creative-error">
                                <span><span class="mr-2"><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.code}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 flex justify-center w-full">
                        <button type="submit" :disabled="form.processing" class="py-3 w-1/2  px-10 bg-teal-700 rounded-full text-white font-semibold">Update Password</button>
                    </div>
                    <div class="flex justify-center mt-5">
                        <Link href="#" class="hover:text-teal-700 font-semibold">Resend new Code</Link>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {useForm} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
defineProps({
    update:Boolean
})
let form=useForm({
    email:'',
    code:''
})
</script>

<style scoped>

</style>
