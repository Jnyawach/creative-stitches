<template>
    <admin>
        <Head>
            <title>Edit Posts</title>
        </Head>
        <TitleBlock>
            <h6 class="font-bold text-sm">Edit Post</h6>
            <template #info>
                <p class="text-sm"><span class="ml-2 mr-2 text-teal-900"><i class="fas fa-info-circle"></i></span>Edit Blog Post</p>
            </template>
        </TitleBlock>
        <div class="mt-5 flex">
            <img :src="postImage">
        </div>
        <div class="mt-8 p-3">
            <form @submit.prevent="form.post(route('posts.update',post.id))">
                <div class="grid">
                    <div>
                        <label class="creative-label">Title:</label>
                        <input type="text" class="creative-input" required placeholder="Enter Post Title"
                               v-model="form.title">
                        <div v-if="form.errors.title" class="creative-error">
                            <span>{{ form.errors.title }}</span>
                        </div>
                    </div>
                </div>
                <div class="grid mt-5 grid-cols-2 gap-4">
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

                    <div>
                        <label class="creative-label">Author:</label>

                        <select required class="creative-input" v-model="form.author">
                            <option selected value="">Select Author</option>
                            <option v-for="author in authors.data" :value="author.id">
                                {{ author.name }} {{ author.last_name }}
                            </option>
                        </select>
                        <div v-if="form.errors.author" class="creative-error">
                            <span>{{ form.errors.author }}</span>
                        </div>
                    </div>
                </div>
                <div class="grid mt-4">
                    <div>
                        <label class="creative-label">Post Tags:</label>
                        <div>
                            <small class="text-xs">Post tags are to help with SEO optimization. Enter tags separated by comma</small>
                        </div>
                        <textarea required placeholder="Enter tags" class="creative-text-input" rows="4" v-model="form.tags"></textarea>
                        <div v-if="form.errors.tags" class="creative-error">
                            <span>{{ form.errors.tags }}</span>
                        </div>
                    </div>
                </div>

                <div class="grid mt-5">
                    <div>
                        <label class="creative-label">Post summary:</label>
                        <div>
                            <small class="text-xs">Provide a summary of about 150 words</small>
                        </div>
                        <textarea required placeholder="Enter description" class="creative-text-input" rows="4" v-model="form.summary"></textarea>
                        <div v-if="form.errors.summary" class="creative-error">
                            <span>{{ form.errors.summary}}</span>
                        </div>
                    </div>
                </div>

                <div class="grid mt-5">
                    <div>
                        <label class="creative-label">Post Content:</label>
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

                <div class="grid mt-5">
                    <div>
                        <label class="sumo-label" for="post_image">Post Image (optional):</label>
                        <div>
                            <small class="font-medium">Accepted file types PNG, JPG, JPEG. Maximum size of 2MB. Size 1200px by 675px</small>
                        </div>
                    </div>
                    <input type="file" @input="form.image=$event.target.files[0]" class="mt-4"  id="post_image" >
                    <div v-if="form.errors.image" class="creative-error">
                        <span class="text-xs">{{ form.errors.image}}</span>
                    </div>
                </div>

                <div>
                    <label class="creative-label">Image Credit (optional):</label>

                    <input type="text" class="creative-input" required placeholder="Enter Image Credit"
                           v-model="form.credit">

                    <div v-if="form.errors.credit" class="creative-error">
                        <span>{{ form.errors.credit }}</span>
                    </div>
                </div>

                <div class="mt-4 flex justify-end">
                    <button type="submit" class="btn-primary">Save Post</button>
                </div>
            </form>
        </div>
    </admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import TitleBlock from "@/views/components/title-block.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import Editor from '@tinymce/tinymce-vue'
import {defineProps} from "vue";

let props=defineProps({
    post:Object,
    postImage:String,
    authors:Object
})

let form=useForm({
    title:props.post.title,
    status:props.post.status,
    summary:props.post.summary,
    content:props.post.content,
    image:'',
    author:props.post.author_id,
    tags:props.post.tags,
    credit:props.post.credit,
    _method:'PATCH'
})
</script>

<style scoped>

</style>
