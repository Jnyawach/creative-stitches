<template>
<admin>
    <Head>
        <title>Messages</title>
    </Head>
    <title-block>
        <h6 class="font-bold text-sm">Message from {{message.data.name}}</h6>
        <template #info >
            <p class="text-sm"><span class="ml-2 mr-2 text-teal-900"><i class="fas fa-info-circle"></i></span>Subject:  {{message.data.subject}}</p>
        </template>
    </title-block>

    <div class="mt-10">
        <div class="flex px-2 py-3 justify-between bg-gray-50">
         <p>{{message.data.subject}}</p>
            <Link :href="route('contact.index')" title="Inbox" class="text-teal-700"><span class="mr-2"><i class="fal fa-long-arrow-alt-left"></i></span>Return to inbox</Link>

        </div>
        <div class="mt-3 px-2">
            <h6 class="font-semibold">{{message.data.name}}: {{message.data.email}} on <span class="ml-5 text-teal-700">{{new Date(message.data.created_at).toDateString()}}</span></h6>
            <hr class="mt-2">
            <p class="py-3">{{message.data.message}}</p>
            <hr>
            <div v-if="message.data.status===2" class="mt-3">
                <h6 class="font-bold text-teal-700 mt-3">{{message.data.user.name}} {{message.data.user.last_name}} responded on {{new Date(message.data.updated_at).toDateString()}}</h6>

                <p>{{message.data.response }}</p>

            </div>
            <div v-else class="bg-gray-50 py-3 px-2">
                <h6>Respond to this message</h6>
                <form @submit.prevent="submit">
                    <textarea rows="8" required class="creative-text-input" placeholder="Enter Response Message"
                              v-model="form.response"></textarea>
                    <div v-if="form.errors.response" class="creative-error">
                        <span>{{ form.errors.response }}</span>
                    </div>
                    <div class="mt-3 flex justify-end">
                        <button type="submit" class="btn-primary">
                            Send Response
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <template #sidebar>
        <div class="mt-3">
            <Link :href="route('contact.destroy',message.data.id)" class="text-sm btn-danger"  method="delete" as="button">
                <span class="mr-2"><i class="far fa-trash-alt"></i></span>Delete Message
            </Link>
        </div>
    </template>
</admin>
</template>

<script setup lang="ts">

import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TitleBlock from "@/views/components/title-block.vue";
import {Link} from "@inertiajs/inertia-vue3";
import {useForm} from "@inertiajs/inertia-vue3";


let props=defineProps({
    message:Object
})

let form=useForm({
    response:'',
    _method:'patch'
})

const submit=()=>{
    form.post(route('contact.update',props.message.data.id),{
        onSuccess:()=>{
            form.reset()
        }
    })
}
</script>

<style scoped>

</style>
