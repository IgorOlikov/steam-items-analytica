<script setup>
defineProps({
    id: String,
    name: String,
    slug: String,
    parentId: {
        type: [String],
        default: null,
    },
    categories: Array,
})
</script>

<template>
    <h1> {{ name }}</h1>
</template>

<style scoped>

</style>
