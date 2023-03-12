<template>
    <admin>
        <Head>
            <title>Creative Stitches Policy</title>
        </Head>
        <title-block>
            <h6 class="font-bold text-sm">Creative Stitches Policy</h6>
            <template #info >
                <p class="text-sm flex gap-2">
                    <svg class="fill-teal-700 h-5 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                    <span>Creative Stitches Policy: Terms and Policies</span>
                </p>
            </template>
        </title-block>

        <div class="mt-10 px-3">
         <form @submit.prevent="form.post(route('terms.store'))">
             <div class="grid grid-cols-2 gap-3">
                 <div>
                     <label class="creative-label">Category:</label>
                     <select class="creative-input" v-model="form.category" required>
                         <option selected value="">Select Category</option>
                         <option value="terms">Terms and Conditions</option>
                         <option value="policy">Privacy Policy</option>
                         <option value="cookie">Cookie Policy</option>
                         <option value="refund">Refund Policy</option>
                         <option value="copyright">Copyright Guidelines</option>
                     </select>
                     <div v-if="form.errors.category" class="creative-error">
                         <span>{{ form.errors.category }}</span>
                     </div>
                 </div>
                 <div>
                     <label class="creative-label">Status:</label>
                     <select class="creative-input" v-model="form.status" required>
                         <option selected value="">Select Status</option>
                         <option value="1">Active</option>
                         <option value="0">Inactive</option>

                     </select>
                     <div v-if="form.errors.status" class="creative-error">
                         <span>{{ form.errors.status }}</span>
                     </div>
                 </div>
             </div>
             <div class="grid mt-4">
                 <div>
                     <label class="creative-label">Content:</label>

                     <Editor
                         api-key="51d8ossp03q7qv63ctin9qbrlio19sszyf8j8u5vmlq44ui3"
                         :init="{
                  plugins: 'lists link image table code help wordcount',
                  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat'
                   }"
                         v-model="form.content"
                     />

                     <div v-if="form.errors.content" class="creative-error">
                         <span>{{ form.errors.content}}</span>
                     </div>
                 </div>
             </div>

             <div class="mt-4 flex justify-end">
                 <button type="submit" class="btn-primary">Save</button>
             </div>
         </form>
        </div>
    </admin>
</template>

<script setup lang="ts">
import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue"
import {useForm} from "@inertiajs/inertia-vue3";
import Editor from '@tinymce/tinymce-vue'

let form=useForm({
    status:'',
    category:'',
    content:''
})
</script>

<style scoped>

</style>
