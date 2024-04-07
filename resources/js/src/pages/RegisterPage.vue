<template>
    <div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-200">
        <div class="bg-white dark:bg-green-300 shadow-md rounded-lg px-8 py-6 max-w-md">
            <h1 class="text-2xl font-bold text-center mb-4 dark:border-black">Добро пожаловать!</h1>
            <h1
                v-if="authStore.isErrorMessage"
            >
                {{ authStore.errorMessage }}
            </h1>
            <form action="#">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-black mb-2">Email Адрес</label>
                    <input
                        v-model="email"
                        type="email"
                        id="email"
                        placeholder="Ваш@email.com"
                        required
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-black mb-2">Имя</label>
                    <input
                        v-model="name"
                        type="email"
                        id="email"
                        placeholder="Мой никнейм"
                        required
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-black mb-2">Пароль </label>
                    <input
                        v-model="password"
                        type="password"
                        id="password"
                        placeholder="Введите пароль"
                        required
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-black mb-2">Подтвердите пароль</label>
                    <input
                        v-model="confirmPassword"
                        type="password"
                        id="password"
                        placeholder="Подтвердите пароль"
                        required
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="remember"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 focus:outline-none"
                            checked>
                        <label for="remember" class="ml-2 block text-sm text-gray-700 dark:text-blue-700">Запомнить меня</label>
                    </div>
                    <a href="/login"
                       class="text-xs text-indigo-500 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Войти</a>
                </div>

                <button
                    @click.prevent="authStore.signUp(email, name, password ,confirmPassword)"
                    type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Зарегистрироваться
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import {ref} from "vue";
import {useAuthStore} from "@/store/AuthStore.js";

const email = ref('');
const password = ref('');
const name = ref('');
const confirmPassword = ref('');

const authStore = useAuthStore();

</script>


<style scoped>

</style>
