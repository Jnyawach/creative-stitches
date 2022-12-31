<template layout="main">
<Head>
    <title>{{product.name}}</title>
    <meta name="keywords" :content="product.keywords">
    <meta name="description" :content="product.meta_description">
    <meta property="og:title" :content="product.name">
    <meta property="og:description" :content="product.meta_description">
    <meta property="og:image" :content="product.mainImage.full_image">
    <meta property="og:url" :content="route('shop.show',product.slug)">
    <meta name="twitter:title" :content="product.name">
    <meta name="twitter:description" :content="product.meta_description">
    <meta name="twitter:url" :content="route('shop.show',product.slug)">
    <meta name="twitter:card" :content="product.meta_description">
</Head>
    <section class="my-5 px-3">
     <!-- Breadcrumbs-->
        <div>
            <ol itemscope itemtype="https://schema.org/BreadcrumbList" class="flex font-montserrat">
                <li itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem" class="hover:text-teal-700 m-1 text-sm">
                    <Link itemprop="item" :href="route('shop.index')">
                        <span itemprop="name">Shop all</span></Link>
                    <meta itemprop="position" content="1" />
                </li>
                <li class="m-1">|</li>
                <li itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem" class="hover:text-teal-700 m-1 text-sm">
                    <Link itemscope itemtype="https://schema.org/WebPage"
                       itemprop="item" :itemid="route('shop.category',product.category.slug)"
                       :href="route('shop.category',product.category.slug)">
                        <span itemprop="name">{{product.category.name}}</span></Link>
                    <meta itemprop="position" content="2" />
                </li>
                <li class="m-1">|</li>
                <li itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem" class="hover:text-teal-700 m-1 text-sm">
                    <Link itemprop="item" :href="route('shop.show', product.slug)">
                        <span itemprop="name">{{product.name}}</span></Link>
                    <meta itemprop="position" content="3" />
                </li>
            </ol>

        </div>
        <!---Product Display-->
        <div class="grid md:grid-cols-6 gap-8 mt-4 px-3 md:px-18">
            <div class="md:col-span-3">
                <!--product carousel-->
              <carousel :product="product"></carousel>
            </div>
            <div class="md:col-span-3">
              <div class="flex justify-between">
                  <h6 class="font-semibold">1283 Sales
                      <span class="text-teal-700 mr-2">
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star-half-alt"></i></span>
                        (624)
                    </span>
                  </h6>
                  <button class="font-bold hover:text-teal-700">Report this Design</button>
              </div>
                <h1 class="font-bold mt-2 text-xl">{{product.name}}</h1>
                <h6 class="font-montserrat font-extrabold text-2xl mt-2">
                    USD {{product.price}}
                    <span v-if="product.promotion" class="ml-1 text-teal-700 line-through text-xs">
                        USD {{Number(product.promotion.discount/100*product.price+product.price).toFixed(2)}}</span>
                    <span class="text-sm ml-2">{{product.promotion.discount}}% off</span>
                </h6>
                <p class="text-sm mt-2"><span class="text-teal-700">Available Formats</span><span v-for="format in product.embroideries" :key="format.id" class="ml-1 font-semibold">.{{format.format.abbreviation}}</span></p>
                <p class="text-sm mt-2">SKU: {{product.sku}}</p>
                <div class="flex gap-3">
                    <button type="button" class=" mt-3 text-white bg-teal-700 py-2 px-4 border rounded-full
                       m-1 border-teal-700   hover:bg-teal-900 font-semibold">
                        <span class="mr-2"><i class="far fa-plus"></i></span>Add to Basket
                    </button>
                    <button class="hover:text-teal-700 font-semibold"><span class="mr-2"><i class="fal fa-heart"></i></span>Save to Wishlist</button>
                </div>

                <div class="mt-3">
                    <h6  class="text-teal-700">Additional Details</h6>
                    <ul class="text-sm">
                        <li><span class="mr-2"><i class="far fa-cloud-download"></i></span>Digital Download</li>
                        <li><span class="mr-2"><i class="far fa-shopping-basket"></i></span>Includes Zip file of the selected format of the design & color Chart</li>
                        <li><span class="mr-2"><i class="far fa-shipping-fast"></i></span>No returns Accepted</li>
                    </ul>
                </div>

                <div v-html="product.description" class="mt-2"></div>
                <!--
                <div class="bg-teal-50 p-2 border-l-2 border-l-teal-700">
                    <p class="text-teal-500">You may embroider designs for personal use and items to sell.
                        Do not resell the digitized file.
                        You can embroider it onto you project and sell this like a finish work.</p>
                </div-->
            </div>
        </div>
    </section>
    <!--related products-->
    <section>
        <div class="my-14 px-3 md:px-10">
            <h2 class="font-bold text-2xl">Related Designs</h2>
            <product-list :products="featured"></product-list>
        </div>
    </section>
    <!---product review-->
    <section>
        <div class="px-3 md:px-10 my-10">
            <h5 class="text-2xl font-bold">624 Reviews
                <span class="text-teal-700 mr-2">
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star-half-alt"></i></span>
         </span>
            </h5>
            <hr class="mt-3">
            <div class="mt-5">
                <div>
                    <p><span class="text-teal-700 mr-2">
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star-half-alt"></i></span>
                  </span></p>
                    <p class="mt-2">I went on a not-sober Xmas shopping spree and totally forgot
                        I ordered this mug and a mini planter, so the wait time was no problem at all.
                        When I received this in the mail it was a very pleasant surprise gift from past
                        me to current me! I love them both!! Would order again sober.
                        The packaging was also very secure and efficient!
                        I love when there isn’t an excess of materials used.</p>

                    <div class="flex mt-3 gap-3">
                        <div>
                            <img :src="'/images/user-icon.png'" class="w-14 h-14">
                        </div>
                        <div class="self-center font-bold">
                            <h6>Maria Bruno  02 Feb 2023</h6>
                            <p class="text-teal-700">Verified Purchase</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!---design tags-->
    <section>
        <div class="px-3 md:px-10 bg-teal-50 py-10">
            <h6>Design Tags: {{product.keywords}}</h6>
        </div>
    </section>
</template>

<script setup lang="ts">
import {reactive} from "vue";
import {Head} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
import Carousel from "@/views/components/products/carousel.vue";
import ProductList from "@/views/components/products/product-list.vue";
import Sidelink from "@/views/components/sidelink.vue";

let props=defineProps({
    product:Object,
    products:Object
})
const product=reactive(props.product.data)
const featured=props.products.data



</script>

<style scoped>

</style>
