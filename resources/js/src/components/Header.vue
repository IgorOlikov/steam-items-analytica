<template>
    <div class="bg-slate-400 h-64">
        <h1>HEADER COMPONENT</h1>
        <router-link to="/">Главная</router-link>
        <router-link to="/about">О сайте</router-link>
        <router-link to="/catalog">Каталог</router-link>
        <div>
            <ul>
                <li v-if="!authStore.auth"><router-link to="/login">Войти</router-link></li>
                <li v-else><router-link to="/profile">Профиль</router-link></li>
            </ul>
        </div>
        <catalog-menu/>
    </div>



</template>

<script setup>
import {useAuthStore} from "@/store/AuthStore.js";
import CatalogMenu from "@/components/CatalogMenu.vue";

const authStore = useAuthStore();




</script>

<style scoped>

</style>
