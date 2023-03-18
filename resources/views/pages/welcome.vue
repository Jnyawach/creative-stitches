<template layout="main">
    <Head>
        <title>Download Machine Embroidery designs</title>
        <meta name="description" content="Get access to Creative Stitches library of machine embroidery designs. Download instantly in multiple formats">
        <link rel=“canonical” href="/" />
    </Head>
    <!--Hero image based on running promotion-->
    <div class="bg-black-100 ">
        <div class=" max-w-[1280px] mx-auto">
            <div class="grid md:grid-cols-2 px-3 py-5 md:px-10 gap-4">
                <div class="text-white md:py-16 order-2 md:order-1 text-center md:text-start">
                    <h1 class="text-4xl lg:text-5xl font-extrabold lg:leading-[73px]">{{promotion.data.title}}</h1>
                    <p class="mt-5 text-xl lg:text-3xl font-light">{{promotion.data.description}}</p>
                   <div class="my-5 lg:my-10 flex md:block justify-center">
                       <Link :href="route('shop.promotion',promotion.data.slug)" :title="promotion.data.name"
                       class="bg-teal-700 w-64 rounded-full py-3 px-8 font-semibold flex">
                          <span>
                              Get discount here
                          </span>
                           <span class="ml-5 self-center">
                           <svg class="w-5 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M363.3 100.7l144 144C510.4 247.8 512 251.9 512 255.1s-1.562 8.188-4.688 11.31l-144 144c-6.25 6.25-16.38 6.25-22.62 0s-6.25-16.38 0-22.62l116.7-116.7H16c-8.844 0-16-7.156-16-15.1c0-8.844 7.156-16 16-16h441.4l-116.7-116.7c-6.25-6.25-6.25-16.38 0-22.62S357.1 94.44 363.3 100.7z"/></svg>
                       </span>
                       </Link>
                   </div>
                </div>
                <div class="order-1 md:order-2 p-2 flex justify-center md:justify-end">
                    <img :src="promotion.data.photo" :alt="promotion.data.name" >

                </div>


            </div>
        </div>
    </div>
    <!---Recommended for you-->
    <div class="max-w-[1280px] mx-auto">
        <section>
            <div class="my-14 px-3 md:px-10">
                <h2 class="font-bold text-2xl">Recommended for you</h2>
                <product-list :products="recommends"></product-list>
            </div>
        </section>
        <section>
            <!----Shop by category-->
            <div class="my-14 px-3 md:px-10">
                <h2 class="font-bold text-2xl">Shop by Category</h2>
                <div class="mt-10 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 justify-center gap-2">
                    <div v-for="category in categories" :key="category.id">
                        <Link :title="category.name" :href="route('shop.category',category.slug)">
                            <div class="text-center relative overflow-hidden text-center rounded-md group">
                                <img :src="category.image" class="hover:scale-110 duration-200 relative"
                                     :alt="category.name">
                                <div class="absolute bottom-6 left-0 right-0 mx-auto">
                                    <button class="bg-white px-5 py-2 rounded-full font-montserrat text-sm
                            font-semibold shadow group-hover:text-teal-700">
                                        {{ category.name }}
                                    </button>
                                </div>

                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <!--rest of the products-->
            <div class="my-14 px-3 md:px-10">
                <h2 class="font-bold text-2xl">Featured Designs</h2>
                <product-list :products="featured"></product-list>
            </div>

        </section>


    </div>
    <section class="bg-stone-100 py-14 px-5 md:px-18">
        <div class="max-w-[1280px] mx-auto">
            <div class="grid grid-cols-2 sm:grid-cols-3 justify-center gap-2">
                <div class="text-center md:px-16">
                    <p class="flex justify-center">
                        <svg class="h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M466.5 83.71l-192-80C268.6 1.203 262.3 0 256.1 0S243.5 1.203 237.6 3.703L45.61 83.71C27.73 91.08 16 108.6 16 127.1C16 385.4 205.4 512 255.9 512C305.2 512 496 387.3 496 127.1C496 108.6 484.3 91.08 466.5 83.71zM463.9 128.3c0 225.3-166.2 351.7-207.8 351.7C213.3 479.1 48 352.2 48 128c0-6.5 3.875-12.25 9.75-14.75l192-80c1.973-.8275 4.109-1.266 6.258-1.266c2.071 0 4.154 .4072 6.117 1.266l192 80C463.3 117.1 463.9 125.8 463.9 128.3zM384 176h-112V96c0-8.844-7.156-16-16-16S240 87.16 240 96v80H128C119.2 176 112 183.2 112 192S119.2 208 128 208h112V416c0 8.844 7.156 16 16 16s16-7.156 16-16V208H384c8.844 0 16-7.156 16-16S392.8 176 384 176z"/></svg>
                    </p>
                    <h6 class="font-bold text-lg text-teal-700 mt-2">Secure Payment</h6>
                    <p>100% Secure payment with 256-bit SSL Encryption</p>
                </div>

                <div class="text-center md:px-16">
                    <p class="flex justify-center">
                        <svg class="h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M92.19 0C116.4 0 138.4 9.345 154.9 24.59C161.4 30.6 161.7 40.73 155.7 47.2C149.7 53.68 139.6 54.06 133.1 48.05C122.4 38.08 108 32 92.19 32C58.95 32 32 58.95 32 92.19C32 104.1 35.44 115.2 41.38 124.5C46.13 131.9 43.94 141.8 36.49 146.6C29.03 151.3 19.14 149.1 14.4 141.7C5.28 127.4 0 110.4 0 92.19C0 41.28 41.28 .0003 92.19 .0003L92.19 0zM357.1 24.59C373.6 9.345 395.6 0 419.8 0C470.7 0 512 41.28 512 92.19C512 110.4 506.7 127.4 497.6 141.7C492.9 149.1 482.1 151.3 475.5 146.6C468.1 141.8 465.9 131.9 470.6 124.5C476.6 115.2 480 104.1 480 92.19C480 58.95 453 32 419.8 32C403.1 32 389.6 38.08 378.9 48.05C372.4 54.06 362.3 53.68 356.3 47.2C350.3 40.73 350.6 30.6 357.1 24.59L357.1 24.59zM272 296L329.6 339.2C336.7 344.5 338.1 354.5 332.8 361.6C327.5 368.7 317.5 370.1 310.4 364.8L246.4 316.8C242.4 313.8 239.1 309 239.1 304V176C239.1 167.2 247.2 160 255.1 160C264.8 160 272 167.2 272 176V296zM36.69 507.3C30.44 501.1 30.44 490.9 36.69 484.7L86.7 434.7C52.62 395.4 32 344.1 32 287.1C32 164.3 132.3 63.1 256 63.1C379.7 63.1 480 164.3 480 287.1C480 344.1 459.4 395.4 425.3 434.7L475.3 484.7C481.6 490.9 481.6 501.1 475.3 507.3C469.1 513.6 458.9 513.6 452.7 507.3L402.7 457.3C363.4 491.4 312.1 512 256 512C199.9 512 148.6 491.4 109.3 457.3L59.31 507.3C53.07 513.6 42.93 513.6 36.69 507.3V507.3zM255.1 480C362 480 448 394 448 288C448 181.1 362 96 255.1 96C149.1 96 63.1 181.1 63.1 288C63.1 394 149.1 480 255.1 480z"/></svg>
                    </p>
                    <h6 class="font-bold text-lg text-teal-700 mt-2">24/7 Support</h6>
                    <p>We have a dedicated Support team. Ready to help you 24/7</p>
                </div>

                <div class="text-center md:px-16">
                    <p class="flex justify-center">
                        <svg class="h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M208 224C196.1 224 188 232.1 188 244c0 11.04 8.955 20 20 20s20-8.955 20-20C228 232.1 219 224 208 224zM224.6 80H188.2C163.8 80 144 99.84 144 124.2c0 8.844 7.156 16 16 16s16-7.156 16-16C176 117.5 181.5 112 188.2 112h36.36C233.1 112 240 118.9 240 127.4c0 5.875-3.266 11.16-8.734 13.89L200.6 157.2C195.3 159.1 192 165.4 192 171.4V192c0 8.844 7.156 16 16 16S224 200.8 224 192V181.1l21.78-11.31C261.1 161.8 272 145.5 272 127.4C272 101.3 250.7 80 224.6 80zM416 176C416 78.8 322.9 0 208 0S0 78.8 0 176c0 41.48 17.07 79.54 45.44 109.6c-15.17 32.34-38.65 58.07-38.95 58.38c-6.514 6.836-8.309 16.91-4.568 25.67C5.754 378.4 14.26 384 23.66 384c54.19 0 97.76-20.73 125.9-39.17C168.1 349.4 187.7 352 208 352C322.9 352 416 273.2 416 176zM208 320c-16.96 0-34.04-2.098-50.75-6.232L143.7 310.4L132 318.1c-20.43 13.38-51.58 28.99-89.85 32.97c9.377-12.11 22.3-30.63 32.24-51.82l9.242-19.71L68.72 263.7C44.7 238.2 32 207.9 32 176C32 96.6 110.1 32 208 32S384 96.6 384 176S305 320 208 320zM606.4 435.4C627.6 407.1 640 372.9 640 336C640 238.8 554 160 448 160c-.3145 0-.6191 .041-.9336 .043C447.5 165.3 448 170.6 448 176c0 5.43-.4668 10.76-.9414 16.09C447.4 192.1 447.7 192 448 192c88.22 0 160 64.6 160 144c0 28.69-9.424 56.45-27.25 80.26l-13.08 17.47l11.49 18.55c6.568 10.61 13.18 19.74 18.61 26.74c-18.26-1.91-36.45-6.625-54.3-14.09l-12.69-5.305l-12.58 5.557C495.9 475 472.3 480 448 480c-75.05 0-137.7-46.91-154.9-109.7c-10.1 3.336-20.5 6.132-31.2 8.271C282.7 455.1 357.1 512 448 512c29.82 0 57.94-6.414 83.12-17.54C555 504.5 583.7 512 616.3 512c9.398 0 17.91-5.57 21.73-14.32c3.74-8.758 1.945-18.84-4.568-25.67C633.3 471.8 619.6 456.8 606.4 435.4z"/></svg>
                    </p>
                    <h6 class="font-bold text-lg text-teal-700 mt-2">See our FAQS</h6>
                    <p>We answer almost all embroidery questions that you may have</p>
                </div>

            </div>
        </div>
    </section>
</template>
<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
import ProductList from "@/views/components/products/product-list.vue";
import {Head} from "@inertiajs/inertia-vue3";
import {useCategory} from "@/scripts/use/useCategory";
import {Spinner} from "flowbite-vue";

let props=defineProps({
    products:Object,
    promotion:Object,

})
const recommends=props.products.data.slice(0, 5);
const featured=props.products.data.slice(5)
const {categories}=useCategory()





</script>


