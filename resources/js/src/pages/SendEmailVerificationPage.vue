<template>
    <div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-200">
        <div class="bg-white dark:bg-green-300 shadow-md rounded-lg px-8 py-6 max-w-md">
            <h1 class="text-2xl font-bold text-center mb-4 dark:border-black">Отправить письмо с ссылкой подтверждения почты</h1>
            <h1
                v-if="authStore.isErrorMessage"
            >
                {{ authStore.errorMessage }}
            </h1>
            <h1
                v-if="successMessage"
            >
                {{ successMessage }}
            </h1>
                <button
                    @click.prevent="sendVerifyEmailLink"
                    type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Отправить
                </button>
        </div>
    </div>
</template>

<script setup>
import axiosJwtApi from "@/Axios/Api.js";
import {useAuthStore} from "@/store/AuthStore.js";
import {ref} from "vue";

const authStore = useAuthStore()

const successMessage = ref('')

async function sendVerifyEmailLink() {
    try {
        const response = await axiosJwtApi.post(`http://localhost/api/v1/auth/email/verify`)

        authStore.errorMessage = ''
        successMessage.value = response.data.message
    } catch (err) {
        authStore.errorMessage = err.response.data.message
    }
}



</script>


<style scoped>

</style>
