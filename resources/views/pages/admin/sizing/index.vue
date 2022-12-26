<template>
<admin>
    <Head>
        <title>Embroidery Size Chart</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Embroidery Size Chart</h6>
        <template #info >
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 mr-3 text-teal-900"><i class="fas fa-info-circle"></i></span>Common hoop sizes. Each design must follow this chart guideline</p>
        </template>
    </title-block>
    <div class="mt-10">
        <!--table search and name-->
        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Hoop (inches)</th>
                <th class="text-start py-3 px-4">Hoop (mm)</th>
                <th class="text-start py-3 px-4">Stitching Area (inches)</th>
                <th class="text-start py-3 px-4">Stitching Area (mm)</th>
                <th class="py-3 px-4 text-start">Action</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b" v-if="sizes" v-for="size in sizes" :key="size.id">
                <td class="py-3 px-4">{{ size.id }}</td>
                <td class="py-3 px-4">{{ size.size_in_inches }}</td>
                <td class="py-3 px-4">{{ size.size_in_mm }}</td>
                <td class="py-3 px-4">{{ size.stitching_area_inches }}</td>
                <td class="py-3 px-4">{{ size.stitching_area_mm }}</td>
                <td class="py-3 px-4">
                    <dropdown placement="bottom">
                        <template #trigger="{ toggle }">
                            <button @click="toggle" >
                                Action <span class="self-center"><i class="far fa-ellipsis-v-alt"></i></span>
                            </button>
                        </template>
                        <div class="shadow w-36">
                            <ul class="divide-y">
                                <li class="hover:bg-gray-100 ">
                                    <Link :href="route('sizing.destroy',size.id)" class="text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
                                        <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete
                                    </Link>
                                </li>
                                <li class="hover:bg-gray-100">
                                    <button class="p-2 w-full h-full text-start" @click="editSize(size)">
                                        <span class="mr-2"><i class="fal fa-pen"></i></span>Edit
                                    </button>
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
        <div>
            <button type="button" class="btn-primary btn-small m-1" @click="showModal=true"> <span class="mr-2"><i class="fal fa-plus"></i></span>Add Size</button>
        </div>

        <!--create Size modal-->

        <modal :show="showModal" @close="showModal=false">
            <template #header>
                <h6 class="font-bold text-lg">Add size to embroidery size chart</h6>
            </template>
            <div>
                <form @submit.prevent="submit" id="category-form">
                   <div class="grid grid-cols-2 mt-3 gap-3">
                       <div>
                           <label for="size_in_inches" class="creative-label">Size in Inches:</label>
                           <div>
                               <small>For Example: 4 by 4 (Do not include units)</small>
                           </div>
                           <input type="text" class="creative-input" id="size_in_inches" placeholder="Hoop size in inches"
                                  required v-model="form.size_in_inches"/>
                           <div v-if="form.errors.size_in_inches" class="creative-error">
                               <span>{{ form.errors.size_in_inches }}</span>
                           </div>
                       </div>

                       <div>
                           <label for="size_in_inches" class="creative-label">Size in Centimetres:</label>
                           <div>
                               <small>For Example: 100 by 100 (Do not include units)</small>
                           </div>
                           <input type="text" class="creative-input" id="size_in_inches" placeholder="Hoop size in mm"
                                  required v-model="form.size_in_mm"/>
                           <div v-if="form.errors.size_in_mm" class="creative-error">
                               <span>{{ form.errors.size_in_mm }}</span>
                           </div>
                       </div>
                   </div>
                    <div class="grid grid-cols-2 mt-3 gap-3">
                        <div>
                            <label for="size_in_inches" class="creative-label">Stitching are in Inches:</label>
                            <div>
                                <small>For Example: 3.93 by 3.93 (Do not include units)</small>
                            </div>
                            <input type="text" class="creative-input" id="size_in_inches" placeholder="Stitching are in Inches"
                                   required v-model="form.stitching_area_inches"/>
                            <div v-if="form.errors.stitching_area_inches" class="creative-error">
                                <span>{{ form.errors.stitching_area_inches }}</span>
                            </div>
                        </div>

                        <div>
                            <label for="size_in_inches" class="creative-label">Stitching are in mm:</label>
                            <div>
                                <small>For Example: 100 by 100 (Do not include units)</small>
                            </div>
                            <input type="text" class="creative-input" id="size_in_inches" placeholder="Stitching are in mm"
                                   required v-model="form.stitching_area_mm"/>
                            <div v-if="form.errors.stitching_area_mm" class="creative-error">
                                <span>{{ form.errors.stitching_area_mm }}</span>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <template #footer >
                <div class="flex justify-end">
                    <button class="btn-primary text-sm" type="submit" form="category-form">Save Size</button>
                </div>
            </template>

        </modal>
        <!--create Size Edit modal-->
        <modal :show="showEditModal" @close="showEditModal=false">
            <template #header>
                <h6 class="font-bold text-lg">Update Size Chart</h6>
            </template>
            <div>
                <form @submit.prevent="update" id="update-form">

                    <div class="grid grid-cols-2 mt-3 gap-3">
                        <div>
                            <label for="size_in_inches" class="creative-label">Size in Inches:</label>
                            <div>
                                <small>For Example: 4 by 4 (Do not include units)</small>
                            </div>
                            <input type="text" class="creative-input" id="size_in_inches" placeholder="Hoop size in inches"
                                   required v-model="updateForm.size_in_inches"/>
                            <div v-if="updateForm.errors.size_in_inches" class="creative-error">
                                <span>{{ updateForm.errors.size_in_inches }}</span>
                            </div>
                        </div>

                        <div>
                            <label for="size_in_inches" class="creative-label">Size in Centimetres:</label>
                            <div>
                                <small>For Example: 100 by 100 (Do not include units)</small>
                            </div>
                            <input type="text" class="creative-input" id="size_in_inches" placeholder="Hoop size in mm"
                                   required v-model="updateForm.size_in_mm"/>
                            <div v-if="updateForm.errors.size_in_mm" class="creative-error">
                                <span>{{ updateForm.errors.size_in_mm }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 mt-3 gap-3">
                        <div>
                            <label for="size_in_inches" class="creative-label">Stitching are in Inches:</label>
                            <div>
                                <small>For Example: 3.93 by 3.93 (Do not include units)</small>
                            </div>
                            <input type="text" class="creative-input" id="size_in_inches" placeholder="Stitching are in Inches"
                                   required v-model="updateForm.stitching_area_inches"/>
                            <div v-if="updateForm.errors.stitching_area_inches" class="creative-error">
                                <span>{{ updateForm.errors.stitching_area_inches }}</span>
                            </div>
                        </div>

                        <div>
                            <label for="size_in_inches" class="creative-label">Stitching are in mm:</label>
                            <div>
                                <small>For Example: 100 by 100 (Do not include units)</small>
                            </div>
                            <input type="text" class="creative-input" id="size_in_inches" placeholder="Stitching are in mm"
                                   required v-model="updateForm.stitching_area_mm"/>
                            <div v-if="updateForm.errors.stitching_area_mm" class="creative-error">
                                <span>{{ updateForm.errors.stitching_area_mm }}</span>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <template #footer >
                <div class="flex justify-end">
                    <button class="btn-primary text-sm" type="submit" form="update-form">Update Size</button>
                </div>
            </template>

        </modal>
    </template>
</admin>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import Admin from "@/views/layouts/admin.vue";
import TitleBlock from "@/views/components/title-block.vue";
import {ref} from "vue";
import Modal from "@/views/components/modal.vue"
import {useForm} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
import { Dropdown, Button} from 'flowbite-vue'

defineProps({
    sizes:Object
})
let form=useForm({
    size_in_inches:'',
    size_in_mm:'',
    stitching_area_mm:'',
    stitching_area_inches:''
})
const showModal=ref(false)

//submit size
let submit=()=>{
    form.post(route('sizing.store'),{
        onSuccess:()=>{
            form.reset()
            showModal.value=false

        }
    })}

//editing size chart
const showEditModal=ref(false)
let updateForm=useForm({
    size_in_inches:'',
    size_in_mm:'',
    stitching_area_mm:'',
    stitching_area_inches:'',
    id:''
})
const editSize=(size:any)=>{
    showEditModal.value=true;
    updateForm.size_in_inches=size.size_in_inches;
    updateForm.size_in_mm=size.size_in_mm;
    updateForm.stitching_area_inches=size.stitching_area_inches;
    updateForm.stitching_area_mm=size.stitching_area_mm;
    updateForm.id=size.id;
}

let update=()=>{

    updateForm.patch(route('sizing.update',updateForm.id),{
        onSuccess:()=>{
            updateForm.reset()
            showEditModal.value=false

        }
    })
}
</script>

<style scoped>

</style>
