<template>
    <div class="border-b-2 bg-white h-32"> <!--1-->
            <div class="flex flex-row h-full items-center px-12"> <!-- flex flex row-->

                <div class="basis-4/12   "> <!--row 1-->
                   <div class="flex flex-row px-10">
                        <div class="h-12">
                            <RouterLink :to="{ name: 'home' }">
                                <img  width="50" height="50" :src="`${authStore.appDomain}/logo.jpg`" alt="logo">
                            </RouterLink>
                        </div>
                        <div class="h-12 flex-1 w-full">
                            <button
                                @click.prevent="toggleMenu"
                                class="bg-red-300 w-full h-full rounded-3xl hover:bg-red-400 ">
                                Каталог
                            </button>
                        </div>
                   </div>
                </div> <!--row 1-->

                <div class="basis-11/12 border-l-red-900"> <!--row 2 Global Search-->
                    <SearchInput/>
                </div>

                <div class="basis-4/12 border-l-red-900"> <!--row 3-->

                    <div class="flex flex-row">

                        <div class="cursor-pointer hover:border-2 rounded-2xl hover:shadow basis-1/3">
                            <RouterLink :to="{ name: 'wishlist' }">
                                <wishlist-button class="p-1"/>
                            </RouterLink>
                        </div>
                        <div class="cursor-pointer hover:border-2 rounded-2xl hover:shadow basis-1/3">
                            <RouterLink :to="{ name: 'cart' }">
                                <cart-button class="p-1"/>
                            </RouterLink>
                        </div>

                        <div class="cursor-pointer hover:border-2 rounded-2xl hover:shadow basis-1/3">
                            <RouterLink :to="{ name: 'profile' }">
                                <profile-button class="p-1"/>
                            </RouterLink>
                        </div>

                        </div>

                </div> <!--row 3-->
            </div> <!-- flex flex row-->
    </div> <!--1-->
</template>

<script setup>
import {useAuthStore} from "@/store/AuthStore.js";
import {inject} from "vue";
import SearchInput from "@/UI/SearchInput.vue";
import CartButton from "@/components/Cart/CartComponent.vue";
import WishlistButton from "@/components/Wishlist/WishlistComponent.vue";
import ProfileButton from "@/components/ProfileComponent.vue";

const authStore = useAuthStore();

const { showMenu } = inject('showMenus')

const toggleMenu = async () => {
    showMenu.value ? showMenu.value = false : showMenu.value = true
}



</script>

<style scoped>

</style>
