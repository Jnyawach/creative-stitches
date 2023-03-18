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
                <div v-if="product.rating"  itemprop="aggregateRating" itemtype="https://schema.org/AggregateRating" itemscope>
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
        <div class="grid md:grid-cols-6 gap-8 mt-4 px-2 md:px-18">
            <div class="grid md:col-span-3">
                <!--product carousel-->
              <carousel :product="product"></carousel>
            </div>
            <div class="grid md:col-span-3">
              <div class="flex gap-2">
                  <h6 v-if="product.orders" class="font-semibold">{{product.orders}} Sale(s)</h6>
                  <div v-if="product.rating" class="flex gap-1">
                      <div v-for="rating in product.rating" class="self-center">
                          <svg class="h-4 fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                      </div>
                      <div v-for="rating in 5-product.rating" class="self-center">
                          <svg class="h-4 fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M287.9 0C297.1 0 305.5 5.25 309.5 13.52L378.1 154.8L531.4 177.5C540.4 178.8 547.8 185.1 550.7 193.7C553.5 202.4 551.2 211.9 544.8 218.2L433.6 328.4L459.9 483.9C461.4 492.9 457.7 502.1 450.2 507.4C442.8 512.7 432.1 513.4 424.9 509.1L287.9 435.9L150.1 509.1C142.9 513.4 133.1 512.7 125.6 507.4C118.2 502.1 114.5 492.9 115.1 483.9L142.2 328.4L31.11 218.2C24.65 211.9 22.36 202.4 25.2 193.7C28.03 185.1 35.5 178.8 44.49 177.5L197.7 154.8L266.3 13.52C270.4 5.249 278.7 0 287.9 0L287.9 0zM287.9 78.95L235.4 187.2C231.9 194.3 225.1 199.3 217.3 200.5L98.98 217.9L184.9 303C190.4 308.5 192.9 316.4 191.6 324.1L171.4 443.7L276.6 387.5C283.7 383.7 292.2 383.7 299.2 387.5L404.4 443.7L384.2 324.1C382.9 316.4 385.5 308.5 391 303L476.9 217.9L358.6 200.5C350.7 199.3 343.9 194.3 340.5 187.2L287.9 78.95z"/></svg>
                      </div>
                      <span class="self-center">({{product.totalRating}})</span>
                  </div>

              </div>
                <h1 class="font-bold mt-2 text-xl">{{product.name}}</h1>
                <h6 class="font-extrabold text-2xl mt-2">
                    USD {{Number(product.price).toFixed(2)}}
                    <span v-if="product.promotion_id" class="ml-1 text-teal-700 line-through text-xs">
                        USD {{Number(product.promotion.discount/100*product.price+product.price).toFixed(2)}}
                    <span class="text-sm ml-2">{{product.promotion.discount}}% off</span>
                    </span>

                </h6>
                <p class="text-sm mt-2">
                    <span class="inline-block mr-3">
                        <span class="text-teal-700">Available Formats</span><span v-for="format in product.embroideries" :key="format.id" class="ml-1 font-semibold inline-block">.{{format.format.abbreviation}}</span>
                    </span>
                    <span class="inline-block mr-3"><span class="text-teal-700">Total Stitches:</span> {{product.total_stitches}}</span>
                    <span class="inline-block mr-3"><span class="text-teal-700">Size:</span> {{product.design_size_mm}}mm | {{product.design_size_inches}}"</span>

                </p>
                <p class="text-sm mt-2 font-bold">SKU: {{product.sku}}</p>

                <div class="grid sm:grid-cols-2 gap-3">
                    <Link :href="route('cart.update',product.id)" method="patch"  type="button" class=" mt-3 text-white bg-teal-700 py-2 px-4 border rounded-full
                       m-1 border-teal-700 text-center   hover:bg-teal-900 font-semibold flex justify-center gap-2">
                        <svg class="h-5 fill-white self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256C432 264.8 424.8 272 416 272h-176V448c0 8.844-7.156 16.01-16 16.01S208 456.8 208 448V272H32c-8.844 0-16-7.15-16-15.99C16 247.2 23.16 240 32 240h176V64c0-8.844 7.156-15.99 16-15.99S240 55.16 240 64v176H416C424.8 240 432 247.2 432 256z"/></svg>
                        <span class="self-center">Add to Basket</span>
                    </Link>
                    <Link  v-if="$page.props.auth" :href="route('wishlist.update',product.id)" as="button" method="patch" class="text-black-100
                                         m-2  text-sm hover:text-teal-700 group  font-semibold flex gap-1 justify-center">
                        <svg class="h-5 self-center group-hover:fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M255.1 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 0 232.4 0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L255.1 96zM255.1 141.3L221.4 106.6C196.1 81.31 160 69.77 124.7 75.66C71.21 84.58 31.1 130.9 31.1 185.1V190.9C31.1 223.6 45.55 254.7 69.42 277L250.1 445.7C251.7 447.2 253.8 448 255.1 448C258.2 448 260.3 447.2 261.9 445.7L442.6 277C466.4 254.7 480 223.6 480 190.9V185.1C480 130.9 440.8 84.58 387.3 75.66C351.1 69.77 315.9 81.31 290.6 106.6L255.1 141.3z"/></svg>
                        <span class="self-center">Add to Wishlist</span>
                    </Link>
                    <button v-else  @click="store.login=true" type="button" class="text-black-100
                                         m-2  text-sm hover:text-teal-700 group  font-semibold flex justify-center gap-1">
                        <svg class="h-5 self-center group-hover:fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M255.1 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 0 232.4 0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L255.1 96zM255.1 141.3L221.4 106.6C196.1 81.31 160 69.77 124.7 75.66C71.21 84.58 31.1 130.9 31.1 185.1V190.9C31.1 223.6 45.55 254.7 69.42 277L250.1 445.7C251.7 447.2 253.8 448 255.1 448C258.2 448 260.3 447.2 261.9 445.7L442.6 277C466.4 254.7 480 223.6 480 190.9V185.1C480 130.9 440.8 84.58 387.3 75.66C351.1 69.77 315.9 81.31 290.6 106.6L255.1 141.3z"/></svg>
                        <span class="self-center">Add to Wishlist</span>
                    </button>
                </div>

                <div class="mt-3">
                    <h6  class="text-teal-700 font-bold">Additional Details</h6>
                    <ul class="text-sm mt-2 space-y-2">
                        <li class="flex gap-2">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M192 0C227.3 0 256 28.65 256 64V448C256 483.3 227.3 512 192 512H64C28.65 512 0 483.3 0 448V64C0 28.65 28.65 0 64 0H192zM192 32H64C46.33 32 32 46.33 32 64V448C32 465.7 46.33 480 64 480H192C209.7 480 224 465.7 224 448V416H160C151.2 416 144 408.8 144 400C144 391.2 151.2 384 160 384H224V320H160C151.2 320 144 312.8 144 304C144 295.2 151.2 288 160 288H224V224H160C151.2 224 144 216.8 144 208C144 199.2 151.2 192 160 192H224V128H160C151.2 128 144 120.8 144 112C144 103.2 151.2 96 160 96H224V64C224 46.33 209.7 32 192 32z"/></svg>
                            <span>{{product.design_size_mm}}mm | {{product.design_size_inches}}"</span>
                        </li>
                        <li class="flex gap-2">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M245.4 379.1C248.4 382.7 252.2 384 256 384s7.594-1.344 10.62-4.047l144-128c6.594-5.859 7.219-15.98 1.344-22.58c-5.875-6.625-16.06-7.234-22.59-1.328L272 332.4V16C272 7.156 264.8 0 256 0S240 7.156 240 16v316.4L122.6 228C116.1 222.1 105.9 222.8 100 229.4C94.16 235.1 94.78 246.1 101.4 251.1L245.4 379.1zM448 320h-48c-8.836 0-16 7.162-16 16c0 8.836 7.164 16 16 16H448c17.67 0 32 14.33 32 32v64c0 17.67-14.33 32-32 32H64c-17.67 0-32-14.33-32-32v-64c0-17.67 14.33-32 32-32h48C120.8 352 128 344.8 128 336C128 327.2 120.8 320 112 320H64c-35.35 0-64 28.65-64 64v64c0 35.35 28.65 64 64 64h384c35.35 0 64-28.65 64-64v-64C512 348.7 483.3 320 448 320zM440 416c0-13.25-10.75-24-24-24s-24 10.75-24 24s10.75 24 24 24S440 429.3 440 416z"/></svg>
                            <span>
                                Digital Download
                            </span>
                        </li>
                        <li class="flex gap-2">

                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M224 400C224 408.8 216.8 416 208 416C199.2 416 192 408.8 192 400V304C192 295.2 199.2 288 208 288C216.8 288 224 295.2 224 304V400zM288 288C296.8 288 304 295.2 304 304V400C304 408.8 296.8 416 288 416C279.2 416 272 408.8 272 400V304C272 295.2 279.2 288 288 288zM384 400C384 408.8 376.8 416 368 416C359.2 416 352 408.8 352 400V304C352 295.2 359.2 288 368 288C376.8 288 384 295.2 384 304V400zM349.8 7.943L457.2 192H560C568.8 192 576 199.2 576 208C576 216.8 568.8 224 560 224H536L476.1 463.5C468.1 492 443.4 512 414 512H161.1C132.6 512 107 492 99.88 463.5L40 224H16C7.164 224 0 216.8 0 208C0 199.2 7.164 192 16 192H118.8L226.2 7.943C230.6 .3098 240.4-2.268 248.1 2.184C255.7 6.637 258.3 16.43 253.8 24.07L155.9 192H420.1L322.2 24.07C317.7 16.43 320.3 6.637 327.9 2.184C335.6-2.268 345.4 .3098 349.8 7.943V7.943zM130.9 455.8C134.5 470 147.3 480 161.1 480H414C428.7 480 441.5 470 445.1 455.8L503 224H72.98L130.9 455.8z"/></svg>
                            <span>Includes Zip file of the selected format of the design & color Chart</span>
                        </li>
                        <li class="flex gap-2">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M640 250.7V360C640 379.4 626.3 395.5 607.1 399.2L608 400C608 444.2 572.2 480 528 480C483.8 480 448 444.2 448 400H288C288 444.2 252.2 480 208 480C181.8 480 158.6 467.4 144 448C129.4 467.4 106.2 480 80 480C35.82 480 0 444.2 0 400V104C0 64.24 32.24 32 72 32H408C447.8 32 480 64.24 480 104V128H536C551.1 128 565.3 135.1 574.4 147.2L630.4 221.9C636.6 230.2 640 240.3 640 250.7zM32 104V335.1C45.37 325.1 61.99 320 80 320C106.2 320 129.4 332.6 144 351.1C158.6 332.6 181.8 320 208 320C240.8 320 268.1 339.7 281.3 368H448V104C448 81.91 430.1 64 408 64H72C49.91 64 32 81.91 32 104zM528 320C560.8 320 588.9 339.7 601.3 367.9C605.1 367.3 608 363.1 608 360V256H480V335.1C493.4 325.1 509.1 320 528 320zM480 160V224H592L548.8 166.4C545.8 162.4 541 160 536 160H480zM528 448C554.5 448 576 426.5 576 400C576 373.5 554.5 352 528 352C501.5 352 480 373.5 480 400C480 426.5 501.5 448 528 448zM208 352C181.5 352 160 373.5 160 400C160 426.5 181.5 448 208 448C234.5 448 256 426.5 256 400C256 373.5 234.5 352 208 352zM80 448C106.5 448 128 426.5 128 400C128 373.5 106.5 352 80 352C53.49 352 32 373.5 32 400C32 426.5 53.49 448 80 448z"/></svg>
                            <span>
                                No returns Accepted
                            </span>
                        </li>
                    </ul>
                </div>

                <div v-html="product.description" class="mt-2 text leading-7"></div>

            </div>
        </div>
    </section>
    <!--related products-->
    <section v-if="featured.length">
        <div class="my-14 px-3 md:px-10">
            <h2 class="font-bold text-2xl">Related Designs</h2>
            <product-list :products="featured"></product-list>
        </div>
    </section>
    <!---product review-->
    <section>
        <div v-if="reviews.data.length" class="px-3 md:px-10 my-10">
           <div class="flex gap-2">
               <h5 class="text-2xl font-bold">{{product.totalRating}} Reviews</h5>
               <div v-if="product.rating" class="flex gap-1">
                   <div v-for="rating in product.rating" class="self-center">
                       <svg class="h-4 fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                   </div>
                   <div v-for="rating in 5-product.rating" class="self-center">
                       <svg class="h-4 fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M287.9 0C297.1 0 305.5 5.25 309.5 13.52L378.1 154.8L531.4 177.5C540.4 178.8 547.8 185.1 550.7 193.7C553.5 202.4 551.2 211.9 544.8 218.2L433.6 328.4L459.9 483.9C461.4 492.9 457.7 502.1 450.2 507.4C442.8 512.7 432.1 513.4 424.9 509.1L287.9 435.9L150.1 509.1C142.9 513.4 133.1 512.7 125.6 507.4C118.2 502.1 114.5 492.9 115.1 483.9L142.2 328.4L31.11 218.2C24.65 211.9 22.36 202.4 25.2 193.7C28.03 185.1 35.5 178.8 44.49 177.5L197.7 154.8L266.3 13.52C270.4 5.249 278.7 0 287.9 0L287.9 0zM287.9 78.95L235.4 187.2C231.9 194.3 225.1 199.3 217.3 200.5L98.98 217.9L184.9 303C190.4 308.5 192.9 316.4 191.6 324.1L171.4 443.7L276.6 387.5C283.7 383.7 292.2 383.7 299.2 387.5L404.4 443.7L384.2 324.1C382.9 316.4 385.5 308.5 391 303L476.9 217.9L358.6 200.5C350.7 199.3 343.9 194.3 340.5 187.2L287.9 78.95z"/></svg>
                   </div>

               </div>
           </div>
            <hr class="mt-3">
            <div  v-for="review in reviews.data" class="mt-8">
                <!---review schema-->
                <div>
                    <div itemtype="https://schema.org/Product" itemscope>
                        <meta itemprop="name" :content="product.name" />
                        <meta itemprop="description" :content="product.meta_description" />
                        <div itemprop="aggregateRating" itemtype="https://schema.org/AggregateRating" itemscope>
                            <meta itemprop="reviewCount" :content="product.totalRating" />
                            <meta itemprop="ratingValue" :content="product.rating" />
                        </div>
                        <div  itemprop="review" itemtype="https://schema.org/Review" itemscope>
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
                    <div v-if="product.rating" class="flex gap-1">
                        <div v-for="rating in product.rating" class="self-center">
                            <svg class="h-4 fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                        </div>
                        <div v-for="rating in 5-product.rating" class="self-center">
                            <svg class="h-4 fill-teal-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M287.9 0C297.1 0 305.5 5.25 309.5 13.52L378.1 154.8L531.4 177.5C540.4 178.8 547.8 185.1 550.7 193.7C553.5 202.4 551.2 211.9 544.8 218.2L433.6 328.4L459.9 483.9C461.4 492.9 457.7 502.1 450.2 507.4C442.8 512.7 432.1 513.4 424.9 509.1L287.9 435.9L150.1 509.1C142.9 513.4 133.1 512.7 125.6 507.4C118.2 502.1 114.5 492.9 115.1 483.9L142.2 328.4L31.11 218.2C24.65 211.9 22.36 202.4 25.2 193.7C28.03 185.1 35.5 178.8 44.49 177.5L197.7 154.8L266.3 13.52C270.4 5.249 278.7 0 287.9 0L287.9 0zM287.9 78.95L235.4 187.2C231.9 194.3 225.1 199.3 217.3 200.5L98.98 217.9L184.9 303C190.4 308.5 192.9 316.4 191.6 324.1L171.4 443.7L276.6 387.5C283.7 383.7 292.2 383.7 299.2 387.5L404.4 443.7L384.2 324.1C382.9 316.4 385.5 308.5 391 303L476.9 217.9L358.6 200.5C350.7 199.3 343.9 194.3 340.5 187.2L287.9 78.95z"/></svg>
                        </div>

                    </div>
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
                    <Link :href="reviews.links.prev" class="btn-primary text-xs m-1 flex gap-1" v-if="reviews.links.prev">
                        <svg class="fill-white h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M203.9 405.3c5.877 6.594 5.361 16.69-1.188 22.62c-6.562 5.906-16.69 5.375-22.59-1.188L36.1 266.7c-5.469-6.125-5.469-15.31 0-21.44l144-159.1c5.906-6.562 16.03-7.094 22.59-1.188c6.918 6.271 6.783 16.39 1.188 22.62L69.53 256L203.9 405.3z"/></svg>
                        <span class="self-center">Prev</span>
                    </Link>
                    <Link :href="reviews.links.next" class="btn-primary text-xs m-1 flex gap-1" v-if="reviews.links.next">
                        <span class="self-center">Next</span>
                        <svg class="fill-white h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                    </Link>

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
import {Spinner} from "flowbite-vue";


let props=defineProps({
    product:Object,
    products:Object,
    reviews:Object
})
const product=reactive(props.product.data)
const featured=props.products.data

</script>

<style scoped>

</style>
