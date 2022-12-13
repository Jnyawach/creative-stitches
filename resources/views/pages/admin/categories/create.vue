<template>
<admin>
   <Head>
       <title>Create Category</title>
   </Head>
    <title-block>
        <h6 class="font-bold text-sm">Create Category</h6>
        <template #info>
            <p class="text-sm"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> Categories for classifying products</p>
        </template>

    </title-block>
    <div class="mt-8 p-3">
        <form @submit.prevent="form.post(route('categories.store'))">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="creative-label">Category Name:</label>
                    <input type="text" class="creative-input" required placeholder="Enter Category Name"
                           v-model="form.name">
                    <div v-if="form.errors.name" class="creative-error">
                        <span>{{ form.errors.name }}</span>
                    </div>
                </div>

                <div>
                    <label class="creative-label">Select Status:</label>
                    <select required class="creative-input" v-model="form.status">
                       <option selected value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Disabled</option>
                    </select>

                    <div v-if="form.errors.status" class="creative-error">
                        <span>{{ form.errors.status }}</span>
                    </div>
                </div>
            </div>
            <div class="grid mt-4">
                <div>
                    <label class="creative-label">Category Tags:</label>
                    <div>
                        <small class="text-xs">Categories tags are to help with SEO optimization. Enter tags separated by comma</small>
                    </div>
                    <textarea required placeholder="Enter tags" class="creative-text-input" rows="4" v-model="form.tags"></textarea>
                    <div v-if="form.errors.tags" class="creative-error">
                        <span>{{ form.errors.tags }}</span>
                    </div>
                </div>
            </div>

            <div class="grid mt-4">
                <div>
                    <label class="creative-label">Category Description:</label>
                    <div>
                        <small class="text-xs">Description will be part of meta description for SEO optimization. Provide a maximum
                        of 150 words description</small>
                    </div>
                    <textarea required placeholder="Enter description" class="creative-text-input" rows="4" v-model="form.description"></textarea>
                    <div v-if="form.errors.description" class="creative-error">
                        <span>{{ form.errors.description }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 flex justify-end">
                <button type="submit" class="btn-primary">Save Category</button>
            </div>
        </form>
    </div>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {useForm} from "@inertiajs/inertia-vue3";

let form=useForm({
    name:'',
    status:'',
    tags:'',
    description:'',

})
</script>

<style scoped>

</style>
