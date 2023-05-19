<template layout="main">
<Head>
    <title>{{user.data.name}}</title>
    <meta name="description" content="Shop Embroidery design. Digitally downloadable embroidery designs">
</Head>
    <!--account-menu-->
   <account-menu></account-menu>
    <div class="my-8 px-3 md:px-10">
        <!--profile management-->
        <h1 class="text-2xl font-bold">Your Profile</h1>
        <div class="grid md:grid-cols-2 gap-2 mt-4">
            <div class="border rounded-xl p-3">
                <div class="flex justify-between">
                    <h6 class="font-bold">You profile Information</h6>
                    <button @click="editUser=true" class="text-teal-700 font-bold flex gap-2">

                        <svg class="h-4 fill-teal-700 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M495 59.6C516.9 81.47 516.9 116.9 495 138.8L182.3 451.6C170.9 462.9 156.9 471.2 141.5 475.8L20.52 511.4C14.9 513 8.827 511.5 4.687 507.3C.5466 503.2-1.002 497.1 .6506 491.5L36.23 370.5C40.76 355.1 49.09 341.1 60.44 329.7L373.2 16.97C395.1-4.897 430.5-4.897 452.4 16.97L495 59.6zM341 94.4L417.6 170.1L472.4 116.2C481.8 106.8 481.8 91.6 472.4 82.23L429.8 39.6C420.4 30.23 405.2 30.23 395.8 39.6L341 94.4zM318.4 117L83.07 352.4C75.5 359.9 69.95 369.3 66.93 379.6L39.63 472.4L132.4 445.1C142.7 442.1 152.1 436.5 159.6 428.9L394.1 193.6L318.4 117z"/></svg>
                       <span class="self-center">
                            Edit
                       </span>
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
                    <button @click="editAddress=true" type="button" class="text-teal-700 font-bold flex gap-2"
                            v-if="user.data.address">
                        <svg class="h-4 fill-teal-700 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M495 59.6C516.9 81.47 516.9 116.9 495 138.8L182.3 451.6C170.9 462.9 156.9 471.2 141.5 475.8L20.52 511.4C14.9 513 8.827 511.5 4.687 507.3C.5466 503.2-1.002 497.1 .6506 491.5L36.23 370.5C40.76 355.1 49.09 341.1 60.44 329.7L373.2 16.97C395.1-4.897 430.5-4.897 452.4 16.97L495 59.6zM341 94.4L417.6 170.1L472.4 116.2C481.8 106.8 481.8 91.6 472.4 82.23L429.8 39.6C420.4 30.23 405.2 30.23 395.8 39.6L341 94.4zM318.4 117L83.07 352.4C75.5 359.9 69.95 369.3 66.93 379.6L39.63 472.4L132.4 445.1C142.7 442.1 152.1 436.5 159.6 428.9L394.1 193.6L318.4 117z"/></svg>
                        <span class="self-center">
                            Edit
                       </span>
                    </button>


                </div>
                <div v-if="user.data.address">
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
                                class="hover:text-teal-700 font-bold border py-2 px-8 rounded-full hover:border-teal-700 flex justify-center gap-3 group">
                            <svg class="h-4  self-center group-hover:fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M495 59.6C516.9 81.47 516.9 116.9 495 138.8L182.3 451.6C170.9 462.9 156.9 471.2 141.5 475.8L20.52 511.4C14.9 513 8.827 511.5 4.687 507.3C.5466 503.2-1.002 497.1 .6506 491.5L36.23 370.5C40.76 355.1 49.09 341.1 60.44 329.7L373.2 16.97C395.1-4.897 430.5-4.897 452.4 16.97L495 59.6zM341 94.4L417.6 170.1L472.4 116.2C481.8 106.8 481.8 91.6 472.4 82.23L429.8 39.6C420.4 30.23 405.2 30.23 395.8 39.6L341 94.4zM318.4 117L83.07 352.4C75.5 359.9 69.95 369.3 66.93 379.6L39.63 472.4L132.4 445.1C142.7 442.1 152.1 436.5 159.6 428.9L394.1 193.6L318.4 117z"/></svg>
                            <span class="self-center">
                            Add Address
                       </span>
                        </button>
                        <address-create :show="createAddress" @close="createAddress=false"
                                        :user="user.data.id"></address-create>
                    </div>
                </div>
                <!--end of address management-->
                <hr class="my-3">
                <div class="flex justify-between">
                    <h6 class="font-bold">Password Management</h6>
                    <button @click="editPassword=true" type="button" class="text-teal-700 font-bold flex gap-2">
                        <svg class="h-4 fill-teal-700 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M495 59.6C516.9 81.47 516.9 116.9 495 138.8L182.3 451.6C170.9 462.9 156.9 471.2 141.5 475.8L20.52 511.4C14.9 513 8.827 511.5 4.687 507.3C.5466 503.2-1.002 497.1 .6506 491.5L36.23 370.5C40.76 355.1 49.09 341.1 60.44 329.7L373.2 16.97C395.1-4.897 430.5-4.897 452.4 16.97L495 59.6zM341 94.4L417.6 170.1L472.4 116.2C481.8 106.8 481.8 91.6 472.4 82.23L429.8 39.6C420.4 30.23 405.2 30.23 395.8 39.6L341 94.4zM318.4 117L83.07 352.4C75.5 359.9 69.95 369.3 66.93 379.6L39.63 472.4L132.4 445.1C142.7 442.1 152.1 436.5 159.6 428.9L394.1 193.6L318.4 117z"/></svg>
                        <span class="self-center">
                            Edit
                       </span>
                    </button>
                    <password-edit :show="editPassword" @close="editPassword=false"
                                   :user="user.data.id"></password-edit>


                </div>

            </div>
            <div class="border rounded-xl p-3">
                <div>
                    <div class="flex justify-between">
                        <h6 class="font-bold">Subscription</h6>

                    </div>
                    <div v-if="subscription" class="py-3">
                        <p>Subscribed to News, projects, promotion, and sales</p>
                        <div class="py-3">
                            <Link as="button" method="delete" :href="route('subscription.cancel',subscription.id)" class="hover:text-red-700 font-bold text-sm
                            border py-2 px-5 rounded-full hover:border-red-700">
                                Cancel Subscription
                            </Link>
                        </div>
                    </div>
                    <div v-else class="py-3">
                        <Link as="button" method="patch" :href="route('subscription.create',user.data.id)"
                                class="hover:text-teal-700 font-bold border py-2 px-8 rounded-full hover:border-teal-700">
                            <span class="mr-2"><i class="fal fa-envelope"></i></span> Subscribe to Newsletter
                        </Link>

                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
import {ref} from "vue";
import AccountMenu from "@/views/components/account-menu.vue";
import {Button} from "flowbite-vue";
import AddressCreate from "@/views/components/account/address-create.vue";
import AddressEdit from "@/views/components/account/address-edit.vue";
import UserEdit from "@/views/components/account/user-edit.vue";
import PasswordEdit from "@/views/components/account/password-edit.vue";
defineProps({
    user:Object,
    status:Object,
    subscription:Object
})

const createAddress=ref(false)
const editAddress=ref(false)
const editUser=ref(false)
const  editPassword=ref(false)
</script>

<style scoped>

</style>
