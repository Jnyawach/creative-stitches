<script setup lang="ts">
import {InertiaProgress} from "@inertiajs/progress";
InertiaProgress.init()
import {Link} from "@inertiajs/inertia-vue3";
defineProps({
    auth:Object
})
</script>
<template>
    <div class="relative min-h-screen">
        <div class="flex gap-2">
            <div class="relative">
                <aside class="w-64 top-0">
                    <div class="fixed w-64">
                        <div class="mt-5 px-3">
                            <h1 class="font-bold">CREATIVE STITCHES</h1>
                        </div>
                        <div class="w-full mt-12">
                            <div class="flex gap-3 px-3">
                                <div class="rounded-full h-12 w-12 overflow-hidden">
                                    <img :src="'/images/user-icon.png'" title="User Icon">
                                </div>
                                <div class="self-center">
                                    <div class="flex justify-between gap-4">
                                        <div>

                                            <h6 class="capitalize font-semibold">{{$page.props.auth.name}} {{$page.props.auth.last_name}}</h6>
                                            <Link :href="route('admin.logout')"
                                                  method="post" as="button"
                                                  class="text-primary-200 text-sm font-bold">
                                                <span class="mr-1"><i class="fa-light fa-lock"></i></span>
                                                Log Out
                                            </Link>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!--search-->
                            <div class="mt-8 px-3">
                                <form>
                                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                                    <div class="relative">
                                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </div>
                                        <input type="search" id="default-search" class="block p-3 pl-10 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary-200 focus:border-primary-200 " placeholder="Search Creative Stitches..." required>

                                    </div>
                                </form>
                            </div>

                            <div class="mt-7">
                                <ul>
                                    <li>
                                        <Link href="/">
                                            <div class="hover:bg-gray-100 w-full rounded-md px-3 py-3">
                                                <p class="font-semibold text-sm"> <span class="mr-3 text-primary-200"><i class="fa-light fa-house"></i></span>Home</p>
                                            </div>
                                        </Link>

                                    </li>
                                    <li>
                                        <Link :href="route('admin.index')">
                                            <div class="hover:bg-gray-100 w-full rounded-md px-3 py-3">
                                                <p class="font-semibold text-sm"> <span class="mr-3 text-primary-200"><i class="fa-regular fa-sliders"></i></span>Dashboard</p>
                                            </div>
                                        </Link>

                                    </li>
                                    <li>
                                        <Link href="#">
                                            <div class="hover:bg-gray-100 w-full rounded-md px-3 py-3">
                                                <p class="font-semibold text-sm"> <span class="mr-3 text-primary-200"><i class="fa-regular fa-gear"></i></span>Profile Settings</p>
                                            </div>
                                        </Link>

                                    </li>


                                </ul>
                            </div>
                        </div>
                        <div class="mt-8 mx-4 ">
                            <h5 class="font-semibold text-lg text-primary-200">Links</h5>
                            <ul class="side-link">
                                <li>
                                    <Link :href="route('users.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>Users</p>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('roles.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>Roles & Permissions</p>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('categories.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>Categories</p>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('faqs-category.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>FAQs Categories</p>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('faqs.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>FAQs</p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('posts.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>Posts</p>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('authors.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>Authors</p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('contact.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>Messages</p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('quote-request.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>Quotation Request</p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('terms.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>Terms & Policies</p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('sizing.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>Design Size Chart</p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('products.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>Products</p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('promotion.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>Promotions</p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('coupons.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>Coupons</p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('purchases.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>Orders</p>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('payments.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>Payments</p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('subscriptions.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>Newsletter Subscriber</p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('logs.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800"><span class="mr-2 text-primary-200"><i class="far fa-angle-right"></i></span>Error Logs</p>
                                        </div>
                                    </Link>
                                </li>



                            </ul>

                        </div>



                    </div>
                </aside>
            </div>

            <div class="bg-white w-full min-h-screen pb-5">

                <div>
                    <slot/>
                </div>

            </div>
            <div class="w-full min-h-screen w-72 px-3">
                <div class="fixed ">
                    <div class="pt-8 ">
                        <h6 class="font-bold text-teal-900">Quick links</h6>


                    </div>
                    <div class="">
                        <slot name="sidebar"></slot>
                    </div>
                </div>

            </div>
        </div>
        <div class="bg-black-100 py-3 px-3 z-[10000] relative">
            <div class="">
                <ul class="flex gap-2 text-white">
                    <li><p><span><i class="far fa-copyright"></i></span> Creative Stitches {{new Date().getFullYear()}}</p></li>
                </ul>
            </div>
        </div>
    </div>


</template>
<style scoped>
.side-link{
    height: 400px;
    overflow-y: scroll;
}
.side-link::-webkit-scrollbar {
    width: 3px;
}

/* Track */
.side-link::-webkit-scrollbar-track {
    background: #ebebeb;

}

/* Handle */
.side-link::-webkit-scrollbar-thumb {
    background: #0f766e;
}

/* Handle on hover */
.side-link::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
