<template layout="main">
<div class="my-8 md:my-16">
 <h1 class="text-3xl font-bold text-center">Get in touch</h1>
    <p class="text-center text-teal-600 font-bold mt-3">Any questions or remarks? just write us a message</p>
<div class="flex justify-center place-content-center ">
    <div class="grid md:grid-cols-5 gap-4 mt-16 self-center px-5 md:px-8 ld:px-16  lg:w-4/6">
        <div class="col-span-2">
            <div class="border-l-teal-700 border-l-4 px-3">
                <h6 class="font-bold text-lg">Contact Information</h6>
                <p>Fill the form out and our team will get back to you within 24hrs</p>
            </div>
            <div class="px-3 mt-5 hidden md:block">
                <p class="text-sm"><span class="ml-3 text-teal-700"><i class="fa-regular fa-envelope"></i></span> info@creativestitchings.com</p>
                <p class="mt-2 text-sm"><span class="ml-3 text-teal-700"><i class="fa-regular fa-mobile-notch"></i></span> +254717109280</p>
                <ul class="flex gap-2 px-3 mt-3 text-xl">
                    <li><Link hre="#" title="Pinterest"><span><i class="fa-brands fa-pinterest"></i></span></Link></li>
                    <li><Link hre="#" title="Facebook"><span><i class="fa-brands fa-facebook"></i></span></Link></li>
                    <li><Link hre="#" title="Instagram"><span><i class="fa-brands fa-instagram"></i></span></Link></li>
                    <li><Link hre="#" title="Twitter"><span><i class="fa-brands fa-twitter"></i></span></Link></li>
                </ul>
            </div>
        </div>
        <div class="col-span-3">
            <form @submit.prevent="submit">
                <input type="hidden" v-model="form.last_name">
                <div class="grid md:grid-cols-2 gap-1">
                    <div>
                        <input type="text" v-model="form.name" class="creative-input " required placeholder="Enter Your Name">
                        <div v-if="form.errors.name" class="creative-error">
                            <span>{{ form.errors.name }}</span>
                        </div>
                    </div>
                    <div>
                        <input type="email" v-model="form.email" class="creative-input " required placeholder="Enter Your Email">
                        <div v-if="form.errors.email" class="creative-error">
                            <span>{{ form.errors.email }}</span>
                        </div>
                    </div>
                </div>
                <div class="grid mt-4">
                    <div>
                        <input type="text" v-model="form.subject" class="creative-input " required placeholder="Subject">
                        <div v-if="form.errors.subject" class="creative-error">
                            <span>{{ form.errors.subject }}</span>
                        </div>
                    </div>
                </div>
                <div class="grid mt-4">
                    <textarea required placeholder="Write your message" class="creative-text-input " rows="4" v-model="form.message"></textarea>
                    <div v-if="form.errors.message" class="creative-error">
                        <span>{{ form.errors.message }}</span>
                    </div>
                </div>

                <div class="mt-3 flex justify-end">
                    <button type="submit" class="btn-primary btn-small" :disabled="form.processing">
                        Send Message
                        <span class="animate-ping" v-show="form.processing"><i class="fas fa-ellipsis-h"></i></span>
                    </button>
                </div>
                <div class="mt-3" v-show="$page.props.status">
                    <p class="text-teal-700">{{$page.props.status}}</p>
                </div>
            </form>

            <div class="px-3 mt-5  md:hidden text-center">
                <p class="text-sm"><span class="ml-3 text-teal-700">Email:</span> info@creativestitchings.com</p>
                <p class="mt-2 text-sm"><span class="ml-3 text-teal-700">Cellphone:</span> +254717109280</p>
                <ul class="flex gap-3 px-3 mt-3 text-lg justify-center">
                    <li><Link hre="#" title="Pinterest"><span><i class="fa-brands fa-pinterest"></i></span></Link></li>
                    <li><Link hre="#" title="Facebook"><span><i class="fa-brands fa-facebook"></i></span></Link></li>
                    <li><Link hre="#" title="Instagram"><span><i class="fa-brands fa-instagram"></i></span></Link></li>
                    <li><Link hre="#" title="Twitter"><span><i class="fa-brands fa-twitter"></i></span></Link></li>
                </ul>
            </div>
        </div>
    </div>
</div>


</div>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
import {useForm} from "@inertiajs/inertia-vue3";

let  form=useForm({
    name:'',
    last_name:'',
    email:'',
    subject:'',
    message:''
})

const submit=()=>{
    form.post(route('contact-us.store'),{
        onSuccess:()=>{
            form.reset()
        }
    })

}
</script>

<style scoped>

</style>
