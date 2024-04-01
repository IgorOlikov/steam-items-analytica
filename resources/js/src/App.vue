<template>

    <div class="bg-white w-4/5 m-auto rounded-xl shadow-xl">
        <Header/>
            <div class="min-h-screen">

                <router-view></router-view>
            </div>
        <Footer></Footer>
    </div>

</template>

<script setup>
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import {useAuthStore} from "@/store/AuthStore.js";
import {onMounted} from "vue";

const authStore = useAuthStore()


onMounted(() => {
    authStore.checkUserAuthStatus()
})

</script>


<style scoped>

</style>
