<template>
    <div class="min-h-screen flex items-center justify-center w-full bg-white">
        <div class="bg-white dark:bg-white shadow-md rounded-lg px-8 py-6 max-w-md">
            <h1 class="text-2xl font-bold text-center mb-4 text-black">Добро пожаловать!</h1>
            <h1
                v-if="authStore.isErrorMessage"
            >
                {{ authStore.errorMessage }}
            </h1>
            <form action="#">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium  text-black mb-2">Email Адрес</label>
                    <input
                        v-model="email"
                        type="email"
                        id="email"
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Ваш@email.com"
                        required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-black mb-2">Пароль</label>
                    <input
                        v-model="password"
                        type="password"
                        id="password"
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Ваш пароль"
                        required>
                    <RouterLink :to="{ name: 'forgotPassword' }"
                       class="text-xs text-gray-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Забыл пароль?</RouterLink>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 focus:outline-none" checked>
                        <label for="remember" class="ml-2 block text-sm text-black">Запомнить меня</label>
                    </div>
                    <RouterLink :to="{ name: 'register' }"
                        class="text-xs text-indigo-500 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Зарегестрироваться
                    </RouterLink>
                </div>
                <button
                    @click.prevent="authStore.sighIn(email,password)"
                    type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Login
                </button>
            </form>
        </div>
    </div>
</template>
<script setup>
import {ref} from "vue";
import {useAuthStore} from "@/store/AuthStore.js";
import router from "@/router/router.js";



const email = ref('');
const password = ref('');


const authStore = useAuthStore();



</script>



<style scoped>

</style>
