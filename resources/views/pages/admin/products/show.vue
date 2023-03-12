<template>
<admin>
    <Head>
        <title>{{product.name}}</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">{{product.name}}</h6>
        <template #info >
            <p class="text-sm flex gap-2">
                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                <span>{{product.name}}</span>
            </p>

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
            <a :href="product.colorChart" class="font-bold flex gap-1" v-show="product.colorChart">
                <span>Color Chart</span>
                <svg class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M245.4 379.1C248.4 382.7 252.2 384 256 384s7.594-1.344 10.62-4.047l144-128c6.594-5.859 7.219-15.98 1.344-22.58c-5.875-6.625-16.06-7.234-22.59-1.328L272 332.4V16C272 7.156 264.8 0 256 0S240 7.156 240 16v316.4L122.6 228C116.1 222.1 105.9 222.8 100 229.4C94.16 235.1 94.78 246.1 101.4 251.1L245.4 379.1zM448 320h-48c-8.836 0-16 7.162-16 16c0 8.836 7.164 16 16 16H448c17.67 0 32 14.33 32 32v64c0 17.67-14.33 32-32 32H64c-17.67 0-32-14.33-32-32v-64c0-17.67 14.33-32 32-32h48C120.8 352 128 344.8 128 336C128 327.2 120.8 320 112 320H64c-35.35 0-64 28.65-64 64v64c0 35.35 28.65 64 64 64h384c35.35 0 64-28.65 64-64v-64C512 348.7 483.3 320 448 320zM440 416c0-13.25-10.75-24-24-24s-24 10.75-24 24s10.75 24 24 24S440 429.3 440 416z"/></svg>
            </a>
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
            <Link :href="route('attach.files',product.id)" class="flex gap-1 font-semibold">
                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M432 256C432 264.8 424.8 272 416 272h-176V448c0 8.844-7.156 16.01-16 16.01S208 456.8 208 448V272H32c-8.844 0-16-7.15-16-15.99C16 247.2 23.16 240 32 240h176V64c0-8.844 7.156-15.99 16-15.99S240 55.16 240 64v176H416C424.8 240 432 247.2 432 256z"/></svg>
                <span>Add Embroidery Files</span>
            </Link>
            <Link :href="route('products.edit',product.id)" class="flex gap-1 font-semibold">
                <svg class="h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M495 59.6C516.9 81.47 516.9 116.9 495 138.8L182.3 451.6C170.9 462.9 156.9 471.2 141.5 475.8L20.52 511.4C14.9 513 8.827 511.5 4.687 507.3C.5466 503.2-1.002 497.1 .6506 491.5L36.23 370.5C40.76 355.1 49.09 341.1 60.44 329.7L373.2 16.97C395.1-4.897 430.5-4.897 452.4 16.97L495 59.6zM341 94.4L417.6 170.1L472.4 116.2C481.8 106.8 481.8 91.6 472.4 82.23L429.8 39.6C420.4 30.23 405.2 30.23 395.8 39.6L341 94.4zM318.4 117L83.07 352.4C75.5 359.9 69.95 369.3 66.93 379.6L39.63 472.4L132.4 445.1C142.7 442.1 152.1 436.5 159.6 428.9L394.1 193.6L318.4 117z"/></svg>
                <span>Edit</span>
            </Link>

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
