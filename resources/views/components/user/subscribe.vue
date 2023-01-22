<template>
    <TransitionGroup
        enter-from-class="translate-y-full opacity-0"
        enter-active-class="duration-1000"
        leave-active-class="duration-1000"
        leave-to-class="translate-y-full opacity-0"
    >
    <div v-if="show" class="fixed z-[10000] w-full bg-white bottom-0 w-screen drop-shadow bg-teal-50">
       <div class="w-screen px-3 md:px-14 py-5">
           <div class="flex justify-between px-3">
               <div>
                   <h1 class="font-bold text-4xl">TAKE 10% OFF </h1>
                   <p class="mt-2 text-sm text-lg text-black-100">Your first purchase when you sign up for email</p>
               </div>
               <div>
                  <button @click="hide">
                      <span class="text-4xl"><i class="fal fa-times"></i></span>
                  </button>
               </div>
           </div>
           <div class="my-3 mx-3">
               <form @submit.prevent="submit">
                   <div class="grid md:grid-cols-3 gap-2 my-3">
                       <div class="w-full">
                           <input v-model="form.name" type="text" class="w-full p-3 border focus:border-teal-700 focus:ring-0 bg-transparent  rounded-full" placeholder="Your Name">
                           <div v-if="form.errors.name" class="mt-3 text-red-800 text-sm">
                               <span>{{ form.errors.name }}</span>
                           </div>
                       </div>
                       <div class="w-full">
                           <input v-model="form.email" type="email" class="w-full p-3 border focus:border-teal-700 focus:ring-0 bg-transparent  rounded-full" placeholder="Your Email">
                           <div v-if="form.errors.email" class="mt-3 text-red-800 text-sm">
                               <span>{{ form.errors.email }}</span>
                           </div>
                       </div>
                       <div>
                           <button type="submit" class="bg-teal-700 text-white rounded-full py-3 px-5 font-semibold">Subscribe <span class="ml-3"><i class="fal fa-long-arrow-right"></i></span></button>
                       </div>
                   </div>
               </form>
           </div>
       </div>
    </div>
        </TransitionGroup>
</template>

<script setup lang="ts">
import {useForm} from "@inertiajs/inertia-vue3";
import useLocalStorage from "@/scripts/use/useLocalStorage";
import {computed, onMounted, ref} from "vue";
const emits=defineEmits(['close','open'])

let props=defineProps({
    show:Boolean,
})

let form=useForm({
    name:'',
    email:''
})
const subscribe = localStorage.getItem('subscribe')
const timer=[
    {subscribed:1,timer:new Date().toString()}
]
function subtractHours(date, hours) {
    date.setHours(date.getHours() - hours);

    return date;
}
onMounted(()=>{
    if (!subscribe){
        setTimeout(()=>{
            emits('open')
        },5000)
    }else {
        const data=JSON.parse(subscribe)
        const date=new Date()
        if (subtractHours(date,10)>new Date(data[0].timer)){
            emits('open')
        }
    }
})
const submit=()=>{
    form.post(route('subscribe'),{
        onSuccess:()=>{
            form.reset();
            emits('close');

           localStorage.setItem('subscribe',JSON.stringify(timer))

        }
    })
}
const hide=()=>{
    emits('close')

    localStorage.setItem('subscribe',JSON.stringify(timer))
}

const launcher=computed(()=>{

})
</script>

<style scoped>

</style>
