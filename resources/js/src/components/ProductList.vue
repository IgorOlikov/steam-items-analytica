<template>

    <product-item
        v-for="product in products"
        :key="product.id"
        :name="product.name"
        :price="product.price"
        :id="product.id"
        :slug="product.slug"
    />

</template>

<script setup>

import ProductItem from "@/components/ProductItem.vue";

defineProps({
   products: Array,
});

</script>


<style scoped>

</style>
