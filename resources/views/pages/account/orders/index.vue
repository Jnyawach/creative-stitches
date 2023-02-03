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
                    <Link :href="orders.links.prev" class="btn-primary text-xs m-1" v-if="orders.links.prev"><span
                        class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                    </Link>
                    <Link :href="orders.links.next" class="btn-primary text-xs m-1" v-if="orders.links.next">Next
                        <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

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
                                  <a :href="product.colorChart" class="text-white bg-teal-700 py-1 rounded-md px-2 font-semibold m-1 inline-block" title="Color Chart">Color Chart<span class="ml-2"><i class="fal fa-download"></i></span></a>
                                  <a v-for="embroidery in product.embroideries" :key="embroidery.id"  :href="route('download.artwork',[embroidery.id,order.id])"  @click="downloadOrder(embroidery.id,order.id)" class="text-sm text-white bg-teal-700  py-1 rounded-md px-2 font-semibold m-1 inline-block">{{embroidery.format.abbreviation}}<span class="ml-2"><i class="fal fa-download"></i></span></a>
                              </div>
                              <div class="flex justify-end mt-3">
                                  <Link :href="route('reviews.show',product.id)" title="Review this Product" class="text-teal-700 font-bold hover:text-teal-800">Review this Product</Link>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="sm:hidden">
                      <div class="grid mt-3 gap-1 grid-cols-3">
                          <div class="w-full grid">
                              <a :href="product.colorChart" class="text-center w-full text-sm text-white bg-teal-700  py-1 rounded-md px-2 font-semibold" title="Color Chart">Colors<span class="ml-2"><i class="fal fa-download"></i></span></a>
                          </div>
                          <div v-for="embroidery in product.embroideries" class="w-full grid" :key="embroidery.id">
                              <a :href="route('download.artwork',[embroidery.id,order.id])"  class="text-center w-full text-sm text-white bg-teal-700  py-1 rounded-md px-2 font-semibold">{{embroidery.format.abbreviation}}<span class="ml-2"><i class="fal fa-download"></i></span></a>
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

import _ from "lodash"


let props=defineProps({
    orders:Object,
    filters:Object
})
const search=ref(props.filters.search)
watch(search, _.debounce(function (value:any) {
    Inertia.get(route('orders.index'),{
        search:value
    }, {preserveState:true, replace:true});
}, 300))


</script>

<style scoped>

</style>
