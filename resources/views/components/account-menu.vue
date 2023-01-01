<template>
<div class="bg-black-100  py-3 px-3 md:px-10">
    <ul class="text-white font-montserrat font-semibold text-sm">
      <li>
          <Link :href="route('account.index')" class="hover:text-teal-500" :class="{ 'text-teal-500': $page.url.startsWith('/account') }">
              <span class="mr-1"><i class="far fa-user-circle"></i></span>Profile
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
