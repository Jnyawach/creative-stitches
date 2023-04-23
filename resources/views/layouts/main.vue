<template>

    <header class="bg-white drop-shadow z-[1000] relative">

        <div class="bg-gray-800 px-1 py-3 text-center" v-show="coupon">
            <p class="uppercase text-white font-bold text-xs sm:text-sm relative">GRAB AN EXCLUSIVE OFFER! USE CODE -<span class="text-teal-500">{{coupon.code}}</span>  AND GET {{coupon.discount}}%-OFF!! OFFER ENDS IN
               <span class="px-3 text-center md:absolute">
                    <vue-countdown :time="new Date(coupon.expires)-new Date()" v-slot="{ days, hours, minutes, seconds }">
                    {{ days }}:{{ hours }}:{{ minutes }}:{{ seconds }}
                </vue-countdown>
               </span>
            </p>
        </div>
        <div class="flex py-4  px-3 gap-5 justify-between">
            <div class="flex md:w-3/4 gap-5 justify-between">

                <div class="self-center">
                    <Link href="/" title="Creative Stitches home">
                        <img :src="'/images/creative-stitches-logo.png'" alt="Creative stitches logo" class="w-36 sm:w-44">
                    </Link>
                </div>
                <div class="w-2/3 hidden lg:block">
                    <search></search>
                </div>
            </div>
            <div class="flex mr-5">
                <ul class="flex self-center font-medium gap-6 text-lg">
                    <li v-if="!auth" class="self-center">
                        <button class="hover:text-gray-900 " @click="authModal=true">
                            <svg class="h-5  hover:fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM224 32c52.94 0 96 43.06 96 96c0 52.93-43.06 96-96 96S128 180.9 128 128C128 75.06 171.1 32 224 32zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304zM413.3 480H34.66C33.2 480 32 478.8 32 477.3C32 399.4 95.4 336 173.3 336h101.3C352.6 336 416 399.4 416 477.3C416 478.8 414.8 480 413.3 480z"/></svg>
                        </button>
                    </li>
                    <li v-if="auth">
                        <Link :href="route('account.index')" title="My account" class="self-center hover:text-teal-900  text-lg">
                            <svg class="h-5  hover:fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM224 32c52.94 0 96 43.06 96 96c0 52.93-43.06 96-96 96S128 180.9 128 128C128 75.06 171.1 32 224 32zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304zM413.3 480H34.66C33.2 480 32 478.8 32 477.3C32 399.4 95.4 336 173.3 336h101.3C352.6 336 416 399.4 416 477.3C416 478.8 414.8 480 413.3 480z"/></svg>
                        </Link>
                    </li>
                    <li >
                        <Link v-if="auth" :href="route('wishlist.index')" title="My wishlist" class="hover:text-teal-900  text-lg">
                            <span>
                                <svg class="h-5  hover:fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M255.1 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 0 232.4 0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L255.1 96zM255.1 141.3L221.4 106.6C196.1 81.31 160 69.77 124.7 75.66C71.21 84.58 31.1 130.9 31.1 185.1V190.9C31.1 223.6 45.55 254.7 69.42 277L250.1 445.7C251.7 447.2 253.8 448 255.1 448C258.2 448 260.3 447.2 261.9 445.7L442.6 277C466.4 254.7 480 223.6 480 190.9V185.1C480 130.9 440.8 84.58 387.3 75.66C351.1 69.77 315.9 81.31 290.6 106.6L255.1 141.3z"/></svg>
                            </span>
                        </Link>
                        <button v-else as="button" @click="authModal=true" title="My wishlist" class="self-center">
                            <span>
                                <svg class="h-5  hover:fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M255.1 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 0 232.4 0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L255.1 96zM255.1 141.3L221.4 106.6C196.1 81.31 160 69.77 124.7 75.66C71.21 84.58 31.1 130.9 31.1 185.1V190.9C31.1 223.6 45.55 254.7 69.42 277L250.1 445.7C251.7 447.2 253.8 448 255.1 448C258.2 448 260.3 447.2 261.9 445.7L442.6 277C466.4 254.7 480 223.6 480 190.9V185.1C480 130.9 440.8 84.58 387.3 75.66C351.1 69.77 315.9 81.31 290.6 106.6L255.1 141.3z"/></svg>
                            </span>
                        </button>
                    </li>
                    <li>
                        <button @click="cartModal=true" title="cart" class="hover:text-teal-900 relative">
                            <span>
                                <svg class="h-5  hover:fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M128 128V96C128 42.98 170.1 0 224 0C277 0 320 42.98 320 96V128H400C426.5 128 448 149.5 448 176V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V176C0 149.5 21.49 128 48 128H128zM160 128H288V96C288 60.65 259.3 32 224 32C188.7 32 160 60.65 160 96V128zM48 160C39.16 160 32 167.2 32 176V416C32 451.3 60.65 480 96 480H352C387.3 480 416 451.3 416 416V176C416 167.2 408.8 160 400 160H320V240C320 248.8 312.8 256 304 256C295.2 256 288 248.8 288 240V160H160V240C160 248.8 152.8 256 144 256C135.2 256 128 248.8 128 240V160H48z"/></svg>
                            </span>
                            <div v-if="cart.cartCount" class="absolute bg-teal-700 h-4 w-4 -top-2 -right-3 flex place-content-center rounded-full">
                                <span class="self-center leading-none text-white text-[10px] font-bold text-xm">{{cart.cartCount}}</span>
                            </div>
                        </button>
                    </li>

                    <li v-if="auth">
                        <Link :href="route('user.logout')" title="Logout"
                              class="hover:text-teal-900  text-lg" as="button" method="post">
                            <svg class="h-5  hover:fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"/></svg>
                        </Link>
                    </li>
                </ul>
            </div>



        </div>
        <div class="lg:hidden flex gap-3 px-2 pb-4 ">
            <button class="self-center" @click="drawerVisible = !drawerVisible">
                <svg class="h-8 hover:fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"/></svg>
            </button>
            <div class="w-full self-center">
                <search></search>
            </div>
        </div>
        <div class="py-2 px-2 hidden lg:block">
            <ul class="flex justify-center gap-3 md:gap-5 font-semibold  w-full text-sm">
                <li>
                    <Link :href="route('shop.index')" class="hover:text-teal-700" title="Shop all Embroidery Designs">Shop all</Link>
                </li>
                <li class="hover:text-teal-700" v-for="category in categories" :key="category.id">
                    <Link :href="route('shop.category',category.slug)" :title="category.name">{{category.name}}</Link>
                </li>




            </ul>
        </div>

        <!--mobile menu-->
        <drawer :show="drawerVisible" :categories="categories" @closeDrawer="drawerVisible=false"></drawer>

    </header>
    <main  >
        <Teleport to="body">
            <toast :message="message" @remove="remove()"></toast>
        </Teleport>
        <div class="-z-50">
            <slot/>
        </div>

        <!--login modal-->
        <authentication :show="authModal" @close="authModal=false" :login="true" :key="authKey"></authentication>
    <cart :show="cartModal" @close="cartModal=false" :cart="cart"></cart>
    </main>
    <footer class="bg-black-100">
        <div class="max-w-[1200px] mx-auto">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-5 py-5 px-5 md:px-14">
            <div>
                <h6 class="font-bold text-white">Shop</h6>
                <div class="mt-3">
                    <ul class="sm:text-[13px] font-medium space-y-3">
                        <li>
                            <Link :href="route('shop.index')" class="text-white hover:text-teal-500" title="Shop all Embroidery Designs">Shop all</Link>
                        </li>
                        <li class="py-1" v-for="category in categories" :key="category.id">
                            <Link :href="route('shop.category',category.slug)" class="text-white hover:text-teal-500" :title="category.name">{{category.name}}</Link>
                        </li>
                    </ul>
                </div>
            </div>

            <div>
                <h6 class="font-bold text-white">About</h6>
                <div class="mt-3">
                    <ul class="sm:text-[13px] font-medium">

                        <li class="py-1">
                            <Link :href="route('blog.index')" class="text-white hover:text-teal-500" title="Blog">Blog</Link>
                        </li>
                        <li class="py-1">
                            <a href="https://careermove.co.ke/hiring/creative-stitches" target="_blank" class="text-white hover:text-teal-500" title="Jobs">Jobs</a>
                        </li>
                        <li class="py-1">
                            <Link :href="route('custom-embroidery.index')" class="text-white hover:text-teal-500" title="Custom Embroidery">Custom Embroidery</Link>
                        </li>
                        <!--
                        <li class="py-1">
                            <Link href="#" class="text-white hover:text-teal-500 " title="Embroidery file Conversion">Embroidery file Conversion</Link>
                        </li>
                        <li class="py-1">
                            <Link href="#" class="text-white hover:text-teal-500 " title="Embroidery resizing">Embroidery resizing</Link>
                        </li>
                        -->
                    </ul>
                </div>
            </div>

            <div class="w-full col-span-2 sm:col-span-1">
                <h6 class="font-bold text-white">Help Center</h6>
                <div class="mt-3  flex justify-between">
                    <div class="col-span-1">
                        <ul class="sm:text-[13px] font-medium">
                            <li class="py-1">
                                <Link :href="route('help-center.index')" class="text-white hover:text-teal-500" title="FAQs">FAQs</Link>
                            </li>
                            <li class="py-1">
                                <Link :href="route('contact-us.index')" class="text-white hover:text-teal-500" title="Contact Us">Contact Us</Link>
                            </li>

                        </ul>
                    </div>
                    <div class="self-end">
                        <ul class="flex gap-6 text-lg">
                            <li><a target="_blank" href="https://www.pinterest.com/creativestitchesembroidery/" title="Pinterest" class="bg-teal-700">
                                <svg class="fill-white hover:fill-teal-700" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path d="M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3.8-3.4 5-20.3 6.9-28.1.6-2.5.3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z"/></svg>
                            </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/profile.php?id=100090987513196" target="_blank" class="text-white hover:text-teal-500" title="Facebook">
                                    <svg class="fill-white hover:fill-teal-700" height="20" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/creativestitchesembroidery/" target="_blank"
                                   class="text-white hover:text-teal-500" title="Instagram">
                                    <svg class="fill-white hover:fill-teal-700" height="20" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

        </div>
        </div>
        <div class="pt-5">
            <hr>
            <div class="px-5 md:px-14 py-3 max-w-[1280px] mx-auto">
                <div>
                    <Link href="/" title="Creative Stitches">
                        <img :src="'/images/creative-stitches-white.png'" alt="Creative stitches logo" class="w-44">
                    </Link>
                </div>
                <div class="mt-3">
                    <ul class="grid grid-cols-2 sm:flex gap-5 font-medium text-sm">
                        <li>
                            <Link :href="route('terms.conditions')" class="text-white hover:text-teal-500" title="Terms and Conditions">Terms & Conditions</Link>
                        </li>
                        <li>
                            <Link :href="route('privacy.policy')" class="text-white hover:text-teal-500" title="Privacy Policy">Privacy Policy</Link>
                        </li>
                        <li>
                            <Link :href="route('cookie.policy')" class="text-white hover:text-teal-500" title="Cookie Policy">Cookie Policy</Link>
                        </li>
                        <li>
                            <Link :href="route('copyright.guidelines')" class="text-white hover:text-teal-500" title="Copyright Guidelines">Copyright Guidelines</Link>
                        </li>
                    </ul>
                </div>

                <div class="flex justify-center text-white text-sm  font-medium py-3 mt-5">
                    <p class="flex gap-1"><span>
                        <svg class="fill-white" height="20" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.451-200-200 0-110.531 89.451-200 200-200 110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200zm107.351-101.064c-9.614 9.712-45.53 41.396-104.065 41.396-82.43 0-140.484-61.425-140.484-141.567 0-79.152 60.275-139.401 139.762-139.401 55.531 0 88.738 26.62 97.593 34.779a11.965 11.965 0 0 1 1.936 15.322l-18.155 28.113c-3.841 5.95-11.966 7.282-17.499 2.921-8.595-6.776-31.814-22.538-61.708-22.538-48.303 0-77.916 35.33-77.916 80.082 0 41.589 26.888 83.692 78.277 83.692 32.657 0 56.843-19.039 65.726-27.225 5.27-4.857 13.596-4.039 17.82 1.738l19.865 27.17a11.947 11.947 0 0 1-1.152 15.518z"/></svg>
                    </span> Creative Stitches {{new Date().getFullYear()}}
                       </p>
                </div>

            </div>

        </div>

            <!--WhatsApp button-->
            <a href="https://api.whatsapp.com/send?phone=254705813739" target="_blank" class="fixed bottom-5 right-5 bg-teal-800 rounded-full h-12 w-12 flex
            place-content-center cursor-pointer " title="Chat with us directly">
                <span class="text-white self-center text-2xl">
                    <svg class="fill-white" height="22" width="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                </span>
            </a>

        <subscribe :show="subscribeModal" @close="subscribeModal=false" @open="subscribeModal=true"></subscribe>
        <cookies  :show="cookieModal" @close="cookieModal=false" @open="cookieModal=true"></cookies>
    </footer>
