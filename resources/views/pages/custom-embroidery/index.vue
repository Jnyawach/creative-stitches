<template layout="main">
    <Head>
        <title> Request for Quotation:</title>
        <meta name="description" content="Request for embroidery design quotation: Machine embroidery designs">
    </Head>
    <div class="my-8 md:my-16">
        <h1 class="text-3xl font-bold text-center">Request a Quote</h1>
        <p class="text-center text-teal-600 font-bold mt-3">Share your requirements with us</p>
        <div class="flex justify-center place-content-center w-full">

                <div class="mt-5 w-full sm:w-3/4 lg:w-1/2 px-5">
                    <form @submit.prevent="submit">
                        <input type="hidden" v-model="form.beacon">
                        <div class="grid md:grid-cols-2 gap-1">
                            <div>
                                <input type="text" v-model="form.first_name" class="creative-input " required placeholder="Enter Your First Name">
                                <div v-if="form.errors.first_name" class="creative-error">
                                    <span>{{ form.errors.first_name }}</span>
                                </div>
                            </div>
                            <div>
                                <input type="text" v-model="form.last_name" class="creative-input " required placeholder="Enter Your Last Name">
                                <div v-if="form.errors.last_name" class="creative-error">
                                    <span>{{ form.errors.last_name }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-1 mt-4">
                            <div>
                                <input type="email" v-model="form.email" class="creative-input " required placeholder="Enter Your Email">
                                <div v-if="form.errors.email" class="creative-error">
                                    <span>{{ form.errors.email }}</span>
                                </div>
                            </div>
                            <div>
                                <input type="text" v-model="form.cellphone" class="creative-input " required placeholder="Enter Your Cellphone">
                                <div v-if="form.errors.cellphone" class="creative-error">
                                    <span>{{ form.errors.cellphone }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="grid mt-4">
                            <textarea required placeholder="Additional Information" class="creative-text-input " rows="4" v-model="form.description"></textarea>
                            <div v-if="form.errors.description" class="creative-error">
                                <span>{{ form.errors.description }}</span>
                            </div>
                        </div>

                        <div class="grid mt-4">
                            <label class="creative-label">Attach file (optional)</label>
                            <div>
                                <small class="text-xs text-teal-700">Accepted formats: doc, docx, pdf, ppt, xlsx & csv</small>
                            </div>
                            <input type="file" @input="form.attachment=$event.target.files[0]" class="mt-3">
                            <div v-if="form.errors.attachment" class="creative-error">
                                <span>{{ form.errors.attachment}}</span>
                            </div>
                        </div>

                        <div class="mt-5 flex justify-start sm:justify-end">
                            <button type="submit" class="btn-primary sm:btn-small" :disabled="form.processing">
                                Request Quote
                                <span class="animate-ping" v-show="form.processing"><i class="fas fa-ellipsis-h"></i></span>
                            </button>
                        </div>
                        <div class="mt-3" v-show="$page.props.status">
                            <p class="text-teal-700">{{$page.props.status}}</p>
                        </div>
                    </form>

                </div>

        </div>


    </div>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
import {useForm} from "@inertiajs/inertia-vue3";

let  form=useForm({
    first_name:'',
    last_name:'',
    email:'',
    subject:'',
    description:'',
    cellphone:'',
    attachment:'',
    beacon:''
})

const submit=()=>{
    form.post(route('custom-embroidery.store'),{
        onSuccess:()=>{
            form.reset()
        }
    })

}
</script>

<style scoped>

</style>
