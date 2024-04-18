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
        <RouterLink :to="{ name: 'categoryProducts', params: { categorySlug: slug }}">
            <h1> {{ name }}</h1>
        </RouterLink>
    </div>
</template>

<style scoped>

</style>
