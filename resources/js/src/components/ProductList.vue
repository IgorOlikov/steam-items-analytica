<template>

    <div class="flex-row space-y-4">
    <product-item
        class=""
        v-for="product in products"
        :key="product.id"
        :name="product.name"
        :price="product.price"
        :id="product.id"
        :slug="product.slug"
    />
    </div>
</template>

<script setup>

import ProductItem from "@/components/ProductItem.vue";

defineProps({
   products: Array,
});

</script>


<style scoped>

</style>
