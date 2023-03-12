<template>
<admin>
    <Head>
        <title>Edit Promotion</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Edit Promotions</h6>
        <template #info >
            <p class="text-sm flex gap-2">
                <svg class="fill-teal-700 h-5 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                <span>Edit Promotions</span>
            </p>
        </template>
    </title-block>
    <div class="grid grid-cols-4 gap-2">

        <div class="col-span-3">
            <img :src="promotion.photo">
            <h6 class="mt-3 font-bold">Promotion Photo</h6>
        </div>
    </div>
    <div class="mt-10 px-3">
        <form @submit.prevent="form.post(route('promotion.update',promotion.id))">
            <div class="grid grid-cols-3  gap-3">
                <div>
                    <label class="creative-label">Promotion Name:</label>
                    <input type="text" class="creative-input" required placeholder="Enter Promotion Name"
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
                <div>
                    <label class="creative-label">Promotion Discount:</label>
                    <input type="number" class="creative-input" required placeholder="Enter Promotion Discount"
                           v-model="form.discount" max="20">
                    <div v-if="form.errors.discount" class="creative-error">
                        <span>{{ form.errors.discount }}</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2 mt-5">
                <div>
                    <label class="creative-label">Promotion Title (max 10 words):</label>
                    <input type="text" class="creative-input" required placeholder="Enter Promotion Title"
                           v-model="form.title" max="20">
                    <div v-if="form.errors.title" class="creative-error">
                        <span>{{ form.errors.title }}</span>
                    </div>
                </div>
                <div>
                    <label class="creative-label">Promotion Description (max 10words):</label>
                    <input type="text" class="creative-input" required placeholder="Enter Promotion Description"
                           v-model="form.description" max="20">
                    <div v-if="form.errors.description" class="creative-error">
                        <span>{{ form.errors.description }}</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 mt-5">


                <div>
                    <label class="sumo-label" for="post_image">Banner Hero Image:</label>
                    <div>
                        <small class="font-medium">Accepted file type PNG. The photo must be have square aspect ratio</small>
                    </div>
                    <input type="file" @input="form.photo=$event.target.files[0]" class="mt-4"  id="post_image" required accept="image/png">
                    <div v-if="form.errors.photo" class="creative-error">
                        <span class="text-xs">{{ form.errors.photo}}</span>
                    </div>
                </div>

            </div>
            <div class="mt-5 flex justify-end">
                <button type="submit" class="btn-primary">Update Promotion</button>
            </div>
        </form>
    </div>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {defineProps, reactive} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";

let props=defineProps({
    promotion:Object
})
const promotion=reactive(props.promotion.data)



let form=useForm({
    name:promotion.name,
    status:promotion.status,
    discount:promotion.discount,
    photo:'',
    title:'',
    description:'',
    _method:'PATCH'
})
</script>

<style scoped>

</style>
