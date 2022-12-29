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
                    itemtype="https://schema.org/ListItem" class="hover:text-teal-700 m-1">
                    <Link itemprop="item" :href="route('shop.index')">
                        <span itemprop="name">Shop all</span></Link>
                    <meta itemprop="position" content="1" />
                </li>
                <li class="m-1">|</li>
                <li itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem" class="hover:text-teal-700 m-1">
                    <Link itemscope itemtype="https://schema.org/WebPage"
                       itemprop="item" :itemid="route('shop-category.show',product.category.slug)"
                       :href="route('shop-category.show',product.category.slug)">
                        <span itemprop="name">{{product.category.name}}</span></Link>
                    <meta itemprop="position" content="2" />
                </li>
                <li class="m-1">|</li>
                <li itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem" class="hover:text-teal-700 m-1">
                    <a itemprop="item" :href="route('shop.show', product.slug)">
                        <span itemprop="name">{{product.name}}</span></a>
                    <meta itemprop="position" content="3" />
                </li>
            </ol>

        </div>
        <!---Product Display-->
        <div class="grid grid-cols-5 gap-3">
            <div class="md:col-span-3">
                <div class="carousel">
                    <div class="carousel-inner flex">
                        <div class="carousel-item">
                            <img :src="product.mainImage.thumb">
                        </div>
                        <div class="carousel-item">
                            <img :src="product.mainImage.thumb">
                        </div>
                        <div class="carousel-item">
                            <img :src="product.mainImage.thumb">
                        </div>
                        <div class="carousel-item">
                            <img :src="product.mainImage.thumb">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</template>

<script setup lang="ts">
import {reactive} from "vue";
import {Head} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
import {ref} from "vue";

let props=defineProps({
    product:Object
})
const product=reactive(props.product.data)
const slides=ref(
    [
        product.mainImage.thumb,
        product.secondImage.thumb,
        product.thirdImage.thumb,
        product.fourthImage.thumb,

        ]
)

</script>

<style scoped>

</style>
