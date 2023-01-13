<template>
    <div  class="z-[10000]">
        <ais-instant-search :search-client="searchClient" index-name="products" >

            <ais-configure
                :attributesToSnippet="['names','categories','description','keywords']"
                :hits-per-page.camel="4">
                <ais-autocomplete class="relative ">
                    <template v-slot="{ currentRefinement, indices, refine }">
                    <span class="relative">
                        <input
                            type="search"
                            :value="currentRefinement"
                            placeholder="Search for anything"
                            class="rounded-full w-full focus:border-teal-700"
                            autofocus
                            autocomplete="off"
                            @input="refine($event.currentTarget.value)"
                            @keypress.enter="search"
                        >
                    </span>
                        <div class="search-result absolute mt-3 px-2 w-full sm:px-0" v-if="currentRefinement.length">
                            <div class="rounded-lg  shadow-lg overflow-hidden">
                                <div class="bg-white px-5 py-6 sm:gap-8 sm:p-8">
                                    <div class="divide-y divide-teal-900" v-for="item in indices" :key="item.objectID">
                                        <div class="flex justify-between items-center" v-if="indices.length">
                                            <h2 class="capitalize text-teal-700 py-1 px-2">
                                                {{ item.indexName }}
                                            </h2>
                                            <ais-stats class="" />
                                        </div>
                                        <Link :href="route('shop.show', hit.slug)" class="grid grid-cols-6 items-center space-x-4 px-2 py-2 transition hover:bg-gray-100 " v-for="(hit, index) in item.hits" :key="index">
                                            <div class="grid col-span-1">
                                                <img
                                                    :src="hit.thumbnail"
                                                    :alt="hit.name"
                                                />

                                            </div>
                                            <div class="col-span-5">

                                                <ais-highlight attribute="name" :hit="hit" class="block font-bold"></ais-highlight>
                                                <ais-snippet attribute="description" :hit="hit" class="block text-sm"></ais-snippet>
                                            </div>
                                        </Link>
                                    </div>
                                    <ais-powered-by  class="flex justify-end border-t  mt-4 px-2 py-2"></ais-powered-by>
                                </div>
                            </div>
                        </div>
                    </template>
                </ais-autocomplete>
            </ais-configure>
        </ais-instant-search>
    </div>

</template>

<script setup lang="ts">
import algoliasearch from 'algoliasearch/lite';
import {Link} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";


const searchClient=algoliasearch(
    import.meta.env.VITE_ALGOLIA_APP_ID,
    import.meta.env.VITE_ALGOLIA_SECRET
)
function search(){
    Inertia.get(route('search.algolia'))
}
</script>

<style scoped>
.search-result{
    z-index: 100000 !important;
}
</style>
