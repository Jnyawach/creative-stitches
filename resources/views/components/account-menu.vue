<template>
<div class="bg-black-100  py-3 px-3 md:px-10">
    <ul class="text-white font-montserrat text-sm flex gap-4 font-medium">
      <li>
          <Link :href="route('account.index')" class="hover:text-teal-500" :class="{ 'text-teal-500': $page.url==='/account' }">
              <span class="mr-1"><i class="far fa-user-circle"></i></span>Profile
          </Link>
      </li>
        <li>
            <Link :href="route('wishlist.index')" class="hover:text-teal-500" :class="{ 'text-teal-500': $page.url==='/account/wishlist' }">
                <span class="mr-1"><i class="far fa-heart"></i></span>My Wishlist
            </Link>
        </li>
        <li>
            <Link :href="route('orders.index')" class="hover:text-teal-500" :class="{ 'text-teal-500': $page.url.startsWith('/account/orders') }">
                <span class="mr-1"><i class="fal fa-shopping-bag"></i></span>Orders
            </Link>
        </li>
    </ul>
</div>

</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";

</script>

<style scoped>

</style>
