<template>
    <div class="bg-slate-400 h-64">
        <h1>HEADER COMPONENT</h1>
        <router-link to="/">Главная</router-link>
        <router-link to="/about">О сайте</router-link>
        <router-link to="/catalog">Каталог</router-link>
        <div>
            <div v-if="!authStore.auth">
                <ul>
                    <li><router-link to="/login">Войти</router-link></li>
                    <li><router-link to="/register">Зарегестрироваться</router-link></li>
                </ul>
            </div>
            <div v-else>
                <ul>
                    <li><router-link to="/profile">Профиль</router-link></li>
                    <li
                        @click="authStore.logout()"
                        class="cursor-pointer">Выйти</li>
                </ul>
            </div>
        </div>
        <catalog-menu/>
    </div>



</template>

<script setup>
import {useAuthStore} from "@/store/AuthStore.js";
import CatalogMenu from "@/components/CatalogMenu.vue";
import {ref} from "vue";

const authStore = useAuthStore();

const wishList = ref([]);
const cart = ref([]);

</script>

<style scoped>

</style>
