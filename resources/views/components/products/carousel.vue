<template>
    <div class="grid md:grid-cols-5 gap-1">
        <div class="flex justify-center md:grid gap-1  md:col-span-1 order-2 md:order-1 w-full">
            <div class="overflow-hidden" v-show="product.mainImage.icon">
                <img @click="slideActive=0" :src="product.mainImage.icon" class="object-fit rounded-md cursor-pointer ">
            </div>
            <div class="overflow-hidden" v-if="product.secondImage.icon">
                <img @click="slideActive=1" :src="product.secondImage.icon" class="object-fit rounded-md cursor-pointer ">
            </div>
            <div class="overflow-hidden" v-if="product.thirdImage.icon">
                <img @click="slideActive=2" :src="product.thirdImage.icon" class="object-fit rounded-md cursor-pointer ">
            </div>
            <div class="overflow-hidden" v-if="product.fourthImage.icon">
                <img @click="slideActive=3" :src="product.fourthImage.icon" class="object-fit rounded-md cursor-pointer ">
            </div>
        </div>
        <div class="flex justify-center relative col-span-4 order-1 md:order-2">
            <div v-show="slideActive===index" v-for="(slide,index) in images">
                <img @click="triggerModal(slide)" :src="slide" class="object-fit rounded-md cursor-zoom-in" :alt="product.name">
            </div>
            <button @click="slidePrevious()" class="absolute rounded-full bg-teal-700/30
                            top-0 bottom-0 left-1 my-auto p-2 h-10 w-10 text-white hover:bg-teal-700/50">
                <span><i class="far fa-angle-left"></i></span>
            </button>
            <button @click="slideNext()" class="absolute rounded-full bg-teal-700/30
                          top-0 bottom-0 right-1 my-auto p-2 h-10 w-10 text-white hover:bg-teal-700/50">
                <span><i class="far fa-angle-right"></i></span>
            </button>
        </div>

        <full-image  :show="showModal" @close="showModal=false">
            <div class="flex justify-center">
             <img :src="currentImage">
            </div>
        </full-image>

    </div>
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
        props.product.mainImage.thumb,
        props.product.secondImage.thumb,
        props.product.thirdImage.thumb,
        props.product.fourthImage.thumb,

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
