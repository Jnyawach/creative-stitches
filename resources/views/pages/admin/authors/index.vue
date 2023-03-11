<template xmlns:pagination="http://www.w3.org/1999/html">
<admin>
    <Head>
        <title>Authors</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Authors</h6>
        <template #info>
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 mr-2 text-teal-900"><i class="fas fa-info-circle"></i></span>{{$page.props.status}}</p>
            <p class="text-sm flex gap-2" v-else>
                <svg class="fill-teal-700 h-5 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                <span>Contains Authors for Blog Posts</span></p>
        </template>
    </title-block>

    <div class="mt-10">
        <!--table search and name-->
        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Avatar</th>
                <th class="text-start py-3 px-4">Name</th>
                <th class="text-start py-3 px-4">Profile</th>
                <th class="py-3 px-4 text-start">Action</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b" v-if="authors.data" v-for="author in authors.data" :key="author.id">
                <td class="py-3 px-4">{{ author.id }}</td>
                <td class="py-3 px-4">
                    <img :src="author.avatar" class="w-10">
                </td>
                <td class="py-3 px-4">{{ author.name }} {{ author.last_name }}</td>
                <td class="py-3 px-4">
                    <Link :href="author.profile" title="Author Profile">Profile</Link>
                </td>
                <td class="py-3 px-4">
                    <dropdown placement="bottom">
                        <template #trigger="{ toggle }">
                            <Button @click="toggle" >
                               <span class="flex gap-1">
                                   <span>Action</span>
                                     <svg class="h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512"><path d="M56 472a56 56 0 1 1 0-112 56 56 0 1 1 0 112zm0-160a56 56 0 1 1 0-112 56 56 0 1 1 0 112zM0 96a56 56 0 1 1 112 0A56 56 0 1 1 0 96z"/></svg>
                               </span>
                            </Button>
                        </template>
                        <div class="shadow w-36">
                            <ul class="divide-y">
                                <li class="hover:bg-gray-100 ">
                                    <Link :href="route('authors.destroy',author.id)" class="flex gap-1 text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
                                        <svg class="h-4 fill-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M144 400C144 408.8 136.8 416 128 416C119.2 416 112 408.8 112 400V176C112 167.2 119.2 160 128 160C136.8 160 144 167.2 144 176V400zM240 400C240 408.8 232.8 416 224 416C215.2 416 208 408.8 208 400V176C208 167.2 215.2 160 224 160C232.8 160 240 167.2 240 176V400zM336 400C336 408.8 328.8 416 320 416C311.2 416 304 408.8 304 400V176C304 167.2 311.2 160 320 160C328.8 160 336 167.2 336 176V400zM310.1 22.56L336.9 64H432C440.8 64 448 71.16 448 80C448 88.84 440.8 96 432 96H416V432C416 476.2 380.2 512 336 512H112C67.82 512 32 476.2 32 432V96H16C7.164 96 0 88.84 0 80C0 71.16 7.164 64 16 64H111.1L137 22.56C145.8 8.526 161.2 0 177.7 0H270.3C286.8 0 302.2 8.526 310.1 22.56V22.56zM148.9 64H299.1L283.8 39.52C280.9 34.84 275.8 32 270.3 32H177.7C172.2 32 167.1 34.84 164.2 39.52L148.9 64zM64 432C64 458.5 85.49 480 112 480H336C362.5 480 384 458.5 384 432V96H64V432z"/></svg>
                                        <span>Delete</span>
                                    </Link>
                                </li>
                                <li class="hover:bg-gray-100">
                                    <button class="flex gap-1 p-2 w-full h-full text-start" @click="editAuthor(author)">
                                        <svg class="h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M495 59.6C516.9 81.47 516.9 116.9 495 138.8L182.3 451.6C170.9 462.9 156.9 471.2 141.5 475.8L20.52 511.4C14.9 513 8.827 511.5 4.687 507.3C.5466 503.2-1.002 497.1 .6506 491.5L36.23 370.5C40.76 355.1 49.09 341.1 60.44 329.7L373.2 16.97C395.1-4.897 430.5-4.897 452.4 16.97L495 59.6zM341 94.4L417.6 170.1L472.4 116.2C481.8 106.8 481.8 91.6 472.4 82.23L429.8 39.6C420.4 30.23 405.2 30.23 395.8 39.6L341 94.4zM318.4 117L83.07 352.4C75.5 359.9 69.95 369.3 66.93 379.6L39.63 472.4L132.4 445.1C142.7 442.1 152.1 436.5 159.6 428.9L394.1 193.6L318.4 117z"/></svg>
                                        <span>Edit</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </dropdown>

                </td>

            </tr>


            </tbody>

        </table>
        <pagination :data="authors"></pagination>
    </div>
