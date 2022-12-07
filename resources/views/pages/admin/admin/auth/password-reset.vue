<template layout>
    <Head>
        <title>Reset Password</title>
        <meta head-key="description" name="description" content="Reset your Password" />

    </Head>
    <forgot-password-form
        url="/admin/auth/password-store"
    >
    </forgot-password-form>

</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import ForgotPasswordForm from "@/views/components/auth/forgot-password-form.vue";
</script>
