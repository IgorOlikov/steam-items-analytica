<template>

    <div class="flex flex-col gap-10 ">
    <product-item
        class=""
        v-for="product in products"
        :key="product.id"
        :name="product.name"
        :price="product.price"
        :id="product.id"
        :slug="product.slug"
        :image="product.image"
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
