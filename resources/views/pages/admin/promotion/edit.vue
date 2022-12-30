<template>
<admin>
    <Head>
        <title>Edit Promotion</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Edit Promotions</h6>
        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 mr-3 text-teal-900"><i class="fas fa-info-circle"></i></span>{{promotion.name}}</p>
        </template>
    </title-block>
    <div class="grid grid-cols-4 gap-2">
       <div class="col-span-1">
           <img :src="promotion.mobile">
           <h6 class="mt-3 font-bold">Mobile Banner</h6>
       </div>
        <div class="col-span-3">
            <img :src="promotion.banner">
            <h6 class="mt-3 font-bold">Desktop Banner</h6>
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
            <div class="grid grid-cols-2 mt-3">


                <div>
                    <label class="sumo-label" for="post_image">Banner Hero Image:</label>
                    <div>
                        <small class="font-medium">Accepted file types PNG, JPG, JPEG. Maximum size of 2MB. Must be 1600px by 600px</small>
                    </div>
                    <input type="file" @input="form.banner=$event.target.files[0]" class="mt-4"  id="post_image" required accept="image/*">
                    <div v-if="form.errors.banner" class="creative-error">
                        <span class="text-xs">{{ form.errors.banner}}</span>
                    </div>
                </div>
                <div>
                    <label class="sumo-label" for="post_image">Mobile Hero Image:</label>
                    <div>
                        <small class="font-medium">Accepted file types PNG, JPG, JPEG. Maximum size of 2MB. Must be 800px by 1000px</small>
                    </div>
                    <input type="file" @input="form.mobile=$event.target.files[0]" class="mt-4"  id="post_image" required accept="image/*">
                    <div v-if="form.errors.mobile" class="creative-error">
                        <span class="text-xs">{{ form.errors.mobile}}</span>
                    </div>
                </div>
            </div>
            <div class="mt-4 flex justify-end">
                <button type="submit" class="btn-primary">Save Promotion</button>
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
    banner:'',
    mobile:'',
    _method:'PATCH'
})
</script>

<style scoped>

</style>
