<template>
<admin>
 <Head>
     <title>Roles</title>
 </Head>
    <title-block>
        <h6 class="font-bold text-sm">System Roles</h6>
        <template #info>
            <p class="text-sm flex gap-2">
                <svg class="fill-teal-700 h-5 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                <span>Adjusting Roles will affect user access level</span>
            </p>
        </template>
    </title-block>

    <!--page content-->
    <div class="flex justify-between px-3 py-2">
        <div>
            <h6 class="font-bold">Roles ({{ roles.data.length }})</h6>

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
    <div>
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
            <tr class="border-b" v-if="roles.data" v-for="role in roles.data" :key="role.id">
                <td class="py-3 px-4">{{ role.id }}</td>
                <td class="py-3 px-4">{{ role.name }}</td>
                <td class="py-3 px-4">{{ role.guard_name }}</td>
                <td class="py-3 px-4">
                    <dropdown placement="bottom">
                        <template #trigger="{ toggle }">
                            <Button @click="toggle" >
                                <span class="flex gap-1">
                                    <span>Action</span>
                                     <svg class="h-4 self-center" xmlns="http://www.w3.org/2000/svg"
                                          viewBox="0 0 128 512"><path
                                         d="M56 472a56 56 0 1 1 0-112 56 56 0 1 1 0 112zm0-160a56 56 0 1 1 0-112 56 56 0 1 1 0 112zM0 96a56 56 0 1 1 112 0A56 56 0 1 1 0 96z"/></svg>
                                   </span>
                            </Button>
                        </template>
                        <div class="shadow w-36">
                            <ul class="divide-y">
                                <li class="hover:bg-gray-100 ">
                                    <Link :href="route('roles.destroy',role.id)" class="flex gap-1 text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
                                        <svg class="h-4 fill-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M144 400C144 408.8 136.8 416 128 416C119.2 416 112 408.8 112 400V176C112 167.2 119.2 160 128 160C136.8 160 144 167.2 144 176V400zM240 400C240 408.8 232.8 416 224 416C215.2 416 208 408.8 208 400V176C208 167.2 215.2 160 224 160C232.8 160 240 167.2 240 176V400zM336 400C336 408.8 328.8 416 320 416C311.2 416 304 408.8 304 400V176C304 167.2 311.2 160 320 160C328.8 160 336 167.2 336 176V400zM310.1 22.56L336.9 64H432C440.8 64 448 71.16 448 80C448 88.84 440.8 96 432 96H416V432C416 476.2 380.2 512 336 512H112C67.82 512 32 476.2 32 432V96H16C7.164 96 0 88.84 0 80C0 71.16 7.164 64 16 64H111.1L137 22.56C145.8 8.526 161.2 0 177.7 0H270.3C286.8 0 302.2 8.526 310.1 22.56V22.56zM148.9 64H299.1L283.8 39.52C280.9 34.84 275.8 32 270.3 32H177.7C172.2 32 167.1 34.84 164.2 39.52L148.9 64zM64 432C64 458.5 85.49 480 112 480H336C362.5 480 384 458.5 384 432V96H64V432z"/></svg>
                                        <span>Delete</span>
                                    </Link>
                                </li>
                                <li class="hover:bg-gray-100">
                                    <button class="flex gap-1 p-2 w-full h-full text-start" @click="editRole(role)">
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
        <indirect-pagination :data="roles"></indirect-pagination>
    </div>



    <template #sidebar>
        <sidelink :link="route('roles.index')" class="text-teal-900">Roles</sidelink>
        <sidelink :link="route('permissions.index')">Permissions</sidelink>
        <div>
            <button type="button" class="btn-primary btn-small m-1 flex gap-1" @click="showModal=true">
                <svg class="h-4 self-center fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M432 256C432 264.8 424.8 272 416 272h-176V448c0 8.844-7.156 16.01-16 16.01S208 456.8 208 448V272H32c-8.844 0-16-7.15-16-15.99C16 247.2 23.16 240 32 240h176V64c0-8.844 7.156-15.99 16-15.99S240 55.16 240 64v176H416C424.8 240 432 247.2 432 256z"/></svg>
                <span>Roles</span>
            </button>
        </div>

        <!--Role create modal-->

        <modal :show="showModal" @close="showModal=false">
            <template #header>
                <h6 class="font-bold text-lg">Create Roles</h6>
            </template>
            <div>
                <form @submit.prevent="submit" id="role-form">
                    <div class="mt-3">
                        <label for="role-name" class="creative-label">Role Name:</label>
                        <input type="text" class="creative-input" id="role-name" placeholder="Enter role name"
                               required v-model="form.name"/>
                        <div v-if="form.errors.name" class="creative-error">
                                        <span>{{ form.errors.name }}</span>
                        </div>
                    </div>
                    <div class="mt-5">
                        <label for="role-guard" class="creative-label">Role Guard:</label>
                        <input type="text" class="creative-input" id="role-guard" placeholder="Enter role guard"
                               required v-model="form.guard_name"/>
                        <div v-if="form.errors.guard_name" class="creative-error">
                                        <span>{{ form.errors.guard_name }}</span>
                        </div>
                    </div>

                </form>
            </div>
            <template #footer >
               <div class="flex justify-end">
                   <button class="btn-primary text-sm" type="submit" form="role-form">Save Role</button>
               </div>
            </template>

        </modal>

        <!-- Edit Role create modal-->
        <modal :show="showEditModal" @close="showEditModal=false">
            <template #header>
                <h6 class="font-bold text-lg">Update Role</h6>
            </template>
            <div>
                <form @submit.prevent="update" id="role-form-update">
                    <div class="mt-3">
                        <label for="role-name" class="creative-label">Role Name:</label>
                        <input type="text" class="creative-input" id="role-name" placeholder="Enter role name"
                               required v-model="updateForm.name"/>
                        <div v-if="updateForm.errors.name" class="creative-error">
                            <span>{{updateForm.errors.name }}</span>
                        </div>
                    </div>
                    <div class="mt-5">
                        <label for="role-guard" class="creative-label">Role Guard:</label>
                        <input type="text" class="creative-input" id="role-guard" placeholder="Enter role guard"
                               required v-model="updateForm.guard_name"/>
                        <div v-if="updateForm.errors.guard_name" class="creative-error">
                            <span>{{updateForm.errors.guard_name }}</span>
                        </div>
                    </div>

                </form>
            </div>
            <template #footer >
                <div class="flex justify-end">
                    <button class="btn-primary text-sm" type="submit" form="role-form-update">Update Role</button>
                </div>
            </template>

        </modal>

    </template>