</template>
<script setup lang="ts">
import {InertiaProgress} from "@inertiajs/progress";
InertiaProgress.init()
import {Link, usePage} from "@inertiajs/inertia-vue3";
import {computed, ref, watch} from "vue";
import {useCategory} from "@/scripts/use/useCategory";
import {useCoupon} from "@/scripts/use/useCoupon";
import VueCountdown from '@chenfengyuan/vue-countdown';
import Authentication from "@/views/pages/auth/authentication.vue";
import Toast from "@/views/components/toast.vue";
import {Inertia} from "@inertiajs/inertia";
import {store} from "@/scripts/store/login";
import Cart from "@/views/components/products/cart.vue";
import Search from "@/views/components/search.vue";
import Drawer from "@/views/components/drawer.vue";
import Subscribe from "@/views/components/user/subscribe.vue";
import {Button} from "flowbite-vue";
import Cookies from "@/views/components/cookies.vue";

const {categories}=useCategory()
const  {coupon}=useCoupon()
const cart= computed(() => usePage().props.value.cart)

const drawerVisible=ref(false)

const authModal=ref(false)
const  cartModal=ref(false)
const authKey=ref(new Date().getTime().toString())
let props=defineProps({
    auth:Object,
    session:Object
})


watch(
    () => props.session,
    (session) => {
       if (session.requireAuth){
           authModal.value=true;
           authKey.value=new Date().getTime().toString();
       }

    },
);

const page=usePage()
const message=ref('')
let removeEventListener=Inertia.on("finish",()=>{
    if (page.props.value.status){
        message.value=page.props.value.status
    }
})
function remove(){
 message.value=null
}
watch(store,()=>{
    if (store.login==true){
        authModal.value=true;
        store.login=false;
    }
})
const subscribeModal=ref(false)
const cookieModal=ref(false)
</script>

<style scoped>


</style>
