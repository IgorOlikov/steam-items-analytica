<template>
    <div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-200">
        <div class="bg-white dark:bg-green-300 shadow-md rounded-lg px-8 py-6 max-w-md">
            <h1 class="text-2xl font-bold text-center mb-4 text:black">Отправить ссылку для сброса пароля</h1>
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
            <form action="#">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 text:black mb-2">Email Адрес</label>
                    <input
                        v-model="email"
                        type="email"
                        id="email"
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="your@email.com"
                        required>
                </div>

                <button
                    @click.prevent="sendResetMail(email)"
                    type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Отправить
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import {ref} from "vue";
import {useAuthStore} from "@/store/AuthStore.js";
import axios from "axios";

const authStore = useAuthStore()

const email = ref('')
const successMessage = ref('')

const sendResetMail = async (email) => {
    try {
        const response = await axios.post(`${authStore.appDomain}${authStore.apiVersion}/auth/forgot-password`,{
            email: email
        })
        console.log(response.data)
        successMessage.value = response.data.message
    }catch (err) {
        authStore.errorMessage  = err.response.data.message

    }
}


</script>


<style scoped>

</style>
