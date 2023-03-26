<template layout="main">
<Head>
    <title>Orders</title>
</Head>
    <!--account-menu-->
    <account-menu></account-menu>
    <div class="my-8 px-3 md:px-10">
       <h1 class="text-2xl font-bold">Your Orders- {{orders.meta.total}} in total</h1>
        <div class="sm:flex justify-between mt-5">
            <div class="mt-3">
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input v-model="search" type="search" id="order-search" class="block p-2 pl-10 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-sky-600 focus:border-sky-600" placeholder="Search order by number..." required>

                </div>
            </div>
            <div class="flex justify-between mt-3">
                <div class="self-center">
                    <h6 class="font-medium text-sm sm:text-md">Showing <span class="text-sky-800">{{ orders.meta.current_page }}</span> of <span
                        class="text-sky-800">{{ orders.meta.last_page }}</span> Page(s)</h6>
                </div>
                <div class="flex justify-end">
                    <Link :href="orders.links.prev" class="btn-primary text-xs m-1 flex gap-1" v-if="orders.links.prev">
                        <svg class="fill-white h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M203.9 405.3c5.877 6.594 5.361 16.69-1.188 22.62c-6.562 5.906-16.69 5.375-22.59-1.188L36.1 266.7c-5.469-6.125-5.469-15.31 0-21.44l144-159.1c5.906-6.562 16.03-7.094 22.59-1.188c6.918 6.271 6.783 16.39 1.188 22.62L69.53 256L203.9 405.3z"/></svg>
                        <span class="self-center">Prev</span>
                    </Link>
                    <Link :href="orders.links.next" class="btn-primary text-xs m-1  flex gap-1" v-if="orders.links.next">
                        <span class="self-center">Next</span>

                        <svg class="fill-white h-4 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                    </Link>

                </div>
            </div>
        </div>
        <div class="mt-5 space-y-3">
         <div v-for="order in orders.data" :key="order.id" class="rounded-lg overflow-hidden border">
             <div class="flex justify-between bg-gray-100 px-3 p-2 ">
                 <div>
                     <h6 class="font-bold text-teal-700 text-lg">Order #{{order.order_code}}</h6>
                     <p class="text-sm">Placed on{{new Date(order.created_at).toDateString()}} | {{order.products.length}} Item(s)</p>
                 </div>
                 <div>
                    <h6 class="text-lg font-bold">$ {{Number(order.amount).toFixed(2)}}</h6>
                 </div>
             </div>
             <div class="p-3 grid md:grid-cols-2 gap-3">
              <div v-for="product in order.products" class="bg-gray-50 p-3 border rounded-lg">
                  <div class="grid grid-cols-6 justify-between">
                      <h6 class="font-bold col-span-5">{{product.name}}</h6>
                      <h6 class="font-bold col-span-1">$ {{Number(product.price).toFixed(2)}}</h6>
                  </div>
                  <div class="grid grid-cols-4 mt-3 gap-2">
                   <div class="col-span-1">
                       <img :src="product.mainImage.icon" class="rounded-lg">
                   </div>
                      <div class="text-sm col-span-3">
                          <p><span class="text-teal-700 mr-1">Sku:</span>{{product.sku}}</p>
                          <p><span class="text-teal-700 mr-1">Size:</span>{{product.design_size_mm}} mm | {{product.design_size_inches}} inches</p>
                          <p><span class="text-teal-700 mr-1">Hoop size:</span>{{product.size.size_in_mm}} mm | {{product.size.size_in_inches}} inches</p>
                          <p><span class="text-teal-700 mr-1">Stitch Count:</span>{{product.total_stitches}}</p>
                          <div class="hidden sm:block">
                              <div class="mt-3 block">
                                  <a :href="product.colorChart" class="text-white bg-teal-700 py-1 rounded-md px-2 font-semibold m-1 inline-block gap-1" title="Color Chart">
                                      <span class="self-center inline-block mr-1">Colors</span>
                                      <svg class="fill-white h-4 inline-block self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M245.4 379.1C248.4 382.7 252.2 384 256 384s7.594-1.344 10.62-4.047l144-128c6.594-5.859 7.219-15.98 1.344-22.58c-5.875-6.625-16.06-7.234-22.59-1.328L272 332.4V16C272 7.156 264.8 0 256 0S240 7.156 240 16v316.4L122.6 228C116.1 222.1 105.9 222.8 100 229.4C94.16 235.1 94.78 246.1 101.4 251.1L245.4 379.1zM448 320h-48c-8.836 0-16 7.162-16 16c0 8.836 7.164 16 16 16H448c17.67 0 32 14.33 32 32v64c0 17.67-14.33 32-32 32H64c-17.67 0-32-14.33-32-32v-64c0-17.67 14.33-32 32-32h48C120.8 352 128 344.8 128 336C128 327.2 120.8 320 112 320H64c-35.35 0-64 28.65-64 64v64c0 35.35 28.65 64 64 64h384c35.35 0 64-28.65 64-64v-64C512 348.7 483.3 320 448 320zM440 416c0-13.25-10.75-24-24-24s-24 10.75-24 24s10.75 24 24 24S440 429.3 440 416z"/></svg>
                                  </a>
                                  <a v-for="embroidery in product.embroideries" :key="embroidery.id"  :href="route('download.artwork',[embroidery.id,order.id])"  @click="downloadOrder(embroidery.id,order.id)" class="text-sm text-white bg-teal-700  py-1 rounded-md px-2 font-semibold m-1 inline-block">
                                      <span class="self-center inline-block mr-1">{{embroidery.format.abbreviation}}</span>
                                      <svg class="fill-white h-4 inline-block self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M245.4 379.1C248.4 382.7 252.2 384 256 384s7.594-1.344 10.62-4.047l144-128c6.594-5.859 7.219-15.98 1.344-22.58c-5.875-6.625-16.06-7.234-22.59-1.328L272 332.4V16C272 7.156 264.8 0 256 0S240 7.156 240 16v316.4L122.6 228C116.1 222.1 105.9 222.8 100 229.4C94.16 235.1 94.78 246.1 101.4 251.1L245.4 379.1zM448 320h-48c-8.836 0-16 7.162-16 16c0 8.836 7.164 16 16 16H448c17.67 0 32 14.33 32 32v64c0 17.67-14.33 32-32 32H64c-17.67 0-32-14.33-32-32v-64c0-17.67 14.33-32 32-32h48C120.8 352 128 344.8 128 336C128 327.2 120.8 320 112 320H64c-35.35 0-64 28.65-64 64v64c0 35.35 28.65 64 64 64h384c35.35 0 64-28.65 64-64v-64C512 348.7 483.3 320 448 320zM440 416c0-13.25-10.75-24-24-24s-24 10.75-24 24s10.75 24 24 24S440 429.3 440 416z"/></svg>
                                  </a>
                              </div>
                              <div class="flex justify-end mt-3">
                                  <Link :href="route('reviews.show',product.id)" title="Review this Product" class="text-teal-700 font-bold hover:text-teal-800">Review this Product</Link>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="sm:hidden">
                      <div class="block space-x-1 mt-3">
                          <div class="inline-block ">
                              <a :href="product.colorChart" class="text-white bg-teal-700 py-1 rounded-md px-2 font-semibold m-1 inline-block gap-1" title="Color Chart">
                                  <span class="self-center inline-block mr-1">Colors</span>
                                  <svg class="fill-white h-4 inline-block self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M245.4 379.1C248.4 382.7 252.2 384 256 384s7.594-1.344 10.62-4.047l144-128c6.594-5.859 7.219-15.98 1.344-22.58c-5.875-6.625-16.06-7.234-22.59-1.328L272 332.4V16C272 7.156 264.8 0 256 0S240 7.156 240 16v316.4L122.6 228C116.1 222.1 105.9 222.8 100 229.4C94.16 235.1 94.78 246.1 101.4 251.1L245.4 379.1zM448 320h-48c-8.836 0-16 7.162-16 16c0 8.836 7.164 16 16 16H448c17.67 0 32 14.33 32 32v64c0 17.67-14.33 32-32 32H64c-17.67 0-32-14.33-32-32v-64c0-17.67 14.33-32 32-32h48C120.8 352 128 344.8 128 336C128 327.2 120.8 320 112 320H64c-35.35 0-64 28.65-64 64v64c0 35.35 28.65 64 64 64h384c35.35 0 64-28.65 64-64v-64C512 348.7 483.3 320 448 320zM440 416c0-13.25-10.75-24-24-24s-24 10.75-24 24s10.75 24 24 24S440 429.3 440 416z"/></svg>
                              </a>
                          </div>
                          <div v-for="embroidery in product.embroideries" class="inline-block " :key="embroidery.id">
                              <a :href="route('download.artwork',[embroidery.id,order.id])"  class="text-white bg-teal-700 py-1 rounded-md px-2 font-semibold m-1 inline-block gap-1">
                                  <span class="self-center inline-block mr-1">{{embroidery.format.abbreviation}}</span>
                                  <svg class="fill-white h-4 inline-block self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M245.4 379.1C248.4 382.7 252.2 384 256 384s7.594-1.344 10.62-4.047l144-128c6.594-5.859 7.219-15.98 1.344-22.58c-5.875-6.625-16.06-7.234-22.59-1.328L272 332.4V16C272 7.156 264.8 0 256 0S240 7.156 240 16v316.4L122.6 228C116.1 222.1 105.9 222.8 100 229.4C94.16 235.1 94.78 246.1 101.4 251.1L245.4 379.1zM448 320h-48c-8.836 0-16 7.162-16 16c0 8.836 7.164 16 16 16H448c17.67 0 32 14.33 32 32v64c0 17.67-14.33 32-32 32H64c-17.67 0-32-14.33-32-32v-64c0-17.67 14.33-32 32-32h48C120.8 352 128 344.8 128 336C128 327.2 120.8 320 112 320H64c-35.35 0-64 28.65-64 64v64c0 35.35 28.65 64 64 64h384c35.35 0 64-28.65 64-64v-64C512 348.7 483.3 320 448 320zM440 416c0-13.25-10.75-24-24-24s-24 10.75-24 24s10.75 24 24 24S440 429.3 440 416z"/></svg>
                              </a>
                          </div>
                      </div>
                      <div class="flex justify-end mt-2">
                          <Link :href="route('reviews.show',product.id)" title="Review this Product" class="text-teal-700 font-bold hover:text-teal-800">Review this Product</Link>
                      </div>
                  </div>
              </div>
             </div>
         </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Link,Head} from "@inertiajs/inertia-vue3";
import {defineProps, ref, watch} from "vue";
import AccountMenu from "@/views/components/account-menu.vue";
import {Inertia} from "@inertiajs/inertia";
import {debounce} from 'lodash'


let props=defineProps({
    orders:Object,
    filters:Object
})
const search=ref(props.filters.search)
watch(search, debounce(function (value:any) {
    Inertia.get(route('orders.index'),{
        search:value
    }, {preserveState:true, replace:true});
}, 300))


</script>

<style scoped>

</style>
