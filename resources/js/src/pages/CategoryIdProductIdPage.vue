<template>
    <h1>Product Page</h1>
    <p>Product ID = {{ product.id }}</p>
    <p>Category ID = {{ product.category_id }}</p>
    <p>Name = {{ product.name }}</p>
    <p>Price = {{ product.price }}</p>
</template>

<script setup>
import {onMounted, ref} from "vue";
import {useRoute} from "vue-router";
import axios from "axios";

const product = ref([])

const route = useRoute();
const { productId, categoryId } = route.params


async function fetchCatalog() {
    const { data } = await axios.get(`http://localhost/api/v1/category/${categoryId}/product/${productId}`)

   product.value = data;
}

onMounted(async () => {
    await fetchCatalog()

});
</script>

<style scoped>

</style>