<template #sidebar>
    <div>
        <button type="button" class=" flex gap-2 btn-primary btn-small m-1" @click="showModal=true">

            <svg class="h-4 self-center fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M432 256C432 264.8 424.8 272 416 272h-176V448c0 8.844-7.156 16.01-16 16.01S208 456.8 208 448V272H32c-8.844 0-16-7.15-16-15.99C16 247.2 23.16 240 32 240h176V64c0-8.844 7.156-15.99 16-15.99S240 55.16 240 64v176H416C424.8 240 432 247.2 432 256z"/></svg>
            <span>Author</span>
        </button>
    </div>

    <!--Create author modal-->
    <modal :show="showModal" @close="showModal=false">
        <template #header>
            <h6 class="font-bold text-lg">Create Author</h6>
        </template>
        <div>
            <form @submit.prevent="submit" id="author-form">
                <div class="grid grid-cols-2 gap-2">
                    <div class="mt-3">
                        <label for="author-name" class="creative-label">First Name:</label>
                        <input type="text" class="creative-input" id="author-name" placeholder="Author First Name"
                               required v-model="form.first_name"/>
                        <div v-if="form.errors.first_name" class="creative-error">
                            <span>{{ form.errors.first_name }}</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="author-guard" class="creative-label">Last Name:</label>
                        <input type="text" class="creative-input" id="author-guard" placeholder="Enter Author Last Name"
                               required v-model="form.last_name"/>
                        <div v-if="form.errors.last_name" class="creative-error">
                            <span>{{ form.errors.last_name }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <label for="author-guard" class="creative-label">Profile Link:</label>
                    <div>
                        <small>Provide social media link (Twitter/Medium/Facebook) or personal website link</small>
                    </div>
                    <input type="text" class="creative-input" id="author-guard" placeholder="Enter Author Profile Link"
                           required v-model="form.profile_link"/>
                    <div v-if="form.errors.profile_link" class="creative-error">
                        <span>{{ form.errors.profile_link }}</span>
                    </div>
                </div>

                <div class="grid mt-5">
                    <div>
                        <label class="sumo-label" for="post_image">Profile Photo:</label>
                        <div>
                            <small class="font-medium">Accepted file types PNG, JPG, JPEG. Maximum size of 2MB</small>
                        </div>
                    </div>
                    <input type="file" @input="form.avatar=$event.target.files[0]" class="mt-4"  for="avatar" required>
                    <div v-if="form.errors.avatar" class="creative-error" id="avatar">
                        <span class="text-xs">{{ form.errors.avatar}}</span>
                    </div>
                </div>

            </form>
        </div>
        <template #footer >
            <div class="flex justify-end">
                <button class="btn-primary text-sm" type="submit" form="author-form">Save Author</button>
            </div>
        </template>

    </modal>

    <!-- Edit Role create modal-->
    <modal :show="showEditModal" @close="showEditModal=false">
        <template #header>
            <h6 class="font-bold text-lg">Update Author</h6>
        </template>
        <div>
            <img :src="avatar" class="w-14 my-3">
            <form @submit.prevent="update" id="role-form-update">
                <div class="grid grid-cols-2 gap-2">
                    <div class="mt-3">
                        <label for="author-name" class="creative-label">First Name:</label>
                        <input type="text" class="creative-input" id="author-name" placeholder="Author First Name"
                               required v-model="updateForm.first_name"/>
                        <div v-if="updateForm.errors.first_name" class="creative-error">
                            <span>{{ updateForm.errors.first_name }}</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="author-guard" class="creative-label">Last Name:</label>
                        <input type="text" class="creative-input" id="author-guard" placeholder="Enter Author Last Name"
                               required v-model="updateForm.last_name"/>
                        <div v-if="updateForm.errors.last_name" class="creative-error">
                            <span>{{ updateForm.errors.last_name }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <label for="author-guard" class="creative-label">Profile Link:</label>
                    <div>
                        <small>Provide social media link (Twitter/Medium/Facebook) or personal website link</small>
                    </div>
                    <input type="text" class="creative-input" id="author-guard" placeholder="Enter Author Profile Link"
                           required v-model="updateForm.profile_link"/>
                    <div v-if="updateForm.errors.profile_link" class="creative-error">
                        <span>{{ updateForm.errors.profile_link }}</span>
                    </div>
                </div>

                <div class="grid mt-5">
                    <div>
                        <label class="sumo-label" for="avatar">Profile Photo:</label>
                        <div>
                            <small class="font-medium">Accepted file types PNG, JPG, JPEG. Maximum size of 2MB</small>
                        </div>
                    </div>
                    <input type="file" @input="updateForm.avatar=$event.target.files[0]" class="mt-4" id="avatar">
                    <div v-if="updateForm.errors.avatar" class="creative-error" >
                        <span class="text-xs">{{ updateForm.errors.avatar}}</span>
                    </div>
                </div>

            </form>
        </div>
        <template #footer >
            <div class="flex justify-end">
                <button class="btn-primary text-sm" type="submit" form="role-form-update">Update Author</button>
            </div>
        </template>

    </modal>
</template>
</admin>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
import Admin from "@/views/layouts/admin.vue";
import {ref} from "vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import Modal from "@/views/components/modal.vue";
import { Dropdown} from 'flowbite-vue'
import Pagination from "@/views/components/pagination.vue";
let props=defineProps({
    authors:Object
})

let form=useForm({
    first_name:'',
    last_name:'',
    profile_link:'',
    avatar:''
})
const showModal=ref(false)
const showEditModal=ref(false)
const avatar=ref('')

let submit=()=>{
    form.post(route('authors.store'),{
        onSuccess:()=>{
            form.reset()
            showModal.value=false

        }
    })}

//updating author
let updateForm=useForm({
    first_name:'',
    last_name:'',
    profile_link:'',
    avatar:'',
    id:'',
    _method:'patch'
})

const editAuthor=(author:any)=>{

    updateForm.first_name=author.name;
    updateForm.last_name=author.last_name;
    updateForm.profile_link=author.profile;
    updateForm.id=author.id;
    avatar.value=author.avatar
    showEditModal.value=true;

}
let update=()=>{
    updateForm.post(route('authors.update',updateForm.id),{
        onSuccess:()=>{
            updateForm.reset()
            showEditModal.value=false

        }
    })}
</script>

<style scoped>

</style>
