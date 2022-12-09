<template>
    <admin>
        <Head>
            <title>Permissions</title>
        </Head>
        <title-block>
            <h6 class="font-bold text-sm">System Permissions</h6>
            <template #info>
                <p class="text-sm"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> Adjusting permissions will affect user access level</p>
            </template>
        </title-block>

        <!--page content-->
        <div class="flex justify-between px-3 py-2">
            <div>
                <h6 class="font-bold">Permissions ({{permissions.data.length }})</h6>

            </div>

            <div class=" mr-3">

                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input v-model="search" type="search" id="default-search" class="block p-2 pl-10 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-sky-600 focus:border-sky-600" placeholder="Search roles..." required>

                </div>
            </div>
        </div>
        <div class="">
            <!--table search and name-->


            <table class="table-auto w-full mt-3 border-t">
                <thead>
                <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                    <th class="text-start py-3 px-4">Id</th>
                    <th class="text-start py-3 px-4">Name</th>
                    <th class="text-start py-3 px-4">Guard</th>
                    <th class="py-3 px-4 text-start">Action</th>


                </tr>
                </thead>
                <tbody>
                <tr class="border-b" v-if="permissions.data" v-for="permission in permissions.data" :key="permission.id">
                    <td class="py-3 px-4">{{ permission.id }}</td>
                    <td class="py-3 px-4">{{ permission.name }}</td>
                    <td class="py-3 px-4">{{ permission.guard_name }}</td>
                    <td class="py-3 px-4">
                        <dropdown placement="bottom">
                            <template #trigger="{ toggle }">
                                <Button @click="toggle" >
                                    Action <span class="self-center"><i class="far fa-ellipsis-v-alt"></i></span>
                                </Button>
                            </template>
                            <div class="shadow w-36">
                                <ul class="divide-y">
                                    <li class="hover:bg-gray-100 ">
                                        <Link :href="route('permissions.destroy',permission.id)" class="text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
                                            <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete
                                        </Link>
                                    </li>
                                    <li class="hover:bg-gray-100">
                                        <button class="p-2 w-full h-full text-start" @click="editRole(permission)">
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
                    <h6 class="font-medium">Showing <span class="text-sky-800">{{ permissions.current_page }}</span> of <span
                        class="text-sky-800">{{ permissions.last_page }}</span> Page(s)</h6>
                </div>
                <div class="flex">
                    <Link :href="permissions.prev_page_url" class="btn-primary text-xs m-1" v-if="permissions.prev_page_url"><span
                        class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                    </Link>
                    <Link :href="permissions.next_page_url" class="btn-primary text-xs m-1" v-if="permissions.next_page_url">Next
                        <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

                </div>

            </div>
        </div>



        <template #sidebar>
            <sidelink :link="route('roles.index')" >Roles</sidelink>
            <sidelink :link="route('permissions.index')" class="text-teal-900">Permissions</sidelink>
            <div>
                <button type="button" class="btn-primary btn-small m-1" @click="showModal=true"> <span class="mr-2"><i class="fal fa-plus"></i></span>Permission</button>
            </div>

            <!--Role create modal-->

            <modal :show="showModal" @close="showModal=false">
                <template #header>
                    <h6 class="font-bold text-lg">Create Permissions</h6>
                </template>
                <div>
                    <form @submit.prevent="submit" id="role-form">
                        <div class="mt-3">
                            <label for="role-name" class="creative-label">Permission Name:</label>
                            <input type="text" class="creative-input" id="role-name" placeholder="Enter permission name"
                                   required v-model="form.name"/>
                            <div v-if="form.errors.name" class="creative-error">
                                <span>{{ form.errors.name }}</span>
                            </div>
                        </div>
                        <div class="mt-5">
                            <label for="role-guard" class="creative-label">Permission Guard:</label>
                            <input type="text" class="creative-input" id="role-guard" placeholder="Enter permission guard"
                                   required v-model="form.guard_name"/>
                            <div v-if="form.errors.guard_name" class="creative-error">
                                <span>{{ form.errors.guard_name }}</span>
                            </div>
                        </div>

                    </form>
                </div>
                <template #footer >
                    <div class="flex justify-end">
                        <button class="btn-primary text-sm" type="submit" form="role-form">Save Permission</button>
                    </div>
                </template>

            </modal>

            <!-- Edit Role create modal-->
            <modal :show="showEditModal" @close="showEditModal=false">
                <template #header>
                    <h6 class="font-bold text-lg">Update Permissions</h6>
                </template>
                <div>
                    <form @submit.prevent="update" id="role-form-update">
                        <div class="mt-3">
                            <label for="role-name" class="creative-label">Permission Name:</label>
                            <input type="text" class="creative-input" id="role-name" placeholder="Enter permission name"
                                   required v-model="updateForm.name"/>
                            <div v-if="updateForm.errors.name" class="creative-error">
                                <span>{{updateForm.errors.name }}</span>
                            </div>
                        </div>
                        <div class="mt-5">
                            <label for="role-guard" class="creative-label">Permission Guard:</label>
                            <input type="text" class="creative-input" id="role-guard" placeholder="Enter permission guard"
                                   required v-model="updateForm.guard_name"/>
                            <div v-if="updateForm.errors.guard_name" class="creative-error">
                                <span>{{updateForm.errors.guard_name }}</span>
                            </div>
                        </div>

                    </form>
                </div>
                <template #footer >
                    <div class="flex justify-end">
                        <button class="btn-primary text-sm" type="submit" form="role-form-update">Update Permission</button>
                    </div>
                </template>

            </modal>

        </template>
    </admin>
</template>

<script setup lang="ts">
import { Dropdown, ListGroup, ListGroupItem } from 'flowbite-vue'
import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Sidelink from "@/views/components/sidelink.vue";
import Modal from "@/views/components/modal.vue";
import {ref, watch} from "vue";
import _ from "lodash"
import {Inertia} from "@inertiajs/inertia";
import {useForm} from "@inertiajs/inertia-vue3";

let props=defineProps({
    permissions:Object,
    filters:Object
})

let form=useForm({
    name:'',
    guard_name:''
})
const showModal=ref(false)
const showEditModal=ref(false)

let search=ref(props.filters.search)
watch(search, _.debounce(function (value) {
    Inertia.get(route('permissions.index'),{
        search:value
    }, {preserveState:true, replace:true});
}, 300))
//save role
let submit=()=>{
    form.post(route('permissions.store'),{
        onSuccess:()=>{
            form.reset()
            showModal.value=false

        }
    })}

//edit role
let updateForm=useForm({
    name:'',
    guard_name:'',
    id:''
})
const editRole=(permission)=>{
    console.log(permission)
    updateForm.name=permission.name;
    updateForm.guard_name=permission.guard_name;
    updateForm.id=permission.id
    showEditModal.value=true

}

let update=()=>{
    updateForm.patch(route('permissions.update',updateForm.id),{
        onSuccess:()=>{
            updateForm.reset()
            showEditModal.value=false

        }
    })}
</script>

<style scoped>

</style>
