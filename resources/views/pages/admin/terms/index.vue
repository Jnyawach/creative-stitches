<template>
<admin>
    <Head>
        <title>Creative Stitches Policy</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Creative Stitches Policy</h6>

        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> Creative Stitches Policy: Terms and Policies</p>
        </template>
    </title-block>

    <div class="mt-10 px-3">
        <div class="border rounded-xl p-2 mt-3" v-for="term in terms" :key="term.id">

                <h6 class="font-bold text-lg">
                    <span v-if="term.category==='terms'">Terms and Conditions</span>
                    <span v-else-if="term.category==='policy'">Privacy Policy</span>
                    <span v-else-if="term.category==='cookie'">Cookie Policy</span>
                    <span v-else-if="term.category==='refund'">Refund Policy</span>
                    <span v-else-if="term.category==='copyright'">Copyright Guidelines</span>
                </h6>
                <div class="flex gap-4 mt-3">
                    <p><span class="text-teal-700">Created on</span>{{new Date(term.created_at).toDateString()}}</p>
                    <p><span class="text-teal-700">Last Updated on</span>{{new Date(term.updated_at).toDateString()}}</p>
                </div>
                <div class="flex">
                    <Link :href="route('terms.edit',term.id)" class="text-teal-700 text-sm font-bold p-2 text-start" >
                        <span class="mr-2"><i class="fa-light fa-pen"></i></span>Edit
                    </Link>
                    <Link :href="route('terms.show',term.id)" class="text-teal-700 text-sm font-bold p-2 text-start">
                        <span class="mr-2"><i class="fa-regular fa-eye"></i></span>View
                    </Link>
                    <Link :href="route('terms.destroy',term.id)" class="text-red-700 text-sm font-bold p-2 text-start"  method="delete" as="button">
                        <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete
                    </Link>
                </div>

        </div>
    </div>

    <template #sidebar>
        <Sidelink :link="route('terms.create')">
           <span class="mr-2"><i class="fa-regular fa-plus"></i></span> Create Terms & Policy
        </Sidelink>
    </template>
</admin>

</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import TitleBlock from "@/views/components/title-block.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Sidelink from "@/views/components/sidelink.vue";

defineProps({
    terms:Object
})
</script>

<style scoped>

</style>
