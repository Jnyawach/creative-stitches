<template>
<admin>
    <Head>
        <title>Create Products</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Attach Design to {{product.name}}</h6>
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
            <li>The embroidery file must measure <span class="text-teal-700 font-bold">{{product.design_size_mm}}mm</span> or <span class="text-teal-700 font-bold">{{product.design_size_inches}}inches</span></li>

        </ul>

        <div class="mt-4">
            <div class="mt-4 p-3 bg-teal-50 rounded-xl">
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-3 gap-3">
                        <div>

                            <select class="creative-input" required v-model="form.format_id">
                                <option selected value="">Select Design Format</option>
                                <option :value="format.id" v-for="format in formats" :key="format.id">{{format.name}} (.{{format.abbreviation}})</option>

                            </select>
                        </div>
                        <div>
                            <input type="file" @input="form.artwork=$event.target.files[0]" class="mt-3" required accept="application/zip">
                        </div>
                        <div>
                            <button type="submit" class="btn-primary mt-3">Save Design</button>
                        </div>
                    </div>
                    <div>
                        <div v-if="form.errors.format_id" class="creative-error">
                            <span>{{ form.errors.format_id}}</span>
                        </div>
                        <div v-if="form.errors.artwork" class="creative-error">
                            <span>{{ form.errors.artwork}}</span>
                        </div>
                    </div>
                </form>
            </div>
            <!--available Designs-->
            <table class="table-auto w-full mt-3 border-t">
                <thead class="bg-teal-50">
                <tr>
                    <td class="py-3 px-4 text-start">Design Format</td>
                    <td class="py-3 px-4 text-start">Artwork</td>
                    <td class="py-3 px-4 text-start">Action</td>
                </tr>
                </thead>
                <tbody >
                <tr v-for="design in designs" :key="design.id" class="border-b text-sm">
                    <td>
                      <a class="text-teal-700 flex gap-1" :href="route('admin.design.download',design.id)">
                          <span>{{design.file_name}}</span>
                          <svg class="h-4 fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M245.4 379.1C248.4 382.7 252.2 384 256 384s7.594-1.344 10.62-4.047l144-128c6.594-5.859 7.219-15.98 1.344-22.58c-5.875-6.625-16.06-7.234-22.59-1.328L272 332.4V16C272 7.156 264.8 0 256 0S240 7.156 240 16v316.4L122.6 228C116.1 222.1 105.9 222.8 100 229.4C94.16 235.1 94.78 246.1 101.4 251.1L245.4 379.1zM448 320h-48c-8.836 0-16 7.162-16 16c0 8.836 7.164 16 16 16H448c17.67 0 32 14.33 32 32v64c0 17.67-14.33 32-32 32H64c-17.67 0-32-14.33-32-32v-64c0-17.67 14.33-32 32-32h48C120.8 352 128 344.8 128 336C128 327.2 120.8 320 112 320H64c-35.35 0-64 28.65-64 64v64c0 35.35 28.65 64 64 64h384c35.35 0 64-28.65 64-64v-64C512 348.7 483.3 320 448 320zM440 416c0-13.25-10.75-24-24-24s-24 10.75-24 24s10.75 24 24 24S440 429.3 440 416z"/></svg>
                      </a>
                    </td>
                    <td class="py-3 px-4">{{design.format.name}}(.{{design.format.abbreviation}})</td>
                <td>
                    <Link :href="route('admin.design.delete',design.id)" class="flex gap-1 text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
                        <svg class="h-4 fill-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M144 400C144 408.8 136.8 416 128 416C119.2 416 112 408.8 112 400V176C112 167.2 119.2 160 128 160C136.8 160 144 167.2 144 176V400zM240 400C240 408.8 232.8 416 224 416C215.2 416 208 408.8 208 400V176C208 167.2 215.2 160 224 160C232.8 160 240 167.2 240 176V400zM336 400C336 408.8 328.8 416 320 416C311.2 416 304 408.8 304 400V176C304 167.2 311.2 160 320 160C328.8 160 336 167.2 336 176V400zM310.1 22.56L336.9 64H432C440.8 64 448 71.16 448 80C448 88.84 440.8 96 432 96H416V432C416 476.2 380.2 512 336 512H112C67.82 512 32 476.2 32 432V96H16C7.164 96 0 88.84 0 80C0 71.16 7.164 64 16 64H111.1L137 22.56C145.8 8.526 161.2 0 177.7 0H270.3C286.8 0 302.2 8.526 310.1 22.56V22.56zM148.9 64H299.1L283.8 39.52C280.9 34.84 275.8 32 270.3 32H177.7C172.2 32 167.1 34.84 164.2 39.52L148.9 64zM64 432C64 458.5 85.49 480 112 480H336C362.5 480 384 458.5 384 432V96H64V432z"/></svg>
                        <span>Delete Artwork</span>
                    </Link>
                </td>

                </tr>

                </tbody>
            </table>



        </div>
    </div>
    <template #sidebar>
        <Sidelink :link="route('products.index')" >
            Return to Products
        </Sidelink>
    </template>
</admin>
</template>

<script setup lang="ts">
import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
import Sidelink from "@/views/components/sidelink.vue";

let props=defineProps({
    product:Object,
    formats:Object,
    designs:Object
})

let form=useForm({
   format_id:'',
    artwork:'',
    product_id:props.product.id
})

const submit=()=>{
    form.post(route('save.files'),{
        onSuccess:()=>{
            form.reset()
        }
    })
}
</script>

<style scoped>

</style>
