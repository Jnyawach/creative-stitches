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
            <div class="overflow-hidden" v-if="product.fourthImage">
                <img @click="slideActive=3" :src="product.fourthImage.icon" class="object-fit rounded-md cursor-pointer ">
            </div>
        </div>
        <div class="relative col-span-4 order-1 md:order-2">
            <div v-show="slideActive===index" v-for="(slide,index) in slides">
                <img @click="triggerModal(slide)" :src="slide.thumb" class="object-fit rounded-md cursor-zoom-in" :alt="product.name">
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

        <modal  :show="showModal" @close="showModal=false">
            <template #header>
                <h6>{{product.name}}</h6>
            </template>
            <div class="flex justify-center">
             <img :src="currentImage">
            </div>
        </modal>

    </div>
</template>

<script setup lang="ts">

import {ref} from "vue";
import Modal from "@/views/components/modal.vue";
let props=defineProps({
    product:Object
})
const slides=ref(
    [
        props.product.mainImage,
        props.product.secondImage,
        props.product.thirdImage,
        props.product.fourthImage,

    ]
)
const slideActive=ref(0)
function slideNext(){
    if (slideActive.value<slides.value.length-1){
        slideActive.value++
    }else{
        slideActive.value=0
    }
}

function slidePrevious(){
    if (slideActive.value){
        slideActive.value--
    }else{
        slideActive.value=slides.value.length-1
    }

}
//preview modal
const showModal=ref(false)
const currentImage=ref('')
function triggerModal(slide:any){
    currentImage.value=slide.full_image;
    showModal.value=true
}
</script>

<style scoped>

</style>
