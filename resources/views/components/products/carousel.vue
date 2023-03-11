<template>
    <div class="grid sm:grid-cols-5 gap-1">
        <div class="flex gap-1 sm:block sm:space-y-1  sm:col-span-1 order-2">
            <div class="overflow-hidden" v-show="product.mainImage.icon">
                <img @click="slideActive=0" :src="product.mainImage.icon" class="w-[100px] sm:w-full rounded-md cursor-pointer ">
            </div>
            <div class="overflow-hidden" v-if="product.secondImage.icon">
                <img @click="slideActive=1" :src="product.secondImage.icon" class="w-[100px] sm:w-full rounded-md cursor-pointer ">
            </div>
            <div class="overflow-hidden" v-if="product.thirdImage.icon">
                <img @click="slideActive=2" :src="product.thirdImage.icon" class="w-[100px] sm:w-full rounded-md cursor-pointer ">
            </div>
            <div class="overflow-hidden" v-if="product.fourthImage.icon">
                <img @click="slideActive=3" :src="product.fourthImage.icon" class="w-[100px] sm:w-full rounded-md cursor-pointer ">
            </div>
        </div>
        <div class=" relative  sm:col-span-4 order-1 sm:order-2">
            <div class="relative block">
                <img v-show="slideActive===index" v-for="(slide,index) in images" @click="triggerModal(slide)" :src="slide.thumb" class="w-full rounded-md cursor-zoom-in" :alt="product.name">

                <button @click="slidePrevious()" class="absolute rounded-full bg-teal-700/30
                            top-0 bottom-0  left-1 my-auto p-2 h-10 w-10 text-white hover:bg-teal-700/50 place-content-center flex">

                    <svg class="h-6 self-center fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M203.9 405.3c5.877 6.594 5.361 16.69-1.188 22.62c-6.562 5.906-16.69 5.375-22.59-1.188L36.1 266.7c-5.469-6.125-5.469-15.31 0-21.44l144-159.1c5.906-6.562 16.03-7.094 22.59-1.188c6.918 6.271 6.783 16.39 1.188 22.62L69.53 256L203.9 405.3z"/></svg>
                </button>
                <button @click="slideNext()" class="absolute rounded-full bg-teal-700/30 place-content-center flex
                          top-0 bottom-0 right-1 my-auto p-2 h-10 w-10 text-white hover:bg-teal-700/50">

                    <svg class="h-6 self-center fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M219.9 266.7L75.89 426.7c-5.906 6.562-16.03 7.094-22.59 1.188c-6.918-6.271-6.783-16.39-1.188-22.62L186.5 256L52.11 106.7C46.23 100.1 46.75 90.04 53.29 84.1C59.86 78.2 69.98 78.73 75.89 85.29l144 159.1C225.4 251.4 225.4 260.6 219.9 266.7z"/></svg>
                </button>
            </div>
            <div class="absolute top-1 right-1">
                <a data-pin-do="buttonFollow" href="https://www.pinterest.com/creativestitchesembroidery/">Pinterest</a>
            </div>
        </div>



    </div>
    <full-image  :show="showModal" @close="showModal=false">
        <div class="flex justify-center">
            <img :src="currentImage.full_image" :alt="product.name">
        </div>
    </full-image>
    <component is="script" type="application/javascript" async defer src="//assets.pinterest.com/js/pinit.js">

    </component>
</template>

<script setup lang="ts">

import {ref} from "vue";

import FullImage from "@/views/components/products/full-image.vue";
import {elements} from "chart.js";
let props=defineProps({
    product:Object
})
const slides=ref(
    [
        props.product.mainImage,
        props.product.secondImage,
        props.product.thirdImage,
        props.product.fourthImage,

    ])

const images=slides.value.filter(Boolean)

const slideActive=ref(0)
function slideNext(){
    if (slideActive.value<images.length-1){
        slideActive.value++
    }else{
        slideActive.value=0
    }
}

function slidePrevious(){
    if (slideActive.value){
        slideActive.value--
    }else{
        slideActive.value=images.length-1
    }

}
//preview modal
const showModal=ref(false)
const currentImage=ref('')
function triggerModal(slide:any){
    currentImage.value=slide;
    showModal.value=true
}

const removeEmpty = (obj: any[]) => {
    Object.keys(obj).forEach(k =>
        (obj[k] && typeof obj[k] === 'object') && removeEmpty(obj[k]) ||
        (!obj[k] && obj[k] !== undefined) && delete obj[k]
    );
    return obj;
};



</script>

<style scoped>

</style>
