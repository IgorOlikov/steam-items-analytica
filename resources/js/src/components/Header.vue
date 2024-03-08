<template>
    <div class="bg-slate-400 h-64">
        <h1>HEADER COMPONENT</h1>
        <router-link to="/">Link to home</router-link>
        <router-link to="/about">Link to about</router-link>
        <div>
            <ul>
                <li><router-link to="login">Login</router-link></li>
                <li><router-link to="register">Register</router-link></li>
            </ul>
        </div>
    </div>



</template>

<script setup>
import {useAuthStore} from "@/store/AuthStore.js";

const authStore = useAuthStore();


</script>

<style scoped>

</style>
