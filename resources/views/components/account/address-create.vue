<template>
    <teleport to="body">
        <Transition
            enter-from-class="opacity-0 scale-125"
            enter-to-class="opacity-100 scale-100"
            enter-active-class="transition duration-300"
            leave-active-class="transition duration-200"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-125"
        >
            <div v-if="show" class="inset-0 fixed bg-black-100 bg-opacity-70 z-50 grid place-items-center p-5" >
                <div class="bg-white lg:w-1/2 w-full rounded-xl p-3">
                    <div>
                        <div class="flex justify-end">
                            <button class="bg-teal-600 hover:bg-teal-700 rounded-full h-8 w-8 flex place-content-center" type="button" @click="$emit('close')">

                                <svg class="h-5 self-center fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M312.1 375c9.369 9.369 9.369 24.57 0 33.94s-24.57 9.369-33.94 0L160 289.9l-119 119c-9.369 9.369-24.57 9.369-33.94 0s-9.369-24.57 0-33.94L126.1 256L7.027 136.1c-9.369-9.369-9.369-24.57 0-33.94s24.57-9.369 33.94 0L160 222.1l119-119c9.369-9.369 24.57-9.369 33.94 0s9.369 24.57 0 33.94L193.9 256L312.1 375z"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="p-3">
                       <h6 class="font-bold text-center">Add a New Address</h6>
                        <div class="mt-5">
                          <form @submit.prevent="submit">
                              <div class="mt-3 grid md:grid-cols-2 gap-2">
                                  <div>
                                      <label for="address_create" class="creative-label">Address<sup class="text-red-900 text-[9px]"><i class="fas fa-star-of-life"></i></sup></label>
                                      <input type="text" class="creative-input" id="address_create" placeholder="Enter Address" required v-model="form.address"/>
                                      <div v-if="form.errors.address" class="creative-error">
                                          <span>{{ form.errors.address }}</span>
                                      </div>
                                  </div>
                                  <div>
                                      <label for="zip_create" class="creative-label">Zip Code<sup class="text-red-900 text-[9px]"><i class="fas fa-star-of-life"></i></sup></label>
                                      <input type="text" class="creative-input" id="zip_create" placeholder="Your zip Code" required v-model="form.zip"/>
                                      <div v-if="form.errors.zip" class="creative-error">
                                          <span>{{ form.errors.zip }}</span>
                                      </div>
                                  </div>
                              </div>
                              <div class="mt-5 grid md:grid-cols-2 gap-2">
                                  <div>
                                      <label for="city_create" class="creative-label">City<sup class="text-red-900 text-[9px]"><i class="fas fa-star-of-life"></i></sup></label>
                                      <input type="text" class="creative-input" id="city_create" placeholder="Your City Name" required v-model="form.city"/>
                                      <div v-if="form.errors.city" class="creative-error">
                                          <span>{{ form.errors.city }}</span>
                                      </div>
                                  </div>
                                  <div>
                                      <label for="country_create" class="creative-label">Country<sup class="text-red-900 text-[9px]"><i class="fas fa-star-of-life"></i></sup></label>
                                      <select required class="creative-input" v-model="form.country_id" id="country_create">
                                          <option selected value="">Select Country</option>
                                          <option :value="country.id" v-for="country in countries" :key="country_id">{{country.name}}</option>

                                      </select>
                                      <div v-if="form.errors.country_id" class="creative-error">
                                          <span>{{ form.errors.country_id }}</span>
                                      </div>
                                  </div>
                              </div>

                              <div class="mt-5 flex justify-end">
                                  <button type="submit" class="btn-primary">Save Address</button>
                              </div>
                          </form>
                        </div>
                    </div>


                </div>
            </div>
        </Transition>
    </teleport>
</template>

<script setup lang="ts">
import {useForm} from "@inertiajs/inertia-vue3";
import {useCountry} from "@/scripts/use/useCountry";
import {Button} from "flowbite-vue";
const emits=defineEmits(['close'])
emits("close")
let props=defineProps({
    show:Boolean,
    user:Object
})

let form=useForm({
    address:'',
    zip:'',
    country_id:'',
    city:'',
    user_id:props.user
})
const {countries}=useCountry()
const submit=()=>{
    form.post(route('address.store'),{
        onSuccess:()=>{
            form.reset();
            emits("close")
        }
    })
}
</script>

<style scoped>

</style>
