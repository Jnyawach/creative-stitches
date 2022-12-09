<template layout>
   <Head>
       <title>Machine Embroidery designs: Embroidery Digitizing: Download Embroidery Files</title>
       <meta name="description" content="Machine Embroidery design, Digitizing Services and Embroidery files download">
   </Head>
    <header>
     <div class="bg-gray-900 py-3 text-center">
         <p class="uppercase text-white font-bold text-xs sm:text-sm">GRAB AN EXCLUSIVE OFFER! USE CODE -<span class="text-teal-700">EB78HD</span>  AND GET 10%-OFF!! OFFER ENDS IN 15:00:37</p>
     </div>
        <div class="flex py-4  px-3 gap-5 justify-between">
          <div class="flex w-3/4 gap-5 justify-between">
              <div>
                  <Link href="/" title="Creative Stitches home">
                      <img :src="'/images/creative-stitches-logo.png'" alt="Creative stitches logo" class="w-40">
                  </Link>
              </div>
              <div class="w-2/3">
                  <form>
                      <div class="relative">

                          <input type="search" id="default-search" class="block p-2 pl-5 w-full text-sm text-black-100 font-bold bg-white rounded-full border-2 border-gray-300 focus:border-gray-900 ring-0 outline-0 placeholder-black-100" placeholder="Search for anything...">

                      </div>
                  </form>
              </div>
          </div>
            <div class="flex mr-5">
                <ul class="flex self-center font-medium gap-5 text-lg">
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
        <div class="py-1 px-2">
            <ul class="flex justify-center gap-3 md:gap-5 font-bold font-montserrat w-full text-sm">
                <li class="hover:text-teal-900">
                    <Link href="#" title="Category name">Home & Decor</Link>
                </li>
                <li class="hover:text-teal-900">
                    <Link href="#" title="Category name">Pets</Link>
                </li>
                <li class="hover:text-teal-900">
                    <Link href="#" title="Category name">Wildlife</Link>
                </li>
                <li class="hover:text-teal-900">
                    <Link href="#" title="Category name">Appliques</Link>
                </li>
                <li class="hover:text-teal-900">
                    <Link href="#" title="Category name">Baby & Kids</Link>
                </li>
                <li class="hover:text-teal-900">
                    <Link href="#" title="Category name">Flower & Plants</Link>
                </li>
                <li class="hover:text-teal-900">
                    <Link href="#" title="Category name">Fashions</Link>
                </li>
                <li class="hover:text-teal-900">
                    <Link href="#" title="Category name">Love & Romance</Link>

                </li>
            </ul>
        </div>
    </header>
</template>
<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
import {Head} from "@inertiajs/inertia-vue3";
</script>
