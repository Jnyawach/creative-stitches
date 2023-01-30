<template>
<admin>
    <Head>
        <title>{{product.name}}</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">{{product.name}}</h6>
        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 mr-3 text-teal-900"><i class="fas fa-info-circle"></i></span>{{product.name}}</p>
        </template>
    </title-block>

    <div class="mt-10 px-3">
        <h6 class="font-bold text-teal-700">Product Details</h6>
        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Sku</th>
                <th class="text-start py-3 px-4">Mpn</th>
                <th class="text-start py-3 px-4">Price($)</th>
                <th class="text-start py-3 px-4">Category</th>
                <th class="text-start py-3 px-4">Total Stitches</th>
                <th class="text-start py-3 px-4">Design Size(mm)</th>
                <th class="text-start py-3 px-4 ">Design Size(in)</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b text-[13px] font-medium">
                <td class="py-3 px-4 text-start">{{ product.id }}</td>
                <td class="py-3 px-4 text-start">{{product.sku }}</td>
                <td class="py-3 px-4 text-start">{{product.mpn }}</td>
                <td class="py-3 px-4 text-start">{{Number(product.price).toFixed(2)}}</td>
                <td class="py-3 px-4 text-start">{{product.category.name}}</td>
                <td class="py-3 px-4 text-start">{{product.total_stitches}}</td>
                <td class="py-3 px-4 text-start">{{product.design_size_mm}}</td>
                <td class="py-3 px-4 text-start">{{product.design_size_inches}}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-10 px-3">
        <h6 class="font-bold text-teal-700">Embroidery Designs attached to product</h6>
        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">File name</th>
                <th class="text-start py-3 px-4">File Format</th>



            </tr>
            </thead>
            <tbody>
            <tr class="border-b text-[13px] font-medium" v-for="embroidery in product.embroideries" :key="embroidery.id">
                <td class="py-3 px-4 text-start">{{ embroidery.id}}</td>
                <td class="py-3 px-4 text-start">{{embroidery.file_name }}</td>
                <td class="py-3 px-4 text-start">{{embroidery.format.name}} (.{{embroidery.format.abbreviation}})</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="mt-10 px-3">
        <h6 class="text-teal-700 font-bold">Product Description</h6>
        <div  v-html="product.description"></div>

        <h6 class="text-teal-700 font-bold mt-3">Meta Description</h6>
        <p>{{product.meta_description}}</p>
        <h6 class="text-teal-700 font-bold mt-3">Product Keywords</h6>
        <p>{{product.meta_description}}</p>

        <div>
            <h6 class="text-teal-700 font-bold mt-3">Color Chart</h6>
            <a :href="product.colorChart" class="font-bold" v-show="product.colorChart">
                <span class="mr-2"><i class="fal fa-file-pdf"></i></span>Color Chart <span class="ml-2"><i class="fas fa-download"></i></span></a>
        </div>
        <h6 class="text-teal-700 font-bold mt-3">Product Images</h6>
        <div class="mt-3 grid grid-cols-4 gap-2">

            <img :src="product.mainImage.icon">
            <img :src="product.secondImage.icon">
            <img :src="product.thirdImage.icon">
            <img :src="product.fourthImage.icon">
        </div>
    </div>

    <template #sidebar>
        <div class="mt-3">
            <Sidelink :link="route('attach.files',product.id)">
               <span class="mr-1"><i class="far fa-plus"></i></span> Add embroidery Files
            </Sidelink>
            <Sidelink :link="route('products.edit',product.id)">
                <span class="mr-1"><i class="far fa-pen"></i></span> Edit Product
            </Sidelink>
            <Sidelink >
                <span class="mr-1"><i class="fas fa-comments-alt"></i></span> View Product Reviews
            </Sidelink>
        </div>
    </template>
</admin>
</template>

<script  setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import Admin from "@/views/layouts/admin.vue";
import TitleBlock from "@/views/components/title-block.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Sidelink from "@/views/components/sidelink.vue";
let props=defineProps({
    product:Object
})
const product=props.product.data;
</script>

<style scoped>

</style>
