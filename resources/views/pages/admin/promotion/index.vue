<template>
<admin>
    <Head>
        <title>Promotions</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Available Promotions</h6>
        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 mr-3 text-teal-900"><i class="fas fa-info-circle"></i></span>Running promotions</p>
        </template>
    </title-block>
    <div class="mt-10">
        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Name</th>
                <th class="text-start py-3 px-4">Products</th>
                <th class="text-start py-3 px-4">Discount</th>
                <th class="py-3 px-4 text-start">Action</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b" v-if="promotions.data" v-for="promotion in promotions.data" :key="promotion.id">
                <td class="py-3 px-4">{{ promotion.id }}</td>
                <td class="py-3 px-4">{{ promotion.name }}</td>
                <td class="py-3 px-4">{{ promotion.products_count }}</td>
                <td class="py-3 px-4">{{ promotion.discount }}</td>
                <td class="py-3 px-4">
                    <dropdown placement="bottom">
                        <template #trigger="{ toggle }">
                            <Button @click="toggle" >
                                Action <span class="self-center"><i class="far fa-ellipsis-v-alt"></i></span>
                            </Button>
                        </template>
                        <div class="shadow w-36">
                            <ul class="divide-y">
                                <li class="hover:bg-gray-100">
                                    <Link :href="route('promotion.show',promotion.id)" class="text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
                                        <span class="mr-2"><i class="fal fa-bookmark"></i></span>View Promotion
                                    </Link>
                                </li>

                                <li class="hover:bg-gray-100 py-2">
                                    <Link :href="route('promotion.edit',promotion.id)" class="text-sm font-bold p-2 w-full h-full text-start" >
                                        <span class="mr-2"><i class="fal fa-pen"></i></span>Edit Promotion
                                    </Link>
                                </li>

                                <li class="hover:bg-gray-100">
                                    <Link :href="route('promotion.destroy',promotion.id)" class="text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
                                        <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete
                                    </Link>
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
        <Sidelink :link="route('promotion.create')">
           <span class="mr-2"><i class="far fa-plus"></i></span> Create Promotion
        </Sidelink>
    </template>
</admin>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import Admin from "@/views/layouts/admin.vue";
import TitleBlock from "@/views/components/title-block.vue";
import Sidelink from "@/views/components/sidelink.vue";
import {Link} from "@inertiajs/inertia-vue3";
import { Dropdown} from 'flowbite-vue'
let props=defineProps({
    promotions:Object
})

</script>

<style scoped>

</style>
