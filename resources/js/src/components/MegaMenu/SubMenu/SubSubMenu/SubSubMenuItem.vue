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
    <div class="hover:text-amber-300">
        <a :href="`/catalog/category/${slug}/product`">
            <h1> {{ name }}</h1>
        </a>
    </div>
</template>

<style scoped>

</style>