</admin>
</template>

<script setup lang="ts">
import { Dropdown} from 'flowbite-vue'
import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Sidelink from "@/views/components/sidelink.vue";
import Modal from "@/views/components/modal.vue";
import {ref, watch} from "vue";
import {debounce} from 'lodash';
import {Inertia} from "@inertiajs/inertia";
import {useForm} from "@inertiajs/inertia-vue3";
import IndirectPagination from "@/views/components/indirect-pagination.vue";

let props=defineProps({
    roles:Object,
    filters:Object
})

let form=useForm({
    name:'',
    guard_name:''
})
const showModal=ref(false)
const showEditModal=ref(false)

let search=ref(props.filters.search)
watch(search, debounce(function (value) {
    Inertia.get(route('roles.index'),{
        search:value
    }, {preserveState:true, replace:true});
}, 300))
//save role
let submit=()=>{
    form.post(route('roles.store'),{
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
const editRole=(role)=>{

    updateForm.name=role.name;
    updateForm.guard_name=role.guard_name;
    updateForm.id=role.id
    showEditModal.value=true

}

let update=()=>{
    updateForm.patch(route('roles.update',updateForm.id),{
        onSuccess:()=>{
            updateForm.reset()
            showEditModal.value=false

        }
    })}
</script>

<style scoped>

</style>
