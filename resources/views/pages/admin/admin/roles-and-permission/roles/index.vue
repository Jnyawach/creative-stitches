<template>
<admin>
 <Head>
     <title>Roles</title>
 </Head>
    <title-block>
        <h6 class="font-bold text-sm">System roles and permissions</h6>
        <template #info>
            <p class="text-sm"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> Adjusting roles will affect user access level</p>
        </template>
    </title-block>

    <!--page content-->
    <div class="mt-8">

        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-800">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 font-bold">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Id
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Created on
                    </th>

                    <th scope="col" class="py-3 px-6">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg-white border-b">
                    <td class="py-3 px-6">
                        28
                    </td>
                    <td class="py-3 px-6">
                        Sliver
                    </td>
                    <td class="py-3 px-6">
                        Laptop
                    </td>

                    <td class="py-3 px-6">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>

    </div>

    <template #sidebar>
        <sidelink :link="route('roles.index')">Roles</sidelink>
        <sidelink :link="route('permissions.index')">Permissions</sidelink>
        <div>
            <button type="button" class="btn-primary btn-small m-1"> <span class="mr-2"><i class="fal fa-plus"></i></span>Create role</button>
            <button type="button" class="btn-primary btn-small m-1"> <span class="mr-2"><i class="fal fa-plus"></i></span>Create Permission</button>

        </div>

    </template>
</admin>
</template>

<script setup lang="ts">
import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Sidelink from "@/views/components/sidelink.vue";
</script>

<style scoped>

</style>
