<template>

    <div class="bg-white w-4/6 m-auto rounded-xl shadow-xl">
        <Header/>
            <catalog-menu v-if="showMenu"/>

            <!-- router view begins -->
            <div class="min-h-screen border-b-2">
                <router-view :key="$route.path"></router-view>
            </div>
             <!-- router view ends -->

        <Footer></Footer>
    </div>

</template>

<script setup>
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import {useAuthStore} from "@/store/AuthStore.js";
import {provide, onMounted, ref, onBeforeUpdate, watch, computed} from "vue";
import CatalogMenu from "@/components/MegaMenu/Menu.vue";
import {useWishlistStore} from "@/store/WishlistStore.js";
import {useCartStore} from "@/store/CartStore.js";


const authStore = useAuthStore()
const wishlistStore = useWishlistStore()
const cartStore = useCartStore()
const showMenu = ref(false)

provide('showMenus', {
    showMenu
})

onMounted(() => {
    authStore.checkUserAuthStatus();
    wishlistStore.getWishListFromLocalStorage();
    cartStore.getCart();


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
