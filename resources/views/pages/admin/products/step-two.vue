<template>
<admin>
    <Head>
        <title>Create Products</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Create Products Step 2 of 2</h6>
        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 mr-3 text-teal-900"><i class="fas fa-info-circle"></i></span>{{product.name}}</p>
        </template>
    </title-block>
    <div class="mt-8 px-3">
        <h1 class="font-bold text-xl">Attach Embroidery Designs to this Product</h1>
        <p class="text-teal-700 mt-3">Please not the following:</p>
        <ul class="list-disc px-3">
            <li>Compress all the files and save a .zip</li>
            <li>The embroidery file must match the size selected  when uploading</li>
            <li>Design formats to be included are DST, </li>
        </ul>
    </div>
</admin>
</template>

<script setup lang="ts">
import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {useForm} from "@inertiajs/inertia-vue3";

defineProps({
    product:Object,
    sizes:Object
})
</script>

<style scoped>

</style>
