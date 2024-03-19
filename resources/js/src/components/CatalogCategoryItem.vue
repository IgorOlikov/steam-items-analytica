<script setup>

import {computed} from "vue";

defineProps({
    categories: Array,
    id: String,
    name: String,


})

</script>

<template>

    <div
        v-if="categories.length !== 0"
        class="border">
        <a :href="`/catalog/category/${id}`">
            <p>{{ name }}</p>
        </a>
    </div>
    <div
        v-else
        >
        <a :href="`/category/${id}/products`">
            <p>{{ name}}</p>
        </a>
    </div>


</template>

<style scoped>

</style>
