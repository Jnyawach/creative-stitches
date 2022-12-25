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
        <h6 class="font-bold text-lg">
            <span v-if="term.category==='terms'">Terms and Conditions</span>
            <span v-else-if="term.category==='policy'">Privacy Policy</span>
            <span v-else-if="term.category==='cookie'">Cookie Policy</span>
            <span v-else-if="term.category==='refund'">Refund Policy</span>
            <span v-else-if="term.category==='copyright'">Copyright Guidelines</span>
        </h6>

        <div class="mt-2 leading-7" v-html="term.content"/>
    </div>

    <template #sidebar>
       <div class="mt-3">
           <Link :href="route('terms.edit',term.id)" class="btn-primary m-2" >
               <span class="mr-2"><i class="fa-light fa-pen"></i></span>Edit
           </Link>
           <Link :href="route('terms.destroy',term.id)" class="btn-danger m-2"  method="delete" as="button">
               <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete
           </Link>
       </div>
    </template>
</admin>
</template>

<script setup lang="ts">
import Admin from "@/views/layouts/admin.vue";
import TitleBlock from "@/views/components/title-block.vue";
import {Link} from "@inertiajs/inertia-vue3";


defineProps({
    term:Object
})
</script>

<style scoped>

</style>
