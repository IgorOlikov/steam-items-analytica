<template>
    <div class="grid grid-cols-4 gap-5 px-24 py-20 min-h-max">

        <div class="border-2 rounded-xl">
            <RouterLink :to="{ name: 'catalog'}">
                <div class="flex flex-col p-5">
                    <div class="basis-1/3">
                        <h1>Каталог</h1>
                    </div>
                    <div class="mt-10 basis-1/3">
                        <h1>Большой выбор товаров</h1>
                    </div>
                    <div class="mt-10 basis-1/3">
                       <img  :src="`${authStore.appDomain}/shop/catalog.png`"/>
                    </div>
                </div>
            </RouterLink>
        </div>
        <div class="border-2 rounded-xl"></div>
        <div class="border-2 rounded-xl"></div>
        <div class="border-2 rounded-xl"></div>

    </div>
</template>

<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";
import Header from "@/components/Header.vue";
import {useAuthStore} from "@/store/AuthStore.js";

const authStore = useAuthStore()


</script>

<style scoped>

</style>
