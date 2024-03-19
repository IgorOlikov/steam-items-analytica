<template>
    <h1>Product Page</h1>
    <h1>{{ product }}</h1>
</template>

<script setup>
import {onMounted, ref} from "vue";
import {useRoute} from "vue-router";
import axios from "axios";

const product = ref([])

const route = useRoute();
const productId = route.params.productId;
const categoryId = route.params.categoryId;

//console.log(route.params)

async function fetchCatalog() {
    const { data } = await axios.get(`http://localhost/api/v1/category/${categoryId}/product/${productId}`)

   product.value = data;

    //product.value = data.map((obj) => ({
    //    ...obj
    //}));
}

onMounted(async () => {
    await fetchCatalog()

});
</script>

<style scoped>

</style>
