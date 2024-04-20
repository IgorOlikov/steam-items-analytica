<template>
    <p>{{ id }}</p>
    <p>{{ name }}</p>
    <p>{{ image }}</p>
    <p>{{ price }}</p>
    <p>{{ quantity }}</p>
</template>

<script setup>

defineProps({
    id: String,
    image: String,
    price: Number,
    quantity: Number,
    name: String,
})

</script>

<style scoped>

</style>
