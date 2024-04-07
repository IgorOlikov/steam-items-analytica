<template>

    <div class="bg-white w-4/6 m-auto rounded-xl shadow-xl">
        <Header/>
            <catalog-menu v-if="showMenu"/>


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
import {provide, onMounted, ref, onBeforeUpdate} from "vue";
import CatalogMenu from "@/components/MegaMenu/Menu.vue";


const authStore = useAuthStore()


const showMenu = ref(false)

provide('showMenus', {
    showMenu
})

onMounted(() => {
    authStore.checkUserAuthStatus();
})

onBeforeUpdate(() => {
    removeCatalogFromLocalStorage()
})

const removeCatalogFromLocalStorage = async () => {
    localStorage.removeItem('catalog')
}

</script>


<style scoped>

</style>
