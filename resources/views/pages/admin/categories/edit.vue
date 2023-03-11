<template>
    <admin>
        <Head>
            <title>Edit Category</title>
        </Head>
        <title-block>
            <h6 class="font-bold text-sm">Edit {{category.name}} Category</h6>
            <template #info>
                <p class="text-sm flex gap-2">
                    <svg class="fill-teal-700 h-5 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                    <span>Categories for classifying products</span>
                </p>
            </template>

        </title-block>
        <div class="mt-8 p-3">
            <form @submit.prevent="form.post(route('categories.update',category.data.id))">
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
                <div class="grid mt-5">
                    <div>
                        <label class="sumo-label" for="post_image">Category Image:</label>
                        <div>
                            <small class="font-medium">Accepted file types PNG, JPG, JPEG. Maximum size of 2MB. Must be square and 500 by 500px</small>
                        </div>
                    </div>
                    <input type="file" @input="form.image=$event.target.files[0]" class="mt-4"  id="post_image" accept="image/*">
                    <div v-if="form.errors.image" class="creative-error">
                        <span class="text-xs">{{ form.errors.image}}</span>
                    </div>
                </div>

                <div class="mt-4 flex justify-end">
                    <button type="submit" class="btn-primary">Update Category</button>
                </div>
            </form>
        </div>
        <template #sidebar>
            <div>
                <h6 class="font-bold">Category Image</h6>
                <img :src="category.data.image">
            </div>
        </template>
    </admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {useForm} from "@inertiajs/inertia-vue3";
let props=defineProps({
    category:Object
})
let form=useForm({
    name:props.category.data.name,
    status:props.category.data.status,
    tags:props.category.data.tags,
    description:props.category.data.description,
    image:'',
    _method:'PATCH'

})
</script>

<style scoped>

</style>
