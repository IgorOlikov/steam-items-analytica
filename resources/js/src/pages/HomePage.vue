<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";
import Header from "@/components/Header.vue";


const products = ref([]);

async function fetchApi() {
    const { data }  = await axios.get(`http://localhost/api/v1/product`)


    //products.value = data.map((obj) => ({
    //    ...obj
    //}));

    products.value = data

}

onMounted(async () => {
    await fetchApi()

});
</script>

<template>
    <div>
    <h1>Home Page</h1>
    <router-link to="/catalog">Каталог</router-link>
    <h1 v-for="product in products"  class="text-amber-300">APP COMPONENT{{ product.name }}</h1>
    </div>
</template>

<style scoped>

</style>
