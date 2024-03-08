<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";
import Header from "@/components/Header.vue";


const products = ref([]);

async function fetchApi() {
    const { data }  = await axios.get(`http://localhost/api/v1/product`)

    console.log(data)
    products.value = data.map((obj) => ({
        ...obj
    }));
    console.log(products.value);
}

onMounted(async () => {
    await fetchApi()
    ;});
</script>

<template>
    <h1>Home Page</h1>
    <h1 v-for="product in products"  class="text-amber-300">APP COMPONENT{{ product.name }}</h1>
</template>

<style scoped>

</style>
