<template>
<admin>
    <Head>
        <title>Coupons</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Coupons</h6>
        <template #info>
            <p class="text-sm"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> Available coupons</p>
        </template>
    </title-block>

    <div class="mt-10">
        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Name</th>
                <th class="text-start py-3 px-4">Code</th>
                <th class="text-start py-3 px-4">Discount(%)</th>
                <th class="text-start py-3 px-4">Expires</th>
                <th class="py-3 px-4 text-start">Action</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b"  v-for="coupon in coupons" :key="coupon.id">
                <td class="py-3 px-4">{{ coupon.id }}</td>
                <td class="py-3 px-4">{{ coupon.name }}</td>
                <td class="py-3 px-4">{{ coupon.code }}</td>
                <td class="py-3 px-4">{{ coupon.discount }}</td>
                <td class="py-3 px-4">{{ new Date(coupon.expires).toDateString()}}</td>
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
                                    <Link :href="route('coupons.destroy',coupon.id)" class="text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
                                        <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete
                                    </Link>
                                </li>
                                <li class="hover:bg-gray-100">
                                    <button class="p-2 w-full h-full text-start" @click="editCoupon(coupon)">
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
    </div>
    <template #sidebar>
        <div>
            <button class="btn-primary btn-small" type="button" @click="showModal=true">
                <span class="mr-2"><i class="far fa-plus"></i></span>Create Coupon
            </button>
        </div>
    </template>
    <!--Create coupon modal-->
    <Modal :show="showModal" @close="showModal=false">
        <template #header>
            <h6>Create Coupon Code</h6>
        </template>
        <div>
            <form @submit.prevent="createCoupon">
                <div class="grid grid-cols-2 gap-2">
                    <div class="mt-3">
                        <label for="role-name" class="creative-label">Coupon Name:</label>
                        <input type="text" class="creative-input" id="role-name" placeholder="Enter Coupon name"
                               required v-model="form.name"/>
                        <div v-if="form.errors.name" class="creative-error">
                            <span>{{form.errors.name }}</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="coupon-discount" class="creative-label">Coupon Discount:</label>
                        <input type="number" min="2" max="25" class="creative-input" id="coupon-discount" placeholder="Enter Discount percentage"
                               required v-model="form.discount"/>
                        <div v-if="form.errors.discount" class="creative-error">
                            <span>{{form.errors.discount }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-5 grid grid-cols-2 gap-2">
                    <div class="col-span-1">
                        <label for="coupon-expires" class="creative-label">Expiry Date:</label>
                        <input type="datetime-local" class="creative-input" id="coupon-expires"
                               required v-model="form.expires"/>
                        <div v-if="form.errors.expires" class="creative-error">
                            <span>{{form.errors.expires }}</span>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <label class="creative-label">Coupon Status:</label>
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

                <div class="mt-5">
                    <button type="submit" class="btn-primary">Save Coupon</button>
                </div>
            </form>
        </div>
    </Modal>

    <!--Edi coupon modal-->
    <Modal :show="editModal" @close="editModal=false">
        <template #header>
            <h6>Edit Coupon Code</h6>
        </template>
        <div>
            <form @submit.prevent="updateCoupon">
                <div class="grid grid-cols-2 gap-2">
                    <div class="mt-3">
                        <label for="role-name" class="creative-label">Coupon Name:</label>
                        <input type="text" class="creative-input" id="role-name" placeholder="Enter Coupon name"
                               required v-model="editForm.name"/>
                        <div v-if="editForm.errors.name" class="creative-error">
                            <span>{{editForm.errors.name }}</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="coupon-discount" class="creative-label">Coupon Discount:</label>
                        <input type="number" min="2" max="25" class="creative-input" id="coupon-discount" placeholder="Enter Discount percentage"
                               required v-model="editForm.discount"/>
                        <div v-if="editForm.errors.discount" class="creative-error">
                            <span>{{editForm.errors.discount }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-5 grid grid-cols-2 gap-2">
                    <div class="col-span-1">
                        <label for="coupon-expires" class="creative-label">Expiry Date:</label>
                        <input type="datetime-local" class="creative-input" id="coupon-expires"
                               required v-model="editForm.expires"/>
                        <div v-if="editForm.errors.expires" class="creative-error">
                            <span>{{editForm.errors.expires }}</span>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <label class="creative-label">Coupon Status:</label>
                        <select required class="creative-input" v-model="editForm.status">
                            <option selected value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Disabled</option>
                        </select>

                        <div v-if="editForm.errors.status" class="creative-error">
                            <span>{{ editForm.errors.status }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <button type="submit" class="btn-primary">Update Coupon</button>
                </div>
            </form>
        </div>
    </Modal>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head, useForm} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {Link} from "@inertiajs/inertia-vue3";
import { Dropdown} from 'flowbite-vue'
import {ref} from "vue";
import Modal from "@/views/components/modal.vue";
defineProps({
    coupons:Object
})
let form=useForm({
    name:'',
    discount:'',
    expires:'',
    status:''
})
const showModal=ref(false)
const editModal=ref(false)

const createCoupon=()=>{
    form.post(route('coupons.store'));
    showModal.value=false;
}

let editForm=useForm({
    name:'',
    discount:'',
    expires:'',
    status:'',
    id:'',
    _method:'PATCH'
})

const editCoupon=(coupon:any)=>{
    editForm.name=coupon.name;
    editForm.discount=coupon.discount;
    editForm.expires=coupon.expires;
    editForm.status=coupon.status;
    editForm.id=coupon.id;
    editModal.value=true;
}

const updateCoupon=()=>{
    editForm.post(route('coupons.update',editForm.id));
    editModal.value=false;
}
</script>

<style scoped>

</style>
