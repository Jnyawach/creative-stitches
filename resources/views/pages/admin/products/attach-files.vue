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
                      <a class="text-teal-700" :href="route('admin.design.download',design.id)">{{design.file_name}}<span class="ml-1"><i class="fas fa-download"></i></span></a>
                    </td>
                    <td class="py-3 px-4">{{design.format.name}}(.{{design.format.abbreviation}})</td>
                <td>
                    <Link :href="route('admin.design.delete',design.id)" class="text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
                        <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete Artwork
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
