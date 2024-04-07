<template>
    <div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-200">
        <div class="bg-white dark:bg-green-300 shadow-md rounded-lg px-8 py-6 max-w-md">
            <h1 class="text-2xl font-bold text-center mb-4 dark:border-black">Введите данные</h1>
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
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-black mb-2">Новый пароль </label>
                    <input
                        v-model="password"
                        type="password"
                        id="password_confirm"
                        placeholder="Введите пароль"
                        required
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-black mb-2">Подтвердите новый пароль</label>
                    <input
                        v-model="confirmPassword"
                        type="password"
                        id="password"
                        placeholder="Подтвердите пароль"
                        required
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <button
                    @click.prevent="sendResetRequest"
                    type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Сбросить пароль
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import router from "@/router/router.js";
import {useRoute} from "vue-router";
import {ref} from "vue";
import axios from "axios";
import {useAuthStore} from "@/store/AuthStore.js";

const authStore = useAuthStore()
const route = useRoute();

const token = ref('')

const email = ref('')

const password = ref('')

const confirmPassword = ref('')

const successMessage = ref('')

token.value = route.query.token

email.value = route.query.email

const sendResetRequest = async () => {
    if (password.value !== confirmPassword.value) {
        authStore.errorMessage = 'Пароли не совпадают'
        } else {
    try {
        const response = await axios.post(`${authStore.appDomain}${authStore.apiVersion}/auth/reset-password`, {
            token: token.value,
            email: email.value,
            password: password.value
        })
        successMessage.value = response.data.message
        successMessage.value = ''
        authStore.errorMessage = ''
        await router.push('/login')
    } catch (err) {
        console.log(err.response.data)
        authStore.errorMessage = err.response.data.message
    }

  }
}



</script>


<style scoped>

</style>
