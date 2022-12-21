<template>
<admin>
    <Head>
        <title>Posts</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Blog Posts</h6>

        <template #info >
            <p class="text-sm" v-show="$page.props.status"><span class="ml-2 text-teal-900"><i class="fas fa-info-circle"></i></span> {{$page.props.status}}</p>
        </template>
    </title-block>

    <div class="mt-8 ">
       <div class="flex justify-between px-3 py-2">
           <div>
               <h6 class="font-bold">Posts ({{ posts.data.length }})</h6>

           </div>
           <div class=" mr-3">

               <div class="relative">
                   <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                       <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                   </div>
                   <input v-model="search" type="search" id="default-search" class="block p-2 pl-10 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-sky-600 focus:border-sky-600" placeholder="Search roles..." required>

               </div>
           </div>
       </div>
        <div>
            <!--table search and name-->
            <table class="table-auto w-full mt-3 border-t">
                <thead>
                <tr class="bg-gray-50 h-10 text-teal-900 font-bold text-sm">
                    <th class="text-start py-3 px-4">Id</th>
                    <th class="text-start py-3 px-4">Title</th>
                    <th class="text-start py-3 px-4">Created On</th>
                    <th class="py-3 px-4 text-start">Action</th>


                </tr>
                </thead>
                <tbody>
                <tr class="border-b text-sm" v-if="posts.data" v-for="post in posts.data" :key="post.id">
                    <td class="py-3 px-4">{{ post.id }}</td>
                    <td class="py-3 px-4">{{ post.title }}</td>
                    <td class="py-3 px-4">{{ new Date(post.created_at).toDateString() }}</td>
                    <td class="py-3 px-4">
                        <dropdown placement="bottom">
                            <template #trigger="{ toggle }">
                                <Button @click="toggle" >
                                    Action <span class="self-center"><i class="far fa-ellipsis-v-alt"></i></span>
                                </Button>
                            </template>
                            <div class="shadow w-36">
                                <ul class="divide-y">
                                    <li class="hover:bg-gray-100 h-8">
                                        <Link :href="route('posts.show',post.slug)" class="text-sm font-bold btn-link  pt-3  text-start">
                                            <span class="mr-2"><i class="fa-light fa-bookmark"></i></span>View
                                        </Link>
                                    </li>
                                    <li class="hover:bg-gray-100 h-8">

                                        <Link :href="route('posts.edit',post.id)" class="text-sm font-bold btn-link pt-2 text-start">
                                            <span class="mr-2"><i class="fa-light fa-pen"></i></span>Edit
                                        </Link>
                                    </li>
                                    <li class="hover:bg-gray-100 ">
                                        <Link :href="route('posts.destroy',post.id)" class="text-red-700 text-sm font-bold p-2 w-full h-full text-start"  method="delete" as="button">
                                            <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete
                                        </Link>
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
                    <h6 class="font-medium">Showing <span class="text-sky-800">{{ posts.meta.current_page }}</span> of <span
                        class="text-sky-800">{{ posts.meta.last_page }}</span> Page(s)</h6>
                </div>
                <div class="flex">
                    <Link :href="posts.links.prev" class="btn-primary text-xs m-1" v-if="posts.links.prev"><span
                        class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                    </Link>
                    <Link :href="posts.links.next" class="btn-primary text-xs m-1" v-if="posts.links.next">Next
                        <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

                </div>

            </div>
        </div>
    </div>

    <template #sidebar>
       <div class="mt-3">
           <sidelink :link="route('posts.create')" class="btn-primary btn-small m-1 mt-3">
               <span class="mr-2"><i class="fal fa-plus"></i></span>Add Posts
           </sidelink>
       </div>
    </template>
</admin>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import Admin from "@/views/layouts/admin.vue";
import TitleBlock from "@/views/components/title-block.vue";
import Sidelink from "@/views/components/sidelink.vue";
import {Link} from "@inertiajs/inertia-vue3";
import { Dropdown} from 'flowbite-vue'
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import _ from "lodash"

let props=defineProps({
    posts:Object,
    search:String
})

let search=ref(props.search)
watch(search, _.debounce(function (value) {
    Inertia.get(route('posts.index'),{
        search:value
    }, {preserveState:true, replace:true});
}, 300))
</script>

<style scoped>

</style>
