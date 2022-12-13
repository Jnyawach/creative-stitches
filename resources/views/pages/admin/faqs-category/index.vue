<template>
<admin>
    <Head>
        <title>FAQS Category</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">FAQS Categories</h6>
        <template #info>
            <p class="text-sm"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> FAQS are classifies based on these categories</p>
        </template>
    </title-block>
    <div class="flex justify-between px-3 py-2">
        <h6 class="font-bold">Categories ({{ categories.data.length }})</h6>
    </div>
    <!--categories table-->
    <div class="">
        <!--table search and name-->
        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Name</th>
                <th class="text-start py-3 px-4">Status</th>
                <th class="py-3 px-4 text-start">Action</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b" v-if="categories.data" v-for="category in categories.data" :key="category.id">
                <td class="py-3 px-4">{{ category.id }}</td>
                <td class="py-3 px-4">{{ category.name }}</td>
                <td class="py-3 px-4">
                    <span v-if="category.status">Active </span>
                    <span v-else>Inactive </span>
                </td>
                <td class="py-3 px-4">
                    <dropdown placement="bottom">
                        <template #trigger="{ toggle }">
                            <button @click="toggle" >
                                Action <span class="self-center"><i class="far fa-ellipsis-v-alt"></i></span>
                            </button>
                        </template>
                        <div class="shadow w-36">
                            <ul class="divide-y">
                                <li class="hover:bg-gray-100 ">
                                    <Link :href="route('faqs-category.destroy',category.id)" class="text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
                                        <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete
                                    </Link>
                                </li>
                                <li class="hover:bg-gray-100">
                                    <button class="p-2 w-full h-full text-start" @click="editCategory(category)">
                                        <span class="mr-2"><i class="fal fa-pen"></i></span>Edit
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </dropdown>

                </td>

            </tr>


            </tbody>

        </table>
        <div class="bg-gray-50 p-3 flex justify-between">
            <div class="self-center">
                <h6 class="font-medium">Showing <span class="text-sky-800">{{ categories.current_page }}</span> of <span
                    class="text-sky-800">{{ categories.last_page }}</span> Page(s)</h6>
            </div>
            <div class="flex">
                <Link :href="categories.prev_page_url" class="btn-primary text-xs m-1" v-if="categories.prev_page_url"><span
                    class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                </Link>
                <Link :href="categories.next_page_url" class="btn-primary text-xs m-1" v-if="categories.next_page_url">Next
                    <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

            </div>

        </div>
    </div>
<template #sidebar>
    <div>
        <button type="button" class="btn-primary btn-small m-1" @click="showModal=true"> <span class="mr-2"><i class="fal fa-plus"></i></span>Faq Category</button>
    </div>

    <!--create Fag Category modal-->

    <modal :show="showModal" @close="showModal=false">
        <template #header>
            <h6 class="font-bold text-lg">Create Faqs Category</h6>
        </template>
        <div>
            <form @submit.prevent="submit" id="category-form">
                <div class="mt-3">
                    <label for="category-name" class="creative-label">Category Name:</label>
                    <input type="text" class="creative-input" id="category-name" placeholder="Enter category name"
                           required v-model="form.name"/>
                    <div v-if="form.errors.name" class="creative-error">
                        <span>{{ form.errors.name }}</span>
                    </div>
                </div>
                <div class="mt-5">
                    <label for="category-status" class="creative-label">Category status:</label>
                    <select required v-model="form.status" class="creative-input">
                        <option selected value="" >Select status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>

                    <div v-if="form.errors.status" class="creative-error">
                        <span>{{ form.errors.status }}</span>
                    </div>
                </div>

            </form>
        </div>
        <template #footer >
            <div class="flex justify-end">
                <button class="btn-primary text-sm" type="submit" form="category-form">Save Category</button>
            </div>
        </template>

    </modal>
    <!--category  edit modal-->
    <modal :show="showEditModal" @close="showEditModal=false">
        <template #header>
            <h6 class="font-bold text-lg">Update Faqs Category</h6>
        </template>
        <div>
            <form @submit.prevent="update" id="update-form">
                <div class="mt-3">
                    <label for="category-name-update" class="creative-label">Category Name:</label>
                    <input type="text" class="creative-input" id="category-name" placeholder="Enter category name"
                           required v-model="editForm.name"/>
                    <div v-if="editForm.errors.name" class="creative-error">
                        <span>{{ editForm.errors.name }}</span>
                    </div>
                </div>
                <div class="mt-5">
                    <label for="category-status-update" class="creative-label">Category status:</label>
                    <select required v-model="editForm.status" class="creative-input" id="category-status-update">
                        <option selected value="" >Select status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>

                    <div v-if="editForm.errors.status" class="creative-error">
                        <span>{{ editForm.errors.status }}</span>
                    </div>
                </div>

            </form>
        </div>
        <template #footer >
            <div class="flex justify-end">
                <button class="btn-primary text-sm" type="submit" form="update-form">Update Category</button>
            </div>
        </template>

    </modal>

</template>
</admin>
</template>

<script setup lang="ts">
import TitleBlock from "@/views/components/title-block.vue";
import {Link} from "@inertiajs/inertia-vue3";
import { Dropdown, Button} from 'flowbite-vue'
import {Head} from "@inertiajs/inertia-vue3";
import Admin from "@/views/layouts/admin.vue";
import Modal from "@/views/components/modal.vue"
import {ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
defineProps({
    categories:Object
})
const showEditModal=ref(false)
const showModal=ref(false)
let form=useForm({
    name:'',
    status:''
})

let submit=()=>{
    form.post(route('faqs-category.store'),{
        onSuccess:()=>{
            form.reset()
            showModal.value=false

        }
    })}
//edit category
let editForm=useForm({
    name:'',
    status:'',
    id:''
})
const  editCategory=(category:any)=>{
    editForm.name=category.name;
    editForm.status=category.status;
    editForm.id=category.id
    showEditModal.value=true
}

let update=()=>{

    editForm.patch(route('faqs-category.update',editForm.id),{
        onSuccess:()=>{
            editForm.reset()
            showEditModal.value=false

        }
    })
}
</script>

<style scoped>

</style>
