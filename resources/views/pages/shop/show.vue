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
    <div class="max-w-[1280px] mx-auto">
    <section class="my-5 px-3 ">
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
        <!--product structured data-->
        <div>
            <div itemtype="https://schema.org/Product" itemscope>
                <meta itemprop="mpn" :content="product.mpn" />
                <meta itemprop="name" :content="product.name" />
                <link itemprop="image" :href="product.mainImage.full_image" />
                <meta itemprop="description" :content="product.meta_description" />
                <div itemprop="offers" itemtype="https://schema.org/AggregateOffer" itemscope>
                    <meta itemprop="lowPrice" :content="product.price" />
                    <meta itemprop="highPrice" :content="product.price" />
                    <meta itemprop="offerCount" content="16" />
                    <meta itemprop="priceCurrency" content="USD" />
                </div>
                <div itemprop="aggregateRating" itemtype="https://schema.org/AggregateRating" itemscope>
                    <meta itemprop="reviewCount" :content="product.totalRating" />
                    <meta itemprop="ratingValue" :content="product.rating" />
                </div>
                <meta itemprop="sku" :content="product.sku" />
                <div itemprop="brand" itemtype="https://schema.org/Brand" itemscope>
                    <meta itemprop="name" content="Creative Stitches" />
                </div>
            </div>
        </div>
        <!---Product Display-->
        <div class="grid md:grid-cols-6 gap-8 mt-4 px-3 md:px-18">
            <div class="md:col-span-3">
                <!--product carousel-->
              <carousel :product="product"></carousel>
            </div>
            <div class="md:col-span-3">
              <div class="flex justify-between">
                  <h6 v-if="product.orders" class="font-semibold">{{product.orders}} Sale(s)
                      <span v-if="product.rating" class="text-sm">
                          <span v-for="rating in product.rating" class="text-teal-700"><i class="fas fa-star"></i></span>
                          <span v-for="rating in 5-product.rating" class="text-teal-700"><i class="far fa-star"></i></span>
                          ({{product.totalRating}})
                      </span>
                  </h6>
                  <button class="font-bold hover:text-teal-700">Report this Design</button>
              </div>
                <h1 class="font-bold mt-2 text-xl">{{product.name}}</h1>
                <h6 class="font-montserrat font-extrabold text-2xl mt-2">
                    USD {{Number(product.price).toFixed(2)}}
                    <span v-if="product.promotion" class="ml-1 text-teal-700 line-through text-xs">
                        USD {{Number(product.promotion.discount/100*product.price+product.price).toFixed(2)}}</span>
                    <span class="text-sm ml-2">{{product.promotion.discount}}% off</span>
                </h6>
                <p class="text-sm mt-2"><span class="text-teal-700">Available Formats</span><span v-for="format in product.embroideries" :key="format.id" class="ml-1 font-semibold">.{{format.format.abbreviation}}</span></p>
                <p class="text-sm mt-2">SKU: {{product.sku}}</p>
                <div class="grid sm:grid-cols-2 gap-3">
                    <Link :href="route('cart.update',product.id)" method="patch"  type="button" class=" mt-3 text-white bg-teal-700 py-2 px-4 border rounded-full
                       m-1 border-teal-700 text-center   hover:bg-teal-900 font-semibold">
                        <span class="mr-2"><i class="far fa-plus"></i></span>Add to Basket
                    </Link>
                    <Link  v-if="$page.props.auth" :href="route('wishlist.update',product.id)" as="button" method="patch" class="text-black-100
                                         m-2  text-sm hover:text-teal-700  font-semibold">
                        <span class="mr-2"><i class="far fa-heart"></i></span>Add to Wishlist
                    </Link>
                    <Link v-else  @click="store.login=true" as="button" class="text-black-100
                                         m-2  text-sm hover:text-teal-700  font-semibold">
                        <span class="mr-2"><i class="far fa-heart"></i></span>Add to Wishlist
                    </Link>
                </div>

                <div class="mt-3">
                    <h6  class="text-teal-700 font-bold">Additional Details</h6>
                    <ul class="text-sm mt-2 space-y-2">
                        <li><span class="mr-2"><i class="far fa-cloud-download"></i></span>Digital Download</li>
                        <li><span class="mr-2"><i class="far fa-shopping-basket"></i></span>Includes Zip file of the selected format of the design & color Chart</li>
                        <li><span class="mr-2"><i class="far fa-shipping-fast"></i></span>No returns Accepted</li>
                    </ul>
                </div>

                <div v-html="product.description" class="mt-2 text-sm leading-7"></div>
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
        <div v-if="reviews.data.length" class="px-3 md:px-10 my-10">
            <h5 class="text-2xl font-bold">{{product.totalRating}} Reviews
                <span v-if="product.rating" class="mt-1">
                    <span v-for="rating in product.rating" class="text-teal-700"><i class="fas fa-star"></i></span>
                    <span v-for="rating in 5-product.rating" class="text-teal-700"><i class="far fa-star"></i></span>

                </span>
            </h5>
            <hr class="mt-3">
            <div v-for="review in reviews.data" class="mt-5">
                <!---review schema-->
                <div>
                    <div itemtype="https://schema.org/Product" itemscope>
                        <meta itemprop="name" :content="product.name" />
                        <meta itemprop="description" :content="product.meta_description" />
                        <div itemprop="aggregateRating" itemtype="https://schema.org/AggregateRating" itemscope>
                            <meta itemprop="reviewCount" :content="product.totalRating" />
                            <meta itemprop="ratingValue" :content="product.rating" />
                        </div>
                        <div itemprop="review" itemtype="https://schema.org/Review" itemscope>
                            <div itemprop="author" itemtype="https://schema.org/Person" itemscope>
                                <meta itemprop="name" :content="review.user.name+' '+review.user.last_name" />
                            </div>
                            <div itemprop="reviewRating" itemtype="https://schema.org/Rating" itemscope>
                                <meta itemprop="ratingValue" :content="review.rating" />
                                <meta itemprop="bestRating" content="5" />
                            </div>
                        </div>
                    </div>
                </div>
                <!--End of Review Schema-->
                <div>
                    <p v-if="review.rating" class="mt-1">
                        <span v-for="rating in review.rating" class="text-teal-700"><i class="fas fa-star"></i></span>
                        <span v-for="rating in 5-review.rating" class="text-teal-700"><i
                            class="far fa-star"></i></span>

                    </p>
                    <p v-if="review.comment" class="mt-2">{{review.comment}}</p>

                    <div class="flex mt-3 gap-3">
                        <div>
                            <img :src="'/images/user-icon.png'" class="w-14 h-14">
                        </div>
                        <div class="self-center font-bold">
                            <h6>{{review.user.name}} {{new Date(review.created_at).toDateString()}}</h6>
                            <p class="text-teal-700">Verified Purchase</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-10">
                <div class="self-center">
                    <h6 class="font-medium">Showing <span class="text-sky-800">{{ reviews.meta.current_page }}</span> of <span
                        class="text-sky-800">{{ reviews.meta.last_page }}</span> Page(s)</h6>
                </div>
                <div class="flex">
                    <Link :href="reviews.links.prev" class="btn-primary text-xs m-1" v-if="reviews.links.prev"><span
                        class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                    </Link>
                    <Link :href="reviews.links.next" class="btn-primary text-xs m-1" v-if="reviews.links.next">Next
                        <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

                </div>
            </div>
        </div>
    </section>
    </div>
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
import {store} from "@/scripts/store/login";


let props=defineProps({
    product:Object,
    products:Object,
    reviews:Object
})
const product=reactive(props.product.data)
const featured=props.products.data
const jsonLd={
    "@context": "https://schema.org/",
    "@type": "Product",
    "name":product.name,
    "description":product.meta_description,
    "review": {
        "@type": "Review",
        "reviewRating": {
            "@type": "Rating",
            "ratingValue": product.rating,
            "bestRating": "5"
        },
        "author": {
            "@type": "Person",
            "name": "Fred Benson"
        }
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": product.rating,
        "reviewCount": product.totalRating
    }
}



</script>

<style scoped>

</style>
