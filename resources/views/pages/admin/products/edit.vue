<template>
    <admin>
        <Head>
            <title>Create Products</title>
        </Head>
        <title-block>
            <h6 class="font-bold text-sm">Create Products Step 1 of 2</h6>
            <template #info >
                <p class="text-sm flex gap-2">
                    <svg class="fill-teal-700 h-5 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                    <span>Edit Products</span>
                </p>
            </template>
        </title-block>
        <div class="mt-10 px-3">
            <form @submit.prevent="form.post(route('products.update',product.id))">
                <div class="grid mt-4">
                    <div>
                        <label class="creative-label">Product Name:</label>
                        <input type="text" v-model="form.name" class="creative-input" required>
                        <div v-if="form.errors.name" class="creative-error">
                            <span>{{ form.errors.name }}</span>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3 mt-4">
                    <div>
                        <label class="creative-label">Product Price($):</label>
                        <input type="text" v-model="form.price" class="creative-input" required>
                        <div v-if="form.errors.price" class="creative-error">
                            <span>{{ form.errors.price }}</span>
                        </div>
                    </div>

                    <div>
                        <label class="creative-label">Product Status:</label>
                        <select class="creative-input" required v-model="form.status">
                            <option selected value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <div v-if="form.errors.status" class="creative-error">
                            <span>{{ form.errors.status }}</span>
                        </div>
                    </div>

                    <div>
                        <label class="creative-label">Product Category:</label>
                        <select class="creative-input" required v-model="form.category_id">
                            <option selected value="">Select Category</option>
                            <option :value="category.id" v-for="category in categories" :key="category.id">{{category.name}}</option>

                        </select>
                        <div v-if="form.errors.category_id" class="creative-error">
                            <span>{{ form.errors.category_id}}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <hr>
                    <h6 class="font-bold text-lg text-teal-700">Design information</h6>
                    <p>This section ill contact information related to embroidery file that
                        will be attached to thus product. Designs can only be attached after creating the product</p>
                    <div class="grid grid-cols-2 gap-3 mt-4">
                        <div>
                            <label class="creative-label">Total Stitches:</label>
                            <div>
                                <small>Enter the total stitches for the design e.g. 10020</small>
                            </div>
                            <input type="text" v-model="form.total_stitches" class="creative-input" required>

                            <div v-if="form.errors.total_stitches" class="creative-error">
                                <span>{{ form.errors.total_stitches }}</span>
                            </div>
                        </div>
                        <div>
                            <label class="creative-label">Hoop Size:</label>
                            <div>
                                <small>Select hoop size. Design size mus be within hoop size</small>
                            </div>
                            <select class="creative-input" required v-model="form.size_id">
                                <option selected value="">Select Hoop size</option>
                                <option :value="size.id" v-for="size in sizes" :key="size.id">{{size.size_in_mm}} mm | {{size.size_in_inches}} inches</option>

                            </select>
                            <div v-if="form.errors.size_id" class="creative-error">
                                <span>{{ form.errors.size_id }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mt-4">
                        <div>
                            <label class="creative-label">Design size in mm:</label>
                            <div>
                                <small>Example: 92 by 128 (Do not include units)</small>
                            </div>
                            <input type="text" v-model="form.design_size_mm" class="creative-input" required>

                            <div v-if="form.errors.design_size_mm" class="creative-error">
                                <span>{{ form.errors.design_size_mm }}</span>
                            </div>
                        </div>

                        <div>
                            <label class="creative-label">Design size in inches:</label>
                            <div>
                                <small>Example: 10.2 by 10.2 (Do not include units)</small>
                            </div>
                            <input type="text" v-model="form.design_size_inches" class="creative-input" required>

                            <div v-if="form.errors.design_size_inches" class="creative-error">
                                <span>{{ form.errors.design_size_inches }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid mt-4">
                        <div>
                            <label class="creative-label">Color Chart:</label>
                            <div>
                                <small>Provide color chart to help in stitching. Accepted format PDF</small>
                            </div>
                            <input type="file" @input="form.color_chart=$event.target.files[0]" class="mt-3" accept="application/pdf">

                            <div v-if="form.errors.color_chart" class="creative-error">
                                <span>{{ form.errors.color_chart }}</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid mt-4">
                    <div>
                        <label class="creative-label">Meta Description:</label>
                        <div>
                            <small>Provide a small description about 150 words for SEO</small>
                        </div>
                        <textarea class="creative-text-input" rows="4" v-model="form.meta_description" required></textarea>
                        <div v-if="form.errors.meta_description" class="creative-error">
                            <span>{{ form.errors.meta_description }}</span>
                        </div>
                    </div>
                </div>
                <div class="grid mt-4">
                    <div>
                        <label class="creative-label">Keywords:</label>
                        <div>
                            <small>Enter Keywords separated by a comma</small>
                        </div>
                        <textarea class="creative-text-input" rows="4" v-model="form.keywords" required></textarea>
                        <div v-if="form.errors.keywords" class="creative-error">
                            <span>{{ form.errors.keywords}}</span>
                        </div>
                    </div>
                </div>
                <div class="grid mt-4">
                    <div>
                        <label class="creative-label">Product Description:</label>
                        <div>
                            <small>Keyword rich text to enhance SEO </small>
                        </div>
                        <Editor
                            api-key="51d8ossp03q7qv63ctin9qbrlio19sszyf8j8u5vmlq44ui3"
                            :init="{
                  plugins: 'lists link image table code help wordcount',
                  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat'
                   }"
                            v-model="form.description"
                        />
                        <div v-if="form.errors.description" class="creative-error">
                            <span>{{ form.errors.description}}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h6>Product images:</h6>
                    <div>
                        <small>Acceptable file types png, jpg, jpeg. All Images must be square and measure 1000px by 1000px</small>
                    </div>
                    <div class="grid mt-3 grid-cols-4">

                        <div class="col-span-1">
                            <h6>Main Image</h6>
                            <input type="file" @change="showImagePreview($event)" ref="mainImage" accept="image/*" class="hidden">
                            <div @click="$refs.mainImage.click()"
                                 class="border rounded-xl w-36 h-36 mt-3 flex place-content-center cursor-pointer bg-gray-50 bg-center bg-cover"
                                 :style="{ 'background-image': `url(${previewMainImage})` }">
                                <p class="self-center font-bold bg-gray-100 px-3 py-2 bg-opacity-40 rounded">Select Image</p>

                            </div>
                            <div v-if="form.errors.main_image" class="creative-error">
                                <span>{{ form.errors.main_image}}</span>
                            </div>
                        </div>

                        <div class="col-span-1">
                            <h6>Second Image</h6>
                            <input type="file" @change="showSecondPreview($event)" ref="secondImage" accept="image/*" class="hidden">
                            <div @click="$refs.secondImage.click()"
                                 class="border rounded-xl w-36 h-36 mt-3 flex place-content-center cursor-pointer bg-gray-50 bg-center bg-cover"
                                 :style="{ 'background-image': `url(${previewSecondImage})` }">
                                <p class="self-center font-bold bg-gray-100 px-3 py-2 bg-opacity-40 rounded">Select Image</p>

                            </div>
                            <div v-if="form.errors.second_image" class="creative-error">
                                <span>{{ form.errors.second_image}}</span>
                            </div>
                        </div>

                        <div class="col-span-1">
                            <h6>Third Image</h6>
                            <input type="file" @change="showThirdPreview($event)" ref="thirdImage" accept="image/*" class="hidden">
                            <div @click="$refs.thirdImage.click()"
                                 class="border rounded-xl w-36 h-36 mt-3 flex place-content-center cursor-pointer bg-gray-50 bg-center bg-cover"
                                 :style="{ 'background-image': `url(${previewThirdImage})` }">
                                <p class="self-center font-bold bg-gray-100 px-3 py-2 bg-opacity-40 rounded">Select Image</p>

                            </div>
                            <div v-if="form.errors.third_image" class="creative-error">
                                <span>{{ form.errors.third_image}}</span>
                            </div>
                        </div>

                        <div class="col-span-1">
                            <h6>Fourth Image</h6>
                            <input type="file" @change="showFourthPreview($event)" ref="fourthImage" accept="image/*" class="hidden">
                            <div @click="$refs.fourthImage.click()"
                                 class="border rounded-xl w-36 h-36 mt-3 flex place-content-center cursor-pointer bg-gray-50 bg-center bg-cover"
                                 :style="{ 'background-image': `url(${previewFourthImage})` }">
                                <p class="self-center font-bold bg-gray-100 px-3 py-2 bg-opacity-40 rounded">Select Image</p>

                            </div>
                            <div v-if="form.errors.fourth_image" class="creative-error">
                                <span>{{ form.errors.fourth_image}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <hr>
                </div>

                <div class="mt-3 flex justify-end">
                    <button type="submit" class="btn-primary">Update Product <span class="ml-2"><i class="fa-regular fa-arrow-right-long"></i></span></button>
                </div>
            </form>
        </div>

        <template #sidebar>
            <div class="mt-3 p-2">
                <h6 class="font-bold">Main image</h6>
                <img :src="product.mainImage.icon">
            </div>
            <h6 class="font-bold">Other Images</h6>
            <div class="mt-3 p-2 grid grid-cols-2 gap-2">
                <img :src="product.secondImage.icon">
                <img :src="product.thirdImage.icon">
                <img :src="product.fourthImage.icon">
            </div>

            <div class="mt-3 p-2">
                <h6 class="font-bold">Color Chart and Work Sheet</h6>
                <Link :href="product.colorChart" class="text-teal-700" v-show="product.colorChart"><span class="mr-2"><i class="fal fa-file-pdf"></i></span>Color Chart</Link>
            </div>
        </template>
    </admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import Editor from '@tinymce/tinymce-vue'
import {ref} from "vue";
import {Link} from "@inertiajs/inertia-vue3";
let props=defineProps({
    categories:Object,
    sizes:Object,
    product:Object
})
const product=props.product.data
let form=useForm({
    name:product.name,
    price:product.price,
    description:product.description,
    category_id:product.category_id,
    status:product.status,
    meta_description:product.meta_description,
    keywords:product.keywords,
    main_image:'',
    second_image:'',
    third_image:'',
    fourth_image:'',
    total_stitches:product.total_stitches,
    size_id:product.size_id,
    color_chart:'',
    design_size_mm:product.design_size_mm,
    design_size_inches:product.design_size_inches,
    _method:'PATCH'

})


//Main Image
const previewMainImage=ref(null)
const  mainImage=ref(null);
const showImagePreview= (event:any)=> {
    mainImage.value = event.target;
    if (mainImage.value.files && mainImage.value.files[0]) {
        form.main_image=mainImage.value.files[0]
        let reader = new FileReader();
        reader.onload = (e) => {
            previewMainImage.value = e.target.result;
        };
        reader.readAsDataURL(mainImage.value.files[0]);
    }
}

//Second Image

const previewSecondImage=ref(null)
const  secondImage=ref(null);
const showSecondPreview= (event:any)=> {
    console.log(event)
    secondImage.value = event.target;
    if (secondImage.value.files && secondImage.value.files[0]) {
        form.second_image=secondImage.value.files[0]
        let reader = new FileReader();
        reader.onload = (e) => {
            previewSecondImage.value = e.target.result;
        };
        reader.readAsDataURL(secondImage.value.files[0]);
    }
}

//Third Image

const previewThirdImage=ref(null)
const thirdImage=ref(null);
const showThirdPreview= (event:any)=> {
    console.log(event)
    thirdImage.value = event.target;
    if (thirdImage.value.files && thirdImage.value.files[0]) {
        form.third_image=thirdImage.value.files[0]
        let reader = new FileReader();
        reader.onload = (e) => {
            previewThirdImage.value = e.target.result;
        };
        reader.readAsDataURL(thirdImage.value.files[0]);
    }
}

//fourth Image

const previewFourthImage=ref(null)
const fourthImage=ref(null);
const showFourthPreview= (event:any)=> {
    console.log(event)
    thirdImage.value = event.target;
    if (fourthImage.value.files && fourthImage.value.files[0]) {
        form.fourth_image=fourthImage.value.files[0]
        let reader = new FileReader();
        reader.onload = (e) => {
            previewFourthImage.value = e.target.result;
        };
        reader.readAsDataURL(fourthImage.value.files[0]);
    }
}
</script>

<style scoped>

</style>
