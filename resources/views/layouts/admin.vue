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
                                                  class="text-primary-200 text-sm font-bold flex gap-1">

                                                <svg class="h-4 fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M96 192V128C96 57.31 153.3 0 224 0C294.7 0 352 57.31 352 128V192H368C412.2 192 448 227.8 448 272V432C448 476.2 412.2 512 368 512H80C35.82 512 0 476.2 0 432V272C0 227.8 35.82 192 80 192H96zM128 192H320V128C320 74.98 277 32 224 32C170.1 32 128 74.98 128 128V192zM32 432C32 458.5 53.49 480 80 480H368C394.5 480 416 458.5 416 432V272C416 245.5 394.5 224 368 224H80C53.49 224 32 245.5 32 272V432z"/></svg>
                                                <span>Log Out</span>

                                            </Link>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!--search-->
                            <!---
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
                            --->

                            <div class="mt-7">
                                <ul>
                                    <li>
                                        <Link href="/">
                                            <div class="hover:bg-gray-100 w-full rounded-md px-3 py-3">
                                                <p class="font-semibold text-sm flex gap-1">
                                                    <svg class="fill-teal-700 h-4 mr-1 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M570.6 244C577.2 249.8 577.8 259.1 571.1 266.6C566.2 273.2 556 273.8 549.4 267.1L512 234.1V432C512 476.2 476.2 512 432 512H144C99.82 512 64 476.2 64 432V234.1L26.59 267.1C19.96 273.8 9.849 273.2 4.003 266.6C-1.844 259.1-1.212 249.8 5.414 244L277.4 4.002C283.5-1.334 292.5-1.334 298.6 4.002L570.6 244zM144 480H208V320C208 302.3 222.3 288 240 288H336C353.7 288 368 302.3 368 320V480H432C458.5 480 480 458.5 480 432V206.7L288 37.34L96 206.7V432C96 458.5 117.5 480 144 480zM240 480H336V320H240V480z"/></svg>
                                                    <span>Home</span>
                                                </p>
                                            </div>
                                        </Link>

                                    </li>
                                    <li>
                                        <Link :href="route('admin.index')">
                                            <div class="hover:bg-gray-100 w-full rounded-md px-3 py-3">
                                                <p class="font-semibold text-sm flex gap-1">
                                                    <svg class="fill-teal-700 h-4 mr-1 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 416C0 407.2 7.164 400 16 400H81.6C89.01 363.5 121.3 336 160 336C198.7 336 230.1 363.5 238.4 400H496C504.8 400 512 407.2 512 416C512 424.8 504.8 432 496 432H238.4C230.1 468.5 198.7 496 160 496C121.3 496 89.01 468.5 81.6 432H16C7.164 432 0 424.8 0 416V416zM208 416C208 389.5 186.5 368 160 368C133.5 368 112 389.5 112 416C112 442.5 133.5 464 160 464C186.5 464 208 442.5 208 416zM352 176C390.7 176 422.1 203.5 430.4 240H496C504.8 240 512 247.2 512 256C512 264.8 504.8 272 496 272H430.4C422.1 308.5 390.7 336 352 336C313.3 336 281 308.5 273.6 272H16C7.164 272 0 264.8 0 256C0 247.2 7.164 240 16 240H273.6C281 203.5 313.3 176 352 176zM400 256C400 229.5 378.5 208 352 208C325.5 208 304 229.5 304 256C304 282.5 325.5 304 352 304C378.5 304 400 282.5 400 256zM496 80C504.8 80 512 87.16 512 96C512 104.8 504.8 112 496 112H270.4C262.1 148.5 230.7 176 192 176C153.3 176 121 148.5 113.6 112H16C7.164 112 0 104.8 0 96C0 87.16 7.164 80 16 80H113.6C121 43.48 153.3 16 192 16C230.7 16 262.1 43.48 270.4 80H496zM144 96C144 122.5 165.5 144 192 144C218.5 144 240 122.5 240 96C240 69.49 218.5 48 192 48C165.5 48 144 69.49 144 96z"/></svg>
                                                    <span>Dashboard</span>
                                                </p>
                                            </div>
                                        </Link>

                                    </li>
                                    <li>
                                        <Link href="#">
                                            <div class="hover:bg-gray-100 w-full rounded-md px-3 py-3">
                                                <p class="font-semibold text-sm flex gap-1">
                                                    <svg class="fill-teal-700 h-4 mr-1 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M168 255.1C168 207.4 207.4 167.1 256 167.1C304.6 167.1 344 207.4 344 255.1C344 304.6 304.6 344 256 344C207.4 344 168 304.6 168 255.1zM256 199.1C225.1 199.1 200 225.1 200 255.1C200 286.9 225.1 311.1 256 311.1C286.9 311.1 312 286.9 312 255.1C312 225.1 286.9 199.1 256 199.1zM65.67 230.6L25.34 193.8C14.22 183.7 11.66 167.2 19.18 154.2L49.42 101.8C56.94 88.78 72.51 82.75 86.84 87.32L138.8 103.9C152.2 93.56 167 84.96 182.8 78.43L194.5 25.16C197.7 10.47 210.7 0 225.8 0H286.2C301.3 0 314.3 10.47 317.5 25.16L329.2 78.43C344.1 84.96 359.8 93.56 373.2 103.9L425.2 87.32C439.5 82.75 455.1 88.78 462.6 101.8L492.8 154.2C500.3 167.2 497.8 183.7 486.7 193.8L446.3 230.6C447.4 238.9 448 247.4 448 255.1C448 264.6 447.4 273.1 446.3 281.4L486.7 318.2C497.8 328.3 500.3 344.8 492.8 357.8L462.6 410.2C455.1 423.2 439.5 429.2 425.2 424.7L373.2 408.1C359.8 418.4 344.1 427 329.2 433.6L317.5 486.8C314.3 501.5 301.3 512 286.2 512H225.8C210.7 512 197.7 501.5 194.5 486.8L182.8 433.6C167 427 152.2 418.4 138.8 408.1L86.84 424.7C72.51 429.2 56.94 423.2 49.42 410.2L19.18 357.8C11.66 344.8 14.22 328.3 25.34 318.2L65.67 281.4C64.57 273.1 64 264.6 64 255.1C64 247.4 64.57 238.9 65.67 230.6V230.6zM158.4 129.2L145.1 139.5L77.13 117.8L46.89 170.2L99.58 218.2L97.39 234.8C96.47 241.7 96 248.8 96 255.1C96 263.2 96.47 270.3 97.39 277.2L99.58 293.8L46.89 341.8L77.13 394.2L145.1 372.5L158.4 382.8C169.5 391.4 181.9 398.6 195 403.1L210.5 410.4L225.8 480H286.2L301.5 410.4L316.1 403.1C330.1 398.6 342.5 391.4 353.6 382.8L366.9 372.5L434.9 394.2L465.1 341.8L412.4 293.8L414.6 277.2C415.5 270.3 416 263.2 416 256C416 248.8 415.5 241.7 414.6 234.8L412.4 218.2L465.1 170.2L434.9 117.8L366.9 139.5L353.6 129.2C342.5 120.6 330.1 113.4 316.1 108L301.5 101.6L286.2 32H225.8L210.5 101.6L195 108C181.9 113.4 169.5 120.6 158.4 129.2H158.4z"/></svg>
                                                    <span>Profile Settings</span>
                                                </p>
                                            </div>
                                        </Link>

                                    </li>


                                </ul>
                            </div>
                        </div>
                        <div class="my-8 mx-4 ">
                            <h5 class="font-semibold text-lg text-primary-200">Links</h5>
                            <ul class="side-link pt-3 pb-10">
                                <li>
                                    <Link :href="route('users.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Users</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('roles.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Roles & Permissions</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('categories.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Categories</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('faqs-category.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>FAQS Categories</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('faqs.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>FAQS</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('posts.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Posts</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('authors.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Authors</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('contact.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Messages</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('quote-request.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Quotation Requests</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('terms.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Terms & Policies</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('sizing.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Design Size Chart</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('products.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Products</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('promotion.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Promotions</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('coupons.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Coupons</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('purchases.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Orders</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('payments.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Payments</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('subscriptions.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Newsletter Subscriptions</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('ratings.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Reviews</span>
                                            </p>
                                        </div>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('logs.index')">
                                        <div class="w-full rounded-md px-3 py-1">
                                            <p class="font-semibold hover:text-primary-200 text-sm text-gray-800 flex gap-1">
                                                <svg class="fill-teal-700 h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                                                <span>Error Logs</span>
                                            </p>
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
                    <li>
                        <p class="flex gap-1"><span>
                        <svg class="fill-white" height="20" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 0 1 1.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 0 1-1.152 15.518z"/></svg>
                    </span> Creative Stitches {{new Date().getFullYear()}}
                        </p>
                    </li>
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
