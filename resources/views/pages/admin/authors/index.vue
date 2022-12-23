<template>
<admin>
    <Head>
        <title>Authors</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Authors</h6>
        <template #info>
            <p class="text-sm" v-if="$page.props.status"><span class="ml-2 mr-2 text-teal-900"><i class="fas fa-info-circle"></i></span>{{$page.props.status}}</p>
            <p class="text-sm" v-else><span class="ml-2 mr-2 text-teal-900"><i class="fas fa-info-circle"></i></span> Contains Authors for Blog Posts</p>
        </template>
    </title-block>

    <div class="mt-10">
        <!--table search and name-->
        <table class="table-auto w-full mt-3 border-t">
            <thead>
            <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Avatar</th>
                <th class="text-start py-3 px-4">Name</th>
                <th class="text-start py-3 px-4">Profile</th>
                <th class="py-3 px-4 text-start">Action</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b" v-if="authors.data" v-for="author in authors.data" :key="author.id">
                <td class="py-3 px-4">{{ author.id }}</td>
                <td class="py-3 px-4">
                    <img :src="author.avatar" class="w-10">
                </td>
                <td class="py-3 px-4">{{ author.name }} {{ author.last_name }}</td>
                <td class="py-3 px-4">
                    <Link :href="author.profile" title="Author Profile">Profile</Link>
                </td>
                <td class="py-3 px-4">
                    <dropdown placement="bottom">
                        <template #trigger="{ toggle }">
                            <Button @click="toggle" >
                                Action <span class="self-center"><i class="far fa-ellipsis-v-alt"></i></span>
                            </Button>
                        </template>
                        <div class="shadow w-36">
                            <ul class="divide-y">
                                <li class="hover:bg-gray-100 ">
                                    <Link :href="route('authors.destroy',author.id)" class="text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
                                        <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete
                                    </Link>
                                </li>
                                <li class="hover:bg-gray-100">
                                    <button class="p-2 w-full h-full text-start" @click="editAuthor(author)">
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
        <div class="bg-gray-50 p-3 flex justify-between">
            <div class="self-center">
                <h6 class="font-medium">Showing <span class="text-sky-800">{{ authors.current_page }}</span> of <span
                    class="text-sky-800">{{ authors.last_page }}</span> Page(s)</h6>
            </div>
            <div class="flex">
                <Link :href="authors.prev_page_url" class="btn-primary text-xs m-1" v-if="authors.prev_page_url"><span
                    class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                </Link>
                <Link :href="authors.next_page_url" class="btn-primary text-xs m-1" v-if="authors.next_page_url">Next
                    <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

            </div>

        </div>
    </div>
