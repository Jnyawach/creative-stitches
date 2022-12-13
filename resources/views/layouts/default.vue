<template layout>
    <Head>
        <title>Machine Embroidery designs: Embroidery Digitizing: Download Embroidery Files</title>
        <meta name="description" content="Machine Embroidery design, Digitizing Services and Embroidery files download">
    </Head>
    <header class="bg-white drop-shadow">
        <div class="bg-gray-800 py-3 text-center">
            <p class="uppercase text-white font-bold text-xs sm:text-sm">GRAB AN EXCLUSIVE OFFER! USE CODE -<span class="text-teal-500">EB78HD</span>  AND GET 10%-OFF!! OFFER ENDS IN 15:00:37</p>
        </div>
        <div class="flex py-4  px-3 gap-5 justify-between">
            <div class="flex md:w-3/4 gap-5 justify-between">

                <div class="self-center">
                    <Link href="/" title="Creative Stitches home">
                        <img :src="'/images/creative-stitches-logo.png'" alt="Creative stitches logo" class="w-40">
                    </Link>
                </div>
                <div class="w-2/3 hidden md:block">
                    <form>
                        <div class="relative">

                            <input type="search" id="default-search" class="block p-2 pl-5 w-full text-sm text-black-100 font-bold bg-white rounded-full border-2 border-gray-300 focus:border-gray-900 ring-0 outline-0 placeholder-black-100" placeholder="Search for anything...">

                        </div>
                    </form>
                </div>
            </div>
            <div class="flex mr-5">
                <ul class="flex self-center font-medium gap-6 text-lg">
                    <li>
                        <button class="hover:text-gray-900 font-montserrat">Sign in</button>
                    </li>
                    <li>
                        <Link href="#" title="My wishlist" class="hover:text-teal-900">
                            <span><i class="far fa-heart"></i></span>
                        </Link>
                    </li>
                    <li>
                        <Link href="#" title="cart" class="hover:text-teal-900 relative">
                            <span><i class="far fa-shopping-bag"></i></span>
                            <div class="absolute bg-teal-700 h-4 w-4 -top-2 -right-3 flex place-content-center rounded-full">
                                <span class="self-center leading-none text-white text-[10px] font-bold text-xm">2</span>
                            </div>
                        </Link>
                    </li>
                </ul>
            </div>



        </div>
        <div class="md:hidden flex gap-3 px-2 pb-4">
            <div class="self-center">
                <button class="text-teal-700 text-2xl" @click="drawerVisible = !drawerVisible">
                    <span><i class="fas fa-bars"></i></span>
                </button>
            </div>
            <div class="w-full">
                <form>
                    <input type="search" id="default-search" class="block p-2 pl-5 w-full text-sm text-black-100 font-bold bg-white rounded-full border-2 border-gray-300 focus:border-gray-900 ring-0 outline-0 placeholder-black-100" placeholder="Search for anything...">
                </form>
            </div>
        </div>
        <div class="py-2 px-2 hidden md:block">
            <ul class="flex justify-center gap-3 md:gap-5 font-medium font-montserrat w-full text-sm">
                <li class="hover:text-teal-700" v-for="category in categories" :key="category.id">
                    <Link href="#" :title="category.name">{{category.name}}</Link>
                </li>



            </ul>
        </div>

        <!--mobile menu-->
        <div class="right-drawer"
             :style="{
             width: drawerVisible? '70vw' : '0',
             paddingLeft: drawerVisible? '10px' : '0',
             }"
        >
            <div class="mt-3">
                <div class="flex justify-end mr-6">
                    <button class="text-xl border rounded-full w-9 h-9 border-teal-700" @click="drawerVisible=false">
                        <span><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="px-2">
                    <h1 class="font-bold text-lg">Menu</h1>
                    <div>
                        <ul class="font-medium font-montserrat text-lg">
                            <li class="hover:text-teal-700 py-2" v-for="category in categories" :key="category.id">
                                <Link href="#" :title="category.name">{{category.name}}</Link>
                            </li>
                            <li class="py-2">
                                <Link href="#" title="cart" class=" hover:text-teal-700 relative">
                                    <span><i class="far fa-shopping-bag"></i> Cart</span>

                                </Link>
                            </li>
                            <li class="py-2">
                                <Link href="#" title="cart" class="hover:text-teal-700 relative">
                                    <span><i class="far fa-user-circle"></i> Sign in</span>

                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
        <div class="drawer-mask"
             @click="drawerVisible = false"
             :style="{
             width: drawerVisible ? '100vw' : '0',
             opacity: drawerVisible ? '0.6' : '0',
             }"
        ></div>
    </header>
    <main>
        <slot/>
    </main>
    <footer class="bg-gray-800">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-5 py-5 px-5 md:px-14">
            <div>
                <h6 class="font-bold text-white">Shop</h6>
                <div class="mt-3">
                    <ul class="text-[13px] font-medium">
                        <li class="py-1" v-for="category in categories" :key="category.id">
                            <Link href="#" class="text-white hover:text-teal-500" :title="category.name">{{category.name}}</Link>
                        </li>
                    </ul>
                </div>
            </div>

            <div>
                <h6 class="font-bold text-white">About</h6>
                <div class="mt-3">
                    <ul class="text-[13px] font-medium">
                        <li class="py-1">
                            <Link href="#" class="text-white hover:text-teal-500" title="About Us">About Us</Link>
                        </li>
                        <li class="py-1">
                            <Link href="#" class="text-white hover:text-teal-500" title="Blog">Blog</Link>
                        </li>
                        <li class="py-1">
                            <Link href="#" class="text-white hover:text-teal-500" title="Jobs">Jobs</Link>
                        </li>
                        <li class="py-1">
                            <Link href="#" class="text-white hover:text-teal-500" title="Custom Embroidery">Custom Embroidery</Link>
                        </li>
                        <li class="py-1">
                            <Link href="#" class="text-white hover:text-teal-500 " title="mbroidery file Conversion">Embroidery file Conversion</Link>
                        </li>
                        <li class="py-1">
                            <Link href="#" class="text-white hover:text-teal-500 " title="Embroidery resizing">Embroidery resizing</Link>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="w-full">
                <h6 class="font-bold text-white">Help Center</h6>
                <div class="mt-3 flex justify-between w-full md:block gap-5">
                    <ul class="text-[13px] font-medium">
                        <li class="py-1">
                            <Link href="#" class="text-white hover:text-teal-500" title="FAQs">FAQs</Link>
                        </li>
                        <li class="py-1">
                            <Link href="#" class="text-white hover:text-teal-500" title="Contact Us">Contact Us</Link>
                        </li>

                    </ul>
                    <div class="w-full">
                        <ul class="flex gap-4">
                            <li >
                                <Link href="#" class="text-white hover:text-teal-500" title="Pinterest">
                                    <span><i class="fab fa-pinterest-p"></i></span>
                                </Link>
                            </li>
                            <li>
                                <Link href="#" class="text-white hover:text-teal-500" title="Facebook">
                                    <span><i class="fab fa-facebook-f"></i></span>
                                </Link>
                            </li>
                            <li>
                                <Link href="#" class="text-white hover:text-teal-500" title="Twitter">
                                    <span><i class="fab fa-twitter"></i></span>
                                </Link>
                            </li>
                            <li>
                                <Link href="#" class="text-white hover:text-teal-500" title="Instagram">
                                    <span><i class="fab fa-instagram"></i></span>
                                </Link>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

        </div>
        <div class="pt-5">
            <hr>
            <div class="px-5 md:px-14 py-3">
                <div>
                    <Link href="/" title="Creative Stitches">
                        <img :src="'/images/creative-stitches-white.png'" alt="Creative stitches logo" class="w-44">
                    </Link>
                </div>
                <div class="mt-3">
                    <ul class="flex gap-5 font-medium text-sm">
                        <li>
                            <Link href="#" class="text-white hover:text-teal-500" title="Terms and Conditions">Terms & Conditions</Link>
                        </li>
                        <li>
                            <Link href="#" class="text-white hover:text-teal-500" title="Privacy Policy">Privacy Policy</Link>
                        </li>
                        <li>
                            <Link href="#" class="text-white hover:text-teal-500" title="Cookie Policy">Cookie Policy</Link>
                        </li>
                    </ul>
                </div>

                <div class="flex justify-center text-white text-sm  font-medium py-3">
                    <p><span><i class="far fa-copyright"></i></span> Creative Stitches {{new Date().getFullYear()}}</p>
                </div>

            </div>

        </div>


    </footer>
</template>
<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
import {Head} from "@inertiajs/inertia-vue3";
import {ref} from "vue";
import {useCategory} from "@/scripts/use/useCategory";
const {categories}=useCategory()
const drawerVisible=ref(false)
</script>

<style scoped>
.right-drawer {
    position: absolute;
    top: 0;
    right: 0;
    width: 0; /* initially */
    overflow: hidden;
    height: 100vh;
    padding-left: 0; /* initially */
    border-left: 1px solid whitesmoke;
    background: white;
    z-index: 200;
    transition: all 0.2s; /* for the animation */
}

.drawer-mask {
    position: absolute;
    left: 0;
    top: 0;
    width: 0; /* initially */
    height: 100vh;
    background: #000;
    opacity: 0.3;
    z-index: 199;
}
</style>
