<template layout="main">
<Head>
    <title>{{user.data.name}}</title>
    <meta name="description" content="Shop Embroidery design. Digitally downloadable embroidery designs">
</Head>
    <!--account-menu-->
   <account-menu></account-menu>

    <div class="bg-teal-50 py-3 px-3" v-if="$page.props.status">
        <p><span class="mr-2 text-teal-700"><i class="far fa-info-circle"></i></span>{{$page.props.status}}</p>
    </div>

    <div class="my-8 px-3 md:px-10">
        <!--profile management-->
        <h1 class="text-2xl font-bold">Your Profile</h1>
        <div class="grid md:grid-cols-2 gap-2 mt-4">
            <div class="border rounded-xl p-3">
                <div class="flex justify-between">
                    <h6 class="font-bold">You profile Information</h6>
                    <button @click="editUser=true" class="text-teal-700 font-bold"><span class="mr-2"><i
                        class="fal fa-pen"></i></span>Edit
                    </button>
                    <user-edit :show="editUser" @close="editUser=false" :user="user.data"></user-edit>
                </div>

                <div class="grid sm:grid-cols-2 mt-5">
                    <p><span class="text-teal-700">First Name:</span> {{ user.data.name }}</p>
                    <p><span class="text-teal-700">Last Name:</span> {{ user.data.last_name }}</p>
                    <p><span class="text-teal-700">Email:</span> {{ user.data.email }}</p>
                </div>
                <!-- end of profile management-->
                <hr class="my-3">
                <!--address management-->
                <div class="flex justify-between">
                    <h6 class="font-bold">Address Information</h6>
                    <button @click="editAddress=true" type="button" class="text-teal-700 font-bold"
                            v-if="user.data.address">
                        <span class="mr-2"><i class="fal fa-pen"></i></span>Edit
                    </button>
                    <address-edit :show="editAddress" @close="editAddress=false"
                                  :address="user.data.address"></address-edit>

                </div>
                <div class="mt-3">
                    <div v-if="user.data.address">
                        <div class="grid sm:grid-cols-2 mt-5">
                            <p><span class="text-teal-700">Address:</span> {{ user.data.address.address }}</p>
                            <p><span class="text-teal-700">Zip Code:</span> {{ user.data.address.zip }}</p>
                            <p><span class="text-teal-700">City:</span> {{ user.data.address.city }}</p>
                            <p><span class="text-teal-700">Country:</span> {{ user.data.address.country.name }}</p>
                        </div>
                    </div>
                    <div v-else>
                        <button @click="createAddress=true" type="button"
                                class="hover:text-teal-700 font-bold border py-2 px-8 rounded-full hover:border-teal-700">
                            <span class="mr-2"><i class="fal fa-pen"></i></span> Add Address
                        </button>
                        <address-create :show="createAddress" @close="createAddress=false"
                                        :user="user.data.id"></address-create>
                    </div>
                </div>
                <!--end of address management-->
                <hr class="my-3">
                <div class="flex justify-between">
                    <h6 class="font-bold">Password Management</h6>
                    <button @click="editPassword=true" type="button" class="text-teal-700 font-bold">
                        <span class="mr-2"><i class="fal fa-pen"></i></span>Edit
                    </button>
                    <password-edit :show="editPassword" @close="editPassword=false"
                                   :user="user.data.id"></password-edit>


                </div>

            </div>
            <div class="border rounded-xl p-3">

            </div>
        </div>
    </div>

</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
import {defineProps, ref} from "vue";
import AccountMenu from "@/views/components/account-menu.vue";
import {Button} from "flowbite-vue";
import AddressCreate from "@/views/components/account/address-create.vue";
import AddressEdit from "@/views/components/account/address-edit.vue";
import UserEdit from "@/views/components/account/user-edit.vue";
import PasswordEdit from "@/views/components/account/password-edit.vue";
defineProps({
    user:Object,
    status:Object
})

const createAddress=ref(false)
const editAddress=ref(false)
const editUser=ref(false)
const  editPassword=ref(false)
</script>

<style scoped>

</style>