<template #sidebar>
    <div>
        <button type="button" class="btn-primary btn-small m-1" @click="showModal=true"> <span class="mr-2"><i class="fal fa-plus"></i></span>Author</button>
    </div>

    <!--Create author modal-->
    <modal :show="showModal" @close="showModal=false">
        <template #header>
            <h6 class="font-bold text-lg">Create Author</h6>
        </template>
        <div>
            <form @submit.prevent="submit" id="author-form">
                <div class="grid grid-cols-2 gap-2">
                    <div class="mt-3">
                        <label for="author-name" class="creative-label">First Name:</label>
                        <input type="text" class="creative-input" id="author-name" placeholder="Author First Name"
                               required v-model="form.first_name"/>
                        <div v-if="form.errors.first_name" class="creative-error">
                            <span>{{ form.errors.first_name }}</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="author-guard" class="creative-label">Last Name:</label>
                        <input type="text" class="creative-input" id="author-guard" placeholder="Enter Author Last Name"
                               required v-model="form.last_name"/>
                        <div v-if="form.errors.last_name" class="creative-error">
                            <span>{{ form.errors.last_name }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <label for="author-guard" class="creative-label">Profile Link:</label>
                    <div>
                        <small>Provide social media link (Twitter/Medium/Facebook) or personal website link</small>
                    </div>
                    <input type="text" class="creative-input" id="author-guard" placeholder="Enter Author Profile Link"
                           required v-model="form.profile_link"/>
                    <div v-if="form.errors.profile_link" class="creative-error">
                        <span>{{ form.errors.profile_link }}</span>
                    </div>
                </div>

                <div class="grid mt-5">
                    <div>
                        <label class="sumo-label" for="post_image">Profile Photo:</label>
                        <div>
                            <small class="font-medium">Accepted file types PNG, JPG, JPEG. Maximum size of 2MB</small>
                        </div>
                    </div>
                    <input type="file" @input="form.avatar=$event.target.files[0]" class="mt-4"  for="avatar" required>
                    <div v-if="form.errors.avatar" class="creative-error" id="avatar">
                        <span class="text-xs">{{ form.errors.avatar}}</span>
                    </div>
                </div>

            </form>
        </div>
        <template #footer >
            <div class="flex justify-end">
                <button class="btn-primary text-sm" type="submit" form="author-form">Save Author</button>
            </div>
        </template>

    </modal>

    <!-- Edit Role create modal-->
    <modal :show="showEditModal" @close="showEditModal=false">
        <template #header>
            <h6 class="font-bold text-lg">Update Author</h6>
        </template>
        <div>
            <img :src="avatar" class="w-14 my-3">
            <form @submit.prevent="update" id="role-form-update">
                <div class="grid grid-cols-2 gap-2">
                    <div class="mt-3">
                        <label for="author-name" class="creative-label">First Name:</label>
                        <input type="text" class="creative-input" id="author-name" placeholder="Author First Name"
                               required v-model="updateForm.first_name"/>
                        <div v-if="updateForm.errors.first_name" class="creative-error">
                            <span>{{ updateForm.errors.first_name }}</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="author-guard" class="creative-label">Last Name:</label>
                        <input type="text" class="creative-input" id="author-guard" placeholder="Enter Author Last Name"
                               required v-model="updateForm.last_name"/>
                        <div v-if="updateForm.errors.last_name" class="creative-error">
                            <span>{{ updateForm.errors.last_name }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <label for="author-guard" class="creative-label">Profile Link:</label>
                    <div>
                        <small>Provide social media link (Twitter/Medium/Facebook) or personal website link</small>
                    </div>
                    <input type="text" class="creative-input" id="author-guard" placeholder="Enter Author Profile Link"
                           required v-model="updateForm.profile_link"/>
                    <div v-if="updateForm.errors.profile_link" class="creative-error">
                        <span>{{ updateForm.errors.profile_link }}</span>
                    </div>
                </div>

                <div class="grid mt-5">
                    <div>
                        <label class="sumo-label" for="avatar">Profile Photo:</label>
                        <div>
                            <small class="font-medium">Accepted file types PNG, JPG, JPEG. Maximum size of 2MB</small>
                        </div>
                    </div>
                    <input type="file" @input="updateForm.avatar=$event.target.files[0]" class="mt-4" id="avatar">
                    <div v-if="updateForm.errors.avatar" class="creative-error" >
                        <span class="text-xs">{{ updateForm.errors.avatar}}</span>
                    </div>
                </div>

            </form>
        </div>
        <template #footer >
            <div class="flex justify-end">
                <button class="btn-primary text-sm" type="submit" form="role-form-update">Update Author</button>
            </div>
        </template>

    </modal>
</template>
</admin>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
import Admin from "@/views/layouts/admin.vue";
import {ref} from "vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import Modal from "@/views/components/modal.vue";
import { Dropdown} from 'flowbite-vue'
let props=defineProps({
    authors:Object
})

let form=useForm({
    first_name:'',
    last_name:'',
    profile_link:'',
    avatar:''
})
const showModal=ref(false)
const showEditModal=ref(false)
const avatar=ref('')

let submit=()=>{
    form.post(route('authors.store'),{
        onSuccess:()=>{
            form.reset()
            showModal.value=false

        }
    })}

//updating author
let updateForm=useForm({
    first_name:'',
    last_name:'',
    profile_link:'',
    avatar:'',
    id:'',
    _method:'patch'
})

const editAuthor=(author:any)=>{

    updateForm.first_name=author.name;
    updateForm.last_name=author.last_name;
    updateForm.profile_link=author.profile;
    updateForm.id=author.id;
    avatar.value=author.avatar
    showEditModal.value=true;

}
let update=()=>{
    updateForm.post(route('authors.update',updateForm.id),{
        onSuccess:()=>{
            updateForm.reset()
            showEditModal.value=false

        }
    })}
</script>

<style scoped>

</style>
